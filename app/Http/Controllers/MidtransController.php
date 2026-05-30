<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use App\Models\Konsultasi;
use App\Models\Pesanan;
use App\Models\Petani;
use App\Models\Konsultan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;
use Midtrans\Notification;

class MidtransController extends Controller
{
    /**
     * Inisialisasi konfigurasi Midtrans dari config/midtrans.php
     */
    private function setupMidtrans(): void
    {
        MidtransConfig::$serverKey    = config('midtrans.server_key');
        MidtransConfig::$isProduction = config('midtrans.is_production');
        MidtransConfig::$isSanitized  = config('midtrans.is_sanitized');
        MidtransConfig::$is3ds        = config('midtrans.is_3ds');
    }

    /**
     * Buat Snap Token untuk pembayaran PRODUK (pesanan toko).
     * Dipanggil via AJAX dari dashboard petani.
     *
     * POST /petani/midtrans/token/pesanan/{id}
     */
    public function tokenPesanan(Request $request, $id)
    {
        $this->setupMidtrans();

        $pesanan = Pesanan::with(['toko'])->findOrFail($id);
        $petani  = Petani::where('user_id', Auth::id())->first();

        if (!$petani || $pesanan->id_petani !== $petani->id) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak.'], 403);
        }

        // Jika sudah ada token aktif, kembalikan langsung
        if ($pesanan->snap_token) {
            return response()->json(['success' => true, 'snap_token' => $pesanan->snap_token]);
        }

        // Buat order_id unik
        $orderId = 'DOCTREEN-PRODUK-' . $pesanan->id . '-' . time();

