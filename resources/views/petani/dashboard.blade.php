<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Dashboard Petani — Doctreen</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --g50: #EAF3DE; --g100: #C0DD97; --g200: #97C459; --g400: #639922; 
      --g600: #3B6D11; --g800: #27500A; --g900: #173404; --t50: #E1F5EE; 
      --t400: #1D9E75; --t600: #0F6E56; --a50: #FAEEDA; --a400: #BA7517; 
      --r50: #FCEBEB; --r400: #E24B4A; --gray50: #F1EFE8; --gray100: #D3D1C7; 
      --gray400: #888780; --text: #1a2e0d; --tm: #4a5c3a; --bg: #f7faf2;
    }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text); display: flex; min-height: 100vh; }
    .sb { width: 260px; background: var(--g900); display: flex; flex-direction: column; padding: 1.5rem 0; position: fixed; top: 0; bottom: 0; left: 0; z-index: 50; }
    .sb-logo { font-family: 'DM Serif Display', serif; font-size: 1.5rem; color: #EAF3DE; padding: 0 1.5rem 1.5rem; border-bottom: 1px solid rgba(255,255,255,.08); margin-bottom: 1rem; }
    .sb-logo span { color: var(--g200); }
    .sb-lbl { font-size: .65rem; font-weight: 600; text-transform: uppercase; letter-spacing: .1em; color: rgba(255,255,255,.25); padding: 1rem 1.5rem .5rem; }
    .sbi { display: flex; align-items: center; gap: 12px; padding: .75rem 1.5rem; color: rgba(255,255,255,.55); font-size: .9rem; background: none; border: none; width: 100%; text-align: left; cursor: pointer; }
    .sbi:hover { background: rgba(255,255,255,.06); color: white; }
    .sbi.active { background: rgba(99,153,34,.2); color: var(--g100); border-right: 3px solid var(--g400); }
    .sbi-ico { width: 20px; text-align: center; }
    .sb-bot { margin-top: auto; padding: 1rem; border-top: 1px solid rgba(255,255,255,.08); }
    .u-card { display: flex; align-items: center; gap: 10px; padding: .75rem; border-radius: 10px; background: rgba(255,255,255,.05); }
    .u-av { width: 38px; height: 38px; border-radius: 50%; background: var(--g400); display: flex; align-items: center; justify-content: center; font-weight: 600; color: white; }
    .u-role { font-size: .75rem; color: rgba(255,255,255,.4); }
    .main { margin-left: 260px; flex: 1; padding: 2.5rem; max-width: 1200px; }
    .topbar { display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem; }
    .pg-title { font-family: 'DM Serif Display', serif; font-size: 1.75rem; color: var(--g900); }
    .pg-sub { font-size: .875rem; color: var(--gray400); margin-top: 4px; }
    .btn-sm { padding: .6rem 1.25rem; background: var(--g600); color: white; border: none; border-radius: 8px; font-size: .875rem; font-weight: 500; cursor: pointer; }
    .btn-sm:hover { background: var(--g800); }
    .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem; margin-bottom: 2rem; }
    .sc { background: white; border: 1px solid rgba(99,153,34,.1); border-radius: 16px; padding: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
    .sc-lbl { font-size: .8rem; color: var(--gray400); margin-bottom: .5rem; }
    .sc-num { font-family: 'DM Serif Display', serif; font-size: 1.8rem; color: var(--g900); }
    .sc-sub { font-size: .75rem; color: var(--t400); margin-top: .5rem; font-weight: 500; }
    .grid2 { display: grid; grid-template-columns: 1.2fr 1fr; gap: 1.5rem; }
    .card { background: white; border: 1px solid rgba(99,153,34,.1); border-radius: 16px; padding: 1.5rem; height: 100%; }
    .ct { font-size: 1rem; font-weight: 600; color: var(--g800); margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; }
    .ct a { font-size: .8rem; color: var(--g400); text-decoration: none; }
    .ki { display: flex; gap: 15px; padding: 1rem 0; border-bottom: 1px solid var(--gray50); align-items: center; }
    .ki:last-child { border-bottom: none; }
    .k-ico { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0; }
    .k-g { background: var(--g50); } .k-a { background: var(--a50); } .k-t { background: var(--t50); }
    .k-ttl { font-size: .9rem; font-weight: 600; color: var(--text); margin-bottom: 2px; }
    .k-meta { font-size: .75rem; color: var(--gray400); }
    .badge { padding: .25rem .75rem; border-radius: 100px; font-size: .7rem; font-weight: 600; }
    .b-dijawab { background: var(--g50); color: var(--g600); }
    .b-proses { background: var(--a50); color: var(--a400); }
    .b-selesai { background: var(--t50); color: var(--t600); }
    .tab-hidden { display: none; }
    .ov { position: fixed; inset: 0; background: rgba(0,0,0,0.4); backdrop-filter: blur(4px); z-index: 200; display: none; align-items: center; justify-content: center; }
    .ov.show { display: flex; }
    .modal { background: white; border-radius: 20px; padding: 2.5rem; width: 90%; max-width: 500px; }
    .foto-box{border:1px solid var(--gray100);border-radius:8px;padding:.75rem;font-size:.8rem;color:var(--gray400);text-align:center;margin:.75rem 0}
    .star{font-size:1.3rem;opacity:.3}
    .star.active{opacity:1}
    table { width: 100%; border-collapse: collapse; }
    th, td { text-align: left; padding: 1rem; border-bottom: 1px solid var(--gray50); }
  </style>
</head>
<body>
<aside class="sb">
  <div class="sb-logo">Doc<span>tree</span>n</div>
  <span class="sb-lbl">Menu Utama</span>
  <button class="sbi active" onclick="showTab('dashboard',this)"><span class="sbi-ico">🍾</span>Dashboard</button>
  <button class="sbi" onclick="showTab('konsultasi',this)"><span class="sbi-ico">💬</span>Konsultasi</button>
  <button class="sbi" onclick="showTab('toko',this)"><span class="sbi-ico">🛒</span>Toko Agri</button>
  <button class="sbi" onclick="showTab('riwayat',this)"><span class="sbi-ico">📋</span>Riwayat</button>
  <span class="sb-lbl">Akun</span>
  <button class="sbi" onclick="showTab('profil',this)"><span class="sbi-ico">👤</span>Profil Saya</button>
  <form method="POST" action="{{ route('logout') }}" style="margin-top: 5px;">
    @csrf
    <button type="submit" class="sbi" style="color:#ff8e8e"><span class="sbi-ico">🚪</span>Keluar</button>
  </form>
  <div class="sb-bot">
    <div class="u-card">
      <div class="u-av">BP</div>
      <div><div style="font-size:.85rem;color:white;font-weight:500">Bapak Petani</div><div class="u-role">Mitra Doctreen</div></div>
    </div>
  </div>
</aside>

<main class="main">
  <div id="tab-dashboard">
    <div class="topbar">
      <div>
        <div class="pg-title">Selamat Pagi, Petani!</div>
        <div class="pg-sub">Pantau kondisi kebun Anda hari ini</div>
      </div>
      <button class="btn-sm" onclick="document.querySelector('.ov').classList.add('show')">+ Ajukan Keluhan</button>
    </div>

    <div class="stats">
      <div class="sc">
        <div class="sc-lbl">Total Konsultasi</div>
        <div class="sc-num">{{ $totalKonsultasi }}</div>
        <div class="sc-sub">Keluhan Anda</div>
      </div>
      <div class="sc">
        <div class="sc-lbl">Tingkat Penyelesaian</div>
        @php $persen = $totalKonsultasi > 0 ? round(($terjawab / $totalKonsultasi) * 100) : 0; @endphp
        <div class="sc-num">{{ $persen }}%</div>
        <div class="sc-sub">{{ $terjawab }} Keluhan dijawab</div>
      </div>
      <div class="sc">
        <div class="sc-lbl">Pesanan Produk</div>
        <div class="sc-num">{{ sprintf('%02d', $pesananAktif) }}</div>
        <div class="sc-sub">Menunggu pembayaran</div>
      </div>
    </div>

    <div class="grid2">
      <div class="card">
        <div class="ct">Keluhan Terbaru <a href="#">Lihat Semua →</a></div>
        @forelse($keluhans as $kel)
          <div class="ki">
            <div class="k-ico {{ $kel->status === 'selesai' ? 'k-t' : ($kel->status === 'proses' ? 'k-a' : 'k-g') }}">🍃</div>
            <div style="flex:1">
              <div class="k-ttl">{{ $kel->judul_keluhan }}</div>
              <div class="k-meta">{{ $kel->tanggal_keluhan }} • {{ optional($kel->konsultasi->konsultan)->nama ?? 'Menunggu' }}</div>
            </div>
            <span class="badge {{ $kel->status === 'selesai' ? 'b-selesai' : ($kel->status === 'proses' ? 'b-proses' : 'b-dijawab') }}">{{ ucfirst($kel->status) }}</span>
          </div>
        @empty
          <div class="ki"><div style="color:var(--gray400);font-size:.85rem">Belum ada keluhan</div></div>
        @endforelse
      </div>

      <div class="card">
        <div class="ct">Konsultan Ahli</div>
        @forelse($konsultans as $c)
          <div class="ki">
            <div class="k-ico k-g">👨‍🌾</div>
            <div style="flex:1">
              <div class="k-ttl">{{ $c->nama ?? '-' }}</div>
              <div class="k-meta">{{ $c->keahlian ?? '-' }}</div>
            </div>
          </div>
        @empty
          <div class="ki"><div style="color:var(--gray400);font-size:.85rem">Belum ada konsultan aktif</div></div>
        @endforelse
      </div>
    </div>
  </div>

  <div id="tab-toko" class="tab-hidden">
    <div class="topbar">
      <div>
        <div class="pg-title">Toko Pertanian</div>
        <div class="pg-sub">Beli kebutuhan tani langsung dari supplier terpercaya.</div>
      </div>
    </div>
    <div class="card">
      <p style="color:var(--gray400)">Bagian toko belum seluruhnya di-render dari database pada halaman ini.</p>
    </div>
  </div>

  <div id="tab-konsultasi" class="tab-hidden">
    <div class="topbar"><div class="pg-title">Daftar Konsultasi</div></div>
    <div class="card"><p style="color:var(--gray400)">Gunakan keluhan pada dashboard untuk memantau status.</p></div>
  </div>

  <div id="tab-riwayat" class="tab-hidden">
    <div class="topbar"><div class="pg-title">Riwayat Aktivitas</div></div>
    <div class="card">
      <table>
        <thead><tr><th>Tanggal</th><th>Masalah</th><th>Status</th></tr></thead>
        <tbody>
          @forelse($riwayats ?? [] as $r)
            <tr>
              <td style="color:var(--gray400)">{{ $r->tanggal_waktu ?? '-' }}</td>
              <td>{{ $r->masalah ?? '-' }}</td>
              <td><span class="badge b-selesai">{{ ucfirst($r->status ?? 'selesai') }}</span></td>
            </tr>
          @empty
            <tr><td colspan="3" style="color:var(--gray400);text-align:center;padding:1rem">Belum ada riwayat</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</main>

<!-- MODAL -->
  <div class="ov" onclick="bgClose(event)">
  <form class="modal" method="POST" action="{{ route('petani.keluhan.store') }}" enctype="multipart/form-data" onsubmit="document.querySelector('.ov').classList.remove('show')">
    @csrf
    <div class="m-title" style="font-family:'DM Serif Display'; font-size: 1.5rem; margin-bottom:1rem;">Kirim Keluhan</div>
    <div style="display:flex; flex-direction:column; gap:15px;">
      <div>
        <input name="judul_keluhan" type="text" placeholder="Judul Masalah" style="width:100%; padding:12px; border-radius:8px; border:1px solid var(--gray100);" required>
      </div>
      <div>
        <textarea name="isi_keluhan" placeholder="Deskripsikan kondisi tanaman..." style="width:100%; padding:12px; border-radius:8px; border:1px solid var(--gray100); height:100px;" required></textarea>
      </div>
      <div>
        <label style="display:block;margin-bottom:6px;font-size:.78rem;color:var(--gray400);font-weight:600">Pilih Konsultan</label>
        <select name="id_konsultan" style="width:100%; padding:12px; border-radius:8px; border:1px solid var(--gray100);" required>
          <option value="" selected>-- Pilih Konsultan --</option>
          @foreach($konsultans as $c)
            <option value="{{ $c->id_konsultan ?? $c->id }}">{{ $c->nama ?? '-' }}{{ isset($c->keahlian) ? ' • ' . $c->keahlian : '' }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <textarea name="catatan_tanaman" placeholder="(Opsional) Nama/ID tanaman" style="width:100%; padding:12px; border-radius:8px; border:1px solid var(--gray100); height:70px;"></textarea>
        <div style="font-size:.78rem;color:var(--gray400);margin-top:6px">Jika Anda punya pilihan tanaman dari database, gunakan field `id_tanaman` (belum tersedia di UI ini).</div>
      </div>
      <div>
        <input name="foto_kendala" type="file" accept="image/*" style="width:100%; padding:10px; border-radius:8px; border:1px solid var(--gray100);">
      </div>
      <button class="btn-sm" style="width:100%;" type="submit">Kirim Sekarang</button>
    </div>
  </form>
</div>

<script>
  function showTab(name, el) {
    ['dashboard', 'konsultasi', 'toko', 'riwayat'].forEach(t => {
      document.getElementById('tab-' + t).classList.add('tab-hidden');
    });
    document.getElementById('tab-' + name).classList.remove('tab-hidden');
    document.querySelectorAll('.sbi').forEach(b => b.classList.remove('active'));
    if (el) el.classList.add('active');
  }

  function bgClose(e) {
    if (e.target.classList.contains('ov')) document.querySelector('.ov').classList.remove('show');
  }
</script>
</body>
</html>

