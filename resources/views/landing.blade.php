<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctreen — Solusi Kesehatan Tanaman Anda</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        /* RESET & VARIABLES */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --green-deep: #1a3d2b;
            --green-mid: #2d6a4f;
            --green-light: #52b788;
            --green-pale: #d8f3dc;
            --cream: #f8f4ec;
            --gold: #c9a84c;
            --text-dark: #1c2b1e;
            --text-muted: #5a7060;
            --white: #ffffff;
            --shadow: 0 20px 60px rgba(26,61,43,0.1);
        }

        html { scroll-behavior: smooth; }
        body { font-family: 'DM Sans', sans-serif; background: var(--cream); color: var(--text-dark); overflow-x: hidden; }

        /* NAV */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.2rem 4rem;
            background: rgba(248, 244, 236, 0.85);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(82, 183, 136, 0.15);
        }
        .logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .logo-icon { width: 38px; height: 38px; background: var(--green-mid); border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .logo-icon svg { width: 22px; height: 22px; fill: #fff; }
        .logo-text { font-family: 'Playfair Display', serif; font-size: 1.4rem; color: var(--green-deep); font-weight: 700; }
        .logo-text span { color: var(--green-light); }
        
        nav ul { list-style: none; display: flex; gap: 2rem; align-items: center; }
        nav ul a { text-decoration: none; color: var(--text-muted); font-size: .9rem; font-weight: 500; transition: color .3s; }
        nav ul a:hover { color: var(--green-mid); }
        .nav-cta { background: var(--green-mid); color: #fff !important; padding: .6rem 1.4rem; border-radius: 50px; }
        .nav-cta:hover { background: var(--green-deep) !important; }

        /* HERO */
        .hero {
            min-height: 100vh; display: grid; grid-template-columns: 1.1fr 0.9fr;
            align-items: center; padding: 8rem 4rem 4rem; gap: 4rem;
            position: relative;
        }
        .hero-tag {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--green-pale); color: var(--green-mid);
            padding: .5rem 1.2rem; border-radius: 50px;
            font-size: .75rem; font-weight: 700; letter-spacing: .05em;
            text-transform: uppercase; margin-bottom: 1.5rem;
        }
        h1 { font-family: 'Playfair Display', serif; font-size: 4rem; line-height: 1.1; color: var(--green-deep); margin-bottom: 1.5rem; }
        h1 em { font-style: italic; color: var(--green-mid); }
        .hero-desc { font-size: 1.1rem; line-height: 1.8; color: var(--text-muted); max-width: 500px; margin-bottom: 2.5rem; }
        .hero-buttons { display: flex; gap: 1rem; }
        
        .btn { padding: 1rem 2.2rem; border-radius: 50px; text-decoration: none; font-weight: 600; font-size: 1rem; transition: all .3s ease; display: inline-flex; align-items: center; gap: 10px; }
        .btn-primary { background: var(--green-mid); color: var(--white); box-shadow: 0 10px 20px rgba(45, 106, 79, 0.2); }
        .btn-primary:hover { transform: translateY(-3px); background: var(--green-deep); }
        .btn-outline { border: 2px solid var(--green-mid); color: var(--green-mid); }
        .btn-outline:hover { background: var(--green-pale); }

        /* HERO VISUAL */
        .hero-visual { position: relative; }
        .hero-card-main { background: #fff; border-radius: 30px; padding: 2.5rem; width: 100%; max-width: 400px; box-shadow: var(--shadow); position: relative; z-index: 5; }
        .card-header-img { width: 100%; height: 200px; border-radius: 20px; background: linear-gradient(135deg, var(--green-pale), #b7e4c7); display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; }
        .leaf-svg { width: 100px; height: 100px; filter: drop-shadow(0 5px 15px rgba(0,0,0,0.1)); }
        
        .konsultan-info { display: flex; align-items: center; gap: 15px; margin-bottom: 1.5rem; }
        .avatar { width: 50px; height: 50px; border-radius: 50%; background: var(--green-mid); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: bold; }
        .chat-preview { background: var(--green-pale); border-radius: 15px; padding: 1.2rem; font-size: .85rem; border-left: 4px solid var(--green-light); position: relative; }
        
        /* FLOATING BADGES */
        .badge { position: absolute; background: #fff; padding: 1rem; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); display: flex; align-items: center; gap: 12px; z-index: 10; transition: transform 0.3s ease; }
        .badge:hover { transform: scale(1.05); }
        .badge-left { top: 20%; left: -40px; }
        .badge-right { bottom: 15%; right: -30px; }

        /* FEATURES SECTION */
        section { padding: 6rem 4rem; }
        .section-header { text-align: center; max-width: 700px; margin: 0 auto 4rem; }
        .section-tag { color: var(--green-mid); font-weight: 700; text-transform: uppercase; font-size: .8rem; letter-spacing: 2px; margin-bottom: 1rem; display: block; }
        .section-title { font-family: 'Playfair Display', serif; font-size: 2.8rem; color: var(--green-deep); margin-bottom: 1.2rem; }
        
        .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; }
        .feature-card { background: #fff; padding: 2.5rem; border-radius: 24px; transition: all 0.3s ease; border: 1px solid rgba(0,0,0,0.03); }
        .feature-card:hover { transform: translateY(-10px); box-shadow: var(--shadow); border-color: var(--green-pale); }
        .feature-icon { font-size: 2.5rem; margin-bottom: 1.5rem; display: block; }

        /* HOW IT WORKS */
        .how-it-works { background: var(--green-deep); color: #fff; border-radius: 50px; margin: 0 2rem; }
        .how-it-works .section-title { color: #fff; }
        .steps { display: grid; grid-template-columns: repeat(4, 1fr); gap: 3rem; margin-top: 4rem; position: relative; }
        .step { text-align: center; z-index: 2; }
        .step-num { width: 60px; height: 60px; border-radius: 50%; background: var(--green-mid); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; font-size: 1.5rem; font-family: 'Playfair Display', serif; font-weight: 700; border: 3px solid var(--green-light); }

        /* CONSULTANT CARD */
        .c-card { background: #fff; border-radius: 24px; padding: 2rem; border: 1px solid rgba(0,0,0,0.05); transition: 0.3s; }
        .c-card:hover { transform: translateY(-5px); box-shadow: var(--shadow); }
        .c-top { display: flex; gap: 15px; margin-bottom: 1.5rem; }
        .c-tags { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 1.5rem; }
        .c-tag { background: var(--green-pale); color: var(--green-mid); padding: 4px 12px; border-radius: 20px; font-size: .75rem; font-weight: 600; }
        .c-footer { display: flex; justify-content: space-between; align-items: center; padding-top: 1rem; border-top: 1px solid #eee; }

        /* TOKO SECTION */
        .toko-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
        .p-card { background: #fff; border-radius: 20px; overflow: hidden; transition: 0.3s; }
        .p-img { height: 160px; background: var(--green-pale); display: flex; align-items: center; justify-content: center; font-size: 3rem; }
        .p-info { padding: 1.2rem; }

        /* CTA SECTION */
        .cta { text-align: center; background: linear-gradient(rgba(26, 61, 43, 0.9), rgba(26, 61, 43, 0.9)), url('https://images.unsplash.com/photo-1464226184884-fa280b87c399?auto=format&fit=crop&q=80&w=2000'); background-size: cover; background-position: center; color: #fff; padding: 8rem 4rem; margin: 4rem 2rem; border-radius: 50px; }

        /* FOOTER */
        footer { background: var(--green-deep); color: rgba(255,255,255,0.7); padding: 5rem 4rem 2rem; }
        .footer-grid { display: grid; grid-template-columns: 1.5fr 1fr 1fr 1fr; gap: 4rem; margin-bottom: 4rem; }
        .footer-link { color: rgba(255,255,255,0.5); text-decoration: none; display: block; margin-bottom: 10px; transition: 0.3s; }
        .footer-link:hover { color: var(--green-light); padding-left: 5px; }

        /* MOBILE RESPONSIVE */
        @media (max-width: 1024px) {
            .hero { grid-template-columns: 1fr; text-align: center; padding-top: 10rem; }
            .hero-desc { margin: 0 auto 2.5rem; }
            .hero-buttons { justify-content: center; }
            .hero-visual { margin-top: 4rem; display: flex; justify-content: center; }
            .grid-3, .steps, .toko-grid { grid-template-columns: repeat(2, 1fr); }
            .badge { display: none; }
        }

        @media (max-width: 768px) {
            nav { padding: 1rem 1.5rem; }
            nav ul { display: none; }
            section { padding: 4rem 1.5rem; }
            h1 { font-size: 2.8rem; }
            .grid-3, .steps, .toko-grid, .footer-grid { grid-template-columns: 1fr; }
            .how-it-works { border-radius: 30px; margin: 0 10px; }
            .cta { margin: 2rem 10px; border-radius: 30px; padding: 4rem 1.5rem; }
        }
    </style>
</head>
<body>

    <nav>
        <a href="#" class="logo">
            <div class="logo-icon">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15v-4H7l5-8v4h4l-5 8z"/></svg>
            </div>
            <span class="logo-text">Doc<span>tree</span>n</span>
        </a>
        <ul>
            <li><a href="#features">Fitur</a></li>
            <li><a href="#how">Cara Kerja</a></li>
            <li><a href="#consultants">Konsultan</a></li>
            <li><a href="#shop">Toko</a></li>
            <li><a href="#" class="nav-cta">Mulai Sekarang</a></li>
        </ul>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <div class="hero-tag">✨ Platform Agrikultur Terpercaya</div>
            <h1>Rawat Tanamanmu <br>dengan <em>Ahli Berlisensi</em></h1>
            <p class="hero-desc">Dapatkan diagnosis penyakit tanaman secara instan dan konsultasi langsung dengan ahli botani profesional untuk hasil panen maksimal.</p>
            <div class="hero-buttons">
                <a href="register" class="btn btn-primary">daftar Gratis</a>
                <a href="login" class="btn btn-outline">masuk</a>
            </div>
        </div>

        <div class="hero-visual">
            <div class="hero-card-main">
                <div class="card-header-img">
                    <svg class="leaf-svg" viewBox="0 0 100 100">
                        <ellipse cx="50" cy="50" rx="30" ry="45" fill="#2d6a4f" transform="rotate(-20 50 50)"/>
                        <line x1="50" y1="20" x2="50" y2="80" stroke="#52b788" stroke-width="2"/>
                        <line x1="50" y1="40" x2="35" y2="55" stroke="#52b788" stroke-width="1.5"/>
                        <line x1="50" y1="50" x2="65" y2="60" stroke="#52b788" stroke-width="1.5"/>
                    </svg>
                </div>
                <div class="konsultan-info">
                    <div class="avatar">RH</div>
                    <div>
                        <p style="font-weight: 700;">Dr. Rini Hartati, M.P.</p>
                        <p style="font-size: 0.75rem; color: var(--text-muted);">Spesialis Fitopatologi</p>
                    </div>
                </div>
                <div class="chat-preview">
                    <p style="font-weight: 700; font-size: 0.7rem; color: var(--green-mid); margin-bottom: 5px;">DIAGNOSIS TERDETEKSI</p>
                    "Tanaman tomat Anda terkena <b>Late Blight</b>. Disarankan pemangkasan area terinfeksi..."
                </div>
            </div>
            
            <div class="badge badge-left">
                <span style="font-size: 1.5rem;">🌿</span>
                <div>
                    <p style="font-weight: 700; font-size: 0.8rem;">24 Petani Aktif</p>
                    <p style="font-size: 0.7rem; color: var(--text-muted);">Sedang berkonsultasi</p>
                </div>
            </div>

            <div class="badge badge-right">
                <span style="font-size: 1.5rem;">⭐</span>
                <div>
                    <p style="font-weight: 700; font-size: 0.8rem;">Rating 4.9/5.0</p>
                    <p style="font-size: 0.7rem; color: var(--text-muted);">Kepuasan pengguna</p>
                </div>
            </div>
        </div>
    </section>

    <section id="features">
        <div class="section-header">
            <span class="section-tag">Keunggulan Kami</span>
            <h2 class="section-title">Solusi Lengkap untuk Petani Modern</h2>
        </div>
        <div class="grid-3">
            <div class="feature-card">
                <span class="feature-icon">🔍</span>
                <h3 style="margin-bottom: 1rem;">Diagnosis Akurat</h3>
                <p style="color: var(--text-muted); font-size: 0.95rem;">Teknologi analisis visual dipadukan dengan keahlian konsultan manusia untuk hasil diagnosis tepat.</p>
            </div>
            <div class="feature-card">
                <span class="feature-icon">💬</span>
                <h3 style="margin-bottom: 1rem;">Chat Real-time</h3>
                <p style="color: var(--text-muted); font-size: 0.95rem;">Ngobrol langsung dengan konsultan tanpa bot. Tanya jawab lebih personal dan mendalam.</p>
            </div>
            <div class="feature-card">
                <span class="feature-icon">🛍️</span>
                <h3 style="margin-bottom: 1rem;">Toko Rekomendasi</h3>
                <p style="color: var(--text-muted); font-size: 0.95rem;">Dapatkan akses langsung ke pupuk dan pestisida yang diresepkan oleh para ahli kami.</p>
            </div>
        </div>
    </section>

    <section id="how" class="how-it-works">
        <div class="section-header">
            <span class="section-tag" style="color: var(--green-light);">Alur Proses</span>
            <h2 class="section-title">Hanya 4 Langkah Mudah</h2>
        </div>
        <div class="steps">
            <div class="step">
                <div class="step-num">01</div>
                <p style="font-weight: 700; margin-bottom: 8px;">Upload Foto</p>
                <p style="font-size: 0.85rem; color: rgba(255,255,255,0.6);">Ambil foto bagian tanaman yang sakit.</p>
            </div>
            <div class="step">
                <div class="step-num">02</div>
                <p style="font-weight: 700; margin-bottom: 8px;">Pilih Ahli</p>
                <p style="font-size: 0.85rem; color: rgba(255,255,255,0.6);">Pilih konsultan sesuai spesialisasi.</p>
            </div>
            <div class="step">
                <div class="step-num">03</div>
                <p style="font-weight: 700; margin-bottom: 8px;">Diskusi</p>
                <p style="font-size: 0.85rem; color: rgba(255,255,255,0.6);">Konsultasi via chat interaktif.</p>
            </div>
            <div class="step">
                <div class="step-num">04</div>
                <p style="font-weight: 700; margin-bottom: 8px;">Terapkan Solusi</p>
                <p style="font-size: 0.85rem; color: rgba(255,255,255,0.6);">Ikuti arahan dan pantau hasilnya.</p>
            </div>
        </div>
    </section>

    <section id="consultants">
        <div class="section-header">
            <span class="section-tag">Expert Directory</span>
            <h2 class="section-title">Konsultan Terbaik Minggu Ini</h2>
        </div>
        <div class="grid-3">
            <div class="c-card">
                <div class="c-top">
                    <div class="avatar">RH</div>
                    <div>
                        <p style="font-weight: 700;">Dr. Rini Hartati</p>
                        <p style="font-size: 0.8rem; color: var(--gold);">★★★★★ <span style="color: #999;">(312)</span></p>
                    </div>
                </div>
                <div class="c-tags">
                    <span class="c-tag">Padi</span> <span class="c-tag">Jagung</span> <span class="c-tag">Hama</span>
                </div>
                <div class="c-footer">
                    <p style="font-weight: 700; color: var(--green-mid);">Rp 75k<span style="font-size: 0.7rem; font-weight: 400; color: #999;">/sesi</span></p>
                    <a href="#" style="color: var(--green-mid); text-decoration: none; font-weight: 700; font-size: 0.9rem;">Chat Ahli →</a>
                </div>
            </div>
            <div class="c-card">
                <div class="c-top">
                    <div class="avatar" style="background: var(--green-deep);">BA</div>
                    <div>
                        <p style="font-weight: 700;">Ir. Budi Aryanto</p>
                        <p style="font-size: 0.8rem; color: var(--gold);">★★★★★ <span style="color: #999;">(245)</span></p>
                    </div>
                </div>
                <div class="c-tags">
                    <span class="c-tag">Sawit</span> <span class="c-tag">Kopi</span> <span class="c-tag">Nutrisi</span>
                </div>
                <div class="c-footer">
                    <p style="font-weight: 700; color: var(--green-mid);">Rp 90k<span style="font-size: 0.7rem; font-weight: 400; color: #999;">/sesi</span></p>
                    <a href="#" style="color: var(--green-mid); text-decoration: none; font-weight: 700; font-size: 0.9rem;">Chat Ahli →</a>
                </div>
            </div>
            <div class="c-card">
                <div class="c-top">
                    <div class="avatar" style="background: var(--green-light);">SW</div>
                    <div>
                        <p style="font-weight: 700;">Sari Wulandari</p>
                        <p style="font-size: 0.8rem; color: var(--gold);">★★★★☆ <span style="color: #999;">(189)</span></p>
                    </div>
                </div>
                <div class="c-tags">
                    <span class="c-tag">Hidroponik</span> <span class="c-tag">Sayur</span>
                </div>
                <div class="c-footer">
                    <p style="font-weight: 700; color: var(--green-mid);">Rp 55k<span style="font-size: 0.7rem; font-weight: 400; color: #999;">/sesi</span></p>
                    <a href="#" style="color: var(--green-mid); text-decoration: none; font-weight: 700; font-size: 0.9rem;">Chat Ahli →</a>
                </div>
            </div>
        </div>
    </section>

    <section id="shop">
        <div class="section-header">
            <span class="section-tag">Marketplace</span>
            <h2 class="section-title">Produk Rekomendasi Ahli</h2>
        </div>
        <div class="toko-grid">
            <div class="p-card">
                <div class="p-img">🌱</div>
                <div class="p-info">
                    <p style="font-weight: 700; font-size: 0.9rem; margin-bottom: 5px;">Mankozeb 80%</p>
                    <p style="color: var(--green-mid); font-weight: 700;">Rp 45.000</p>
                    <p style="font-size: 0.7rem; color: #999; margin-top: 5px;">Tersedia di Toko Agri</p>
                </div>
            </div>
            <div class="p-card">
                <div class="p-img">🧪</div>
                <div class="p-info">
                    <p style="font-weight: 700; font-size: 0.9rem; margin-bottom: 5px;">NPK Mutiara 16</p>
                    <p style="color: var(--green-mid); font-weight: 700;">Rp 120.000</p>
                    <p style="font-size: 0.7rem; color: #999; margin-top: 5px;">Tersedia di Toko Agri</p>
                </div>
            </div>
            <div class="p-card">
                <div class="p-img">🌿</div>
                <div class="p-info">
                    <p style="font-weight: 700; font-size: 0.9rem; margin-bottom: 5px;">Abamektin 18EC</p>
                    <p style="color: var(--green-mid); font-weight: 700;">Rp 68.000</p>
                    <p style="font-size: 0.7rem; color: #999; margin-top: 5px;">Tersedia di Toko Agri</p>
                </div>
            </div>
            <div class="p-card">
                <div class="p-img">💧</div>
                <div class="p-info">
                    <p style="font-weight: 700; font-size: 0.9rem; margin-bottom: 5px;">ZPT Rootone F</p>
                    <p style="color: var(--green-mid); font-weight: 700;">Rp 32.500</p>
                    <p style="font-size: 0.7rem; color: #999; margin-top: 5px;">Tersedia di Toko Agri</p>
                </div>
            </div>
        </div>
    </section>

    <section class="cta">
        <h2 style="font-family: 'Playfair Display', serif; font-size: 3rem; margin-bottom: 1.5rem;">Mari Tingkatkan Hasil Panen Bersama</h2>
        <p style="margin-bottom: 2.5rem; opacity: 0.9; max-width: 600px; margin-left: auto; margin-right: auto;">Dapatkan akses ke ratusan ahli pertanian hanya dalam satu genggaman tangan Anda.</p>
        <a href="#" class="btn btn-primary" style="background: #fff; color: var(--green-deep);">Daftar Sekarang — Gratis</a>
    </section>

    <footer>
        <div class="footer-grid">
            <div>
                <div class="logo" style="margin-bottom: 1.5rem;">
                    <div class="logo-icon"><svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15v-4H7l5-8v4h4l-5 8z"/></svg></div>
                    <span class="logo-text" style="color: #fff;">Doc<span>tree</span>n</span>
                </div>
                <p style="font-size: 0.9rem; line-height: 1.6;">Menghubungkan teknologi dan keahlian untuk masa depan pertanian Indonesia yang lebih hijau.</p>
            </div>
            <div>
                <p style="font-weight: 700; color: #fff; margin-bottom: 1.5rem;">Menu</p>
                <a href="#" class="footer-link">Beranda</a>
                <a href="#" class="footer-link">Cari Konsultan</a>
                <a href="#" class="footer-link">Belanja Alat</a>
            </div>
            <div>
                <p style="font-weight: 700; color: #fff; margin-bottom: 1.5rem;">Bantuan</p>
                <a href="#" class="footer-link">Syarat & Ketentuan</a>
                <a href="#" class="footer-link">Kebijakan Privasi</a>
                <a href="#" class="footer-link">FAQ</a>
            </div>
            <div>
                <p style="font-weight: 700; color: #fff; margin-bottom: 1.5rem;">Kontak</p>
                <p style="font-size: 0.85rem;">support@doctreen.id</p>
                <p style="font-size: 0.85rem; margin-top: 10px;">Bandung, Jawa Barat</p>
            </div>
        </div>
        <div style="text-align: center; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 2rem; font-size: 0.8rem;">
            © 2026 Doctreen. Dibuat dengan ❤ untuk Petani Indonesia.
        </div>
    </footer>

</body>
</html>