      font-weight: 700;
      color: var(--g800);
      margin-bottom: 6px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .kel-item-desc {
      font-size: 0.92rem;
      color: var(--tm);
      line-height: 1.6;
      white-space: pre-line;
      margin-bottom: 0.75rem;
      max-height: 5rem;
      overflow: hidden;
    }
    .kel-item-meta {
      font-size: 0.8rem;
      color: var(--gray400);
      margin-top: 6px;
      display: flex;
      align-items: center;
      gap: 12px;
      flex-wrap: wrap;
      font-weight: 600;
    }
    .kel-item-right {
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      gap: 12px;
      flex-shrink: 0;
    }

    /* ─── RESPONSIVENESS / CARD & GRID LAYOUT ADAPTATION ─── */
    @media (max-width: 1024px) {
      .grid2 { grid-template-columns: 1fr; gap: 1.75rem; }
      .main { margin-left: 280px; padding: 2rem; }
    }
    @media (max-width: 768px) {
      body { flex-direction: column; }
      .sb { 
        width: 100%; 
        position: sticky; 
        top: 0; 
        height: auto; 
        padding: 0.75rem 1.5rem; 
        flex-direction: row; 
        align-items: center; 
        justify-content: space-betw
<truncated 44759 bytes>
">
                    <button class="btn-sm" style="padding: 6px 12px; font-size: 0.75rem; background: var(--g600); color: white; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;"
                            data-id="{{ $pes->id }}"
                            data-trx="#TRX-{{ sprintf('%04d', $pes->id) }}"
                            data-tanggal="{{ $pes->tanggal_pesan }}"
                            data-toko="{{ $pes->toko->nama_toko ?? 'Mitra Doctreen' }}"
                            data-produk="{{ $pes->nama_produk }}"
                            data-qty="{{ $pes->kuantitas }}"
                            data-harga="{{ $pes->produk ? $pes->produk->harga * 1000 : ($pes->total_harga / max(1, $pes->kuantitas)) * 1000 }}"
                            data-subtotal="{{ $hargaRupiah }}"
                            data-kirim="{{ $pes->metode_kirim }}"
                            data-bayar="{{ $pes->payment_type ? ucfirst(str_replace('_', ' ', $pes->payment_type)) : ($pes->metode_bayar ?? 'Midtrans') }}"
                            data-status-label="{{ ucfirst($statusBayar) }}"
                            data-status-badge="{{ $badgeClass }}"
                            data-bukti-bayar="{{ $pes->bukti_bayar ? asset('storage/' . $pes->bukti_bayar) : '' }}"
                            onclick="openDetailBelanja(this)">
                      Lihat
                    </button>
                    <form action="{{ route('petani.pesanan.destroy', $pes->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus riwayat transaksi belanja ini secara permanen?')" style="margin: 0; display: inline-block;">
                      @csrf
                      @method('DELETE')
The above content does NOT show the entire file contents. If you need to view any lines of the file which were not shown to complete your task, call this tool again to view those lines.