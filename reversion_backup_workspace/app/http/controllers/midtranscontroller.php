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

<truncated 13551 bytes>

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
                'status_bayar_konsultasi'   => 'Sukses/Lunas',
                'payment_type_konsultasi'   => $paymentType,
                'midtrans_status_konsultasi'=> 'settlement',
                'status' => $keluhan->status === 'baru' ? 'proses' : $keluhan->status,
            ]);

            // Update konsultasi jadi menunggu/proses
            Konsultasi::where('id_keluhan', $keluhan->id)->update(['status' => 'proses']);
        } else {
            $keluhan->update([
                'status_bayar_konsultasi'    => 'gagal',
                'midtrans_status_konsultasi' => 'expire',
            ]);
        }

        return response()->json(['success' => true]);
    }
}
