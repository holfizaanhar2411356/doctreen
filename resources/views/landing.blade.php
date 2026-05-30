<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctreen — Platform Konsultasi Kesehatan Tanaman Terpercaya</title>
    <meta name="description" content="Doctreen menghubungkan petani Indonesia dengan ahli fitopatologi berlisensi. Diagnosis akurat, konsultasi real-time, dan produk pertanian pilihan ahli.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ────────────────────────────────────────
           DESIGN TOKENS & RESET
        ──────────────────────────────────────── */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; font-size: 16px; }

        :root {
            /* Palette */
            --forest:     #031c10;
            --deep:       #062f1e;
            --mid:        #1a5c3a;
            --accent:     #2d8f5e;
            --sage:       #6aaa7e;
            --mint:       #b8e8cb;
            --pale:       #eaf4ee;
            --cream:      #f5f8f4;
            --white:      #ffffff;
            --gold:       #e8a020;
            --text:       #0d2618;
            --muted:      #486b54;
            --subtle:     #a4bfab;

            /* Shadows */
            --shadow-xs:  0 1px 4px rgba(3,28,16,.06);
            --shadow-sm:  0 4px 16px rgba(3,28,16,.08);
            --shadow-md:  0 12px 36px rgba(3,28,16,.10);
            --shadow-lg:  0 24px 64px rgba(3,28,16,.12);

            /* Radii */
            --r-sm:  10px;
            --r-md:  16px;
            --r-lg:  24px;
            --r-xl:  36px;

            /* Transitions */
            --ease:  cubic-bezier(.22,.68,0,1.2);
            --t-fast: .2s;
            --t-med:  .35s;
        }

        body {
            font-family: 'Outfit', system-ui, sans-serif;
            background: var(--cream);
            color: var(--text);
            overflow-x: hidden;
            line-height: 1.6;
            letter-spacing: -.012em;
        }

        /* ────────────────────────────────────────
           SCROLLBAR STYLING
        ──────────────────────────────────────── */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: var(--pale); }
        ::-webkit-scrollbar-thumb { background: var(--mint); border-radius: 99px; }

        /* ────────────────────────────────────────
           UTILITY
        ──────────────────────────────────────── */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 2rem; }
        .section-label {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            color: var(--accent);
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }
        .section-label::before {
            content: '';
            display: block;
            width: 20px;
            height: 2px;
            background: var(--accent);
            border-radius: 2px;
        }
        .section-title {
            font-family: 'Lora', Georgia, serif;
            font-size: clamp(1.8rem, 3.5vw, 2.8rem);
            font-weight: 700;
            line-height: 1.2;
            color: var(--deep);
        }
        .section-subtitle {
            font-size: 1.05rem;
            color: var(--muted);
            line-height: 1.75;
            max-width: 600px;
        }
        .section-header {
            margin-bottom: 3.5rem;
        }
        .section-header.centered {
            text-align: center;
        }
        .section-header.centered .section-label { justify-content: center; }
        .section-header.centered .section-subtitle { margin: 1rem auto 0; }

        /* ────────────────────────────────────────
           NAVBAR
        ──────────────────────────────────────── */
        #navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 900;
            padding: 1.25rem 0;
            transition: background var(--t-med), padding var(--t-med), box-shadow var(--t-med);
        }
        #navbar .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        #navbar.scrolled {
            background: rgba(3, 28, 16, .92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: .9rem 0;
            box-shadow: 0 1px 0 rgba(255,255,255,.06);
        }
        .nav-logo {
            display: flex;
            align-items: center;
            gap: .75rem;
            text-decoration: none;
        }
        .nav-logo-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--accent), var(--sage));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
        }
        .nav-logo-text {
            font-family: 'Lora', serif;
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--white);
            letter-spacing: -.02em;
        }
        .nav-logo-text span { color: var(--mint); }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
        }
        .nav-links a {
            color: rgba(255,255,255,.75);
            text-decoration: none;
            font-size: .9rem;
            font-weight: 500;
            transition: color var(--t-fast);
        }
        .nav-links a:hover { color: var(--mint); }
        .nav-actions {
            display: flex;
            align-items: center;
            gap: .75rem;
        }
        .btn-ghost {
            color: rgba(255,255,255,.85);
            text-decoration: none;
            font-size: .9rem;
            font-weight: 600;
            padding: .5rem 1rem;
            border-radius: 99px;
            transition: color var(--t-fast), background var(--t-fast);
        }
        .btn-ghost:hover {
            color: var(--white);
            background: rgba(255,255,255,.08);
        }
        .btn-nav-cta {
            background: var(--white);
            color: var(--deep);
            text-decoration: none;
            font-size: .88rem;
            font-weight: 700;
            padding: .55rem 1.35rem;
            border-radius: 99px;
            transition: background var(--t-fast), transform var(--t-fast), box-shadow var(--t-fast);
        }
        .btn-nav-cta:hover {
            background: var(--mint);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0,0,0,.15);
        }

        /* Mobile nav toggle */
        .nav-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 4px;
        }
        .nav-toggle span {
            display: block;
            width: 22px; height: 2px;
            background: var(--white);
            border-radius: 2px;
            transition: var(--t-med);
        }

        /* ────────────────────────────────────────
           HERO SECTION
        ──────────────────────────────────────── */
        #hero {
            min-height: 100vh;
            background:
                linear-gradient(170deg, rgba(3,28,16,.88) 0%, rgba(6,47,30,.96) 100%),
                url('/images/landing_hero_bg.png') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 8rem 2rem 6rem;
            position: relative;
            overflow: hidden;
        }
        #hero::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 100px;
            background: linear-gradient(to top, var(--cream), transparent);
        }
        /* Decorative rings */
        .hero-ring {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(184,232,203,.1);
            pointer-events: none;
        }
        .hero-ring-1 { width: 500px; height: 500px; top: 50%; left: 50%; transform: translate(-50%,-50%); }
        .hero-ring-2 { width: 750px; height: 750px; top: 50%; left: 50%; transform: translate(-50%,-50%); }
        .hero-ring-3 { width: 1000px; height: 1000px; top: 50%; left: 50%; transform: translate(-50%,-50%); }

        .hero-content { position: relative; z-index: 2; max-width: 860px; }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.14);
            color: var(--mint);
            font-size: .78rem;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: .5rem 1.25rem;
            border-radius: 99px;
            margin-bottom: 2rem;
            backdrop-filter: blur(6px);
        }
        .hero-badge-dot {
            width: 6px; height: 6px;
            background: #4ade80;
            border-radius: 50%;
            animation: pulse-dot 1.8s infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: .5; transform: scale(.8); }
        }
        .hero-title {
            font-family: 'Lora', serif;
            font-size: clamp(2.4rem, 6vw, 4.2rem);
            font-weight: 700;
            color: var(--white);
            line-height: 1.18;
            margin-bottom: 1.5rem;
        }
        .hero-title em {
            font-style: italic;
            color: var(--mint);
        }
        .hero-desc {
            font-size: 1.1rem;
            color: rgba(255,255,255,.78);
            line-height: 1.8;
            max-width: 680px;
            margin: 0 auto 2.5rem;
        }
        .hero-btns {
            display: flex;
            gap: 1rem;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn-primary {
            background: var(--white);
            color: var(--deep);
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            padding: .9rem 2rem;
            border-radius: 99px;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            transition: transform var(--t-fast), box-shadow var(--t-fast), background var(--t-fast);
            box-shadow: 0 8px 24px rgba(0,0,0,.2);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(0,0,0,.28);
            background: var(--pale);
        }
        .btn-secondary {
            background: transparent;
            color: rgba(255,255,255,.85);
            text-decoration: none;
            font-weight: 600;
            font-size: .95rem;
            padding: .9rem 1.75rem;
            border-radius: 99px;
            border: 1px solid rgba(255,255,255,.2);
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            transition: background var(--t-fast), color var(--t-fast), border-color var(--t-fast);
        }
        .btn-secondary:hover {
            background: rgba(255,255,255,.08);
            color: var(--white);
            border-color: rgba(255,255,255,.35);
        }
        /* Hero stats */
        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin-top: 3.5rem;
            padding-top: 2.5rem;
            border-top: 1px solid rgba(255,255,255,.1);
        }
        .hero-stat-num {
            font-family: 'Lora', serif;
            font-size: 1.9rem;
            font-weight: 700;
            color: var(--white);
            line-height: 1;
        }
        .hero-stat-label {
            font-size: .8rem;
            color: rgba(255,255,255,.55);
            margin-top: .25rem;
            letter-spacing: .03em;
        }

        /* ────────────────────────────────────────
           SECTION: FITUR (FEATURES)
        ──────────────────────────────────────── */
        #fitur {
            padding: 7rem 0;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }
        .feature-card {
            background: var(--white);
            border: 1px solid rgba(6,47,30,.07);
            border-radius: var(--r-lg);
            padding: 2.5rem 2rem;
            transition: transform var(--t-med) var(--ease), box-shadow var(--t-med);
        }
        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-md);
        }
        .feature-icon {
            width: 56px; height: 56px;
            border-radius: var(--r-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 1.75rem;
        }
        .fi-green  { background: var(--pale);    color: var(--accent); }
        .fi-blue   { background: #e8f0fe;         color: #3b5bdb; }
        .fi-orange { background: #fff3e0;         color: #e07b30; }
        .feature-card h3 {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--deep);
            margin-bottom: .75rem;
        }
        .feature-card p {
            font-size: .92rem;
            color: var(--muted);
            line-height: 1.7;
        }

        /* ────────────────────────────────────────
           SECTION: CARA KERJA (HOW IT WORKS)
        ──────────────────────────────────────── */
        #cara-kerja {
            padding: 7rem 0;
            background: var(--deep);
            position: relative;
            overflow: hidden;
        }
        #cara-kerja::before {
            content: '';
            position: absolute;
            top: -30%; right: -15%;
            width: 700px; height: 700px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(45,143,94,.12) 0%, transparent 65%);
            pointer-events: none;
        }
        #cara-kerja .section-title { color: var(--white); }
        #cara-kerja .section-label { color: var(--sage); }
        #cara-kerja .section-label::before { background: var(--sage); }
        .steps-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            position: relative;
        }
        /* Connector line between steps */
        .steps-grid::after {
            content: '';
            position: absolute;
            top: 40px; left: 10%; right: 10%;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(106,170,126,.3) 20%, rgba(106,170,126,.3) 80%, transparent);
            pointer-events: none;
        }
        .step-card {
            text-align: center;
            position: relative;
            z-index: 1;
        }
        .step-num {
            width: 80px; height: 80px;
            border-radius: 50%;
            background: rgba(255,255,255,.05);
            border: 1px solid rgba(106,170,126,.25);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-family: 'Lora', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--sage);
            transition: background var(--t-med), border-color var(--t-med), transform var(--t-med) var(--ease);
        }
        .step-card:hover .step-num {
            background: var(--accent);
            border-color: var(--sage);
            transform: scale(1.08);
            color: var(--white);
        }
        .step-card h4 {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: .6rem;
        }
        .step-card p {
            font-size: .85rem;
            color: rgba(255,255,255,.55);
            line-height: 1.65;
            max-width: 200px;
            margin: 0 auto;
        }

        /* ────────────────────────────────────────
           SECTION: ENSIKLOPEDIA TANAMAN
        ──────────────────────────────────────── */
        #tanaman {
            padding: 7rem 0;
        }
        .crop-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }
        .crop-card {
            background: var(--white);
            border: 1px solid rgba(6,47,30,.07);
            border-radius: var(--r-lg);
            padding: 1.75rem;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            transition: transform var(--t-med) var(--ease), box-shadow var(--t-med);
        }
        .crop-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }
        .crop-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px dashed rgba(6,47,30,.1);
        }
        .crop-icon {
            width: 50px; height: 50px;
            border-radius: var(--r-sm);
            background: var(--pale);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }
        .crop-name {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--deep);
        }
        .crop-latin {
            font-size: .8rem;
            color: var(--muted);
            font-style: italic;
        }
        .crop-section-label {
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--accent);
            margin-bottom: .3rem;
        }
        .crop-section-text {
            font-size: .87rem;
            color: var(--muted);
            line-height: 1.65;
        }
        .pest-tags {
            display: flex;
            flex-wrap: wrap;
            gap: .4rem;
            margin-top: .25rem;
        }
        .pest-tag {
            font-size: .73rem;
            font-weight: 700;
            color: #b93030;
            background: #fff0f0;
            border: 1px solid rgba(185,48,48,.12);
            padding: 3px 10px;
            border-radius: 99px;
        }

        /* ────────────────────────────────────────
           SECTION: KONSULTAN
        ──────────────────────────────────────── */
        #konsultan {
            padding: 7rem 0;
            background: var(--pale);
        }
        .consultant-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }
        .consultant-card {
            background: var(--white);
            border: 1px solid rgba(6,47,30,.07);
            border-radius: var(--r-lg);
            padding: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            transition: transform var(--t-med) var(--ease), box-shadow var(--t-med);
        }
        .consultant-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-md);
        }
        .consultant-head {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .consultant-avatar {
            width: 56px; height: 56px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700;
            font-size: 1.15rem;
            color: var(--white);
            flex-shrink: 0;
            overflow: hidden;
        }
        .consultant-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .av-green  { background: linear-gradient(135deg, var(--mid), var(--accent)); }
        .av-deep   { background: linear-gradient(135deg, var(--deep), var(--mid)); }
        .av-sage   { background: linear-gradient(135deg, var(--sage), #8ec98f); }
        .consultant-name {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--deep);
        }
        .consultant-rating {
            display: flex;
            align-items: center;
            gap: .4rem;
            margin-top: .15rem;
        }
        .stars { color: var(--gold); font-size: .9rem; letter-spacing: -1px; }
        .sessions { font-size: .78rem; color: var(--subtle); font-weight: 500; }
        .spec-tags {
            display: flex;
            flex-wrap: wrap;
            gap: .4rem;
        }
        .spec-tag {
            background: var(--pale);
            color: var(--mid);
            border: 1px solid rgba(26,92,58,.1);
            font-size: .77rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 99px;
        }
        .consultant-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 1.25rem;
            border-top: 1px solid rgba(6,47,30,.06);
        }
        .price {
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--deep);
        }
        .price sub {
            font-size: .75rem;
            font-weight: 500;
            color: var(--muted);
        }
        .btn-chat {
            text-decoration: none;
            color: var(--accent);
            font-weight: 700;
            font-size: .9rem;
            display: flex;
            align-items: center;
            gap: .3rem;
            transition: color var(--t-fast), gap var(--t-fast);
        }
        .btn-chat:hover {
            color: var(--deep);
            gap: .6rem;
        }

        /* ────────────────────────────────────────
           SECTION: MARKETPLACE
        ──────────────────────────────────────── */
        #toko {
            padding: 7rem 0;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
        }
        .product-card {
            background: var(--white);
            border: 1px solid rgba(6,47,30,.07);
            border-radius: var(--r-lg);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform var(--t-med) var(--ease), box-shadow var(--t-med);
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }
        .product-img {
            height: 160px;
            background: var(--pale);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
        }
        .product-body {
            padding: 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .product-name {
            font-size: .95rem;
            font-weight: 700;
            color: var(--deep);
            margin-bottom: .4rem;
        }
        .product-price {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--accent);
            margin-bottom: auto;
        }
        .product-store {
            font-size: .75rem;
            color: var(--subtle);
            font-weight: 500;
            padding-top: .75rem;
            margin-top: .75rem;
            border-top: 1px dashed rgba(6,47,30,.08);
        }

        /* ────────────────────────────────────────
           SECTION: CUSTOMER SERVICE (LIVE CHAT)
        ──────────────────────────────────────── */
        #cs {
            padding: 7rem 0;
            background: var(--pale);
        }
        .cs-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            max-width: 1100px;
            margin: 0 auto;
        }
        .cs-info { display: flex; flex-direction: column; gap: 1.5rem; }
        .cs-desc {
            font-size: 1rem;
            color: var(--muted);
            line-height: 1.8;
        }
        .cs-status-bar {
            display: flex;
            flex-direction: column;
            gap: .75rem;
            background: var(--white);
            border: 1px solid rgba(6,47,30,.07);
            border-radius: var(--r-md);
            padding: 1.25rem 1.5rem;
        }
        .cs-status-row {
            display: flex;
            align-items: center;
            gap: .6rem;
            font-size: .85rem;
            font-weight: 600;
            color: var(--muted);
        }
        .status-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: #f59e0b;
            animation: pulse-status 1.6s infinite;
            flex-shrink: 0;
        }
        .status-dot.online  { background: #22c55e; }
        .status-dot.offline { background: #94a3b8; animation: none; }
        @keyframes pulse-status {
            0%, 100% { opacity: 1; }
            50%       { opacity: .4; }
        }
        .cs-terminal {
            background: #0e1a12;
            border-radius: var(--r-md);
            padding: 1rem 1.25rem;
            max-height: 160px;
            overflow-y: auto;
        }
        .cs-terminal-header {
            font-family: 'Courier New', monospace;
            font-size: .68rem;
            color: var(--sage);
            font-weight: 700;
            letter-spacing: .08em;
            padding-bottom: .5rem;
            margin-bottom: .5rem;
            border-bottom: 1px solid rgba(255,255,255,.06);
            display: flex;
            justify-content: space-between;
        }
        .terminal-live {
            font-size: .62rem;
            background: rgba(106,170,126,.15);
            color: var(--mint);
            padding: 1px 6px;
            border-radius: 3px;
        }
        #terminal-logs {
            font-family: 'Courier New', monospace;
            font-size: .7rem;
            color: #6a9a72;
            display: flex;
            flex-direction: column;
            gap: .4rem;
            line-height: 1.5;
        }
        #terminal-logs .log-ts { color: #44624a; }
        #terminal-logs .log-ok  { color: #4ade80; }
        #terminal-logs .log-warn{ color: #fbbf24; }

        /* Chat Window */
        .chat-window {
            background: var(--white);
            border: 1px solid rgba(6,47,30,.08);
            border-radius: var(--r-xl);
            display: flex;
            flex-direction: column;
            height: 500px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }
        .chat-header {
            background: var(--deep);
            padding: 1.1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: .75rem;
        }
        .chat-agent-dot {
            width: 9px; height: 9px;
            border-radius: 50%;
            background: #22c55e;
            flex-shrink: 0;
        }
        .chat-agent-name  { font-size: .9rem; font-weight: 700; color: var(--white); }
        .chat-agent-sub   { font-size: .7rem; color: rgba(255,255,255,.55); }
        .chat-messages {
            flex: 1;
            padding: 1.25rem;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: .75rem;
            background: #fafcfa;
        }
        .bubble {
            padding: .8rem 1.1rem;
            border-radius: var(--r-md);
            font-size: .87rem;
            line-height: 1.6;
            max-width: 80%;
            word-break: break-word;
        }
        .bubble-agent {
            background: var(--pale);
            color: var(--deep);
            align-self: flex-start;
            border-bottom-left-radius: 4px;
        }
        .bubble-user {
            background: var(--accent);
            color: var(--white);
            align-self: flex-end;
            border-bottom-right-radius: 4px;
        }
        .typing-indicator {
            display: none;
            align-self: flex-start;
            align-items: center;
            gap: 3px;
            background: var(--pale);
            border-radius: var(--r-md);
            border-bottom-left-radius: 4px;
            padding: .75rem 1rem;
        }
        .typing-indicator.show { display: flex; }
        .typing-dot {
            width: 5px; height: 5px;
            border-radius: 50%;
            background: var(--sage);
            animation: typing-bounce 1.2s infinite ease-in-out both;
        }
        .typing-dot:nth-child(2) { animation-delay: .18s; }
        .typing-dot:nth-child(3) { animation-delay: .36s; }
        @keyframes typing-bounce {
            0%, 80%, 100% { transform: scale(0); }
            40%           { transform: scale(1); }
        }
        .chat-footer {
            padding: .9rem 1rem;
            background: var(--white);
            border-top: 1px solid rgba(6,47,30,.06);
            display: flex;
            gap: .6rem;
        }
        .chat-input {
            flex: 1;
            padding: .65rem 1rem;
            border-radius: 99px;
            border: 1.5px solid rgba(6,47,30,.12);
            outline: none;
            font-family: 'Outfit', sans-serif;
            font-size: .88rem;
            background: var(--cream);
            color: var(--text);
            transition: border-color var(--t-fast);
        }
        .chat-input:focus { border-color: var(--accent); background: var(--white); }
        .chat-send {
            background: var(--deep);
            color: var(--white);
            border: none;
            padding: 0 1.25rem;
            border-radius: 99px;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: .85rem;
            cursor: pointer;
            transition: background var(--t-fast), transform var(--t-fast);
        }
        .chat-send:hover { background: var(--accent); transform: scale(1.02); }

        /* ────────────────────────────────────────
           SECTION: FAQ
        ──────────────────────────────────────── */
        #faq {
            padding: 7rem 0;
        }
        .faq-list {
            max-width: 780px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: .75rem;
        }
        .faq-item {
            background: var(--white);
            border: 1px solid rgba(6,47,30,.07);
            border-radius: var(--r-md);
            overflow: hidden;
            transition: box-shadow var(--t-med), border-color var(--t-med);
        }
        .faq-item:hover {
            border-color: rgba(45,143,94,.25);
        }
        .faq-item.open {
            box-shadow: var(--shadow-sm);
            border-color: rgba(45,143,94,.3);
        }
        .faq-trigger {
            width: 100%;
            background: none;
            border: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 1.35rem 1.75rem;
            text-align: left;
            cursor: pointer;
            font-family: 'Outfit', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            color: var(--deep);
        }
        .faq-chevron {
            width: 20px; height: 20px;
            flex-shrink: 0;
            stroke: var(--accent);
            transition: transform var(--t-med) var(--ease);
        }
        .faq-item.open .faq-chevron {
            transform: rotate(180deg);
        }
        .faq-body {
            max-height: 0;
            overflow: hidden;
            transition: max-height .4s cubic-bezier(.22,.68,0,1);
        }
        .faq-item.open .faq-body {
            max-height: 300px;
        }
        .faq-body p {
            font-size: .92rem;
            color: var(--muted);
            line-height: 1.75;
            padding: 0 1.75rem 1.5rem;
        }

        /* ────────────────────────────────────────
           SECTION: CTA
        ──────────────────────────────────────── */
        #cta {
            padding: 7rem 0 6rem;
        }
        .cta-card {
            background: var(--deep);
            border-radius: var(--r-xl);
            padding: 6rem 3rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .cta-card::before {
            content: '';
            position: absolute;
            top: -20%; left: 50%; transform: translateX(-50%);
            width: 600px; height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(45,143,94,.18) 0%, transparent 60%);
            pointer-events: none;
        }
        .cta-card .section-title {
            color: var(--white);
            font-size: clamp(1.8rem, 4vw, 3rem);
            margin-bottom: 1.25rem;
        }
        .cta-card p {
            color: rgba(255,255,255,.72);
            font-size: 1.05rem;
            line-height: 1.75;
            max-width: 560px;
            margin: 0 auto 2.5rem;
        }
        .cta-kicker {
            margin-top: 2rem;
            font-size: .78rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--mint);
            font-weight: 700;
            opacity: .7;
        }

        /* ────────────────────────────────────────
           FOOTER
        ──────────────────────────────────────── */
        footer {
            background: var(--forest);
            padding: 5rem 0 2.5rem;
            border-top: 1px solid rgba(255,255,255,.04);
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 1.6fr 1fr 1fr 1fr;
            gap: 4rem;
            margin-bottom: 4rem;
        }
        .footer-brand-text {
            font-family: 'Lora', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--white);
        }
        .footer-brand-text span { color: var(--mint); }
        .footer-tagline {
            font-size: .88rem;
            color: rgba(255,255,255,.45);
            line-height: 1.7;
            max-width: 280px;
            margin-top: .75rem;
        }
        .footer-col-title {
            font-size: .75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: rgba(255,255,255,.4);
            margin-bottom: 1.25rem;
        }
        .footer-link {
            display: block;
            color: rgba(255,255,255,.55);
            text-decoration: none;
            font-size: .88rem;
            font-weight: 500;
            margin-bottom: .75rem;
            transition: color var(--t-fast), padding-left var(--t-fast);
        }
        .footer-link:hover {
            color: var(--mint);
            padding-left: 4px;
        }
        .footer-bottom {
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,.05);
            text-align: center;
            font-size: .82rem;
            color: rgba(255,255,255,.28);
        }

        /* ────────────────────────────────────────
           MODAL
        ──────────────────────────────────────── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(3,28,16,.5);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            opacity: 0;
            pointer-events: none;
            transition: opacity var(--t-med);
        }
        .modal-overlay.open {
            opacity: 1;
            pointer-events: auto;
        }
        .modal-box {
            background: var(--white);
            border-radius: var(--r-xl);
            max-width: 600px;
            width: 100%;
            max-height: 85vh;
            overflow-y: auto;
            padding: 2.5rem;
            position: relative;
            transform: scale(.95);
            transition: transform var(--t-med) var(--ease);
        }
        .modal-overlay.open .modal-box {
            transform: scale(1);
        }
        .modal-close {
            position: absolute;
            top: 1.25rem; right: 1.25rem;
            background: var(--pale);
            border: none;
            border-radius: 50%;
            width: 34px; height: 34px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            color: var(--muted);
            font-size: 1rem;
            transition: background var(--t-fast), color var(--t-fast);
        }
        .modal-close:hover { background: var(--mint); color: var(--deep); }
        .modal-title {
            font-family: 'Lora', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--deep);
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--pale);
        }
        .modal-body {
            font-size: .92rem;
            color: var(--muted);
            line-height: 1.75;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .modal-body h5 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--deep);
            margin-top: .5rem;
        }

        /* ────────────────────────────────────────
           SCROLL REVEAL ANIMATION
        ──────────────────────────────────────── */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity .6s ease, transform .6s var(--ease);
        }
        .reveal.visible {
            opacity: 1;
            transform: none;
        }

        /* ────────────────────────────────────────
           RESPONSIVE
        ──────────────────────────────────────── */
        @media (max-width: 1024px) {
            .features-grid,
            .crop-grid,
            .consultant-grid { grid-template-columns: repeat(2, 1fr); }
            .steps-grid       { grid-template-columns: repeat(2, 1fr); }
            .steps-grid::after { display: none; }
            .product-grid     { grid-template-columns: repeat(2, 1fr); }
            .footer-grid      { grid-template-columns: 1fr 1fr; gap: 2.5rem; }
            .cs-wrapper       { grid-template-columns: 1fr; gap: 2.5rem; }
        }
        @media (max-width: 768px) {
            .nav-links, .nav-actions { display: none; }
            .nav-toggle             { display: flex; }
            .features-grid,
            .crop-grid,
            .consultant-grid,
            .steps-grid,
            .product-grid,
            .footer-grid  { grid-template-columns: 1fr; }
            .hero-stats   { gap: 2rem; flex-wrap: wrap; }
            .cta-card     { padding: 4rem 1.5rem; }
        }
    </style>
