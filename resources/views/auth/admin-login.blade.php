<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Login — Doctreen</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root{--g900:#173404;--g600:#3B6D11;--text:#1a2e0d;--bg:#f1efe8;--r400:#E24B4A;--gray:#D3D1C7}
        body{font-family:'DM Sans',sans-serif;background:var(--bg);display:flex;align-items:center;justify-content:center;min-height:100vh;margin:0}
        .admin-card{background:white;padding:2.5rem;border-radius:20px;box-shadow:0 10px 40px rgba(0,0,0,0.05);width:100%;max-width:400px;border:1px solid var(--gray)}
        .admin-header{text-align:center;margin-bottom:2rem}
        .admin-logo{font-family:'DM Serif Display',serif;font-size:1.75rem;color:var(--g900);text-decoration:none}
        .admin-logo span{color:#97C459}
        .badge{display:inline-block;padding:4px 12px;background:var(--g900);color:white;border-radius:20px;font-size:0.7rem;font-weight:600;margin-top:8px;letter-spacing:1px}
        .fg{margin-bottom:1.25rem}
        label{display:block;font-size:0.85rem;margin-bottom:6px;font-weight:600;color:var(--text)}
        input{width:100%;padding:0.85rem;border:1.5px solid var(--gray);border-radius:10px;box-sizing:border-box;outline:none;transition:border-color 0.2s}
        input:focus{border-color:var(--g600)}
        .btn-admin{width:100%;padding:1rem;background:var(--g900);color:white;border:none;border-radius:10px;cursor:pointer;font-weight:600;font-size:1rem;transition:opacity 0.2s}
        .btn-admin:hover{opacity:0.9}
        .back-link{display:block;text-align:center;margin-top:1.5rem;text-decoration:none;color:var(--gray400);font-size:0.85rem}
    </style>
</head>
<body>

<div class="admin-card">
    <div class="admin-header">
        <a href="/" class="admin-logo">Doc<span>tree</span>n</a><br>
        <span class="badge">ADMINISTRATOR</span>
    </div>

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <div class="fg">
            <label>Username / Email Admin</label>
            <input type="text" name="username" placeholder="Masukkan identitas admin" required autofocus>
        </div>

        <div class="fg">
            <label>Password</label>
            <input type="password" name="password" placeholder="••••••••" required>
        </div>

        @if(session('error'))
            <p style="color:var(--r400); font-size:0.8rem; text-align:center; margin-bottom:1rem">{{ session('error') }}</p>
        @endif

        <button type="submit" class="btn-admin">Masuk ke Panel Kontrol</button>
    </form>

    <a href="{{ route('login') }}" class="back-link">← Kembali ke Login User</a>
</div>

</body>
</html>