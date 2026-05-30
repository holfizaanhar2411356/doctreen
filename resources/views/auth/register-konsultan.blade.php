<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Gabung Konsultan — Doctreen</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root { 
            --g50: #EAF3DE; 
            --g100: #C0DD97; 
            --g400: #639922; 
            --g600: #3B6D11; 
            --g800: #27500A; 
            --g900: #173404; 
            --gray: #D3D1C7; 
            --gm: #888780; 
            --text: #1a2e0d; 
            --tm: #4a5c3a; 
            --bg: #f7faf2; 
            --red: #e3342f; 
        }
        * { margin:0; padding:0; box-sizing:border-box }
        body { 
            font-family:'DM Sans', sans-serif; 
            background: linear-gradient(135deg, #f7faf2 0%, #eaf3de 100%);
            min-height:100vh; 
            display:flex; 
            align-items:center; 
            justify-content:center; 
            padding:2rem;
            position: relative;
        }
        body::before {
            content: '';
            position: absolute;
            top: 5%;
            left: 5%;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(99, 153, 34, 0.05);
            filter: blur(80px);
            z-index: 0;
        }
        body::after {
            content: '';
            position: absolute;
            bottom: 5%;
            right: 5%;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            background: rgba(39, 80, 10, 0.05);
            filter: blur(100px);
            z-index: 0;
        }
        .reg-card { 
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 24px; 
            box-shadow: 0 12px 40px rgba(39, 80, 10, 0.08); 
            padding: 3rem; 
            width: 100%; 
            max-width: 550px;
            position: relative;
            z-index: 1;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .reg-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 48px rgba(39, 80, 10, 0.12);
        }
        .reg-header { text-align:center; margin-bottom:2.25rem }
        .logo { font-family:'DM Serif Display',serif; font-size:1.75rem; color:var(--g900); text-decoration:none; display:block; margin-bottom:0.75rem }
        .logo span { color:var(--g400) }
        .reg-title { font-family:'DM Serif Display',serif; font-size:1.65rem; color:var(--g900); margin-bottom:.5rem }
        .reg-sub { font-size:.9rem; color:var(--tm); line-height: 1.5 }
        .row { display:grid; grid-template-columns:1fr 1fr; gap:.75rem }
        .fg { margin-bottom:1.25rem }
        label { display:block; font-size:.82rem; font-weight:600; color:var(--text); margin-bottom:6px }
        input { 
            width:100%; 
            padding:.75rem .95rem; 
            border:1.5px solid var(--gray); 
            border-radius:10px; 
            font-size:.875rem; 
            outline:none; 
            background: rgba(255, 255, 255, 0.8);
            transition: all 0.25s ease;
        }
        input:focus { 
            border-color:var(--g400); 
            background: #fff;
            box-shadow: 0 0 0 4px rgba(99, 153, 34, 0.1);
        }
        .btn-sub { 
            width:100%; 
            padding:1rem; 
            background:var(--g600); 
            color:white; 
            border:none; 
            border-radius:12px; 
            font-size:1rem; 
            font-weight: 600;
            cursor:pointer; 
            margin-top:.75rem;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(59, 109, 17, 0.2);
        }
        .btn-sub:hover { 
            background:var(--g800); 
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(39, 80, 10, 0.3);
        }
        .btn-sub:active {
            transform: translateY(1px);
        }
        .sw { text-align:center; margin-top:1.5rem; font-size:.875rem; color:var(--tm) }
        .sw a { color:var(--g600); text-decoration:none; font-weight:600 }
        .sw a:hover { text-decoration: underline; }
        .error-text { color: var(--red); font-size: 0.75rem; margin-top: 5px; display: block; font-weight: 500; }
        
        .pending-alert {
            background-color: var(--g50); 
            border: 1.5px solid var(--g100); 
            color: var(--g800); /* Menggunakan warna #27500A */
            border-radius: 14px; 
            padding: 1.15rem 1.35rem; 
            font-size: 0.875rem; 
            font-weight: 500; 
            line-height: 1.6; 
            margin-bottom: 2rem; 
            box-shadow: 0 6px 16px rgba(39, 80, 10, 0.04);
            animation: fadeIn 0.4s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @media(max-width:480px){ 
            .row { grid-template-columns:1fr } 
            .reg-card { padding: 2rem 1.5rem; }
        }
    </style>
</head>
<body>
    <div class="reg-card">
        <div class="reg-header">
            <a href="/" class="logo" style="display: inline-block;">
                <img src="/images/doctreen_logo.png" alt="Doctreen" style="height: 48px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.15);">
            </a>
            <h1 class="reg-title">Gabung Sebagai Konsultan</h1>
            <p class="reg-sub">Bagikan keahlian sains pertanian Anda bersama ribuan petani mitra Doctreen</p>
        </div>
        @if (session('status_pending'))
            <div class="pending-alert">
                <div style="display: flex; gap: 8px; align-items: flex-start;">
                    <span style="font-size: 1.3rem; line-height: 1;">🌱</span>
                    <div>
                        <strong style="display: block; margin-bottom: 4px; font-size: 0.95rem;">Pendaftaran Berhasil!</strong>
                        {{ session('status_pending') }}
                    </div>
                </div>
            </div>
        @endif
        @if (session('error'))
            <div class="error-text" style="font-size:0.85rem; margin-bottom:20px; background: rgba(227, 52, 47, 0.05); padding: 0.75rem 1rem; border-radius: 10px; border-left: 4px solid var(--red);">
                {{ session('error') }}
            </div>
        @endif
        <form method="POST" action="{{ route('register.konsultan') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="fg">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Contoh: Dr. Ir. Budi" value="{{ old('nama') }}" required>
                    @error('nama') <span class="error-text">{{ $message }}</span> @enderror
                </div>
                <div class="fg">
                    <label>No. Telepon</label>
                    <input type="tel" name="telepon" placeholder="Contoh: 08123456789" value="{{ old('telepon') }}" required>
                    @error('telepon') <span class="error-text">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="fg">
                <label>Email</label>
                <input type="email" name="email" placeholder="Contoh: budi@doctreen.id" value="{{ old('email') }}" required>
                @error('email') <span class="error-text">{{ $message }}</span> @enderror
            </div>
            <div class="fg">
                <label>Spesialisasi / Keahlian Utama</label>
                <input type="text" name="spesialisasi" placeholder="Contoh: Hama & Penyakit Padi, Ilmu Tanah" value="{{ old('spesialisasi') }}" required>
                @error('spesialisasi') <span class="error-text">{{ $message }}</span> @enderror
            </div>
            <div class="fg">
                <label>Tarif Konsultasi (Rp)</label>
                <input type="number" name="tarif_konsultasi" placeholder="Kelipatan 1000. Contoh: 25000" value="{{ old('tarif_konsultasi', 0) }}" min="0" step="1000" required>
                @error('tarif_konsultasi') <span class="error-text">{{ $message }}</span> @enderror
            </div>
            <div class="row">
                <div class="fg">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Minimal 8 karakter" required>
                    @error('password') <span class="error-text">{{ $message }}</span> @enderror
                </div>
                <div class="fg">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password" required>
                </div>
            </div>
            <div class="fg">
                <label>Foto Profil / Dokumen ID</label>
                <input type="file" name="foto_profil" accept="image/*" style="padding: 0.45rem;">
                @error('foto_profil') <span class="error-text">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn-sub">Daftar Sekarang</button>
        </form>
        <div class="sw">Ingin daftar sebagai petani? <a href="{{ route('register') }}">Klik di sini</a></div>
        <div class="sw" style="margin-top: 1rem;">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></div>
    </div>
</body>
</html>
