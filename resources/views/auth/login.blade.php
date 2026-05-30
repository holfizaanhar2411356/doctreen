<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Masuk — Doctreen</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root{--g50:#EAF3DE;--g100:#C0DD97;--g200:#97C459;--g400:#639922;--g600:#3B6D11;--g800:#27500A;--g900:#173404;--gray:#D3D1C7;--gm:#888780;--text:#1a2e0d;--tm:#4a5c3a;--bg:#f7faf2;--r400:#E24B4A}
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'DM Sans',sans-serif;background:var(--bg);min-height:100vh;display:flex}
        .auth-left{flex:1;background:var(--g900);padding:3rem;display:flex;flex-direction:column;justify-content:space-between;position:relative;overflow:hidden}
        .auth-left::before{content:'';position:absolute;bottom:-20%;right:-10%;width:400px;height:400px;border-radius:50%;background:rgba(99,153,34,.12)}
        .auth-logo{font-family:'DM Serif Display',serif;font-size:1.5rem;color:#EAF3DE;text-decoration:none}
        .auth-logo span{color:#97C459}
        .auth-tagline h2{font-family:'DM Serif Display',serif;font-size:2rem;color:white;line-height:1.2;margin-bottom:.75rem}
        .auth-tagline p{color:rgba(255,255,255,.5);font-size:.9rem;line-height:1.7}
        .testimonial{background:rgba(255,255,255,.07);border-radius:12px;padding:1.25rem}
        .testimonial p{color:rgba(255,255,255,.75);font-size:.875rem;line-height:1.6;margin-bottom:.75rem;font-style:italic}
        .t-av{width:32px;height:32px;border-radius:50%;background:var(--g400);display:inline-flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:600;color:white;margin-right:8px;vertical-align:middle}
        .t-name{font-size:.8rem;color:rgba(255,255,255,.6)}
        .auth-right{flex:1;display:flex;align-items:center;justify-content:center;padding:3rem}
        .form-wrap{width:100%;max-width:400px}
        .form-title{font-family:'DM Serif Display',serif;font-size:1.75rem;color:var(--g900);margin-bottom:.5rem}
        .form-sub{font-size:.875rem;color:var(--tm);margin-bottom:2rem}
        .role-selector{display:grid;grid-template-columns:1fr 1fr;gap:.75rem;margin-bottom:1.75rem}
        .role-btn{padding:.75rem;border:1.5px solid var(--gray);border-radius:10px;background:white;cursor:pointer;text-align:center;transition:all .2s;font-family:'DM Sans',sans-serif}
        .role-btn.active{border-color:var(--g400);background:var(--g50)}
        .role-icon{font-size:1.4rem;display:block;margin-bottom:4px}
        .role-label{font-size:.8rem;font-weight:500;color:var(--tm)}
        .role-btn.active .role-label{color:var(--g600)}
        .fg{margin-bottom:1.25rem}
        label{display:block;font-size:.82rem;font-weight:500;color:var(--text);margin-bottom:6px}
        input[type=text],input[type=password]{width:100%;padding:.7rem .9rem;border:1.5px solid var(--gray);border-radius:8px;font-size:.9rem;font-family:'DM Sans',sans-serif;color:var(--text);background:white;transition:border-color .2s;outline:none}
        input:focus{border-color:var(--g400)}
        .forgot{font-size:.8rem;color:var(--g600);text-decoration:none;float:right}
        .btn-sub{width:100%;padding:.875rem;background:var(--g600);color:white;border:none;border-radius:10px;font-size:1rem;font-weight:500;font-family:'DM Sans',sans-serif;cursor:pointer;transition:background .2s;margin-top:.5rem}
        .btn-sub:hover{background:var(--g800)}
        .auth-sw{text-align:center;margin-top:1.5rem;font-size:.875rem;color:var(--tm)}
        .auth-sw a{color:var(--g600);text-decoration:none;font-weight:500}
        .auth-back{margin:0 0 1rem; font-size:.85rem;}
        .auth-back a{color:var(--g600); text-decoration:none;}
        .auth-back a:hover{text-decoration:underline;}
        .div{display:flex;align-items:center;gap:1rem;margin:1.25rem 0}
        .div::before,.div::after{content:'';flex:1;height:1px;background:var(--gray)}
        .div span{font-size:.75rem;color:var(--gm)}
        @media(max-width:768px){.auth-left{display:none}.auth-right{padding:2rem 1.5rem}}
    </style>
</head>
<body>
<div class="auth-left">
  <a href="/" class="auth-logo" style="display: inline-block;">
    <img src="/images/doctreen_logo.png" alt="Doctreen" style="height: 48px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.25);">
  </a>
  <div class="auth-tagline">
    <h2>Solusi Cerdas untuk Petani Indonesia</h2>
    <p>Terhubung dengan konsultan pertanian berpengalaman dan dapatkan solusi tepat untuk tanaman Anda.</p>
  </div>
  <div class="testimonial">
    <p>"Doctreen benar-benar mengubah cara saya bertani. Dalam 30 menit, masalah padi saya yang terserang blas langsung ada solusinya."</p>
    <div><span class="t-av">SW</span><span class="t-name">Suwarno, Petani Padi — Karawang</span></div>
  </div>
</div>

<div class="auth-right">
    <div class="form-wrap">
        <h1 class="form-title">Selamat Datang</h1>
        <p class="form-sub">Masuk ke akun Doctreen Anda</p>
        <p class="auth-back"><a href="{{ route('home') }}">← Kembali ke Beranda</a></p>

       <div class="role-selector">
    <button type="button" class="role-btn active" id="btn-petani" onclick="setRole(this, 'petani')">
        <span class="role-icon">🌾</span>
        <span class="role-label">Petani</span>
    </button>
    
    <button type="button" class="role-btn" id="btn-konsultan" onclick="setRole(this, 'konsultan')">
        <span class="role-icon">👨‍🔬</span>
        <span class="role-label">Konsultan</span>
    </button>
</div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="hidden" name="role" id="roleInput" value="petani">

            <div class="fg">
                <label>Nomor Telepon / Email</label>
                <input type="text" name="identifier" placeholder="08xx atau email@example.com" value="{{ old('identifier') }}" required autofocus>
                @error('identifier')
                    <span style="color:var(--r400); font-size:0.75rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="fg">
               <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password" required>
                @error('password')
                    <span style="color:var(--r400); font-size:0.75rem;">{{ $message }}</span>
                @enderror
            </div>

            @if(session('error'))
                <p style="color:var(--r400); font-size:.82rem; margin-bottom:.75rem">{{ session('error') }}</p>
            @endif

            <button type="submit" class="btn-sub">Masuk</button>
        </form>

        <div class="div"><span>atau</span></div>
        <div class="auth-sw">Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></div>
    </div>
</div>

<script>
/**
 * Mengatur peran (role) saat tombol diklik.
 * Memperbarui tampilan tombol dan nilai input hidden yang akan dikirim ke server.
 */
function setRole(el, r) {
  document.querySelectorAll('.role-btn').forEach(b => b.classList.remove('active'));
  el.classList.add('active');
  document.getElementById('roleInput').value = r;
}
</script>
</body>
</html>