</head>
<body>

    <!-- ── NAVBAR ── -->
    <nav id="navbar">
        <div class="nav-inner">
            <a href="#" class="nav-logo">
                <div class="nav-logo-icon">🌿</div>
                <span class="nav-logo-text">Doc<span>tree</span>n</span>
            </a>
            <ul class="nav-links">
                <li><a href="#fitur">Fitur</a></li>
                <li><a href="#cara-kerja">Cara Kerja</a></li>
                <li><a href="#konsultan">Konsultan</a></li>
                <li><a href="#toko">Toko</a></li>
                <li><a href="#cs">Bantuan</a></li>
                <li><a href="#faq">FAQ</a></li>
            </ul>
            <div class="nav-actions">
                <a href="{{ route('login') }}" class="btn-ghost">Masuk</a>
                <a href="{{ route('register') }}" class="btn-nav-cta">Daftar Gratis</a>
            </div>
            <div class="nav-toggle" id="navToggle" aria-label="Buka menu" role="button" tabindex="0">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <!-- ── HERO ── -->
    <section id="hero">
        <div class="hero-ring hero-ring-1"></div>
        <div class="hero-ring hero-ring-2"></div>
        <div class="hero-ring hero-ring-3"></div>
        <div class="hero-content">
            <div class="hero-badge">
                <span class="hero-badge-dot"></span>
                Platform Agrikultur Terpercaya
            </div>
            <h1 class="hero-title">
                Tanaman Sehat,<br>
                <em>Panen Melimpah</em>
            </h1>
            <p class="hero-desc">
                Konsultasikan masalah tanaman Anda langsung dengan ahli fitopatologi dan konsultan pertanian berlisensi. Diagnosis akurat, solusi nyata, hasil panen maksimal.
            </p>
            <div class="hero-btns">
                <a href="{{ route('login') }}" class="btn-primary">
                    Mulai Konsultasi &rarr;
                </a>
                <a href="{{ route('register') }}" class="btn-secondary">
                    Daftar Gratis
                </a>
            </div>
            <div class="hero-stats">
                <div>
                    <div class="hero-stat-num">500+</div>
                    <div class="hero-stat-label">Konsultan Berlisensi</div>
                </div>
                <div>
                    <div class="hero-stat-num">12k+</div>
                    <div class="hero-stat-label">Kasus Tertangani</div>
                </div>
                <div>
                    <div class="hero-stat-num">98%</div>
                    <div class="hero-stat-label">Tingkat Kepuasan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── FITUR ── -->
    <section id="fitur">
        <div class="container">
            <div class="section-header centered reveal">
                <span class="section-label">Keunggulan Kami</span>
                <h2 class="section-title">Solusi Lengkap untuk Petani Modern</h2>
                <p class="section-subtitle">Teknologi canggih dan keahlian pakar terbaik hadir dalam satu platform yang mudah digunakan.</p>
            </div>
            <div class="features-grid">
                <div class="feature-card reveal">
                    <div class="feature-icon fi-green">🔬</div>
                    <h3>Diagnosis AI + Ahli Manusia</h3>
                    <p>Teknologi analisis gambar berbasis AI dipadukan dengan verifikasi langsung konsultan berlisensi untuk hasil diagnosis yang akurat dan terpercaya.</p>
                </div>
                <div class="feature-card reveal">
                    <div class="feature-icon fi-blue">💬</div>
                    <h3>Chat Real-time Privat</h3>
                    <p>Ngobrol langsung dengan konsultan pilihan Anda tanpa perantara. Sesi diskusi terasa personal, mendalam, dan terarah sesuai kebutuhan lahan Anda.</p>
                </div>
                <div class="feature-card reveal">
                    <div class="feature-icon fi-orange">🛒</div>
                    <h3>Toko Produk Teresepkan</h3>
                    <p>Dapatkan rekomendasi pupuk dan pestisida langsung dari konsultan, tersedia di toko mitra kami dengan harga terjamin dan pengiriman terpercaya.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ── CARA KERJA ── -->
    <section id="cara-kerja">
        <div class="container">
            <div class="section-header centered reveal">
                <span class="section-label">Alur Proses</span>
                <h2 class="section-title">Hanya 4 Langkah Mudah</h2>
            </div>
            <div class="steps-grid">
                <div class="step-card reveal">
                    <div class="step-num">01</div>
                    <h4>Upload Foto Tanaman</h4>
                    <p>Ambil foto bagian tanaman yang menunjukkan gejala penyakit atau kelainan.</p>
                </div>
                <div class="step-card reveal">
                    <div class="step-num">02</div>
                    <h4>Pilih Konsultan Ahli</h4>
                    <p>Pilih konsultan berlisensi sesuai spesialisasi komoditas dan kebutuhan lahan Anda.</p>
                </div>
                <div class="step-card reveal">
                    <div class="step-num">03</div>
                    <h4>Diskusi & Konsultasi</h4>
                    <p>Konsultasikan masalah tanaman Anda secara privat melalui live chat yang aman.</p>
                </div>
                <div class="step-card reveal">
                    <div class="step-num">04</div>
                    <h4>Terapkan Solusi</h4>
                    <p>Ikuti resep penanganan dari ahli dan pantau perkembangan kesehatan tanaman Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ── ENSIKLOPEDIA TANAMAN ── -->
    <section id="tanaman">
        <div class="container">
            <div class="section-header centered reveal">
                <span class="section-label">Ensiklopedia Tanaman</span>
                <h2 class="section-title">Pustaka Komoditas &amp; Klinik Proteksi</h2>
                <p class="section-subtitle">Referensi lengkap perawatan, pengobatan, dan ancaman hama untuk tanaman utama pertanian Indonesia.</p>
            </div>
            <div class="crop-grid" id="cropGrid">
                @forelse($tanamans as $tn)
                    @php
                        $cropImage = $tn->foto_tanaman ? asset('storage/' . $tn->foto_tanaman) : null;
                        $ancamans  = is_array($tn->ancaman_hama) ? $tn->ancaman_hama : (json_decode($tn->ancaman_hama, true) ?: []);
                    @endphp
                    <div class="crop-card reveal">
                        <div class="crop-header">
                            @if($cropImage)
                                <img src="{{ $cropImage }}" class="crop-icon" style="object-fit:cover;" alt="{{ $tn->nama_tanaman }}">
                            @else
                                <div class="crop-icon">🌱</div>
                            @endif
                            <div>
                                <div class="crop-name">{{ $tn->nama_tanaman }}</div>
                                <div class="crop-latin">{{ $tn->nama_latin ?? 'Species sp.' }}</div>
                            </div>
                        </div>
                        <div>
                            <div class="crop-section-label">🚜 Perawatan Berkala</div>
                            <p class="crop-section-text">{{ Str::limit($tn->metode_perawatan ?? 'Belum ada panduan khusus.', 110) }}</p>
                        </div>
                        <div>
                            <div class="crop-section-label">🧪 Protokol Pengobatan</div>
                            <p class="crop-section-text">{{ Str::limit($tn->protokol_pengobatan ?? 'Belum ada resep penanganan.', 110) }}</p>
                        </div>
                        @if(count($ancamans) > 0)
                            <div>
                                <div class="crop-section-label">⚠️ Hama &amp; Penyakit Utama</div>
                                <div class="pest-tags">
                                    @foreach($ancamans as $anc)
                                        <span class="pest-tag">{{ trim($anc) }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <!-- Fallback data -->
                    <div class="crop-card reveal">
                        <div class="crop-header">
                            <div class="crop-icon">🌾</div>
                            <div><div class="crop-name">Padi</div><div class="crop-latin">Oryza sativa</div></div>
                        </div>
                        <div>
                            <div class="crop-section-label">🚜 Perawatan Berkala</div>
                            <p class="crop-section-text">Pengairan tergenang berkala, pemupukan urea NPK berimbang, pencabutan gulma liar secara rutin.</p>
                        </div>
                        <div>
                            <div class="crop-section-label">🧪 Protokol Pengobatan</div>
                            <p class="crop-section-text">Pemberian fungisida sistemik berbahan aktif karbendazim atau tebukonazol untuk busuk leher padi.</p>
                        </div>
                        <div>
                            <div class="crop-section-label">⚠️ Hama &amp; Penyakit Utama</div>
                            <div class="pest-tags">
                                <span class="pest-tag">Wereng Coklat</span>
                                <span class="pest-tag">Walang Sangit</span>
                                <span class="pest-tag">Blast</span>
                            </div>
                        </div>
                    </div>
                    <div class="crop-card reveal">
                        <div class="crop-header">
                            <div class="crop-icon">🌽</div>
                            <div><div class="crop-name">Jagung</div><div class="crop-latin">Zea mays</div></div>
                        </div>
                        <div>
                            <div class="crop-section-label">🚜 Perawatan Berkala</div>
                            <p class="crop-section-text">Penyiraman pagi hari, penggemburan tanah sekitar akar, pembumbunan batang agar kokoh dan tegak.</p>
                        </div>
                        <div>
                            <div class="crop-section-label">🧪 Protokol Pengobatan</div>
                            <p class="crop-section-text">Penyemprotan biopestisida Bacillus thuringiensis untuk membasmi ulat tentara grayak secara alami.</p>
                        </div>
                        <div>
                            <div class="crop-section-label">⚠️ Hama &amp; Penyakit Utama</div>
                            <div class="pest-tags">
                                <span class="pest-tag">Ulat Grayak</span>
                                <span class="pest-tag">Bule Jagung</span>
                                <span class="pest-tag">Busuk Tongkol</span>
                            </div>
                        </div>
                    </div>
                    <div class="crop-card reveal">
                        <div class="crop-header">
                            <div class="crop-icon">🌶️</div>
                            <div><div class="crop-name">Cabai Rawit</div><div class="crop-latin">Capsicum frutescens</div></div>
                        </div>
                        <div>
                            <div class="crop-section-label">🚜 Perawatan Berkala</div>
                            <p class="crop-section-text">Pemberian mulsa plastik hitam perak, pemangkasan tunas air bawah cabang Y, penyemprotan kalsium rutin.</p>
                        </div>
                        <div>
                            <div class="crop-section-label">🧪 Protokol Pengobatan</div>
                            <p class="crop-section-text">Pemberian akarisida berbahan aktif abamektin atau imidakloprid untuk mengatasi keriting daun akibat kutu.</p>
                        </div>
                        <div>
                            <div class="crop-section-label">⚠️ Hama &amp; Penyakit Utama</div>
                            <div class="pest-tags">
                                <span class="pest-tag">Kutu Kebul</span>
                                <span class="pest-tag">Antraknosa</span>
                                <span class="pest-tag">Layu Fusarium</span>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ── KONSULTAN ── -->
    <section id="konsultan">
        <div class="container">
            <div class="section-header centered reveal">
                <span class="section-label">Expert Directory</span>
                <h2 class="section-title">Konsultan Terbaik Minggu Ini</h2>
                <p class="section-subtitle">Ahli fitopatologi dan agronomi berlisensi siap membantu menangani masalah tanaman Anda.</p>
            </div>
            <div class="consultant-grid">
                @forelse($konsultans as $k)
                    @php
                        $initials = strtoupper(substr($k->nama ?? 'KS', 0, 2));
                        $avatar   = $k->foto_profil ? asset('storage/' . $k->foto_profil) : null;
                        $tarif    = $k->tarif_konsultasi ? 'Rp ' . number_format($k->tarif_konsultasi * 1000, 0, ',', '.') : 'Gratis';
                    @endphp
                    <div class="consultant-card reveal">
                        <div class="consultant-head">
                            <div class="consultant-avatar av-green">
                                @if($avatar)
                                    <img src="{{ $avatar }}" alt="{{ $k->nama }}">
                                @else
                                    {{ $initials }}
                                @endif
                            </div>
                            <div>
                                <div class="consultant-name">{{ $k->nama }}</div>
                                <div class="consultant-rating">
                                    <span class="stars">★★★★★</span>
                                    <span class="sessions">Aktif</span>
                                </div>
                            </div>
                        </div>
                        <div class="spec-tags">
                            @if($k->keahlian)
                                @foreach(explode(',', $k->keahlian) as $spec)
                                    <span class="spec-tag">{{ trim($spec) }}</span>
                                @endforeach
                            @else
                                <span class="spec-tag">Konsultan Umum</span>
                            @endif
                        </div>
                        <div class="consultant-footer">
                            <div class="price">{{ $tarif }}<sub>/sesi</sub></div>
                            <a href="{{ route('login') }}" class="btn-chat">Konsultasi &rarr;</a>
                        </div>
                    </div>
                @empty
                    <div class="consultant-card reveal">
                        <div class="consultant-head">
                            <div class="consultant-avatar av-deep">RH</div>
                            <div>
                                <div class="consultant-name">Dr. Rini Hartati, M.P.</div>
                                <div class="consultant-rating">
                                    <span class="stars">★★★★★</span>
                                    <span class="sessions">312 sesi</span>
                                </div>
                            </div>
                        </div>
                        <div class="spec-tags">
                            <span class="spec-tag">Padi</span>
                            <span class="spec-tag">Jagung</span>
                            <span class="spec-tag">Hama Patogen</span>
                        </div>
                        <div class="consultant-footer">
                            <div class="price">Rp 75.000<sub>/sesi</sub></div>
                            <a href="{{ route('login') }}" class="btn-chat">Konsultasi &rarr;</a>
                        </div>
                    </div>
                    <div class="consultant-card reveal">
                        <div class="consultant-head">
                            <div class="consultant-avatar av-green">BA</div>
                            <div>
                                <div class="consultant-name">Ir. Budi Aryanto</div>
                                <div class="consultant-rating">
                                    <span class="stars">★★★★★</span>
                                    <span class="sessions">245 sesi</span>
                                </div>
                            </div>
                        </div>
                        <div class="spec-tags">
                            <span class="spec-tag">Kelapa Sawit</span>
                            <span class="spec-tag">Kopi</span>
                            <span class="spec-tag">Nutrisi Lahan</span>
                        </div>
                        <div class="consultant-footer">
                            <div class="price">Rp 90.000<sub>/sesi</sub></div>
                            <a href="{{ route('login') }}" class="btn-chat">Konsultasi &rarr;</a>
                        </div>
                    </div>
                    <div class="consultant-card reveal">
                        <div class="consultant-head">
                            <div class="consultant-avatar av-sage">SW</div>
                            <div>
                                <div class="consultant-name">Sari Wulandari, S.P.</div>
                                <div class="consultant-rating">
                                    <span class="stars">★★★★★</span>
                                    <span class="sessions">189 sesi</span>
                                </div>
                            </div>
                        </div>
                        <div class="spec-tags">
                            <span class="spec-tag">Hidroponik</span>
                            <span class="spec-tag">Sayur Hijau</span>
                        </div>
                        <div class="consultant-footer">
                            <div class="price">Rp 55.000<sub>/sesi</sub></div>
                            <a href="{{ route('login') }}" class="btn-chat">Konsultasi &rarr;</a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ── TOKO ── -->
    <section id="toko">
        <div class="container">
            <div class="section-header centered reveal">
                <span class="section-label">Marketplace</span>
                <h2 class="section-title">Produk Rekomendasi Ahli</h2>
                <p class="section-subtitle">Pupuk, pestisida, dan saprotan pilihan langsung dari rekomendasi konsultan berlisensi kami.</p>
            </div>
            <div class="product-grid">
                @forelse($produks as $pr)
                    @php
                        $prodImage = $pr->foto_produk ? asset('storage/' . $pr->foto_produk) : null;
                        $harga     = $pr->harga ? 'Rp ' . number_format($pr->harga * 1000, 0, ',', '.') : 'Hubungi Toko';
                    @endphp
                    <div class="product-card reveal">
                        @if($prodImage)
                            <div class="product-img" style="background-image:url('{{ $prodImage }}');background-size:cover;background-position:center;"></div>
                        @else
                            <div class="product-img">🌱</div>
                        @endif
                        <div class="product-body">
                            <div class="product-name">{{ $pr->nama_produk }}</div>
                            <div class="product-price">{{ $harga }}</div>
                            <div class="product-store">🏪 {{ $pr->toko->nama_toko ?? 'Mitra Doctreen' }}</div>
                        </div>
                    </div>
                @empty
                    <div class="product-card reveal">
                        <div class="product-img">🌱</div>
                        <div class="product-body">
                            <div class="product-name">Mankozeb 80% WP</div>
                            <div class="product-price">Rp 45.000</div>
                            <div class="product-store">🏪 Toko Agri Mandiri</div>
                        </div>
                    </div>
                    <div class="product-card reveal">
                        <div class="product-img">🧪</div>
                        <div class="product-body">
                            <div class="product-name">NPK Mutiara 16-16-16</div>
                            <div class="product-price">Rp 120.000</div>
                            <div class="product-store">🏪 Toko Agri Mandiri</div>
                        </div>
                    </div>
                    <div class="product-card reveal">
                        <div class="product-img">🌿</div>
                        <div class="product-body">
                            <div class="product-name">Abamektin 18 EC</div>
                            <div class="product-price">Rp 68.000</div>
                            <div class="product-store">🏪 Toko Tani Subur</div>
                        </div>
                    </div>
                    <div class="product-card reveal">
                        <div class="product-img">💧</div>
                        <div class="product-body">
                            <div class="product-name">ZPT Rootone-F</div>
                            <div class="product-price">Rp 32.500</div>
                            <div class="product-store">🏪 Toko Tani Subur</div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ── CUSTOMER SERVICE ── -->
    <section id="cs">
        <div class="container">
            <div class="section-header centered reveal">
                <span class="section-label">Bantuan Real-time</span>
                <h2 class="section-title">Ada yang Bisa Kami Bantu?</h2>
            </div>
            <div class="cs-wrapper">
                <div class="cs-info reveal">
                    <p class="cs-desc">
                        Hubungi tim dukungan kami kapan saja. Sistem live chat ini terhubung menggunakan teknologi <strong>Socket.IO WebSocket</strong> untuk respons instan tanpa penundaan.
                    </p>
                    <div class="cs-status-bar">
                        <div class="cs-status-row">
                            <span class="status-dot" id="serverDot"></span>
                            <span id="serverStatusText">Menghubungkan ke server...</span>
                        </div>
                        <div style="font-family:'Courier New',monospace;font-size:.75rem;color:var(--muted);">
                            <span id="sessionIdDisplay">Session ID: generating...</span>
                        </div>
                    </div>
                    <div class="cs-terminal">
                        <div class="cs-terminal-header">
                            <span>SOCKET.IO STREAM LOGS</span>
                            <span class="terminal-live">LIVE</span>
                        </div>
                        <div id="terminal-logs">
                            <div><span class="log-ts">[init]</span> Connecting to engine...</div>
                            <div><span class="log-ts">[init]</span> Transport: websocket</div>
                        </div>
                    </div>
                </div>

                <div class="chat-window reveal">
                    <div class="chat-header">
                        <div class="chat-agent-dot" id="chatAgentDot"></div>
                        <div>
                            <div class="chat-agent-name">Lara — Doctreen Support</div>
                            <div class="chat-agent-sub">Layanan 24/7 · Respon &lt; 2 menit</div>
                        </div>
                    </div>
                    <div class="chat-messages" id="chatMessages">
                        <div class="bubble bubble-agent">
                            Halo! 🌿 Selamat datang di pusat bantuan Doctreen. Saya Lara, siap membantu Anda. Ada yang ingin ditanyakan seputar konsultasi atau produk kami?
                        </div>
                    </div>
                    <div class="typing-indicator" id="typingIndicator">
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                    </div>
                    <div class="chat-footer">
                        <input
                            type="text"
                            id="chatInput"
                            class="chat-input"
                            placeholder="Ketik pesan Anda di sini..."
                            autocomplete="off"
                        >
                        <button class="chat-send" id="chatSendBtn">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── FAQ ── -->
    <section id="faq">
        <div class="container">
            <div class="section-header centered reveal">
                <span class="section-label">FAQ</span>
                <h2 class="section-title">Pertanyaan yang Sering Diajukan</h2>
            </div>
            <div class="faq-list">
                <div class="faq-item reveal">
                    <button class="faq-trigger" type="button">
                        <span>Bagaimana cara kerja diagnosis penyakit tanaman di Doctreen?</span>
                        <svg class="faq-chevron" viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="faq-body">
                        <p>Unggah foto daun atau bagian tanaman yang bermasalah melalui dashboard. Sistem AI kami akan mendeteksi gejala secara visual, kemudian diteruskan ke konsultan fitopatologi berlisensi untuk diverifikasi dan dibuatkan resep penanganan yang tepat.</p>
                    </div>
                </div>
                <div class="faq-item reveal">
                    <button class="faq-trigger" type="button">
                        <span>Apakah sesi konsultasi dengan ahli dikenakan biaya?</span>
                        <svg class="faq-chevron" viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="faq-body">
                        <p>Pendaftaran akun dan akses ensiklopedia tanaman 100% gratis. Untuk sesi konsultasi privat dengan konsultan berlisensi, tarif ditentukan transparan oleh masing-masing konsultan, mulai dari Rp 55.000 per sesi. Tidak ada biaya tersembunyi.</p>
                    </div>
                </div>
                <div class="faq-item reveal">
                    <button class="faq-trigger" type="button">
                        <span>Berapa lama respons dari konsultan setelah pengajuan?</span>
                        <svg class="faq-chevron" viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="faq-body">
                        <p>Sebagian besar konsultasi aktif mendapat respons dalam 1–2 jam setelah pengajuan. Anda akan mendapat notifikasi instan di platform begitu konsultan merespon atau resep penanganan telah diterbitkan.</p>
                    </div>
                </div>
                <div class="faq-item reveal">
                    <button class="faq-trigger" type="button">
                        <span>Bagaimana cara membeli produk yang direkomendasikan konsultan?</span>
                        <svg class="faq-chevron" viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="faq-body">
                        <p>Setiap resep dari konsultan menyertakan tautan langsung ke produk di toko mitra kami. Pembelian dapat dilakukan secara instan dengan opsi pengiriman JNE, J&T, atau COD melalui payment gateway Midtrans yang aman.</p>
                    </div>
                </div>
                <div class="faq-item reveal">
                    <button class="faq-trigger" type="button">
                        <span>Apakah data dan foto tanaman saya aman?</span>
                        <svg class="faq-chevron" viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="faq-body">
                        <p>Data Anda dienkripsi penuh dan hanya digunakan untuk keperluan diagnosis serta konsultasi. Kami tidak menjual atau membagikan data pribadi Anda kepada pihak ketiga untuk kepentingan komersial apapun.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── CTA ── -->
    <section id="cta">
        <div class="container">
            <div class="cta-card reveal">
                <h2 class="section-title">Mulai Tingkatkan Hasil Panen Anda</h2>
                <p>Bergabung dengan ribuan petani Indonesia yang telah mempercayakan kesehatan tanamannya kepada Doctreen. Gratis untuk mulai, tanpa syarat.</p>
                <div class="hero-btns">
                    <a href="{{ route('register') }}" class="btn-primary">Daftar Sekarang — Gratis</a>
                    <a href="{{ route('login') }}" class="btn-secondary" style="color:rgba(255,255,255,.75);">Sudah punya akun? Masuk</a>
                </div>
                <p class="cta-kicker">Doctreen — Solusi Agrikultur Terpercaya untuk Indonesia</p>
            </div>
        </div>
    </section>

    <!-- ── FOOTER ── -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="footer-brand-text">Doc<span>tree</span>n</div>
                    <p class="footer-tagline">Menghubungkan teknologi dan keahlian demi masa depan pertanian Indonesia yang lebih hijau dan produktif.</p>
                </div>
                <div>
                    <p class="footer-col-title">Navigasi</p>
                    <a href="#fitur" class="footer-link">Fitur Kami</a>
                    <a href="#cara-kerja" class="footer-link">Cara Kerja</a>
                    <a href="#konsultan" class="footer-link">Konsultan Ahli</a>
                    <a href="#toko" class="footer-link">Marketplace</a>
                </div>
                <div>
                    <p class="footer-col-title">Legal</p>
                    <a href="javascript:void(0)" onclick="openModal('ketentuan')" class="footer-link">Syarat &amp; Ketentuan</a>
                    <a href="javascript:void(0)" onclick="openModal('privasi')" class="footer-link">Kebijakan Privasi</a>
                    <a href="#faq" class="footer-link">Pusat Bantuan</a>
                    <a href="#cs" class="footer-link">Customer Service</a>
                </div>
                <div>
                    <p class="footer-col-title">Kontak</p>
                    <p style="font-size:.88rem;color:rgba(255,255,255,.55);margin-bottom:.6rem;">📧 support@doctreen.id</p>
                    <p style="font-size:.88rem;color:rgba(255,255,255,.55);">📍 Bandung, Jawa Barat</p>
                </div>
            </div>
            <div class="footer-bottom">
                © 2026 Doctreen. Dibuat dengan 💚 untuk Petani Indonesia.
            </div>
        </div>
    </footer>

    <!-- ── MODALS ── -->
    <div class="modal-overlay" id="modal-ketentuan">
        <div class="modal-box">
            <button class="modal-close" onclick="closeModal('ketentuan')" aria-label="Tutup">✕</button>
            <h3 class="modal-title">Syarat &amp; Ketentuan Penggunaan</h3>
            <div class="modal-body">
                <p>Dengan mengakses dan menggunakan platform Doctreen, Anda dinyatakan telah menyetujui seluruh syarat dan ketentuan berikut ini.</p>
                <h5>1. Ketentuan Akun Pengguna</h5>
                <p>Pengguna wajib memberikan data yang jujur, akurat, dan terkini saat pendaftaran. Pemalsuan identitas atau kredensial konsultan akan ditindak sesuai ketentuan hukum yang berlaku.</p>
                <h5>2. Sesi Konsultasi Medis Tanaman</h5>
                <p>Doctreen berfungsi sebagai jembatan konsultasi fitopatologi. Seluruh rekomendasi konsultan merupakan panduan profesional, namun Doctreen tidak bertanggung jawab atas kerugian akibat bencana alam atau faktor di luar kendali rekomendasi medis.</p>
                <h5>3. Transaksi &amp; Pembayaran</h5>
                <p>Semua pembayaran diproses melalui payment gateway resmi Midtrans. Refund hanya berlaku jika konsultan tidak merespons aduan dalam 48 jam setelah sesi dibuat.</p>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="modal-privasi">
        <div class="modal-box">
            <button class="modal-close" onclick="closeModal('privasi')" aria-label="Tutup">✕</button>
            <h3 class="modal-title">Kebijakan Privasi Data Pengguna</h3>
            <div class="modal-body">
                <p>Doctreen berkomitmen penuh untuk melindungi privasi dan keamanan data seluruh pengguna platform kami.</p>
                <h5>1. Data yang Kami Kumpulkan</h5>
                <p>Kami mengumpulkan data yang Anda berikan secara sukarela: nama, email, nomor WhatsApp, foto profil, dokumen sertifikasi (untuk konsultan), foto tanaman, dan log percakapan konsultasi.</p>
                <h5>2. Penggunaan Data</h5>
                <p>Data digunakan untuk proses diagnosis, integrasi pembayaran Midtrans, notifikasi status konsultasi, dan komunikasi layanan pelanggan. Tidak ada penggunaan di luar keperluan tersebut.</p>
                <h5>3. Keamanan Data</h5>
                <p>Doctreen menerapkan enkripsi database dan protokol keamanan tinggi. Data pribadi Anda tidak akan pernah dijual atau disebarkan kepada pihak ketiga untuk kepentingan komersial eksternal.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>
    <script>
    /* ═══════════════════════════════════════════
       1. NAVBAR — scroll behavior
    ═══════════════════════════════════════════ */
    (function () {
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', function () {
            navbar.classList.toggle('scrolled', window.scrollY > 60);
        }, { passive: true });

        // Mobile nav toggle (basic)
        document.getElementById('navToggle').addEventListener('click', function () {
            const links = document.querySelector('.nav-links');
            const actions = document.querySelector('.nav-actions');
            if (links) links.style.display = links.style.display === 'flex' ? 'none' : 'flex';
            if (actions) actions.style.display = actions.style.display === 'flex' ? 'none' : 'flex';
        });
    })();

    /* ═══════════════════════════════════════════
       2. SCROLL REVEAL
    ═══════════════════════════════════════════ */
    (function () {
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll('.reveal').forEach(function (el, i) {
            el.style.transitionDelay = (i % 4) * 0.08 + 's';
            observer.observe(el);
        });
    })();

    /* ═══════════════════════════════════════════
       3. FAQ — accordion
    ═══════════════════════════════════════════ */
    (function () {
        document.querySelectorAll('.faq-trigger').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const item = this.closest('.faq-item');
                const isOpen = item.classList.contains('open');

                // Close all
                document.querySelectorAll('.faq-item.open').forEach(function (openItem) {
                    openItem.classList.remove('open');
                });

                // Toggle clicked
                if (!isOpen) {
                    item.classList.add('open');
                }
            });
        });
    })();

    /* ═══════════════════════════════════════════
       4. MODALS — legal overlays
    ═══════════════════════════════════════════ */
    function openModal(id) {
        var modal = document.getElementById('modal-' + id);
        if (modal) {
            modal.classList.add('open');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal(id) {
        var modal = document.getElementById('modal-' + id);
        if (modal) {
            modal.classList.remove('open');
            document.body.style.overflow = '';
        }
    }

    // Close modal on overlay click
    document.querySelectorAll('.modal-overlay').forEach(function (overlay) {
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) {
                overlay.classList.remove('open');
                document.body.style.overflow = '';
            }
        });
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay.open').forEach(function (modal) {
                modal.classList.remove('open');
            });
            document.body.style.overflow = '';
        }
    });

    /* ═══════════════════════════════════════════
       5. LIVE CHAT — Socket.IO + offline fallback
    ═══════════════════════════════════════════ */
    (function () {
        var SOCKET_URL   = 'http://localhost:3000';
        var sessionId    = 'sid_' + Math.random().toString(36).slice(2, 10);
        var socket       = null;
        var typingTimer  = null;
        var isConnected  = false;

        // DOM refs
        var serverDot       = document.getElementById('serverDot');
        var statusText      = document.getElementById('serverStatusText');
        var sessionDisplay  = document.getElementById('sessionIdDisplay');
        var terminalLogs    = document.getElementById('terminal-logs');
        var chatMessages    = document.getElementById('chatMessages');
        var typingIndicator = document.getElementById('typingIndicator');
        var chatInput       = document.getElementById('chatInput');
        var chatSendBtn     = document.getElementById('chatSendBtn');
        var chatAgentDot    = document.getElementById('chatAgentDot');

        sessionDisplay.textContent = 'Session: ' + sessionId;

        function addLog(text, type) {
            var el = document.createElement('div');
            var ts = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            var tsClass = type === 'ok' ? 'log-ok' : type === 'warn' ? 'log-warn' : 'log-ts';
            el.innerHTML = '<span class="' + tsClass + '">[' + ts + ']</span> ' + text;
            terminalLogs.appendChild(el);
            terminalLogs.parentElement.scrollTop = terminalLogs.parentElement.scrollHeight;
        }

        function setStatus(state) {
            if (state === 'online') {
                serverDot.className  = 'status-dot online';
                statusText.textContent = 'Terhubung (Socket.IO)';
                if (chatAgentDot) chatAgentDot.style.background = '#22c55e';
            } else if (state === 'offline') {
                serverDot.className  = 'status-dot offline';
                statusText.textContent = 'Mode Demo (Simulator Offline)';
                if (chatAgentDot) chatAgentDot.style.background = '#94a3b8';
            } else {
                serverDot.className  = 'status-dot';
                statusText.textContent = 'Menghubungkan...';
            }
        }

        function appendBubble(text, sender) {
            var bubble = document.createElement('div');
            bubble.className = 'bubble ' + (sender === 'user' ? 'bubble-user' : 'bubble-agent');
            bubble.textContent = text;
            chatMessages.appendChild(bubble);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function showTyping() {
            typingIndicator.classList.add('show');
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function hideTyping() {
            typingIndicator.classList.remove('show');
        }

        // Contextual chatbot responses for offline mode
        function getBotReply(msg) {
            msg = msg.toLowerCase();
            if (/\b(halo|hai|hello|hi|helo|selamat)\b/.test(msg)) {
                return 'Halo! Senang bertemu Anda 😊 Ada yang bisa Lara bantu seputar Doctreen hari ini?';
            }
            if (/\b(beli|produk|toko|pesanan|checkout|saprotan|pupuk|pestisida)\b/.test(msg)) {
                return 'Untuk membeli produk, silakan masuk ke dashboard Anda → buka tab Toko → pilih produk → klik "Beli Sekarang". Pembayaran aman via Midtrans. 🛒';
            }
            if (/\b(konsultasi|keluhan|sakit|diagnos|penyakit|hama|tanaman)\b/.test(msg)) {
                return 'Buat sesi konsultasi dengan masuk ke dashboard → klik "Konsultasi Baru" → upload foto tanaman → pilih konsultan. Ahli kami siap membantu! 🌿';
            }
            if (/\b(harga|biaya|tarif|gratis|bayar)\b/.test(msg)) {
                return 'Akses ensiklopedia tanaman gratis. Sesi konsultasi privat mulai dari Rp 55.000/sesi, tergantung konsultan yang Anda pilih. Transparan, tanpa biaya tersembunyi. 💰';
            }
            if (/\b(daftar|register|akun|masuk|login)\b/.test(msg)) {
                return 'Untuk mendaftar, klik tombol "Daftar Gratis" di navbar atas. Proses hanya butuh 2 menit dan langsung bisa digunakan! 🚀';
            }
            if (/\b(refund|kembalikan|batal|cancel)\b/.test(msg)) {
                return 'Refund berlaku jika konsultan tidak merespons dalam 48 jam. Hubungi tim kami di support@doctreen.id untuk proses lebih lanjut.';
            }
            return 'Terima kasih sudah menghubungi kami! Pertanyaan Anda telah dicatat. Untuk bantuan lebih lanjut, silakan masuk ke portal Doctreen dan gunakan fitur klinik diagnosis lengkap. 🌾';
        }

        function sendMessage() {
            var text = chatInput.value.trim();
            if (!text) return;

            appendBubble(text, 'user');
            chatInput.value = '';
            addLog('📤 emit("send_cs_message", "' + text.slice(0, 30) + (text.length > 30 ? '...' : '') + '")', '');

            if (isConnected && socket) {
                socket.emit('send_cs_message', { sender: 'user', message: text, session: sessionId });
                socket.emit('user_stop_typing');
            } else {
                // Offline simulator
                setTimeout(function () {
                    addLog('📥 received("agent_typing")', 'ok');
                    showTyping();
                    var delay = 1000 + Math.random() * 700;
                    setTimeout(function () {
                        hideTyping();
                        var reply = getBotReply(text);
                        addLog('📥 received("receive_cs_message")', 'ok');
                        appendBubble(reply, 'agent');
                        playChime();
                    }, delay);
                }, 350);
            }
        }

        function playChime() {
            try {
                var Ctx = window.AudioContext || window.webkitAudioContext;
                if (!Ctx) return;
                var ctx = new Ctx();
                [[587.33, 0], [880, 0.12]].forEach(function (pair) {
                    var osc  = ctx.createOscillator();
                    var gain = ctx.createGain();
                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(pair[0], ctx.currentTime + pair[1]);
                    gain.gain.setValueAtTime(0.1, ctx.currentTime + pair[1]);
                    gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + pair[1] + 0.5);
                    osc.connect(gain);
                    gain.connect(ctx.destination);
                    osc.start(ctx.currentTime + pair[1]);
                    osc.stop(ctx.currentTime + pair[1] + 0.5);
                });
            } catch (e) { /* audio blocked */ }
        }

        // Event listeners
        chatSendBtn.addEventListener('click', sendMessage);
        chatInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') sendMessage();
        });
        chatInput.addEventListener('input', function () {
            if (!isConnected || !socket) return;
            socket.emit('user_typing');
            clearTimeout(typingTimer);
            typingTimer = setTimeout(function () {
                socket.emit('user_stop_typing');
            }, 2000);
        });

        // Initialize Socket.IO
        addLog('Allocating session: ' + sessionId, '');

        try {
            socket = io(SOCKET_URL, { timeout: 4000, reconnection: false });

            socket.on('connect', function () {
                isConnected = true;
                setStatus('online');
                addLog('Connected to ' + SOCKET_URL + ' (id: ' + socket.id + ')', 'ok');
            });

            socket.on('connect_error', function () {
                if (!isConnected) {
                    isConnected = false;
                    setStatus('offline');
                    addLog('Connection failed. Fallback to offline simulator.', 'warn');
                }
            });

            socket.on('receive_cs_message', function (data) {
                addLog('📥 received("receive_cs_message")', 'ok');
                appendBubble(data.message, data.sender === 'user' ? 'user' : 'agent');
                playChime();
                hideTyping();
            });

            socket.on('agent_typing', function () {
                addLog('📥 received("agent_typing")', '');
                showTyping();
            });

            socket.on('agent_stop_typing', function () {
                hideTyping();
            });

        } catch (err) {
            setStatus('offline');
            addLog('Socket.IO unavailable. Running in demo mode.', 'warn');
        }

        // Fallback timer
        setTimeout(function () {
            if (!isConnected) {
                setStatus('offline');
                addLog('Timeout. Switched to offline simulator mode.', 'warn');
            }
        }, 4500);

    })();
    </script>
</body>
</html>