        // Harga dalam rupiah (kalikan 1000 karena tersimpan dalam ribuan)
        $hargaRupiah = (int) ($pesanan->total_harga * 1000);

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $hargaRupiah,
            ],
            'item_details' => [
                [
                    'id'       => 'PRODUK-' . $pesanan->id_produk,
                    'price'    => $hargaRupiah,
                    'quantity' => 1,
                    'name'     => substr($pesanan->nama_produk, 0, 50),
                ],
            ],
            'customer_details' => [
                'first_name' => $petani->nama ?? Auth::user()->name,
                'email'      => Auth::user()->email,
                'phone'      => $petani->telepon ?? '08000000000',
            ],
            'callbacks' => [
                'finish' => url('/petani/dashboard'),
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            // Simpan snap token & order_id ke database
            $pesanan->update([
                'snap_token' => $snapToken,
                'order_id'   => $orderId,
            ]);

            return response()->json(['success' => true, 'snap_token' => $snapToken]);
        } catch (\Exception $e) {
            Log::error('Midtrans tokenPesanan error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal membuat token pembayaran: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Buat Snap Token untuk pembayaran KONSULTASI (keluhan ke konsultan).
     * Dipanggil via AJAX dari dashboard petani.
     *
     * POST /petani/midtrans/token/keluhan/{id}
     */
    public function tokenKeluhan(Request $request, $id)
    {
        $this->setupMidtrans();

        $keluhan = Keluhan::with(['konsultasi.konsultan'])->findOrFail($id);
        $petani  = Petani::where('user_id', Auth::id())->first();

        if (!$petani || $keluhan->id_petani !== $petani->id) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak.'], 403);
        }

        // Jika sudah ada token aktif, kembalikan langsung
        if ($keluhan->snap_token_konsultasi) {
            return response()->json(['success' => true, 'snap_token' => $keluhan->snap_token_konsultasi]);
        }

        // Ambil data konsultan & tarif dari relasi terbaru
        $konsultasi = $keluhan->konsultasi->last();
        $konsultan  = $konsultasi?->konsultan;
        $tarif      = $konsultan ? (int) ($konsultan->tarif_konsultasi * 1000) : 50000;

        // JIKA INI SESI FOLLOW-UP (memiliki parent_id), BERIKAN DISKON 50%
        $isFollowUp = !empty($keluhan->parent_id);
        if ($isFollowUp) {
            $tarif = (int) ($tarif * 0.5);
        }

        // Jika tarif = 0, tidak perlu pembayaran
        if ($tarif <= 0) {
            return response()->json(['success' => false, 'message' => 'Konsultasi ini gratis, tidak perlu pembayaran.']);
        }

        // Buat order_id unik
        $orderId = 'DOCTREEN-KONSUL-' . $keluhan->id . '-' . time();

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $tarif,
            ],
            'item_details' => [
                [
                    'id'       => 'KONSUL-' . $keluhan->id,
                    'price'    => $tarif,
                    'quantity' => 1,
                    'name'     => 'Konsultasi: ' . substr($keluhan->judul_keluhan, 0, 40),
                ],
            ],
            'customer_details' => [
                'first_name' => $petani->nama ?? Auth::user()->name,
                'email'      => Auth::user()->email,
                'phone'      => $petani->telepon ?? '08000000000',
            ],
            'callbacks' => [
                'finish' => url('/petani/dashboard'),
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            // Simpan snap token & order_id
            $keluhan->update([
                'snap_token_konsultasi' => $snapToken,
                'order_id_konsultasi'   => $orderId,
                'status_bayar_konsultasi' => 'menunggu',
            ]);

            return response()->json(['success' => true, 'snap_token' => $snapToken, 'tarif' => $tarif]);
        } catch (\Exception $e) {
            Log::error('Midtrans tokenKeluhan error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal membuat token pembayaran: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Terima Notifikasi (Webhook) dari Midtrans.
     * Route ini TIDAK memerlukan autentikasi & CSRF exempt.
     *
     * POST /midtrans/callback
     */
    public function callback(Request $request)
    {
        try {
            $this->setupMidtrans();
            
            $notification = new Notification();
            $orderId           = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            $fraudStatus       = $notification->fraud_status;
            $paymentType       = $notification->payment_type;
            $statusCode        = $notification->status_code;
            $grossAmount       = $notification->gross_amount;
            $signatureKey      = $notification->signature_key;
            $serverKey         = config('midtrans.server_key');

            // SECURITY: Verifikasi Signature Key dari Midtrans (SHA512)
            $localSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

            if ($localSignature !== $signatureKey) {
                Log::warning("Midtrans Callback Signature Mismatch — Expected: $localSignature | Got: $signatureKey");
                return response()->json(['status' => 'error', 'message' => 'Invalid signature key.'], 403);
            }

            Log::info("Midtrans Callback — Order: $orderId | Status: $transactionStatus | Fraud: $fraudStatus");

            // Tentukan apakah pembayaran sukses
            $berhasil = ($transactionStatus === 'settlement') ||
                        ($transactionStatus === 'capture' && $fraudStatus === 'accept');

            $gagal = in_array($transactionStatus, ['deny', 'expire', 'cancel', 'failure']);

            // === Proses Pesanan Produk ===
            if (str_starts_with($orderId, 'DOCTREEN-PRODUK-') || str_starts_with($orderId, 'PESANAN-')) {
                $pesanan = Pesanan::where('order_id', $orderId)->first();
                if ($pesanan) {
                    if ($berhasil) {
                        $pesanan->update([
                            'status_bayar'    => 'Selesai',
                            'payment_type'    => $paymentType,
                            'midtrans_status' => $transactionStatus,
                        ]);
                    } elseif ($gagal) {
                        $pesanan->update([
                            'midtrans_status' => $transactionStatus,
                            'status_bayar'    => 'gagal',
                        ]);
                        // RESTORE PRODUCT STOCK ON TRANSACTION FAILURE
                        if ($pesanan->produk) {
                            $pesanan->produk->increment('stok', $pesanan->kuantitas);
                        }
                    }
                }
            }

            // === Proses Konsultasi Keluhan ===
            if (str_starts_with($orderId, 'DOCTREEN-KONSUL-') || str_starts_with($orderId, 'KELUHAN-')) {
                $keluhan = Keluhan::where('order_id_konsultasi', $orderId)->first();
                if ($keluhan) {
                    if ($berhasil) {
                        $keluhan->update([
                            'status_bayar_konsultasi'   => 'Selesai',
                            'payment_type_konsultasi'   => $paymentType,
                            'midtrans_status_konsultasi'=> $transactionStatus,
                            // Otomatis ubah status keluhan jadi 'proses' setelah dibayar
                            'status' => $keluhan->status === 'baru' ? 'proses' : $keluhan->status,
                        ]);

                        // Update sesi konsultasi terbaru yang masih menunggu
                        Konsultasi::where('id_keluhan', $keluhan->id)->where('status', 'menunggu')->update(['status' => 'proses']);
                    } elseif ($gagal) {
                        $keluhan->update([
                            'midtrans_status_konsultasi' => $transactionStatus,
                            'status_bayar_konsultasi'    => 'gagal',
                        ]);
                    } else {
                        $keluhan->update([
                            'midtrans_status_konsultasi' => $transactionStatus,
                            'payment_type_konsultasi'    => $paymentType,
                        ]);
                    }
                }
            }

            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Cek status pembayaran terkini (dipanggil via polling frontend).
     *
     * GET /petani/midtrans/status/pesanan/{id}
     */
    public function statusPesanan($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $petani  = Petani::where('user_id', Auth::id())->first();

        if (!$petani || $pesanan->id_petani !== $petani->id) {
            return response()->json(['success' => false], 403);
        }

        return response()->json([
            'success'      => true,
            'status_bayar' => $pesanan->status_bayar,
            'payment_type' => $pesanan->payment_type,
        ]);
    }

    /**
     * Cek status pembayaran konsultasi (dipanggil via polling frontend).
     *
     * GET /petani/midtrans/status/keluhan/{id}
     */
    public function statusKeluhan($id)
    {
        $keluhan = Keluhan::findOrFail($id);
        $petani  = Petani::where('user_id', Auth::id())->first();

        if (!$petani || $keluhan->id_petani !== $petani->id) {
            return response()->json(['success' => false], 403);
        }

        return response()->json([
            'success'      => true,
            'status_bayar' => $keluhan->status_bayar_konsultasi,
            'payment_type' => $keluhan->payment_type_konsultasi,
        ]);
    }

    /**
     * Update status pembayaran pesanan secara langsung (untuk simulasi/localhost).
     *
     * POST /petani/midtrans/update/pesanan/{id}
     */
    public function updateStatusPesanan(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'payment_type' => 'nullable|string',
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $petani  = Petani::where('user_id', Auth::id())->first();

        if (!$petani || $pesanan->id_petani !== $petani->id) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak.'], 403);
        }

        $status = $request->status; // 'success' or 'cancel'
        $paymentType = $request->payment_type ?? 'qris';

        if ($status === 'success') {
            $pesanan->update([
                'status_bayar'    => 'Selesai',
                'payment_type'    => $paymentType,
                'midtrans_status' => 'settlement',
            ]);
        } else {
            $pesanan->update([
                'status_bayar'    => 'gagal',
                'midtrans_status' => 'expire',
            ]);
            // RESTORE PRODUCT STOCK ON TRANSACTION FAILURE
            if ($pesanan->produk) {
                $pesanan->produk->increment('stok', $pesanan->kuantitas);
            }
        }

        return response()->json(['success' => true]);
    }

    /**
     * Update status pembayaran keluhan secara langsung (untuk simulasi/localhost).
     *
     * POST /petani/midtrans/update/keluhan/{id}
     */
    public function updateStatusKeluhan(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'payment_type' => 'nullable|string',
        ]);

        $keluhan = Keluhan::findOrFail($id);
        $petani  = Petani::where('user_id', Auth::id())->first();

        if (!$petani || $keluhan->id_petani !== $petani->id) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak.'], 403);
        }

        $status = $request->status; // 'success' or 'cancel'
        $paymentType = $request->payment_type ?? 'qris';

        if ($status === 'success') {
            $keluhan->update([
                'status_bayar_konsultasi'   => 'Selesai',
                'payment_type_konsultasi'   => $paymentType,
                'midtrans_status_konsultasi'=> 'settlement',
                'status' => $keluhan->status === 'baru' ? 'proses' : $keluhan->status,
            ]);

            // Update sesi konsultasi terbaru yang masih menunggu
            Konsultasi::where('id_keluhan', $keluhan->id)->where('status', 'menunggu')->update(['status' => 'proses']);
        } else {
            $keluhan->update([
                'status_bayar_konsultasi'    => 'gagal',
                'midtrans_status_konsultasi' => 'expire',
            ]);
        }

        return response()->json(['success' => true]);
    }
}