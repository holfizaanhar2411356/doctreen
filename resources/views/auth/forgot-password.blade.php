<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Lupa Password — Doctreen</title>
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
            top: 10%;
            left: 10%;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            background: rgba(99, 153, 34, 0.04);
            filter: blur(80px);
        }
        .card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(39, 80, 10, 0.06);
            padding: 2.75rem;
            width: 100%;
            max-width: 460px;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-2px);
        }
        .header { text-align:center; margin-bottom:2rem }
        .logo { font-family:'DM Serif Display',serif; font-size:1.6rem; color:var(--g900); text-decoration:none; display:block; margin-bottom:0.75rem }
        .logo span { color:var(--g400) }
        .title { font-family:'DM Serif Display',serif; font-size:1.5rem; color:var(--g900); margin-bottom:.5rem }
        .sub { font-size:.875rem; color:var(--tm); line-height:1.5 }
        .fg { margin-bottom:1.5rem }
        label { display:block; font-size:.82rem; font-weight:600; color:var(--text); margin-bottom:6px }
        input {
            width:100%;
            padding:.75rem .95rem;
            border:1.5px solid var(--gray);
            border-radius:8px;
            font-size:.9rem;
            outline:none;
            background: rgba(255, 255, 255, 0.8);
            transition: all 0.2s ease;
        }
        input:focus {
            border-color:var(--g400);
            background: #fff;
        }
        .btn-sub {
            width:100%;
            padding:.875rem;
            background:var(--g600);
            color:white;
            border:none;
            border-radius:10px;
            font-size:0.95rem;
            font-weight:600;
            cursor:pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(59, 109, 17, 0.15);
        }
        .btn-sub:hover {
            background:var(--g800);
            box-shadow: 0 6px 16px rgba(39, 80, 10, 0.25);
        }
        .sw { text-align:center; margin-top:1.5rem; font-size:.875rem; color:var(--tm) }
        .sw a { color:var(--g600); text-decoration:none; font-weight:600 }
        .sw a:hover { text-decoration:underline; }
        .error-text { color: var(--red); font-size: 0.75rem; margin-top: 5px; display: block; font-weight: 500; }
        
        .alert-success {
            background-color: var(--g50);
            border: 1.5px solid var(--g100);
            color: var(--g800);
            border-radius: 10px;
            padding: 1rem;
            font-size: 0.85rem;
            font-weight: 500;
            line-height: 1.5;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <a href="/" class="logo">Doc<span>tree</span>n</a>
            <h1 class="title">Lupa Password?</h1>
            <p class="sub">Masukkan alamat email Anda untuk mendapatkan tautan pengaturan ulang password.</p>
        </div>
        @if (session('status'))
            <div class="alert-success">
                <span style="font-size: 1.1rem; margin-right: 4px;">✉️</span>
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="fg">
                <label>Alamat Email Terdaftar</label>
                <input type="email" name="email" placeholder="email@domain.com" value="{{ old('email') }}" required autofocus>
                @error('email') <span class="error-text">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn-sub">Kirim Link Reset Password</button>
        </form>
        <div class="sw">Kembali ke <a href="{{ route('login') }}">Halaman Masuk</a></div>
    </div>
</body>
</html>
