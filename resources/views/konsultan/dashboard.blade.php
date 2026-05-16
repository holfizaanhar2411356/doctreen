<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Dashboard Konsultan — Doctreen</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    :root{--g50:#EAF3DE;--g100:#C0DD97;--g200:#97C459;--g400:#639922;--g600:#3B6D11;--g800:#27500A;--g900:#173404;--t50:#E1F5EE;--t400:#1D9E75;--t600:#0F6E56;--a50:#FAEEDA;--a400:#BA7517;--r50:#FCEBEB;--r400:#E24B4A;--gray50:#F1EFE8;--gray100:#D3D1C7;--gray400:#888780;--text:#1a2e0d;--tm:#4a5c3a;--bg:#f7faf2}
    *{margin:0;padding:0;box-sizing:border-box}
    body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);display:flex;min-height:100vh}
    .sb{width:240px;background:var(--g900);display:flex;flex-direction:column;padding:1.5rem 0;position:fixed;top:0;bottom:0;left:0;z-index:50;overflow-y:auto}
    .sb-logo{font-family:'DM Serif Display',serif;font-size:1.3rem;color:#EAF3DE;padding:0 1.5rem 1.5rem;border-bottom:1px solid rgba(255,255,255,.08);margin-bottom:1rem}
    .sb-logo span{color:#97C459}
    .sb-lbl{font-size:.65rem;font-weight:600;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,255,255,.25);padding:.5rem 1rem .3rem;display:block}
    .sbi{display:flex;align-items:center;gap:10px;padding:.65rem 1.5rem;color:rgba(255,255,255,.55);font-size:.875rem;text-decoration:none;transition:all .2s;cursor:pointer;background:none;border:none;font-family:'DM Sans',sans-serif;width:100%;text-align:left}
    .sbi:hover{background:rgba(255,255,255,.06);color:rgba(255,255,255,.9)}
    .sbi.active{background:rgba(99,153,34,.25);color:var(--g100)}
    .sbi-ico{width:18px;text-align:center}
    .sb-bot{margin-top:auto;padding:1rem;border-top:1px solid rgba(255,255,255,.08)}
    .u-card{display:flex;align-items:center;gap:10px;padding:.75rem;border-radius:8px;background:rgba(255,255,255,.06)}
    .u-av{width:36px;height:36px;border-radius:50%;background:var(--t400);display:flex;align-items:center;justify-content:center;font-size:.8rem;font-weight:600;color:white}
    .u-name{font-size:.8rem;color:rgba(255,255,255,.8);font-weight:500}.u-role{font-size:.7rem;color:rgba(255,255,255,.35)}
    .main{margin-left:240px;flex:1;padding:2rem;max-width:calc(100% - 240px)}
    .topbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem}
    .pg-title{font-family:'DM Serif Display',serif;font-size:1.5rem;color:var(--g900)}.pg-sub{font-size:.82rem;color:var(--gray400)}
    .stats{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:2rem}
    .sc{background:white;border:1px solid rgba(99,153,34,.1);border-radius:12px;padding:1.25rem}
    .sc-lbl{font-size:.75rem;color:var(--gray400);margin-bottom:.5rem}.sc-num{font-family:'DM Serif Display',serif;font-size:1.7rem;color:var(--g900)}.sc-sub{font-size:.75rem;color:var(--t400);margin-top:.25rem}.sc-sub.a{color:var(--a400)}
    .grid2{display:grid;grid-template-columns:1fr 1.4fr;gap:1.5rem;margin-bottom:1.5rem}
    .card{background:white;border:1px solid rgba(99,153,34,.1);border-radius:14px;padding:1.5rem}
    .ct{font-size:.9rem;font-weight:600;color:var(--g800);margin-bottom:1.25rem;display:flex;justify-content:space-between;align-items:center}
    .ct a{font-size:.78rem;color:var(--g400);text-decoration:none;cursor:pointer;background:none;border:none;font-family:'DM Sans',sans-serif}
    .badge{padding:.2rem .6rem;border-radius:100px;font-size:.7rem;font-weight:600}
    .b-dijawab{background:var(--g50);color:var(--g600)}.b-proses{background:var(--a50);color:var(--a400)}.b-selesai{background:var(--t50);color:var(--t600)}.b-baru{background:var(--r50);color:var(--r400)}.b-menunggu{background:var(--gray50);color:var(--gray400)}
    .btn-sm{padding:.5rem 1rem;background:var(--g600);color:white;border:none;border-radius:8px;font-size:.82rem;font-weight:500;cursor:pointer;font-family:'DM Sans',sans-serif}
    .btn-sm:hover{background:var(--g800)}
    .btn-xs{padding:.3rem .7rem;border-radius:6px;font-size:.72rem;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;border:none}
    .btn-xs.g{background:var(--g50);color:var(--g600);border:1px solid var(--g100)}
    .btn-xs.t{background:var(--t50);color:var(--t600);border:1px solid #b2e4d5}
    .btn-xs.a{background:var(--a50);color:var(--a400);border:1px solid #f5ddb0}
    .keluhan-card{border:1px solid rgba(99,153,34,.12);border-radius:12px;padding:1.1rem;margin-bottom:.85rem;background:white;transition:box-shadow .2s}
    .keluhan-card:hover{box-shadow:0 2px 12px rgba(39,80,10,.08)}
    .kc-top{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:.75rem}
    .kc-ttl{font-size:.9rem;font-weight:600;color:var(--text);margin-bottom:.25rem}
    .kc-meta{font-size:.75rem;color:var(--gray400)}
    .kc-body{font-size:.82rem;color:var(--tm);line-height:1.6;margin-bottom:.85rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .kc-foot{display:flex;align-items:center;justify-content:space-between}
    .kc-tag{display:flex;gap:.4rem;flex-wrap:wrap}
    .tag{padding:.2rem .55rem;border-radius:6px;font-size:.7rem;font-weight:500;background:var(--g50);color:var(--g600)}
    .tag.foto{background:var(--t50);color:var(--t600)}
    .kc-act{display:flex;gap:.5rem}
    .tab-hidden{display:none}
    .ov{position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:200;display:none;align-items:center;justify-content:center}.ov.show{display:flex}
    .modal{background:white;border-radius:16px;padding:2rem;width:100%;max-width:520px;max-height:90vh;overflow-y:auto}
    .m-title{font-family:'DM Serif Display',serif;font-size:1.3rem;color:var(--g900);margin-bottom:1.5rem}
    .fg{margin-bottom:1.1rem}.fg label{display:block;font-size:.82rem;font-weight:500;color:var(--text);margin-bottom:5px}
    .fg input,.fg textarea,.fg select{width:100%;padding:.65rem .85rem;border:1.5px solid var(--gray100);border-radius:8px;font-size:.875rem;font-family:'DM Sans',sans-serif;color:var(--text);background:white;outline:none}
    .fg input:focus,.fg textarea:focus,.fg select:focus{border-color:var(--g400)}.fg textarea{resize:vertical;min-height:100px}
    .m-act{display:flex;gap:.75rem;margin-top:1.5rem}
    .btn-c{flex:1;padding:.75rem;border:1.5px solid var(--gray100);border-radius:8px;background:white;font-family:'DM Sans',sans-serif;font-size:.9rem;cursor:pointer}
    .btn-s{flex:2;padding:.75rem;background:var(--g600);color:white;border:none;border-radius:8px;font-family:'DM Sans',sans-serif;font-size:.9rem;font-weight:500;cursor:pointer}
    .tbl{width:100%;border-collapse:collapse;font-size:.85rem}
    .tbl thead tr{border-bottom:1.5px solid var(--gray50)}
    .tbl th{text-align:left;padding:.65rem .5rem;color:var(--gray400);font-weight:500}
    .tbl td{padding:.7rem .5rem;border-bottom:1px solid var(--gray50)}.tbl tr:last-child td{border-bottom:none}
  </style>
</head>
<body>
<aside class="sb">
  <div class="sb-logo">Doc<span>tree</span>n</div>
  <span class="sb-lbl">Menu Utama</span>
  <button class="sbi active" onclick="showTab('dashboard',this)"><span class="sbi-ico">🍾</span>Dashboard</button>
  <button class="sbi" onclick="showTab('keluhan',this)"><span class="sbi-ico">🛡️</span>Keluhan Masuk</button>
  <button class="sbi" onclick="showTab('riwayat',this)"><span class="sbi-ico">📋</span>Riwayat Saya</button>
  <button class="sbi" onclick="showTab('ulasan',this)"><span class="sbi-ico">⭐</span>Ulasan</button>
  <span class="sb-lbl">Akun</span>
  <button class="sbi" onclick="showTab('profil',this)"><span class="sbi-ico">👤</span>Profil Saya</button>
  <form method="POST" action="{{ route('logout') }}" style="margin-top: 5px;">
    @csrf
    <button type="submit" class="sbi" style="color: #ff8e8e;"><span class="sbi-ico">🚪</span>Keluar</button>
  </form>
  <div class="sb-bot">
    <div class="u-card"><div class="u-av">{{ strtoupper(substr(auth()->user()->name ?? 'Konsultan',0,2)) }}</div><div><div class="u-name">{{ auth()->user()->name ?? '-' }}</div><div class="u-role">Konsultan Pertanian</div></div></div>
  </div>
</aside>

<main class="main">
  <div id="tab-dashboard">
    <div class="topbar">
      <div>
        <div class="pg-title">Selamat Datang</div>
        <div class="pg-sub">Dashboard konsultan berbasis data</div>
      </div>
      <div class="nb">🔔</div>
    </div>

    <div class="stats">
      <div class="sc"><div class="sc-lbl">💬 Total Konsultasi</div><div class="sc-num">{{ $totalDitangani }}</div><div class="sc-sub">Data dari database</div></div>
      <div class="sc"><div class="sc-lbl">⏳ Sedang Diproses</div><div class="sc-num">{{ $konsultasiAktif->count() }}</div><div class="sc-sub a">Berjalan</div></div>
      <div class="sc"><div class="sc-lbl">✅ Selesai</div><div class="sc-num">{{ $selesai }}</div><div class="sc-sub">Keluhan selesai</div></div>
      <div class="sc"><div class="sc-lbl">⭐ Rating Rata-rata</div><div class="sc-num">—</div><div class="sc-sub">Belum tersedia di controller</div></div>
    </div>

    <div class="grid2">
      <div>
        <div class="ct" style="margin-bottom:1rem">Keluhan Baru</div>
        @forelse($keluhanBaru as $kel)
          <div class="keluhan-card">
            <div class="kc-top">
              <div>
                <div class="kc-ttl">{{ $kel->judul_keluhan }}</div>
                <div class="kc-meta">{{ $kel->tanaman->nama_tanaman ?? '-' }} · {{ $kel->petani->nama_petani ?? '-' }} · {{ $kel->tanggal_keluhan }}</div>
              </div>
              <span class="badge b-baru">Baru</span>
            </div>
            <div class="kc-body">{{ $kel->isi_keluhan ?? $kel->catatan ?? '-' }}</div>
            <div class="kc-foot">
              <div class="kc-tag"><span class="tag">{{ $kel->tanaman->nama_tanaman ?? '-' }}</span></div>
              <div class="kc-act"><button class="btn-xs a" onclick="openModal('modalBeri')">Beri Jawaban</button></div>
            </div>
          </div>
        @empty
          <div class="keluhan-card"><div style="color:var(--gray400);font-size:.85rem">Tidak ada keluhan baru.</div></div>
        @endforelse
      </div>

      <div>
        <div class="card" style="margin-bottom:1.5rem">
          <div class="ct">Jadwal Konsultasi Hari Ini</div>
          <div style="color:var(--gray400);font-size:.85rem">(Belum ada kolom jadwal di query controller. Bisa ditambahkan jika dibutuhkan.)</div>
        </div>

        <div class="card">
          <div class="ct">Ulasan Terbaru</div>
          <div style="color:var(--gray400);font-size:.85rem">Belum tersedia data ulasan di controller saat ini.</div>
        </div>
      </div>
    </div>
  </div>

  <div id="tab-keluhan" class="tab-hidden">
    <div class="topbar">
      <div><div class="pg-title">Keluhan Masuk</div><div class="pg-sub">Semua keluhan yang ditugaskan kepada Anda</div></div>
      <div class="tr"><select style="padding:.55rem 1rem;border:1.5px solid var(--gray100);border-radius:8px;font-family:'DM Sans',sans-serif;font-size:.82rem;background:white;outline:none"><option>Semua Status</option><option>Baru</option><option>Proses</option><option>Selesai</option></select></div>
    </div>
    <div class="card">
      <p style="color:var(--gray400);font-size:.85rem">Bagian ini bisa diisi dari tabel keluhan + konsultasiAktif jika Anda ingin.</p>
    </div>
  </div>

  <div id="tab-riwayat" class="tab-hidden">
    <div class="topbar">
      <div><div class="pg-title">Riwayat Konsultasi</div><div class="pg-sub">Rekap seluruh konsultasi yang Anda tangani</div></div>
    </div>
    <div class="card"><p style="color:var(--gray400);font-size:.85rem">Riwayat belum ditampilkan karena controller belum mengirim data riwayat pada dashboard.</p></div>
  </div>

  <div id="tab-ulasan" class="tab-hidden">
    <div class="topbar">
      <div><div class="pg-title">Ulasan</div><div class="pg-sub">Ulasan dari petani</div></div>
    </div>
    <div class="card"><p style="color:var(--gray400);font-size:.85rem">Belum tersedia data ulasan pada dashboard konsultan saat ini.</p></div>
  </div>

  <div id="tab-profil" class="tab-hidden">
    <div class="topbar">
      <div><div class="pg-title">Profil Saya</div><div class="pg-sub">Informasi akun</div></div>
      <div><button class="btn-sm">Simpan Perubahan</button></div>
    </div>
    <div class="card"><p style="color:var(--gray400);font-size:.85rem">Profil belum diikat ke tabel profil konsultan di halaman ini.</p></div>
  </div>
</main>

<div class="ov" id="modalBeri" onclick="bgClose(event,'modalBeri')">
  <div class="modal">
    <div class="m-title">Beri Jawaban Konsultasi</div>
    <div style="background:var(--g50);border-radius:10px;padding:1rem;margin-bottom:1.25rem;font-size:.82rem;color:var(--g800)">
      Form jawaban bisa dihubungkan ke route dari KonsultanController (jawabKeluhan/selesai) sesuai kebutuhan.
    </div>
    <div class="fg"><label>Catatan Jawaban</label><textarea placeholder="Tulis rekomendasi untuk petani..."></textarea></div>
    <div class="m-act"><button class="btn-c" onclick="closeModal('modalBeri')">Batal</button><button class="btn-s" onclick="closeModal('modalBeri')">Kirim</button></div>
  </div>
</div>

<script>
function showTab(name,el){
  ['dashboard','keluhan','riwayat','ulasan','profil'].forEach(t=>{document.getElementById('tab-'+t).className='tab-hidden'});
  document.getElementById('tab-'+name).className='';
  document.querySelectorAll('.sbi').forEach(b=>b.classList.remove('active'));
  if(el)el.classList.add('active');
}
function openModal(id){document.getElementById(id).classList.add('show')}
function closeModal(id){document.getElementById(id).classList.remove('show')}
function bgClose(e,id){if(e.target.id===id)closeModal(id)}
</script>
</body>
</html>

