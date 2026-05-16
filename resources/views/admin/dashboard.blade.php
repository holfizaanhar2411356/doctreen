<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0"><title>Dashboard Admin — Doctreen</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root{--g50:#EAF3DE;--g100:#C0DD97;--g200:#97C459;--g400:#639922;--g600:#3B6D11;--g800:#27500A;--g900:#173404;--t50:#E1F5EE;--t400:#1D9E75;--t600:#0F6E56;--a50:#FAEEDA;--a400:#BA7517;--r50:#FCEBEB;--r400:#E24B4A;--r600:#C0392B;--gray50:#F1EFE8;--gray100:#D3D1C7;--gray400:#888780;--text:#1a2e0d;--tm:#4a5c3a;--bg:#f7faf2}
*{margin:0;padding:0;box-sizing:border-box}body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);display:flex;min-height:100vh}
.sb{width:240px;background:var(--g900);display:flex;flex-direction:column;padding:1.5rem 0;position:fixed;top:0;bottom:0;left:0;z-index:50;overflow-y:auto}
.sb-logo{font-family:'DM Serif Display',serif;font-size:1.3rem;color:#EAF3DE;padding:0 1.5rem 1.5rem;border-bottom:1px solid rgba(255,255,255,.08);margin-bottom:1rem}.sb-logo span{color:#97C459}
.sb-lbl{font-size:.65rem;font-weight:600;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,255,255,.25);padding:.5rem 1rem .3rem;display:block}
.sbi{display:flex;align-items:center;gap:10px;padding:.65rem 1.5rem;color:rgba(255,255,255,.55);font-size:.875rem;text-decoration:none;transition:all .2s;cursor:pointer;background:none;border:none;font-family:'DM Sans',sans-serif;width:100%;text-align:left}
.sbi:hover{background:rgba(255,255,255,.06);color:rgba(255,255,255,.9)}.sbi.active{background:rgba(99,153,34,.25);color:var(--g100)}
.sbi-ico{width:18px;text-align:center}
.sb-bot{margin-top:auto;padding:1rem;border-top:1px solid rgba(255,255,255,.08)}
.u-card{display:flex;align-items:center;gap:10px;padding:.75rem;border-radius:8px;background:rgba(255,255,255,.06)}
.u-av{width:36px;height:36px;border-radius:50%;background:#639922;display:flex;align-items:center;justify-content:center;font-size:.8rem;font-weight:600;color:white}
.u-name{font-size:.8rem;color:rgba(255,255,255,.8);font-weight:500}.u-role{font-size:.7rem;color:rgba(255,255,255,.35)}
.main{margin-left:240px;flex:1;padding:2rem;max-width:calc(100% - 240px)}
.topbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem}
.pg-title{font-family:'DM Serif Display',serif;font-size:1.5rem;color:var(--g900)}.pg-sub{font-size:.82rem;color:var(--gray400)}
.tr{display:flex;align-items:center;gap:1rem}
.nb{width:36px;height:36px;border-radius:50%;background:white;border:1px solid var(--gray100);display:flex;align-items:center;justify-content:center;cursor:pointer;position:relative;font-size:1rem}
.nd{position:absolute;top:6px;right:6px;width:8px;height:8px;border-radius:50%;background:var(--r400);border:2px solid white}
.stats{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:2rem}
.sc{background:white;border:1px solid rgba(99,153,34,.1);border-radius:12px;padding:1.25rem;position:relative;overflow:hidden}
.sc::after{content:'';position:absolute;right:-10px;top:-10px;width:60px;height:60px;border-radius:50%;opacity:.06}
.sc.g::after{background:var(--g400)}.sc.t::after{background:var(--t400)}.sc.a::after{background:var(--a400)}.sc.r::after{background:var(--r400)}
.sc-lbl{font-size:.75rem;color:var(--gray400);margin-bottom:.5rem;display:flex;align-items:center;gap:6px}
.sc-num{font-family:'DM Serif Display',serif;font-size:1.7rem;color:var(--g900)}.sc-sub{font-size:.75rem;color:var(--t400);margin-top:.25rem}
.sc-sub.r{color:var(--r400)}.sc-sub.a{color:var(--a400)}
.grid2{display:grid;grid-template-columns:1.5fr 1fr;gap:1.5rem;margin-bottom:1.5rem}
.grid3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:1.5rem;margin-bottom:1.5rem}
.card{background:white;border:1px solid rgba(99,153,34,.1);border-radius:14px;padding:1.5rem}
.ct{font-size:.9rem;font-weight:600;color:var(--g800);margin-bottom:1.25rem;display:flex;justify-content:space-between;align-items:center}.ct a{font-size:.78rem;color:var(--g400);text-decoration:none;cursor:pointer;background:none;border:none;font-family:'DM Sans',sans-serif}
.tbl{width:100%;border-collapse:collapse;font-size:.85rem}
.tbl thead tr{border-bottom:1.5px solid var(--gray50)}
.tbl th{text-align:left;padding:.65rem .5rem;color:var(--gray400);font-weight:500}
.tbl td{padding:.7rem .5rem;border-bottom:1px solid var(--gray50)}
.tbl tr:last-child td{border-bottom:none}
.badge{padding:.2rem .6rem;border-radius:100px;font-size:.7rem;font-weight:600}
.b-aktif{background:var(--g50);color:var(--g600)}.b-proses{background:var(--a50);color:var(--a400)}.b-selesai{background:var(--t50);color:var(--t600)}.b-baru{background:var(--r50);color:var(--r400)}.b-nonaktif{background:var(--gray50);color:var(--gray400)}
.btn-xs{padding:.3rem .7rem;border-radius:6px;font-size:.72rem;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;border:none}
.btn-xs.g{background:var(--g50);color:var(--g600);border:1px solid var(--g100)}
.btn-xs.r{background:var(--r50);color:var(--r400);border:1px solid #f5c6c6}
.btn-xs.a{background:var(--a50);color:var(--a400);border:1px solid #f5ddb0}
.btn-sm{padding:.5rem 1rem;background:var(--g600);color:white;border:none;border-radius:8px;font-size:.82rem;font-weight:500;cursor:pointer;font-family:'DM Sans',sans-serif}
.btn-sm:hover{background:var(--g800)}
.act-row{display:flex;gap:.5rem}
.u-item{display:flex;align-items:center;gap:10px;padding:.75rem 0;border-bottom:1px solid var(--gray50)}.u-item:last-child{border-bottom:none}
.uav{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.8rem;font-weight:600;flex-shrink:0}
.uav.g{background:var(--g50);color:var(--g600)}.uav.t{background:var(--t50);color:var(--t600)}.uav.a{background:var(--a50);color:var(--a400)}
.un{font-size:.85rem;font-weight:500;color:var(--text)}.um{font-size:.75rem;color:var(--gray400)}
.ov{position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:200;display:none;align-items:center;justify-content:center}.ov.show{display:flex}
.modal{background:white;border-radius:16px;padding:2rem;width:100%;max-width:500px;max-height:90vh;overflow-y:auto}
.m-title{font-family:'DM Serif Display',serif;font-size:1.3rem;color:var(--g900);margin-bottom:1.5rem}
.fg{margin-bottom:1.1rem}.fg label{display:block;font-size:.82rem;font-weight:500;color:var(--text);margin-bottom:5px}
.fg input,.fg textarea,.fg select{width:100%;padding:.65rem .85rem;border:1.5px solid var(--gray100);border-radius:8px;font-size:.875rem;font-family:'DM Sans',sans-serif;color:var(--text);background:white;outline:none}
.fg input:focus,.fg textarea:focus,.fg select:focus{border-color:var(--g400)}.fg textarea{resize:vertical;min-height:90px}
.m-act{display:flex;gap:.75rem;margin-top:1.5rem}
.btn-c{flex:1;padding:.75rem;border:1.5px solid var(--gray100);border-radius:8px;background:white;font-family:'DM Sans',sans-serif;font-size:.9rem;cursor:pointer}
.btn-s{flex:2;padding:.75rem;background:var(--g600);color:white;border:none;border-radius:8px;font-family:'DM Sans',sans-serif;font-size:.9rem;font-weight:500;cursor:pointer}
.tab-hidden{display:none}
.alert-item{display:flex;align-items:flex-start;gap:10px;padding:.85rem;border-radius:10px;margin-bottom:.75rem}
.alert-item.r{background:var(--r50);border:1px solid #f5c6c6}
.alert-item.a{background:var(--a50);border:1px solid #f5ddb0}
.alert-item.g{background:var(--g50);border:1px solid var(--g100)}
.al-ico{font-size:1.1rem;flex-shrink:0;margin-top:1px}.al-ttl{font-size:.82rem;font-weight:600;color:var(--text)}.al-sub{font-size:.75rem;color:var(--gray400)}
.cht-bar{display:flex;flex-direction:column;gap:.6rem}
.cht-row{display:flex;align-items:center;gap:.75rem;font-size:.8rem}
.cht-lbl{width:80px;color:var(--tm);text-align:right;flex-shrink:0}
.cht-track{flex:1;height:10px;background:var(--gray50);border-radius:100px;overflow:hidden}
.cht-fill{height:100%;border-radius:100px;background:var(--g400)}
.cht-fill.t{background:var(--t400)}.cht-fill.a{background:var(--a400)}
.cht-val{width:40px;font-weight:500;color:var(--text)}
.tabs-horiz{display:flex;gap:.5rem;margin-bottom:1.25rem;border-bottom:1px solid var(--gray50);padding-bottom:.75rem}
.th-btn{padding:.35rem .85rem;border-radius:6px;font-size:.8rem;font-weight:500;cursor:pointer;border:none;background:none;color:var(--gray400);font-family:'DM Sans',sans-serif}
.th-btn.active{background:var(--g50);color:var(--g600)}
</style></head>
<body>
<aside class="sb">
  <div class="sb-logo">Doc<span>tree</span>n</div>
  <span class="sb-lbl">Menu Utama</span>
  <button class="sbi active" onclick="showTab('dashboard',this)"><span class="sbi-ico">📊</span>Dashboard</button>
  <button class="sbi" onclick="showTab('petani',this)"><span class="sbi-ico">🌾</span>Data Petani</button>
  <button class="sbi" onclick="showTab('konsultan',this)"><span class="sbi-ico">👨‍🌾</span>Data Konsultan</button>
  <button class="sbi" onclick="showTab('keluhan',this)"><span class="sbi-ico">🗡</span>Keluhan Masuk</button>
  <button class="sbi" onclick="showTab('toko',this)"><span class="sbi-ico">🏪</span>Toko & Produk</button>
  <button class="sbi" onclick="showTab('riwayat',this)"><span class="sbi-ico">📋</span>Riwayat</button>
  <span class="sb-lbl">Sistem</span>
  <button class="sbi"><span class="sbi-ico">⚙️</span>Pengaturan</button>
  <a href="login" class="sbi"><span class="sbi-ico">🚪</span>Keluar</a>
  <div class="sb-bot"><div class="u-card"><div class="u-av">AD</div><div><div class="u-name">Admin Doctreen</div><div class="u-role">Super Admin</div></div></div></div>
</aside>

<main class="main">
    @if(session('success'))
        <div class="card" style="border-color: rgba(99,153,34,.2); margin-bottom:1rem;">
            <div style="color: var(--g600); font-weight:600;">{{ session('success') }}</div>
        </div>
    @endif
    @if(session('error'))
        <div class="card alert-item r" style="margin-bottom:1rem; border-color:#f5c6c6; background:#FDE8E8;">
            <div class="al-ico">⚠️</div>
            <div><div class="al-ttl">{{ session('error') }}</div></div>
        </div>
    @endif

<!-- DASHBOARD -->
<div id="tab-dashboard">
  <div class="topbar">
    <div><div class="pg-title">Dashboard Admin</div><div class="pg-sub">Ringkasan platform Doctreen hari ini</div></div>
    <div class="tr">
      <div class="nb">🔔<span class="nd"></span></div>
      <button type="button" class="btn-sm" onclick="openModal('modalAddKonsultan')">+ Tambah Konsultan</button>
    </div>
  </div>
  <div class="stats">
    <div class="sc g"><div class="sc-lbl">🌾 Total Petani</div><div class="sc-num">{{ $totalPetani }}</div><div class="sc-sub">Data dari database</div></div>
    <div class="sc t"><div class="sc-lbl">👨‍🌾 Total Konsultan</div><div class="sc-num">{{ $totalKonsultan }}</div><div class="sc-sub">Data dari database</div></div>
    <div class="sc a"><div class="sc-lbl">💬 Keluhan Aktif</div><div class="sc-num">{{ $totalKeluhan }}</div><div class="sc-sub a">{{ $selesai }} sudah selesai</div></div>
    <div class="sc r"><div class="sc-lbl">🏜️ Total Toko</div><div class="sc-num">{{ is_countable($tokoVerifikasi) ? count($tokoVerifikasi) : ($tokoVerifikasi ?? 0) }}</div><div class="sc-sub">Verifikasi (aktif)</div></div>
  </div>

  <div class="grid2">
    <div class="card">
      <div class="ct">Aktivitas Keluhan per Bulan
        <div style="display:flex;gap:.5rem">
          <button class="th-btn active" onclick="setChartTab(this,'padi')">Padi</button>
          <button class="th-btn" onclick="setChartTab(this,'jagung')">Jagung</button>
          <button class="th-btn" onclick="setChartTab(this,'cabai')">Cabai</button>
        </div>
      </div>
      <div class="cht-bar">
        <div class="cht-row"><span class="cht-lbl">Jan</span><div class="cht-track"><div class="cht-fill" style="width:45%"></div></div><span class="cht-val">45</span></div>
        <div class="cht-row"><span class="cht-lbl">Feb</span><div class="cht-track"><div class="cht-fill" style="width:62%"></div></div><span class="cht-val">62</span></div>
        <div class="cht-row"><span class="cht-lbl">Mar</span><div class="cht-track"><div class="cht-fill" style="width:78%"></div></div><span class="cht-val">78</span></div>
        <div class="cht-row"><span class="cht-lbl">Apr</span><div class="cht-track"><div class="cht-fill t" style="width:91%"></div></div><span class="cht-val">91</span></div>
        <div class="cht-row"><span class="cht-lbl">Mei</span><div class="cht-track"><div class="cht-fill" style="width:55%"></div></div><span class="cht-val">55</span></div>
        <div class="cht-row"><span class="cht-lbl">Jun</span><div class="cht-track"><div class="cht-fill a" style="width:38%"></div></div><span class="cht-val">38</span></div>
      </div>
    </div>
    <div class="card">
      <div class="ct">Notifikasi & Peringatan</div>
      <div class="alert-item r"><span class="al-ico">🔨</span><div><div class="al-ttl">{{ max($totalKeluhan - $selesai,0) }} Keluhan belum selesai</div><div class="al-sub">Perlu penugasan konsultan</div></div></div>
      <div class="alert-item a"><span class="al-ico">⏰</span><div><div class="al-ttl">Konsultasi dalam proses</div><div class="al-sub">Perlu monitoring</div></div></div>
      <div class="alert-item g"><span class="al-ico">✅</span><div><div class="al-ttl">Toko terverifikasi</div><div class="al-sub">{{ is_countable($tokoVerifikasi) ? count($tokoVerifikasi) : 0 }} aktif</div></div></div>
      <div class="alert-item a"><span class="al-ico">👤</span><div><div class="al-ttl">Registrasi petani</div><div class="al-sub">Data masuk sistem</div></div></div>
    </div>
  </div>

  <div class="grid3">
    <div class="card">
      <div class="ct">Keluhan Terbaru</div>
      @forelse($keluhanTerbaru as $k)
        @php
          $status = $k->status ?? 'baru';
          $badgeClass = $status === 'selesai' ? 'b-selesai' : ($status === 'proses' ? 'b-proses' : 'b-baru');
          $avatarClass = $status === 'selesai' ? 't' : ($status === 'proses' ? 'a' : 'g');
          $petaniName = $k->petani->nama_petani ?? '—';
        @endphp
        <div class="u-item">
          <div class="uav {{ $avatarClass }}">{{ strtoupper(substr($petaniName,0,2)) }}</div>
          <div style="flex:1">
            <div class="un">{{ $k->judul_keluhan }}</div>
            <div class="um">{{ $petaniName }} · {{ $k->tanggal_keluhan }}</div>
          </div>
          <span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
        </div>
      @empty
        <div class="u-item"><div style="flex:1;color:var(--gray400);font-size:.85rem">Belum ada keluhan</div></div>
      @endforelse
    </div>
    <div class="card">
      <div class="ct">Konsultan Teraktif</div>
      @forelse($konsultans as $c)
        @php $name = $c->nama ?? 'K'; $status = $c->status ?? 'aktif';
             $avatarClass = $status === 'aktif' ? 'g' : 'a';
        @endphp
        <div class="u-item">
          <div class="uav {{ $avatarClass }}">{{ strtoupper(substr($name,0,2)) }}</div>
          <div style="flex:1">
            <div class="un">{{ $name }}</div>
            <div class="um">{{ $c->keahlian ?? '—' }}</div>
          </div>
          <span style="font-size:.8rem;color:#f5a623">★</span>
        </div>
      @empty
        <div class="u-item"><div style="flex:1;color:var(--gray400);font-size:.85rem">Belum ada data konsultan</div></div>
      @endforelse
    </div>
    <div class="card">
      <div class="ct">Distribusi Kategori Keluhan</div>
      <div class="cht-bar">
        <div class="cht-row"><span class="cht-lbl">Padi</span><div class="cht-track"><div class="cht-fill" style="width:72%"></div></div><span class="cht-val">72%</span></div>
        <div class="cht-row"><span class="cht-lbl">Cabai</span><div class="cht-track"><div class="cht-fill t" style="width:41%"></div></div><span class="cht-val">41%</span></div>
        <div class="cht-row"><span class="cht-lbl">Jagung</span><div class="cht-track"><div class="cht-fill a" style="width:33%"></div></div><span class="cht-val">33%</span></div>
        <div class="cht-row"><span class="cht-lbl">Tomat</span><div class="cht-track"><div class="cht-fill" style="width:22%"></div></div><span class="cht-val">22%</span></div>
        <div class="cht-row"><span class="cht-lbl">Lainnya</span><div class="cht-track"><div class="cht-fill" style="width:15%"></div></div><span class="cht-val">15%</span></div>
      </div>
    </div>
  </div>
</div>

<!-- DATA PETANI -->
<div id="tab-petani" class="tab-hidden">
  <div class="topbar">
    <div><div class="pg-title">Data Petani</div><div class="pg-sub">Kelola seluruh akun petani terdaftar</div></div>
    <div class="tr">
      <input type="text" placeholder="🔍 Cari petani..." style="padding:.55rem 1rem;border:1.5px solid var(--gray100);border-radius:8px;font-size:.82rem;font-family:'DM Sans',sans-serif;outline:none;width:220px">
      <button type="button" class="btn-sm" onclick="openModal('modalAddPetani')">+ Tambah Petani</button>
    </div>
  </div>
  <div class="card">
    <table class="tbl">
      <thead><tr>
        <th>Nama Petani</th><th>No. Telepon</th><th>Asal Daerah</th><th>Total Keluhan</th><th>Status</th><th>Aksi</th>
      </tr></thead>
      <tbody>
        @forelse($petanis as $p)
          @php
            $petaniName = $p->nama ?? ($p->user->name ?? 'Petani');
            $telepon = $p->user->telepon ?? $p->telepon ?? '-';
            $daerah = $p->daerah ?? '-';
            $keluhansCount = $p->keluhans_count ?? 0;
          @endphp
          <tr>
            <td>
              <div style="display:flex;align-items:center;gap:8px">
                <div class="uav g" style="width:30px;height:30px;font-size:.72rem">{{ strtoupper(substr($petaniName,0,2)) }}</div>
                <div>
                  <div style="font-size:.85rem;font-weight:500">{{ $petaniName }}</div>
                  <div style="font-size:.72rem;color:var(--gray400)">{{ $p->user->email ?? '—' }}</div>
                </div>
              </div>
            </td>
            <td>{{ $telepon }}</td>
            <td>{{ $daerah }}</td>
            <td>{{ $keluhansCount }}</td>
            <td><span class="badge b-aktif">Aktif</span></td>
            <td>
              <div class="act-row">
                <button type="button" class="btn-xs g" data-id="{{ $p->id }}" data-nama="{{ $petaniName }}" data-email="{{ $p->user->email ?? '' }}" data-telepon="{{ $telepon }}" data-daerah="{{ $daerah }}" onclick="openEditPetani(this)">Edit</button>
                <form method="POST" action="{{ route('admin.petani.hapus', $p->id) }}" onsubmit="return confirm('Hapus petani ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-xs r">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" style="color:var(--gray400);text-align:center;padding:1rem">Belum ada data petani</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<!-- DATA KONSULTAN -->
<div id="tab-konsultan" class="tab-hidden">
  <div class="topbar">
    <div><div class="pg-title">Data Konsultan</div><div class="pg-sub">Kelola konsultan pertanian terdaftar</div></div>
    <div class="tr">
      <input type="text" placeholder="🔍 Cari konsultan..." style="padding:.55rem 1rem;border:1.5px solid var(--gray100);border-radius:8px;font-size:.82rem;font-family:'DM Sans',sans-serif;outline:none;width:220px">
      <button type="button" class="btn-sm" onclick="openModal('modalAddKonsultan')">+ Tambah Konsultan</button>
    </div>
  </div>
  <div class="card">
    <table class="tbl">
      <thead><tr>
        <th>Nama Konsultan</th><th>No. Kontak</th><th>Spesialisasi</th><th>Biaya (per sesi)</th><th>Rating</th><th>Status</th><th>Aksi</th>
      </tr></thead>
      <tbody>
        @forelse($konsultans as $k)
          <tr>
            <td>
              <div style="display:flex;align-items:center;gap:8px">
                <div class="uav g" style="width:30px;height:30px;font-size:.72rem">{{ strtoupper(substr($k->nama ?? 'K',0,2)) }}</div>
                <div style="font-size:.85rem;font-weight:500">{{ $k->nama ?? '-' }}</div>
              </div>
            </td>
            <td>{{ $k->telepon ?? $k->user->telepon ?? '-' }}</td>
            <td>{{ $k->keahlian ?? '-' }}</td>
            <td>
              @php
                $biaya = $k->tarif_konsultasi ?? $k->biaya;
                echo (!empty($biaya) || $biaya === 0)
                  ? 'Rp ' . number_format((int)$biaya, 0, ',', '.')
                  : 'Rp -';
              @endphp
            </td>
            <td><span style="color:#f5a623">⭐</span></td>
            <td><span class="badge b-aktif">{{ ucfirst($k->status ?? 'aktif') }}</span></td>
            <td>
              <div class="act-row">
                <button type="button" class="btn-xs g" data-id="{{ $k->id }}" data-nama="{{ $k->nama }}" data-email="{{ $k->user->email ?? '' }}" data-telepon="{{ $k->user->telepon ?? '' }}" data-keahlian="{{ $k->keahlian ?? '' }}" data-tarif="{{ $k->tarif_konsultasi ?? '' }}" data-status="{{ $k->status ?? 'verifikasi' }}" onclick="openEditKonsultan(this)">Edit</button>
                @if(($k->status ?? '') !== 'aktif')
                  <form method="POST" action="{{ route('admin.konsultan.verifikasi', $k->id) }}">
                    @csrf
                    <button type="submit" class="btn-xs a">Verifikasi</button>
                  </form>
                @endif
                <form method="POST" action="{{ route('admin.konsultan.hapus', $k->id) }}" onsubmit="return confirm('Hapus konsultan ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-xs r">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="7" style="color:var(--gray400);text-align:center;padding:1rem">Belum ada data konsultan</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<!-- KELUHAN MASUK (tetap placeholder, tidak di-harcode angka) -->
<div id="tab-keluhan" class="tab-hidden">
  <div class="topbar">
    <div><div class="pg-title">Keluhan Masuk</div><div class="pg-sub">Kelola dan tugaskan keluhan petani ke konsultan</div></div>
    <div class="tr">
      <select style="padding:.55rem 1rem;border:1.5px solid var(--gray100);border-radius:8px;font-family:'DM Sans',sans-serif;font-size:.82rem;background:white;outline:none">
        <option>Semua Status</option><option>Baru</option><option>Proses</option><option>Selesai</option>
      </select>
    </div>
  </div>
  <div class="card">
    <table class="tbl">
      <thead><tr>
        <th>Petani</th><th>Judul Keluhan</th><th>Tanggal</th><th>Status</th><th>Konsultan</th><th>Aksi</th>
      </tr></thead>
      <tbody>
        @forelse($keluhanTerbaru as $kl)
          @php
            $petaniName = $kl->petani->nama ?? '-';
            $status = $kl->status ?? 'baru';
            $badge = $status === 'selesai' ? 'b-selesai' : ($status === 'proses' ? 'b-proses' : 'b-baru');
            $kon = $kl->konsultasi && $kl->konsultasi->konsultan ? $kl->konsultasi->konsultan->nama : '-';
          @endphp
          <tr>
            <td>{{ $petaniName }}</td>
            <td><div style="font-size:.85rem;font-weight:500">{{ $kl->judul_keluhan }}</div><div style="font-size:.72rem;color:var(--gray400)">—</div></td>
            <td>{{ $kl->tanggal_keluhan }}</td>
            <td><span class="badge {{ $badge }}">{{ ucfirst($status) }}</span></td>
            <td><span style="color:var(--gray400);font-size:.8rem">{{ $kon }}</span></td>
            <td><button class="btn-xs a">Tugaskan</button></td>
          </tr>
        @empty
          <tr><td colspan="6" style="color:var(--gray400);text-align:center;padding:1rem">Belum ada keluhan</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<!-- TOKO & PRODUK -->
<div id="tab-toko" class="tab-hidden">
  <div class="topbar">
    <div><div class="pg-title">Toko & Produk</div><div class="pg-sub">Kelola toko mitra dan daftar produk</div></div>
    <div class="tr"><button type="button" class="btn-sm" onclick="openModal('modalAddToko')">+ Tambah Toko</button></div>
  </div>
  <div class="card">
    <table class="tbl">
      <thead><tr>
        <th>Nama Toko</th><th>Email</th><th>Lokasi</th><th>Status</th><th>Aksi</th>
      </tr></thead>
      <tbody>
        @forelse($tokos as $t)
          <tr>
            <td>
              <div style="display:flex;align-items:center;gap:8px">
                <div class="uav g" style="width:30px;height:30px;font-size:.72rem">{{ strtoupper(substr($t->nama_toko ?? 'T',0,2)) }}</div>
                <div>
                  <div style="font-size:.85rem;font-weight:500">{{ $t->nama_toko ?? '-' }}</div>
                  <div style="font-size:.72rem;color:var(--gray400)">{{ $t->user->telepon ?? '-' }}</div>
                </div>
              </div>
            </td>
            <td>{{ $t->user->email ?? '-' }}</td>
            <td>{{ $t->alamat ?? '-' }}</td>
            <td><span class="badge {{ $t->status === 'aktif' ? 'b-aktif' : ($t->status === 'verifikasi' ? 'b-proses' : 'b-nonaktif') }}">{{ ucfirst($t->status ?? 'verifikasi') }}</span></td>
            <td>
              <div class="act-row">
                <button type="button" class="btn-xs g" data-id="{{ $t->id }}" data-nama="{{ $t->nama_toko ?? '' }}" data-email="{{ $t->user->email ?? '' }}" data-telepon="{{ $t->user->telepon ?? '' }}" data-alamat="{{ $t->alamat ?? '' }}" data-status="{{ $t->status ?? 'verifikasi' }}" onclick="openEditToko(this)">Edit</button>
                @if($t->status !== 'aktif')
                  <form method="POST" action="{{ route('admin.toko.verifikasi', $t->id) }}">
                    @csrf
                    <button type="submit" class="btn-xs a">Verifikasi</button>
                  </form>
                @endif
                <form method="POST" action="{{ route('admin.toko.hapus', $t->id) }}" onsubmit="return confirm('Hapus toko ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-xs r">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" style="color:var(--gray400);text-align:center;padding:1rem">Belum ada data toko</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<!-- RIWAYAT -->
<div id="tab-riwayat" class="tab-hidden">
  <div class="topbar">
    <div><div class="pg-title">Riwayat Konsultasi</div><div class="pg-sub">Rekap seluruh aktivitas konsultasi di platform</div></div>
    <div class="tr">
      <select style="padding:.55rem 1rem;border:1.5px solid var(--gray100);border-radius:8px;font-family:'DM Sans',sans-serif;font-size:.82rem;background:white;outline:none">
        <option>Semua Bulan</option><option>April 2026</option><option>Maret 2026</option>
      </select>
    </div>
  </div>
  <div class="card">
    <table class="tbl">
      <thead><tr>
        <th>Tanggal</th><th>Petani</th><th>Masalah</th><th>Konsultan</th><th>Tindakan</th><th>Status</th>
      </tr></thead>
      <tbody>
        @forelse($riwayats as $r)
          <tr>
            <td>{{ $r->tanggal_konsultasi ? date('d M Y', strtotime($r->tanggal_konsultasi)) : '-' }}</td>
            <td>{{ $r->keluhan->petani->nama ?? '-' }}</td>
            <td>{{ $r->keluhan->judul ?? ($r->keluhan->deskripsi ?? '-') }}</td>
            <td>{{ $r->konsultan->nama ?? 'Belum ditugaskan' }}</td>
            <td>{{ $r->diagnosa ? \Illuminate\Support\Str::limit($r->diagnosa, 45) : ($r->rekomendasi ? \Illuminate\Support\Str::limit($r->rekomendasi, 45) : 'Belum selesai') }}</td>
            <td><span class="badge {{ $r->status === 'selesai' ? 'b-aktif' : ($r->status === 'proses' ? 'b-proses' : 'b-nonaktif') }}">{{ ucfirst($r->status) }}</span></td>
          </tr>
        @empty
          <tr><td colspan="6" style="color:var(--gray400);text-align:center;padding:1rem">Belum ada riwayat konsultasi</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

</main>

<!-- MODAL -->
<div class="ov" id="modalTugaskan" onclick="bgClose(event,'modalTugaskan')">
  <div class="modal">
    <div class="m-title">Tugaskan Konsultan</div>
    <div class="fg"><label>Keluhan</label><input type="text" value="—" readonly style="background:var(--gray50)"></div>
    <div class="fg"><label>Pilih Konsultan</label>
      <select><option>-- Pilih konsultan --</option>
        @foreach($konsultans as $k)
          <option>{{ $k->nama ?? '-' }}</option>
        @endforeach
      </select>
    </div>
    <div class="fg"><label>Tanggal Konsultasi</label><input type="date"></div>
    <div class="fg"><label>Catatan (opsional)</label><textarea placeholder="Tambahkan catatan untuk konsultan..."></textarea></div>
    <div class="m-act">
      <button class="btn-c" onclick="closeModal('modalTugaskan')">Batal</button>
      <button class="btn-s" onclick="closeModal('modalTugaskan')">Tugaskan</button>
    </div>
  </div>
</div>

<div class="ov" id="modalAddPetani" onclick="bgClose(event,'modalAddPetani')">
  <div class="modal">
    <div class="m-title">Tambah Petani Baru</div>
    <form method="POST" action="{{ route('admin.petani.store') }}">
      @csrf
      <div class="fg"><label>Nama Lengkap</label><input type="text" name="nama" placeholder="Nama petani" required></div>
      <div class="fg"><label>Email</label><input type="email" name="email" placeholder="email@contoh.com" required></div>
      <div class="fg"><label>No. Telepon</label><input type="tel" name="telepon" placeholder="08xxxxxxxxxx" required></div>
      <div class="fg"><label>Asal Daerah</label><input type="text" name="daerah" placeholder="cth: Karawang, Jawa Barat"></div>
      <div class="fg"><label>Password Sementara</label><input type="password" name="password" placeholder="Min. 8 karakter"></div>
      <div class="m-act">
        <button type="button" class="btn-c" onclick="closeModal('modalAddPetani')">Batal</button>
        <button type="submit" class="btn-s">Simpan</button>
      </div>
    </form>
  </div>
</div>

<div class="ov" id="modalAddKonsultan" onclick="bgClose(event,'modalAddKonsultan')">
  <div class="modal">
    <div class="m-title">Tambah Konsultan Baru</div>
    <form method="POST" action="{{ route('admin.konsultan.store') }}">
      @csrf
      <div class="fg"><label>Nama Konsultan</label><input type="text" name="nama" placeholder="cth: Dr. Budi Santoso, SP" required></div>
      <div class="fg"><label>Email</label><input type="email" name="email" placeholder="email@contoh.com" required></div>
      <div class="fg"><label>No. Kontak</label><input type="tel" name="telepon" placeholder="08xxxxxxxxxx" required></div>
      <div class="fg"><label>Spesialisasi</label><input type="text" name="keahlian" placeholder="cth: Padi, Jagung, Hama"></div>
      <div class="fg"><label>Biaya Konsultasi (Rp)</label><input type="number" name="tarif_konsultasi" placeholder="cth: 75000"></div>
      <div class="fg"><label>Password Sementara</label><input type="password" name="password" placeholder="Min. 8 karakter"></div>
      <div class="m-act">
        <button type="button" class="btn-c" onclick="closeModal('modalAddKonsultan')">Batal</button>
        <button type="submit" class="btn-s">Simpan</button>
      </div>
    </form>
  </div>
</div>

<div class="ov" id="modalAddToko" onclick="bgClose(event,'modalAddToko')">
  <div class="modal">
    <div class="m-title">Tambah Toko Baru</div>
    <form method="POST" action="{{ route('admin.toko.store') }}">
      @csrf
      <div class="fg"><label>Nama Toko</label><input type="text" name="nama_toko" placeholder="cth: AgriJaya Surabaya" required></div>
      <div class="fg"><label>Email</label><input type="email" name="email" placeholder="email@contoh.com" required></div>
      <div class="fg"><label>No. Telepon</label><input type="tel" name="telepon" placeholder="08xxxxxxxxxx" required></div>
      <div class="fg"><label>Alamat Toko</label><textarea name="alamat" placeholder="Alamat lengkap toko..." required></textarea></div>
      <div class="fg"><label>Status</label>
        <select name="status">
          <option value="verifikasi">Verifikasi</option>
          <option value="aktif">Aktif</option>
          <option value="nonaktif">Nonaktif</option>
        </select>
      </div>
      <div class="fg"><label>Password Sementara</label><input type="password" name="password" placeholder="Min. 8 karakter"></div>
      <div class="m-act">
        <button type="button" class="btn-c" onclick="closeModal('modalAddToko')">Batal</button>
        <button type="submit" class="btn-s">Simpan</button>
      </div>
    </form>
  </div>
</div>

<div class="ov" id="modalEditPetani" onclick="bgClose(event,'modalEditPetani')">
  <div class="modal">
    <div class="m-title">Edit Petani</div>
    <form id="editPetaniForm" method="POST" action="">
      @csrf
      @method('PUT')
      <div class="fg"><label>Nama Lengkap</label><input id="editPetaniNama" type="text" name="nama" required></div>
      <div class="fg"><label>Email</label><input id="editPetaniEmail" type="email" name="email" required></div>
      <div class="fg"><label>No. Telepon</label><input id="editPetaniTelepon" type="tel" name="telepon" required></div>
      <div class="fg"><label>Asal Daerah</label><input id="editPetaniDaerah" type="text" name="daerah"></div>
      <div class="fg"><label>Password Baru</label><input id="editPetaniPassword" type="password" name="password" placeholder="Kosongkan jika tidak diganti"></div>
      <div class="m-act">
        <button type="button" class="btn-c" onclick="closeModal('modalEditPetani')">Batal</button>
        <button type="submit" class="btn-s">Simpan</button>
      </div>
    </form>
  </div>
</div>

<div class="ov" id="modalEditKonsultan" onclick="bgClose(event,'modalEditKonsultan')">
  <div class="modal">
    <div class="m-title">Edit Konsultan</div>
    <form id="editKonsultanForm" method="POST" action="">
      @csrf
      @method('PUT')
      <div class="fg"><label>Nama Konsultan</label><input id="editKonsultanNama" type="text" name="nama" required></div>
      <div class="fg"><label>Email</label><input id="editKonsultanEmail" type="email" name="email" required></div>
      <div class="fg"><label>No. Kontak</label><input id="editKonsultanTelepon" type="tel" name="telepon" required></div>
      <div class="fg"><label>Spesialisasi</label><input id="editKonsultanKeahlian" type="text" name="keahlian"></div>
      <div class="fg"><label>Biaya Konsultasi (Rp)</label><input id="editKonsultanTarif" type="number" name="tarif_konsultasi"></div>
      <div class="fg"><label>Status</label>
        <select id="editKonsultanStatus" name="status">
          <option value="verifikasi">Verifikasi</option>
          <option value="aktif">Aktif</option>
          <option value="nonaktif">Nonaktif</option>
        </select>
      </div>
      <div class="fg"><label>Password Baru</label><input id="editKonsultanPassword" type="password" name="password" placeholder="Kosongkan jika tidak diganti"></div>
      <div class="m-act">
        <button type="button" class="btn-c" onclick="closeModal('modalEditKonsultan')">Batal</button>
        <button type="submit" class="btn-s">Simpan</button>
      </div>
    </form>
  </div>
</div>

<div class="ov" id="modalEditToko" onclick="bgClose(event,'modalEditToko')">
  <div class="modal">
    <div class="m-title">Edit Toko</div>
    <form id="editTokoForm" method="POST" action="">
      @csrf
      @method('PUT')
      <div class="fg"><label>Nama Toko</label><input id="editTokoNama" type="text" name="nama_toko" required></div>
      <div class="fg"><label>Email</label><input id="editTokoEmail" type="email" name="email" required></div>
      <div class="fg"><label>No. Telepon</label><input id="editTokoTelepon" type="tel" name="telepon" required></div>
      <div class="fg"><label>Alamat</label><textarea id="editTokoAlamat" name="alamat" required></textarea></div>
      <div class="fg"><label>Status</label>
        <select id="editTokoStatus" name="status">
          <option value="verifikasi">Verifikasi</option>
          <option value="aktif">Aktif</option>
          <option value="nonaktif">Nonaktif</option>
        </select>
      </div>
      <div class="fg"><label>Password Baru</label><input id="editTokoPassword" type="password" name="password" placeholder="Kosongkan jika tidak diganti"></div>
      <div class="m-act">
        <button type="button" class="btn-c" onclick="closeModal('modalEditToko')">Batal</button>
        <button type="submit" class="btn-s">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script>
function showTab(name,el){
  ['dashboard','petani','konsultan','keluhan','toko','riwayat'].forEach(t=>{document.getElementById('tab-'+t).className='tab-hidden'});
  document.getElementById('tab-'+name).className='';
  document.querySelectorAll('.sbi').forEach(b=>b.classList.remove('active'));
  if(el)el.classList.add('active');
}
function openModal(id){document.getElementById(id).classList.add('show')}
function closeModal(id){document.getElementById(id).classList.remove('show')}
function bgClose(e,id){if(e.target.id===id)closeModal(id)}
function setChartTab(el){document.querySelectorAll('.th-btn').forEach(b=>b.classList.remove('active'));el.classList.add('active')}
function openEditPetani(button){
  const form = document.getElementById('editPetaniForm');
  form.action = '/admin/petani/' + button.dataset.id;
  document.getElementById('editPetaniNama').value = button.dataset.nama;
  document.getElementById('editPetaniEmail').value = button.dataset.email;
  document.getElementById('editPetaniTelepon').value = button.dataset.telepon;
  document.getElementById('editPetaniDaerah').value = button.dataset.daerah;
  document.getElementById('editPetaniPassword').value = '';
  openModal('modalEditPetani');
}
function openEditKonsultan(button){
  const form = document.getElementById('editKonsultanForm');
  form.action = '/admin/konsultan/' + button.dataset.id;
  document.getElementById('editKonsultanNama').value = button.dataset.nama;
  document.getElementById('editKonsultanEmail').value = button.dataset.email;
  document.getElementById('editKonsultanTelepon').value = button.dataset.telepon;
  document.getElementById('editKonsultanKeahlian').value = button.dataset.keahlian;
  document.getElementById('editKonsultanTarif').value = button.dataset.tarif;
  document.getElementById('editKonsultanStatus').value = button.dataset.status;
  document.getElementById('editKonsultanPassword').value = '';
  openModal('modalEditKonsultan');
}
function openEditToko(button){
  const form = document.getElementById('editTokoForm');
  form.action = '/admin/toko/' + button.dataset.id;
  document.getElementById('editTokoNama').value = button.dataset.nama;
  document.getElementById('editTokoEmail').value = button.dataset.email;
  document.getElementById('editTokoTelepon').value = button.dataset.telepon;
  document.getElementById('editTokoAlamat').value = button.dataset.alamat;
  document.getElementById('editTokoStatus').value = button.dataset.status;
  document.getElementById('editTokoPassword').value = '';
  openModal('modalEditToko');
}
</script>
</body></html>

