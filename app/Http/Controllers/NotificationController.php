<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use App\Models\Pesanan;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config as MidtransConfig;
use Midtrans\Notification;

class NotificationController extends Controller
{
    private function setupMidtrans()
    {
        MidtransConfig::$serverKey    = config('midtrans.server_key');
        MidtransConfig::$isProduction = config('midtrans.is_production');
        MidtransConfig::$isSanitized  = config('midtrans.is_sanitized');
        MidtransConfig::$is3ds        = config('midtrans.is_3ds');
    }

    public function callback(Request $request)
    {
        try {
            $this->setupMidtrans();

            // Membaca notifikasi dari Midtrans
            $notification = new Notification();

            $orderId           = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            $fraudStatus       = $notification->fraud_status;
            $paymentType       = $notification->payment_type;
            $statusCode        = $notification->status_code;
            $grossAmount       = $notification->gross_amount;
            $signatureKey      = $notification->signature_key;
            $serverKey         = config('midtrans.server_key');

            // Proteksi Validasi SHA512 Signature Key
            $localSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

            if ($localSignature !== $signatureKey) {
                Log::warning("Midtrans Signature Mismatch. Local: $localSignature | Received: $signatureKey");
                return response()->json(['success' => false, 'message' => 'Invalid signature key.'], 403);
            }

            Log::info("Midtrans Webhook — Order: $orderId | Status: $transactionStatus | Amount: $grossAmount");

            $berhasil = ($transactionStatus === 'settlement') ||
                        ($transactionStatus === 'capture' && $fraudStatus === 'accept');

            $gagal = in_array($transactionStatus, ['deny', 'expire', 'cancel', 'failure']);

            if ($berhasil) {
                // 1. Pembayaran Konsultasi Keluhan
                if (str_starts_with($orderId, 'DOCTREEN-KONSUL-') || str_contains($orderId, 'KONSUL-')) {
                    $parts = explode('-', $orderId);
                    $keluhanId = $parts[2] ?? null;

                    if ($keluhanId) {
                        $keluhan = Keluhan::find($keluhanId);
                        if ($keluhan) {
                            $keluhan->update([
                                'status'                     => 'baru', // Masuk antrean konsultan
                                'status_bayar_konsultasi'   => 'Selesai',
                                'payment_type_konsultasi'   => $paymentType,
                                'midtrans_status_konsultasi'=> $transactionStatus,
                                'last_resolved_at'          => null, // Reset resolved timestamp
                            ]);

                            // Catat ke transaksi terpusat
                            Transaction::updateOrCreate(
                                ['order_id' => $orderId],
                                [
                                    'user_id'     => $keluhan->id_petani,
                                    'tipe_produk' => 'konsultasi',
                                    'produk_id'   => $keluhan->id,
                                    'nominal'     => (int) $grossAmount,
                                    'status'      => 'Selesai',
                                ]
                            );
                        }
                    }
                }
                // 2. Pembayaran Belanja Produk Fisik
                elseif (str_starts_with($orderId, 'DOCTREEN-PRODUK-') || str_contains($orderId, 'PRODUK-')) {
                    $parts = explode('-', $orderId);
                    $pesananId = $parts[2] ?? null;

                    if ($pesananId) {
                        $pesanan = Pesanan::find($pesananId);
                        if ($pesanan) {
                            $pesanan->update([
                                'status_bayar'    => 'Diproses', // Ubah status pesanan menjadi 'Diproses'
                                'payment_type'    => $paymentType,
                                'midtrans_status' => $transactionStatus,
                            ]);

                            // Catat ke transaksi terpusat
                            Transaction::updateOrCreate(
                                ['order_id' => $orderId],
                                [
                                    'user_id'     => $pesanan->id_petani,
                                    'tipe_produk' => 'produk_fisik',
                                    'produk_id'   => $pesanan->id_produk,
                                    'nominal'     => (int) $grossAmount,
                                    'status'      => 'Selesai',
                                ]
                            );
                        }
                    }
                }
            } elseif ($gagal) {
                if (str_starts_with($orderId, 'DOCTREEN-KONSUL-') || str_contains($orderId, 'KONSUL-')) {
                    $parts = explode('-', $orderId);
                    $keluhanId = $parts[2] ?? null;
                    if ($keluhanId) {
                        Keluhan::where('id', $keluhanId)->update([
                            'status_bayar_konsultasi'    => 'gagal',
                            'midtrans_status_konsultasi' => $transactionStatus,
                        ]);
                    }
                } elseif (str_starts_with($orderId, 'DOCTREEN-PRODUK-') || str_contains($orderId, 'PRODUK-')) {
                    $parts = explode('-', $orderId);
                    $pesananId = $parts[2] ?? null;
                    if ($pesananId) {
                        $pesanan = Pesanan::find($pesananId);
                        if ($pesanan) {
                            $pesanan->update([
                                'status_bayar'    => 'gagal',
                                'midtrans_status' => $transactionStatus,
                            ]);
                            // Kembalikan stok produk fisik
                            if ($pesanan->produk) {
                                $pesanan->produk->increment('stok', $pesanan->kuantitas);
                            }
                        }
                    }
                }
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error("Midtrans Notification Error: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
