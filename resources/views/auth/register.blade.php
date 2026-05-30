<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Daftar — Doctreen</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root { --g50:#EAF3DE; --g100:#C0DD97; --g400:#639922; --g600:#3B6D11; --g800:#27500A; --g900:#173404; --gray:#D3D1C7; --gm:#888780; --text:#1a2e0d; --tm:#4a5c3a; --bg:#f7faf2; --red: #e3342f; }
        * { margin:0; padding:0; box-sizing:border-box }
        body { font-family:'DM Sans',sans-serif; background:var(--bg); min-height:100vh; display:flex; align-items:center; justify-content:center; padding:2rem }
        .reg-card { background:white; border-radius:20px; box-shadow:0 4px 32px rgba(39,80,10,.07); padding:2.5rem; width:100%; max-width:500px }
        .reg-header { text-align:center; margin-bottom:2rem }
        .logo { font-family:'DM Serif Display',serif; font-size:1.5rem; color:var(--g900); text-decoration:none; display:block; margin-bottom:1rem }
        .logo span { color:var(--g400) }
        .reg-title { font-family:'DM Serif Display',serif; font-size:1.5rem; color:var(--g900); margin-bottom:.35rem }
        .reg-sub { font-size:.875rem; color:var(--tm) }
        .role-sel { display:grid; grid-template-columns:1fr 1fr; gap:.75rem; margin-bottom:1.75rem }
        .role-btn { padding:.75rem; border:1.5px solid var(--gray); border-radius:10px; background:white; cursor:pointer; text-align:center; transition:all .2s }
        .role-btn.active { border-color:var(--g400); background:var(--g50) }
        .role-icon { font-size:1.4rem; display:block; margin-bottom:4px }
        .role-lbl { font-size:.8rem; font-weight:500; color:var(--tm) }
        .role-btn.active .role-lbl { color:var(--g600) }
        .row { display:grid; grid-template-columns:1fr 1fr; gap:.75rem }
        .fg { margin-bottom:1.1rem }
        label { display:block; font-size:.82rem; font-weight:500; color:var(--text); margin-bottom:5px }
        input { width:100%; padding:.7rem .9rem; border:1.5px solid var(--gray); border-radius:8px; font-size:.875rem; outline:none; }
        input:focus { border-color:var(--g400) }
        .btn-sub { width:100%; padding:.875rem; background:var(--g600); color:white; border:none; border-radius:10px; font-size:1rem; cursor:pointer; margin-top:.5rem }
        .btn-sub:hover { background:var(--g800) }
        .sw { text-align:center; margin-top:1.25rem; font-size:.875rem; color:var(--tm) }
        .sw a { color:var(--g600); text-decoration:none; font-weight:500 }
        .error-text { color: var(--red); font-size: 0.75rem; margin-top: 4px; display: block; }
        @media(max-width:480px){ .row { grid-template-columns:1fr } }
    </style>
</head>
<body>
    <div class="reg-card">
        <div class="reg-header">
            <a href="/" class="logo" style="display: inline-block;">
                <img src="/images/doctreen_logo.png" alt="Doctreen" style="height: 48px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.15);">
            </a>
            <h1 class="reg-title">Buat Akun Baru</h1>
            <p class="reg-sub">Mulai perjalanan pertanian yang lebih cerdas</p>
        </div>

        <div class="role-sel">
            <button type="button" class="role-btn {{ old('role', 'petani') == 'petani' ? 'active' : '' }}" onclick="setRole(this,'petani')">
                <span class="role-icon">🌾</span><span class="role-lbl">Saya Petani</span>
            </button>
            <button type="button" class="role-btn {{ old('role') == 'konsultan' ? 'active' : '' }}" onclick="setRole(this,'konsultan')">
                <span class="role-icon">👨‍🔬</span><span class="role-lbl">Saya Konsultan</span>
            </button>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="hidden" name="role" id="roleInput" value="{{ old('role', 'petani') }}">

            <div class="row">
                <div class="fg">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required>
                    @error('nama') <span class="error-text">{{ $message }}</span> @enderror
                </div>
                <div class="fg">
                    <label>No. Telepon</label>
                    <input type="tel" name="telepon" value="{{ old('telepon') }}" required>
                    @error('telepon') <span class="error-text">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="fg">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
                @error('email') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="fg" id="asalField" style="{{ old('role', 'petani') == 'petani' ? '' : 'display:none' }}">
                <label>Asal Daerah</label>
                <input type="text" name="asal" value="{{ old('asal') }}">
                @error('asal') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div id="expertiseField" class="fg" style="{{ old('role') == 'konsultan' ? '' : 'display:none' }}">
                <label>Spesialisasi / Keahlian</label>
                <input type="text" name="spesialisasi" value="{{ old('spesialisasi') }}">
                @error('spesialisasi') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div id="tarifField" class="fg" style="{{ old('role') == 'konsultan' ? '' : 'display:none' }}">
                <label>Tarif Konsultasi </label>
                <input type="number" name="tarif_konsultasi" value="{{ old('tarif_konsultasi', 0) }}" min="0" step="1000">
                @error('tarif_konsultasi') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="row">

                <div class="fg">
                    <label>Password</label>
                    <input type="password" name="password" required>
                    @error('password') <span class="error-text">{{ $message }}</span> @enderror
                </div>
                <div class="fg">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required>
                </div>
            </div>

            <button type="submit" class="btn-sub">Daftar Sekarang</button>
        </form>

        <div class="sw">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></div>
    </div>

    <script>
        function setRole(el, r) {
            document.querySelectorAll('.role-btn').forEach(b => b.classList.remove('active'));
            el.classList.add('active');
            document.getElementById('roleInput').value = r;
            document.getElementById('asalField').style.display = r === 'petani' ? '' : 'none';
            document.getElementById('expertiseField').style.display = r === 'konsultan' ? '' : 'none';
            document.getElementById('tarifField').style.display = r === 'konsultan' ? '' : 'none';

        }
    </script>
</body>
</html>