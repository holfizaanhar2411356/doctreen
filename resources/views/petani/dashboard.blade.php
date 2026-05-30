<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Dashboard Petani — Doctreen</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap');

    :root {
      --g50: #F3F8EE;
      --g100: #E3EFE0;
      --g200: #C2DFC1;
      --g400: #7BB978;
      --g600: #3B7D3F;
      --g800: #062f1e; /* Flora Forest Green */
      --g900: #031b11; /* Deepest Jungle Green */
      --mint: #c4f2d7; /* Flora Mint Accent */
      --mint-light: #e6f9ee;
      --t50: #e6f9ee;
      --t400: #7BB978;
      --t600: #3B7D3F;
      --a50: #FFF9E6;
      --a400: #FFA800;
      --r50: #FFF5F5;
      --r400: #D84B4B;
      --gray50: #F4F7F2;
      --gray100: #E5E5E0;
      --gray400: #8C8B82;
      --text: #062f1e;
      --tm: #3C503D;
      --bg: #F4F7F2;
      --radius-lg: 24px;
      --radius-md: 16px;
      --radius-sm: 12px;
      --glass-bg: rgba(255, 255, 255, 0.78);
      --glass-border: rgba(6, 47, 30, 0.05);
      --shadow-lg: 0 30px 60px rgba(6, 47, 30, 0.05);
      --shadow-sm: 0 4px 20px rgba(6, 47, 30, 0.02);
    }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { 
      font-family: 'DM Sans', sans-serif; 
      background: radial-gradient(circle at 10% 10%, #eaf3de 0%, var(--bg) 60%); 
      color: var(--text); 
      display: flex; 
      min-height: 100vh; 
      letter-spacing: -0.01em; 
      position: relative;
    }
    
    /* Ambient Glowing Orbs like reference */
    body::before {
      content:'';
      position:absolute;
      top:-5%;
      left:-5%;
      width:400px;
      height:400px;
      border-radius:50%;
      background: radial-gradient(circle, rgba(196, 242, 215, 0.15) 0%, transparent 60%);
      filter: blur(40px);
      pointer-events: none;
      z-index: 0;
    }
    
    /* Custom Scrollbar */
    ::-webkit-scrollbar { width: 8px; height: 8px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: var(--g200); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--g400); }

    /* Sidebar */
    .sb { 
      width: 280px; 
      background: linear-gradient(180deg, var(--g900) 0%, #02120b 100%); 
      display: flex; 
      flex-direction: column; 
      padding: 2.25rem 0; 
      position: fixed; 
      top: 0; 
      bottom: 0; 
      left: 0; 
      z-index: 50; 
      box-shadow: 4px 0 35px rgba(3,27,17,0.15); 
    }
    .sb-logo { 
      font-family: 'Playfair Display', serif; 
      font-size: 1.85rem; 
      color: #fff; 
      font-weight: 700;
      padding: 0 2rem 2rem; 
      border-bottom: 1px solid rgba(255,255,255,.05); 
      margin-bottom: 1.25rem; 
      letter-spacing: -0.02em;
    }
    .sb-logo span { color: var(--mint); }
    .sb-lbl { 
      font-size: .72rem; 
      font-weight: 700; 
      text-transform: uppercase; 
      letter-spacing: .12em; 
      color: rgba(255,255,255,.3); 
      padding: 1.25rem 2rem .5rem; 
    }
    .sbi { 
      display: flex; 
      align-items: center; 
      gap: 14px; 
      padding: .85rem 2rem; 
      color: rgba(255,255,255,.6); 
      font-size: .95rem; 
      background: none; 
      border: none; 
      width: 100%; 
      text-align: left; 
      cursor: pointer; 
      transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1); 
      font-weight: 500; 
    }
    .sbi:hover { 
      background: rgba(255,255,255,.04); 
      color: white; 
      padding-left: 2.25rem; 
    }
    .sbi.active { 
      background: rgba(196, 242, 215, 0.07); 
      color: var(--mint); 
      border-right: 4px solid var(--mint); 
      font-weight: 600; 
    }
    .sbi-ico { width: 22px; text-align: center; font-size: 1.25rem; }
    .sb-bot { margin-top: auto; padding: 1.25rem; border-top: 1px solid rgba(255,255,255,.05); }
    .u-card { 
      display: flex; 
      align-items: center; 
      gap: 12px; 
      padding: .85rem; 
      border-radius: var(--radius-md); 
      background: rgba(255,255,255,.04); 
      border: 1px solid rgba(255,255,255,.05); 
      transition: all 0.25s ease; 
    }
    .u-card:hover { 
      background: rgba(255,255,255,.08); 
      transform: translateY(-2px);
    }
    .u-av { 
      width: 42px; 
      height: 42px; 
      border-radius: 50%; 
      background: var(--mint); 
      display: flex; 
      align-items: center; 
      justify-content: center; 
      font-weight: 700; 
      color: var(--g800); 
      overflow: hidden; 
      border: 2px solid rgba(255,255,255,0.25); 
    }
    .u-role { font-size: .78rem; color: rgba(255,255,255,.45); }
    
    /* Main Layout */
    .main { 
      margin-left: 280px; 
      flex: 1; 
      padding: 3rem; 
      max-width: 1240px; 
      z-index: 1;
      position: relative;
    }
    .topbar { 
      display: flex; 
      align-items: center; 
      justify-content: space-between; 
      margin-bottom: 2.5rem; 
    }
    .pg-title { 
      font-family: 'Playfair Display', serif; 
      font-size: 2.3rem; 
      color: var(--g800); 
      font-weight: 700;
      letter-spacing: -0.02em;
    }
    .pg-sub { font-size: .95rem; color: var(--tm); margin-top: 6px; font-weight: 500; }
    
    /* Buttons & Badges */
    .btn-sm { 
      padding: .75rem 1.5rem; 
      background: var(--g800); 
      color: white; 
      border: none; 
      border-radius: var(--radius-sm); 
      font-size: .9rem; 
      font-weight: 700; 
      cursor: pointer; 
      transition: all 0.25s ease; 
      display: inline-flex; 
      align-items: center; 
      gap: 8px; 
      box-shadow: 0 6px 20px rgba(6, 47, 30, 0.12);
    }
    .btn-sm:hover { 
      background: var(--g900); 
      transform: translateY(-2px); 
      box-shadow: 0 10px 25px rgba(6, 47, 30, 0.22); 
    }
    .btn-sm:active { transform: translateY(0); }
    
    .badge { 
      padding: .4rem 1rem; 
      border-radius: 100px; 
      font-size: .75rem; 
      font-weight: 700; 
      display: inline-block; 
      text-transform: uppercase; 
      letter-spacing: 0.05em; 
    }
    .b-dijawab { background: var(--g50); color: var(--g600); border: 1px solid rgba(59,125,63,0.15); }
    .b-proses { background: var(--a50); color: var(--a400); border: 1px solid rgba(254,168,0,0.15); }
    .b-selesai { background: var(--mint-light); color: var(--g600); border: 1px solid rgba(196,242,215,0.4); }
    
    /* Stats grid */
    .stats { 
      display: grid; 
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); 
      gap: 1.5rem; 
      margin-bottom: 2.5rem; 
    }
    .sc { 
      background: var(--glass-bg); 
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border); 
      border-radius: var(--radius-lg); 
      padding: 1.75rem; 
      box-shadow: var(--shadow-lg); 
      border-left: 5px solid var(--g400); 
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); 
    }
    .sc:hover { 
      transform: translateY(-4px) scale(1.01); 
      box-shadow: 0 20px 40px rgba(6, 47, 30, 0.08);
      border-left-color: var(--g600);
    }
    .sc-lbl { 
      font-size: .78rem; 
      font-weight: 700; 
      color: var(--tm); 
      margin-bottom: .6rem; 
      text-transform: uppercase; 
      letter-spacing: 0.06em; 
    }
    .sc-num { 
      font-family: 'Playfair Display', serif; 
      font-size: 2.5rem; 
      color: var(--g800); 
      font-weight: 700;
    }
    .sc-sub { font-size: .8rem; color: var(--g600); margin-top: .6rem; font-weight: 600; }
    
    .grid2 { display: grid; grid-template-columns: 1.2fr 1fr; gap: 1.75rem; }
    
    .card { 
      background: var(--glass-bg); 
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border); 
      border-radius: var(--radius-lg); 
      padding: 2rem; 
      height: auto; 
      box-shadow: var(--shadow-lg); 
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .grid2 > .card { height: 100%; }
    .ct { 
      font-family: 'Playfair Display', serif;
      font-size: 1.35rem; 
      font-weight: 700; 
      color: var(--g800); 
      margin-bottom: 1.75rem; 
      display: flex; 
      justify-content: space-between; 
      align-items: center; 
    }
    .ct a { 
      font-family: 'DM Sans', sans-serif;
      font-size: .85rem; 
      color: var(--g600); 
      text-decoration: none; 
      font-weight: 700; 
      transition: all 0.2s ease; 
    }
    .ct a:hover { color: var(--g800); text-decoration: underline; }
    
    /* Growth Journey / Keluhan list (Flora Style) */
    .ki { 
      display: flex; 
      gap: 16px; 
      padding: 1.2rem 0; 
      border-bottom: 1px solid var(--gray100); 
      align-items: center; 
      transition: all 0.25s ease; 
      position: relative;
    }
    .ki:last-child { border-bottom: none; }
    .ki:hover {
      padding-left: 8px;
    }
    .k-ico { 
      width: 48px; 
      height: 48px; 
      border-radius: var(--radius-sm); 
      display: flex; 
      align-items: center; 
      justify-content: center; 
      font-size: 1.35rem; 
      flex-shrink: 0; 
      box-shadow: var(--shadow-sm); 
      transition: transform 0.25s ease;
    }
    .ki:hover .k-ico {
      transform: scale(1.08) rotate(5deg);
    }
    .k-g { background: var(--g50); } 
    .k-a { background: var(--a50); } 
    .k-t { background: var(--mint-light); }
    .k-ttl { font-size: .95rem; font-weight: 700; color: var(--text); margin-bottom: 4px; }
    .k-meta { font-size: .8rem; color: var(--tm); font-weight: 500; }
    
    .tab-hidden { display: none; }
    
    /* Overlay and Modal */
    .ov { 
      position: fixed; 
      inset: 0; 
      background: rgba(3, 27, 17, 0.45); 
      backdrop-filter: blur(12px); 
      -webkit-backdrop-filter: blur(12px);
      z-index: 200; 
      display: none; 
      align-items: center; 
      justify-content: center; 
      transition: all 0.3s ease; 
    }
    .ov.show { display: flex; }
    .modal { 
      background: rgba(255, 255, 255, 0.94); 
      backdrop-filter: blur(25px);
      -webkit-backdrop-filter: blur(25px);
      border: 1px solid rgba(255, 255, 255, 0.6);
      border-radius: var(--radius-lg); 
      padding: 2.5rem; 
      width: 92%; 
      max-width: 580px; 
      box-shadow: 0 30px 70px rgba(3, 27, 17, 0.15); 
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); 
      max-height: 90vh; 
      overflow-y: auto; 
    }
    .foto-box { 
      border: 2px dashed var(--g200); 
      border-radius: var(--radius-sm); 
      padding: 1.5rem; 
      font-size: .85rem; 
      color: var(--tm); 
      text-align: center; 
      margin: 1rem 0;
      background: rgba(123, 185, 120, 0.03);
      cursor: pointer;
      transition: all 0.2s ease;
    }
    .foto-box:hover {
      border-color: var(--g400);
      background: rgba(123, 185, 120, 0.08);
    }
    
    /* Tables */
    table { width: 100%; border-collapse: collapse; }
    th, td { text-align: left; padding: 1.25rem 1.1rem; border-bottom: 1px solid var(--gray100); }
    th { 
      color: var(--g800); 
      font-weight: 700; 
      font-size: 0.82rem; 
      border-bottom: 2px solid var(--g200); 
      text-transform: uppercase; 
      letter-spacing: 0.08em; 
    }
    td { font-size: 0.92rem; color: var(--text); }
    tr:hover td { background: rgba(196, 242, 215, 0.12); }
    
    /* â”€â”€â”€ TOKO & PRODUK STYLING â”€â”€â”€ */
    .produk-grid { 
      display: grid; 
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); 
      gap: 1.75rem; 
      margin-top: 1.5rem; 
    }
    .prod-card { 
      background: var(--glass-bg); 
      backdrop-filter: blur(15px);
      -webkit-backdrop-filter: blur(15px);
      border: 1px solid var(--glass-border); 
      border-radius: var(--radius-lg); 
      overflow: hidden; 
      box-shadow: var(--shadow-lg); 
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); 
      display: flex; 
      flex-direction: column; 
      height: 100%; 
    }
    .prod-card:hover { 
      transform: translateY(-6px); 
      box-shadow: 0 25px 50px rgba(6, 47, 30, 0.1); 
      border-color: var(--g400); 
    }
    .prod-img { 
      width: 100%; 
      height: 180px; 
      background: var(--gray50); 
      position: relative; 
      overflow: hidden; 
      display: flex; 
      align-items: center; 
      justify-content: center; 
      color: var(--gray400); 
      font-size: 2.2rem; 
    }
    .prod-img img { 
      width: 100%; 
      height: 100%; 
      object-fit: cover; 
      transition: transform 0.5s ease;
    }
    .prod-card:hover .prod-img img {
      transform: scale(1.06);
    }
    .prod-badge { 
      position: absolute; 
      top: 12px; 
      right: 12px; 
      background: rgba(255,255,255,0.92); 
      backdrop-filter: blur(4px);
      padding: 6px 12px; 
      border-radius: 8px; 
      font-size: 0.72rem; 
      font-weight: 700; 
      color: var(--g800); 
      border: 1px solid var(--g100); 
      box-shadow: var(--shadow-sm); 
    }
    .prod-content { padding: 1.5rem; display: flex; flex-direction: column; flex: 1; }
    .prod-cat { 
      font-size: 0.78rem; 
      color: var(--g600); 
      text-transform: uppercase; 
      font-weight: 700; 
      margin-bottom: 8px; 
      letter-spacing: 0.05em; 
    }
    .prod-title { 
      font-family: 'Playfair Display', serif;
      font-size: 1.15rem; 
      font-weight: 700; 
      color: var(--g800); 
      line-height: 1.3; 
      margin-bottom: 10px; 
    }
    .prod-desc { 
      font-size: 0.88rem; 
      color: var(--tm); 
      display: -webkit-box; 
      -webkit-line-clamp: 2; 
      -webkit-box-orient: vertical; 
      overflow: hidden; 
      margin-bottom: 15px; 
      min-height: 40px; 
      line-height: 1.5; 
    }
    .prod-meta { 
      display: flex; 
      align-items: center; 
      justify-content: space-between; 
      margin-top: auto; 
      padding-top: 12px; 
      border-top: 1px solid var(--gray100); 
    }
    .prod-price { font-size: 1.25rem; font-weight: 800; color: var(--g800); }
    .prod-stok { font-size: 0.8rem; color: var(--tm); font-weight: 600; }
    
    .btn-block { 
      display: block; 
      width: 100%; 
      padding: 0.85rem; 
      background: var(--g800); 
      color: white; 
      border: none; 
      border-radius: var(--radius-sm); 
      font-size: 0.9rem; 
      font-weight: 700; 
      cursor: pointer; 
      text-align: center; 
      margin-top: 15px; 
      transition: all 0.25s ease; 
      box-shadow: 0 4px 15px rgba(6, 47, 30, 0.1);
    }
    .btn-block:hover { background: var(--g900); transform: translateY(-1px); }
    .btn-block:active { transform: translateY(1px); }
    .btn-disabled { background: var(--gray100); color: var(--gray400); cursor: not-allowed; box-shadow: none; }
    .btn-disabled:hover { background: var(--gray100); transform: none; }

    /* â”€â”€â”€ PUSTAKA TANAMAN STYLING â”€â”€â”€ */
    .tanaman-grid { 
      display: grid; 
      grid-template-columns: repeat(auto-fill, minmax(310px, 1fr)); 
      gap: 1.75rem; 
      margin-top: 1.5rem; 
    }
    .tan-card { 
      background: var(--glass-bg); 
      backdrop-filter: blur(15px);
      -webkit-backdrop-filter: blur(15px);
      border: 1px solid var(--glass-border); 
      border-radius: var(--radius-lg); 
      overflow: hidden; 
      box-shadow: var(--shadow-lg); 
      display: flex; 
      flex-direction: column; 
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); 
      height: 100%; 
    }
    .tan-card:hover { 
      transform: translateY(-6px); 
      box-shadow: 0 25px 50px rgba(6, 47, 30, 0.1); 
      border-color: var(--g400); 
    }
    .tan-header { 
      padding: 1.75rem; 
      display: flex; 
      gap: 16px; 
      border-bottom: 1px solid var(--gray100); 
      align-items: center; 
    }
    .tan-avatar { 
      width: 60px; 
      height: 60px; 
      border-radius: var(--radius-md); 
      background: var(--mint-light); 
      display: flex; 
      align-items: center; 
      justify-content: center; 
      font-size: 1.75rem; 
      overflow: hidden; 
      flex-shrink: 0; 
      box-shadow: var(--shadow-sm); 
    }
    .tan-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .tan-name { font-family: 'Playfair Display', serif; font-size: 1.45rem; color: var(--g800); font-weight: 700; }
    .tan-latin { font-style: italic; font-size: 0.88rem; color: var(--tm); margin-top: 2px; }
    .tan-body { padding: 1.75rem; display: flex; flex-direction: column; gap: 14px; flex: 1; }
    .tan-section-title { font-size: 0.85rem; font-weight: 700; color: var(--g800); margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.05em; }
    .tan-section-desc { font-size: 0.9rem; color: var(--text); line-height: 1.55; }
    .tan-badges { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 6px; }
    .tan-badge-danger { 
      background: var(--r50); 
      color: var(--r400); 
      padding: 6px 12px; 
      border-radius: 8px; 
      font-size: 0.78rem; 
      font-weight: 700; 
      border: 1px solid rgba(226,75,74,0.15); 
    }
    
    /* â”€â”€â”€ VIDEO PLAYER STYLING â”€â”€â”€ */
    .video-item { background: #fdfefe; border: 1px solid var(--g200); border-radius: var(--radius-md); overflow: hidden; margin-top: 10px; }
    .video-item-header { padding: 0.75rem 1rem; background: var(--g50); display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid var(--g200); }
    .video-title { font-size: 0.85rem; font-weight: 700; color: var(--g900); }
    .video-uploader { font-size: 0.75rem; color: var(--tm); }
    .video-embed { width: 100%; height: 180px; background: #000; position: relative; }
    .video-embed iframe, .video-embed video { width: 100%; height: 100%; border: none; display: block; }
    
    /* â”€â”€â”€ DUAL TABS IN RIWAYAT â”€â”€â”€ */
    .riwayat-tabs { display: flex; gap: 12px; margin-bottom: 1.5rem; border-bottom: 1px solid var(--gray100); padding-bottom: 12px; }
    .riwayat-tab-btn { 
      background: none; 
      border: none; 
      padding: 10px 20px; 
      font-size: 0.9rem; 
      font-weight: 700; 
      color: var(--gray400); 
      cursor: pointer; 
      border-radius: var(--radius-sm); 
      transition: all 0.25s ease; 
    }
    .riwayat-tab-btn:hover {
      color: var(--g800);
      background: rgba(196, 242, 215, 0.15);
    }
    .riwayat-tab-btn.active { 
      background: var(--g800); 
      color: white; 
      box-shadow: 0 6px 18px rgba(6, 47, 30, 0.15); 
    }

    /* â”€â”€â”€ OTHER PREMIUM MODALS â”€â”€â”€ */
    .modal-fg { display: flex; flex-direction: column; gap: 8px; margin-bottom: 1.25rem; }
    .modal-fg label { font-size: 0.82rem; font-weight: 700; color: var(--g800); text-transform: uppercase; letter-spacing: 0.05em; }
    .modal-input { 
      width: 100%; 
      padding: 12px 16px; 
      border-radius: var(--radius-sm); 
      border: 1.5px solid var(--gray100); 
      font-family: inherit; 
      font-size: 0.95rem; 
      transition: all 0.25s ease; 
      color: var(--text); 
      background: rgba(255,255,255,0.7);
      outline: none;
    }
    .modal-input:focus { 
      border-color: var(--g400); 
      background: white;
      box-shadow: 0 0 0 4px rgba(123, 185, 120, 0.15); 
    }
    
    .rating-wrap { display: flex; gap: 8px; margin: 10px 0; }
    .rating-star { font-size: 2.2rem; cursor: pointer; color: var(--gray100); transition: all 0.15s ease; }
    .rating-star.active { color: #FFA800; transform: scale(1.1); }

    /* â”€â”€â”€ SEARCH BOX â”€â”€â”€ */
    .search-container { display: flex; gap: 12px; margin-bottom: 1.75rem; width: 100%; }
    .search-input { 
      flex: 1; 
      padding: 14px 18px; 
      border-radius: var(--radius-sm); 
      border: 1.5px solid var(--g200); 
      background: white; 
      font-family: inherit; 
      font-size: 0.95rem; 
      box-shadow: var(--shadow-sm); 
      transition: all 0.25s ease;
      outline: none;
    }
    .search-input:focus {
      border-color: var(--g400);
      box-shadow: 0 0 0 4px rgba(123, 185, 120, 0.15);
    }

    /* â”€â”€â”€ SHOPPING CART DRAWER STYLING â”€â”€â”€ */
    .cart-drawer {
      position: fixed;
      top: 0;
      right: -440px;
      width: 420px;
      height: 100%;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      box-shadow: -10px 0 40px rgba(3, 27, 17, 0.12);
      z-index: 300;
      transition: right 0.4s cubic-bezier(0.16, 1, 0.3, 1);
      display: flex;
      flex-direction: column;
      border-left: 1px solid rgba(6, 47, 30, 0.08);
    }
    .cart-drawer.open {
      right: 0;
    }
    .cart-header {
      padding: 1.75rem;
      border-bottom: 1px solid var(--gray100);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .cart-header h3 {
      font-family: 'Playfair Display', serif;
      font-size: 1.5rem;
      color: var(--g800);
      font-weight: 700;
    }
    .cart-body {
      flex: 1;
      overflow-y: auto;
      padding: 1.75rem;
      display: flex;
      flex-direction: column;
      gap: 14px;
    }
    .cart-item {
      display: flex;
      gap: 14px;
      padding-bottom: 14px;
      border-bottom: 1px solid var(--gray100);
      align-items: center;
    }
    .cart-item-img {
      width: 56px;
      height: 56px;
      border-radius: var(--radius-sm);
      background: var(--gray50);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.6rem;
      flex-shrink: 0;
      overflow: hidden;
      border: 1px solid var(--gray100);
    }
    .cart-item-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .cart-item-info {
      flex: 1;
    }
    .cart-item-title {
      font-size: 0.92rem;
      font-weight: 700;
      color: var(--text);
      line-height: 1.3;
    }
    .cart-item-price {
      font-size: 0.85rem;
      color: var(--g800);
      font-weight: 700;
      margin-top: 3px;
    }
    .cart-item-qty {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-top: 6px;
    }
    .qty-btn {
      width: 24px;
      height: 24px;
      border-radius: 6px;
      border: 1px solid var(--gray100);
      background: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.8rem;
      cursor: pointer;
      font-weight: bold;
      transition: background 0.15s;
    }
    .qty-btn:hover {
      background: var(--gray50);
    }
    .cart-item-remove {
      background: none;
      border: none;
      color: var(--r400);
      cursor: pointer;
      font-size: 0.95rem;
      padding: 6px;
      border-radius: 8px;
      transition: all 0.2s ease;
    }
    .cart-item-remove:hover { background: var(--r50); }
    .cart-footer {
      padding: 1.75rem;
      border-top: 1px solid var(--gray100);
      background: var(--g50);
    }
    .cart-summary-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
      font-size: 0.9rem;
    }
    .cart-summary-total {
      font-size: 1.25rem;
      font-weight: 800;
      color: var(--g900);
    }
    
    /* Cart overlay backer */
    .cart-backdrop {
      position: fixed;
      inset: 0;
      background: rgba(3, 27, 17, 0.35);
      backdrop-filter: blur(5px);
      -webkit-backdrop-filter: blur(5px);
      z-index: 290;
      display: none;
    }
    .cart-backdrop.show {
      display: block;
    }
    
    /* Floating Cart FAB */
    .cart-fab {
      position: fixed;
      bottom: 30px;
      right: 30px;
      background: var(--g800);
      color: white;
      border: none;
      border-radius: 50px;
      padding: 16px 28px;
      box-shadow: 0 10px 30px rgba(6, 47, 30, 0.3);
      font-size: 0.95rem;
      font-weight: 700;
      cursor: pointer;
      z-index: 150;
      display: none; /* Only visible on Toko Agri tab */
      align-items: center;
      gap: 10px;
      transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .cart-fab:hover {
      transform: scale(1.05) translateY(-3px);
      background: var(--g900);
      box-shadow: 0 15px 35px rgba(6, 47, 30, 0.4);
    }
    
    /* Small badge styling */
    .mp-bayar {
      background: rgba(6, 47, 30, 0.05) !important;
      border: 1px solid rgba(6, 47, 30, 0.12) !important;
      color: var(--g800) !important;
    }

    /* â”€â”€â”€ TOKO DIRECTORY DIRECTORY STYLE â”€â”€â”€ */
    .toko-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
      gap: 1.75rem;
      margin-top: 1.5rem;
    }
    .toko-card {
      background: var(--glass-bg);
      backdrop-filter: blur(15px);
      -webkit-backdrop-filter: blur(15px);
      border: 1px solid var(--glass-border); 
      border-radius: var(--radius-lg); 
      padding: 1.75rem;
      box-shadow: var(--shadow-lg); 
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); 
      cursor: pointer;
      display: flex;
      flex-direction: column;
      height: 100%;
    }
    .toko-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 25px 50px rgba(6, 47, 30, 0.1); 
      border-color: var(--g400); 
    }
    .toko-avatar {
      width: 54px;
      height: 54px;
      border-radius: var(--radius-md);
      background: linear-gradient(135deg, var(--g400), var(--g800));
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 15px;
      box-shadow: var(--shadow-sm);
    }
    .toko-name {
      font-family: 'Playfair Display', serif;
      font-size: 1.45rem;
      color: var(--g800);
      margin-bottom: 8px;
      font-weight: 700;
    }
    .toko-alamat {
      font-size: 0.88rem;
      color: var(--tm);
      margin-bottom: 15px;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      line-height: 1.5;
      height: 42px;
    }
    .toko-meta {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: auto;
      border-top: 1px solid var(--gray100);
      padding-top: 12px;
    }
    .toko-prod-count {
      font-size: 0.8rem;
      font-weight: 700;
      color: var(--g800);
      background: var(--mint-light);
      padding: 5px 12px;
      border-radius: 8px;
      border: 1px solid rgba(196, 242, 215, 0.4);
    }

    /* â”€â”€â”€ PREMIUM SEARCH BAR (ENSIKLOPEDIA) â”€â”€â”€ */
    .ensik-search-wrapper {
      background: rgba(255, 255, 255, 0.9);
      border: 1.5px solid var(--g200);
      border-radius: var(--radius-md);
      padding: 8px 8px 8px 24px;
      display: flex;
      align-items: center;
      box-shadow: var(--shadow-sm);
      transition: all 0.3s ease;
      margin-bottom: 1.5rem;
    }
    .ensik-search-wrapper:focus-within {
      border-color: var(--g400);
      box-shadow: 0 8px 30px rgba(6, 47, 30, 0.08);
      transform: translateY(-2px);
      background: white;
    }
    .ensik-search-icon {
      font-size: 1.35rem;
      color: var(--g400);
      margin-right: 14px;
      display: flex;
      align-items: center;
    }
    .ensik-search-input {
      flex: 1;
      border: none;
      font-family: inherit;
      font-size: 1rem;
      color: var(--text);
      outline: none;
      background: transparent;
      padding: 10px 0;
    }
    .ensik-search-input::placeholder {
      color: var(--gray400);
    }
    .ensik-search-btn {
      background: var(--g800);
      color: white;
      border: none;
      border-radius: var(--radius-sm);
      padding: 12px 28px;
      font-size: 0.95rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.25s ease;
      box-shadow: 0 4px 15px rgba(6, 47, 30, 0.1);
    }
    .ensik-search-btn:hover {
      background: var(--g900);
      box-shadow: 0 6px 20px rgba(6, 47, 30, 0.2);
    }

    /* â”€â”€â”€ POPULAR SEARCH TAGS â”€â”€â”€ */
    .search-tags {
      display: flex;
      gap: 10px;
      margin-top: 12px;
      flex-wrap: wrap;
    }
    .tag-search {
      background: white;
      border: 1px solid var(--g100);
      border-radius: 20px;
      padding: 8px 16px;
      font-size: 0.85rem;
      color: var(--g800);
      cursor: pointer;
      transition: all 0.25s ease;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 6px;
      box-shadow: var(--shadow-sm);
    }
    .tag-search:hover {
      background: var(--mint-light);
      border-color: var(--g400);
      transform: translateY(-2px);
    }

    .sb-menu-container {
      display: flex;
      flex-direction: column;
      flex: 1;
    }

    /* â”€â”€â”€ KELUHAN LIST VIEW STYLING â”€â”€â”€ */
    .keluhan-list {
      display: flex;
      flex-direction: column;
      gap: 1.15rem;
      margin-top: 1.5rem;
    }
    .kel-item {
      background: var(--glass-bg);
      backdrop-filter: blur(15px);
      -webkit-backdrop-filter: blur(15px);
      border: 1px solid var(--glass-border); 
      border-radius: var(--radius-lg); 
      padding: 1.5rem;
      display: flex;
      align-items: flex-start;
      gap: 1.5rem;
      box-shadow: var(--shadow-lg);
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
      cursor: default;
    }
    .kel-item:hover {
      box-shadow: 0 15px 35px rgba(6, 47, 30, 0.08);
      border-color: var(--g400);
      transform: translateX(4px);
    }
    .kel-item-ico {
      width: 52px;
      height: 52px;
      border-radius: var(--radius-md);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.45rem;
      flex-shrink: 0;
      box-shadow: var(--shadow-sm);
    }
    .kel-item-body { flex: 1; min-width: 0; }
    .kel-item-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--g800);
      margin-bottom: 6px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .kel-item-desc {
      font-size: 0.92rem;
      color: var(--tm);
      line-height: 1.6;
      white-space: pre-line;
      margin-bottom: 0.75rem;
      max-height: 5rem;
      overflow: hidden;
    }
    .kel-item-meta {
      font-size: 0.8rem;
      color: var(--gray400);
      margin-top: 6px;
      display: flex;
      align-items: center;
      gap: 12px;
      flex-wrap: wrap;
      font-weight: 600;
    }
    .kel-item-right {
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      gap: 12px;
      flex-shrink: 0;
    }

    /* â”€â”€â”€ RESPONSIVENESS / CARD & GRID LAYOUT ADAPTATION â”€â”€â”€ */
    @media (max-width: 1024px) {
      .grid2 { grid-template-columns: 1fr; gap: 1.75rem; }
      .main { margin-left: 280px; padding: 2rem; }
    }
    @media (max-width: 768px) {
      body { flex-direction: column; }
      .sb { 
        width: 100%; 
        position: sticky; 
        top: 0; 
        height: auto; 
        padding: 0.75rem 1.5rem; 
        flex-direction: row; 
        align-items: center; 
        justify-content: space-between; 
        border-bottom: 1px solid rgba(255,255,255,0.06);
        z-index: 100;
        background: linear-gradient(90deg, var(--g900) 0%, #02120b 100%); 
      }
      .sb-logo { 
        padding: 0; 
        margin: 0; 
        border-bottom: none; 
        font-size: 1.45rem; 
      }
      .sb-lbl { display: none; }
      .sb-menu-container {
        display: flex;
        flex-direction: row;
        gap: 8px;
        overflow-x: auto;
        padding: 4px 0;
        margin-left: 1.5rem;
        flex: 1;
        scrollbar-width: none;
      }
      .sb-menu-container::-webkit-scrollbar { display: none; }
      .sbi { 
        padding: 8px 12px; 
        font-size: 0.85rem; 
        border-radius: 8px; 
        white-space: nowrap; 
        width: auto;
        display: inline-flex;
        align-items: center;
        gap: 6px;
      }
      .sbi-ico { display: none; }
      .sbi.active {
        border-right: none;
        border-bottom: 3px solid var(--mint);
        background: rgba(196, 242, 215, 0.12);
        color: var(--mint);
      }
      .sb-bot { display: none; }
      .main { margin-left: 0; padding: 1.5rem 1.5rem; margin-top: 0; max-width: 100%; }
      .topbar { flex-direction: column; align-items: flex-start; gap: 1rem; }
      .topbar button { width: 100%; }
      /* Stats: 2 kolom di mobile, bukan 1 */
      .stats { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
      .tanaman-grid { grid-template-columns: 1fr; }
      .produk-grid { grid-template-columns: 1fr; }
      .toko-grid { grid-template-columns: 1fr; }
      .kel-item { flex-wrap: wrap; }
      .kel-item-right { width: 100%; display: flex; gap: 10px; align-items: center; margin-top: 8px; }
      .logout-form { margin-top: 0 !important; }
      /* Modal full-width di mobile */
      .modal { padding: 1.75rem !important; }
      /* Tabel dengan horizontal scroll */
      table { min-width: 600px; }
      .card { padding: 1.5rem; }
      .grid2 { grid-template-columns: 1fr !important; }
    }
    @media (max-width: 480px) {
      .stats { grid-template-columns: 1fr; }
      .main { padding: 1rem; }
      .pg-title { font-size: 1.6rem !important; }
      .sb { padding: 0.6rem 1rem; }
      .sbi { font-size: 0.78rem; padding: 6px 10px; }
    }

    /* â”€â”€â”€ Animasi Overlay â”€â”€â”€ */
    #flower-intro-overlay {
      position: fixed; inset: 0; background: var(--g900);
      z-index: 9999; display: flex; align-items: center;
      justify-content: center; flex-direction: column;
      transition: opacity 0.8s ease; pointer-events: none;
    }
    #flower-intro-overlay.fade-out { opacity: 0; }
    #flower-intro-svg { transform: scale(0) rotate(-30deg);
      transition: transform 1.1s cubic-bezier(0.34, 1.56, 0.64, 1); }
    #flower-intro-svg.bloom { transform: scale(1) rotate(0deg); }
    .flower-intro-lbl { font-family: 'Playfair Display', serif; color: #EAF3DE;
      font-size: 1.5rem; margin-top: 1.5rem; opacity: 0; transition: opacity 0.6s 0.7s; letter-spacing: 0.02em; }
    .flower-intro-lbl.show { opacity: 1; }

    /* Pohon Layu Overlay */
    #wilt-overlay {
      position: fixed; inset: 0; background: var(--g900);
      z-index: 9998; display: none; align-items: center;
      justify-content: center; flex-direction: column;
    }
    #wilt-overlay.show { display: flex; }
    #wilt-tree { opacity: 0; transform: scaleY(1) rotate(0deg); transform-origin: bottom center;
      transition: opacity 0.4s, transform 1.5s cubic-bezier(0.55, 0.06, 0.68, 0.19); }
    #wilt-tree.wilt { opacity: 1; transform: scaleY(0.25) rotate(10deg); }
    .wilt-lbl { color: rgba(234,243,222,0.65); font-family: 'Playfair Display', serif;
      font-size: 1.3rem; margin-top: 1.25rem; opacity: 0; transition: opacity 0.5s ease 0.9s; }
    .wilt-lbl-sub { color: rgba(234,243,222,0.45); font-family: 'DM Sans', sans-serif;
      font-size: 1.1rem; margin-top: 1rem; opacity: 0; transition: opacity 0.5s ease 0.9s; }
    .wilt-lbl.show, .wilt-lbl-sub.show { opacity: 1; }

    /* FULLSCREEN DYNAMIC GREENHOUSE BACKGROUND */
    .dashboard-bg-container {
      position: fixed;
      inset: 0;
      width: 100vw;
      height: 100vh;
      overflow: hidden;
      z-index: 0;
      pointer-events: none;
    }
    
    .dashboard-pan-bg {
      width: 115%;
      height: 115%;
      position: absolute;
      top: -7.5%; left: -7.5%;
      background-image: linear-gradient(135deg, rgba(243, 248, 238, 0.86) 0%, rgba(255, 255, 255, 0.94) 100%), url('/images/petani_bg.png');
      background-size: cover;
      background-position: center;
      filter: blur(4px); /* Soft blur to keep dashboard UI elements perfectly readable */
      transform-origin: center center;
      animation: slowPanPetani 50s infinite ease-in-out;
    }

    @keyframes slowPanPetani {
      0% {
        transform: translate3d(0, 0, 0) scale(1);
      }
      50% {
        transform: translate3d(-5%, -2%, 0) scale(1.05);
      }
      100% {
        transform: translate3d(0, 0, 0) scale(1);
      }
    }
  </style>
</head>
<body>
  <!-- Productive Food Greenhouse Dynamic Background -->
  <div class="dashboard-bg-container">
    <div class="dashboard-pan-bg"></div>
  </div>

{{-- Overlay Bunga Mekar saat Dashboard Dimuat --}}
<div id="flower-intro-overlay">
    <svg id="flower-intro-svg" width="160" height="160" viewBox="0 0 160 160" fill="none" xmlns="http://www.w3.org/2000/svg">
        <ellipse cx="80" cy="22" rx="18" ry="26" fill="#5da832" transform="rotate(0 80 80)"/>
        <ellipse cx="80" cy="22" rx="18" ry="26" fill="#72dd4e" transform="rotate(45 80 80)"/>
        <ellipse cx="80" cy="22" rx="18" ry="26" fill="#5da832" transform="rotate(90 80 80)"/>
        <ellipse cx="80" cy="22" rx="18" ry="26" fill="#72dd4e" transform="rotate(135 80 80)"/>
        <ellipse cx="80" cy="22" rx="18" ry="26" fill="#5da832" transform="rotate(180 80 80)"/>
        <ellipse cx="80" cy="22" rx="18" ry="26" fill="#72dd4e" transform="rotate(225 80 80)"/>
        <ellipse cx="80" cy="22" rx="18" ry="26" fill="#5da832" transform="rotate(270 80 80)"/>
        <ellipse cx="80" cy="22" rx="18" ry="26" fill="#72dd4e" transform="rotate(315 80 80)"/>
        <circle cx="80" cy="80" r="25" fill="#FFA800"/>
        <circle cx="80" cy="80" r="16" fill="#FFD700"/>
        <circle cx="80" cy="80" r="8" fill="#FF8C00"/>
    </svg>
    <div class="flower-intro-lbl" id="flowerIntroLbl">Selamat Datang! ðŸŒ¸</div>
</div>

{{-- Overlay Pohon Layu saat Logout --}}
<div id="wilt-overlay">
    <svg id="wilt-tree" width="130" height="170" viewBox="0 0 130 170" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="58" y="85" width="14" height="75" rx="6" fill="#6b8c4a"/>
        <path d="M58 150 Q42 162 28 170" stroke="#6b8c4a" stroke-width="5" stroke-linecap="round"/>
        <path d="M72 150 Q88 162 102 170" stroke="#6b8c4a" stroke-width="5" stroke-linecap="round"/>
        <ellipse cx="65" cy="85" rx="32" ry="22" fill="#8ab856" opacity="0.8"/>
        <ellipse cx="40" cy="70" rx="25" ry="18" fill="#7aad48" transform="rotate(-30 40 70)" opacity="0.6"/>
        <ellipse cx="90" cy="70" rx="25" ry="18" fill="#7aad48" transform="rotate(30 90 70)" opacity="0.6"/>
        <ellipse cx="65" cy="50" rx="22" ry="27" fill="#9dc861" opacity="0.5"/>
    </svg>
    <div class="wilt-lbl" id="wiltLbl">Sampai jumpa... ðŸ ‚</div>
</div>

<aside class="sb">
  <div class="sb-logo" style="display: flex; align-items: center; justify-content: center; padding: 0.5rem 1.5rem 1.5rem;">
      <img src="/images/doctreen_logo.png" alt="Doctreen" style="height: 40px; width: auto; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
  </div>
  <span class="sb-lbl">Menu Utama</span>
  <div class="sb-menu-container">
    <button type="button" class="sbi active" onclick="showTab('dashboard',this)"><span class="sbi-ico">ðŸ ¾</span>Dashboard</button>
    <button type="button" class="sbi" onclick="showTab('keluhan',this)"><span class="sbi-ico">ðŸ’¬</span>Keluhan Saya</button>
    <button type="button" class="sbi" onclick="showTab('tanaman',this)"><span class="sbi-ico">ðŸŒ±</span>Ensiklopedia</button>
    <button type="button" class="sbi" onclick="showTab('toko',this)"><span class="sbi-ico">ðŸ›’</span>Toko Agri</button>
    <button type="button" class="sbi" onclick="showTab('riwayat',this)"><span class="sbi-ico">ðŸ“‹</span>Riwayat</button>
  </div>
  
  <div class="sb-bot">
    <div class="u-card" style="cursor: pointer; transition: background 0.2s; margin-bottom: 12px;" onclick="openModal('modalProfilPetani')" title="Klik untuk edit profil Anda">
      <div class="u-av">
        @if(!empty($petani->foto_profil))
          <img src="{{ asset('storage/' . $petani->foto_profil) }}" style="width: 100%; height: 100%; object-fit: cover;">
        @else
          {{ strtoupper(substr($petani->nama ?? 'P', 0, 2)) }}
        @endif
      </div>
      <div>
        <div style="font-size:.85rem;color:white;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:140px;">{{ $petani->nama ?? 'Bapak Petani' }}</div>
        <div class="u-role">Mitra Doctreen</div>
      </div>
    </div>
    <form method="POST" action="{{ route('logout') }}" class="logout-form" style="margin: 0;" id="logoutForm">
      @csrf
      <button type="button" class="sbi" style="color:#ff8e8e; padding: .5rem .85rem; border-radius: 8px; font-size: .88rem; background: rgba(255, 142, 142, 0.05); display: flex; align-items: center; justify-content: center; gap: 8px; border: 1px solid rgba(255, 142, 142, 0.15); width: 100%;" onclick="triggerWiltLogout()">
        <span class="sbi-ico" style="margin: 0; font-size: 1.1rem;">ðŸšª</span> Keluar Sesi
      </button>
    </form>
  </div>
</aside>

<main class="main">
  <!-- Dynamic Notification Alerts -->
  @if($errors->any())
    <div style="background: #fdf2f2; border: 1.5px solid #f8b4b4; color: #9b1c1c; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; font-weight: 500; font-size: 0.9rem; box-shadow: 0 4px 10px rgba(155,28,28,0.04);">
      <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.5rem; font-weight: bold;">
        <span>âš ï¸ Ada kesalahan pengisian formulir:</span>
        <button type="button" style="background:none; border:none; color:#9b1c1c; font-weight:bold; cursor:pointer;" onclick="this.parentElement.parentElement.remove()">âœ•</button>
      </div>
      <ul style="margin: 0; padding-left: 1.25rem;">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @if(session('success'))
    <div style="background: var(--g50); border: 1.5px solid var(--g200); color: var(--g800); padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between; font-weight: 500; font-size: 0.9rem; box-shadow: 0 4px 10px rgba(99,153,34,0.04);">
      <span>ðŸŽ‰ {{ session('success') }}</span>
      <button type="button" style="background:none; border:none; color:var(--g800); font-weight:bold; cursor:pointer;" onclick="this.parentElement.remove()">âœ•</button>
    </div>
  @endif

  @if(session('error'))
    <div style="background: var(--r50); border: 1.5px solid var(--r400); color: var(--r400); padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between; font-weight: 500; font-size: 0.9rem; box-shadow: 0 4px 10px rgba(226,75,74,0.04);">
      <span>âš ï¸ {{ session('error') }}</span>
      <button type="button" style="background:none; border:none; color:var(--r400); font-weight:bold; cursor:pointer;" onclick="this.parentElement.remove()">âœ•</button>
    </div>
  @endif

  <!-- TAB DASHBOARD -->
  <div id="tab-dashboard">
    <div class="topbar">
      <div>
        <div class="pg-title">Selamat Pagi, {{ $petani->nama ?? 'Mitra Petani' }}!</div>
        <div class="pg-sub">Pantau kondisi kebun Anda hari ini</div>
      </div>
      <button type="button" class="btn-sm" onclick="openModal('modalKeluhan')">+ Ajukan Keluhan</button>
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
        <div class="sc-lbl">Pesanan Produk Aktif</div>
        <div class="sc-num">{{ sprintf('%02d', $pesananAktif) }}</div>
        <div class="sc-sub">Sesi pesanan aktif</div>
      </div>
    </div>

    <div class="grid2">
      <div class="card">
        <div class="ct">Keluhan Terbaru <a href="javascript:void(0)" onclick="showTab('riwayat', document.querySelector('[onclick*=\'riwayat\']'))">Lihat Semua â†’</a></div>
        @forelse($keluhans->take(5) as $kel)
          @php
            $konsulTerkait = $kel->konsultasi;
            $status = $kel->status ?? 'baru';
            $badgeClass = 'b-dijawab';
            $statusLabel = 'Menunggu';
            if ($status === 'proses') {
                $badgeClass = 'b-proses';
                $statusLabel = 'Proses Medis';
            } elseif ($status === 'selesai') {
                $badgeClass = 'b-selesai';
                $statusLabel = 'Selesai';
            }
          @endphp
          <div class="ki" style="transition: background 0.2s; border-radius: 8px; padding: 8px 10px; margin: 4px 0;">
            <div class="k-ico {{ $kel->status === 'selesai' ? 'k-t' : ($kel->status === 'proses' ? 'k-a' : 'k-g') }}">ðŸƒ</div>
            <div style="flex:1">
              <div class="k-ttl">{{ $kel->judul_keluhan }}</div>
              <div class="k-meta">{{ $kel->tanggal_keluhan }} â€¢ {{ $konsulTerkait && $konsulTerkait->konsultan ? $konsulTerkait->konsultan->nama : 'Menunggu Verifikasi' }}</div>
            </div>
            <span class="badge {{ $badgeClass }}">{{ $statusLabel }}</span>
          </div>
        @empty
          <div class="ki"><div style="color:var(--gray400);font-size:.85rem">Belum ada keluhan tanaman terdaftar.</div></div>
        @endforelse
      </div>

      <div class="card">
        <div class="ct">Konsultan Ahli</div>
        @forelse($konsultans->take(5) as $c)
          <div class="ki" style="cursor: pointer; transition: background 0.15s ease;" onclick="openProfilKonsultan('{{ addslashes($c->nama) }}', '{{ addslashes($c->keahlian ?? '-') }}', '{{ $c->status ?? 'Aktif' }}', '{{ number_format(($c->tarif_konsultasi ?? 0) * 1000, 0, ',', '.') }}', '{{ !empty($c->foto_profil) ? asset('storage/' . $c->foto_profil) : '' }}', '{{ $c->telepon ?? ($c->user->telepon ?? '-') }}', '{{ addslashes($c->alamat ?? 'Jl. Doctreen Agrikultur No. 24, Jakarta') }}')">
            <div class="k-ico k-g">
              @if(!empty($c->foto_profil))
                <img src="{{ asset('storage/' . $c->foto_profil) }}" style="width:100%; height:100%; border-radius:12px; object-fit:cover;">
              @else
                ðŸ‘¨â€ðŸŒ¾
              @endif
            </div>
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

  <!-- TAB ENSIKLOPEDIA TANAMAN (NEW) -->
  <div id="tab-tanaman" class="tab-hidden">
    <div class="topbar">
      <div>
        <div class="pg-title">ðŸŒ± Ensiklopedia Pustaka Tanaman</div>
        <div class="pg-sub">Metode perawatan, protokol pengobatan penyakit, dan video panduan dari konsultan ahli.</div>
      </div>
    </div>

    <div class="ensik-search-wrapper">
      <div class="ensik-search-icon">ðŸ”</div>
      <input type="text" id="tanamanSearchInput" class="ensik-search-input" placeholder="Cari tanaman berdasarkan nama, nama latin, atau jenis..." onkeyup="filterTanaman()">
      <button type="button" class="ensik-search-btn" onclick="filterTanaman()">Cari Tanaman</button>
    </div>
    <div style="margin-bottom: 2rem;">
      <span style="font-size: 0.78rem; font-weight: bold; color: var(--gray400); text-transform: uppercase; margin-right: 8px; display: inline-block;">Pencarian Populer:</span>
      <div class="search-tags" style="display: inline-flex; gap: 8px; flex-wrap: wrap; align-items: center;">
        <span class="tag-search" onclick="setPlantSearch('Padi')">ðŸŒ¾ Padi</span>
        <span class="tag-search" onclick="setPlantSearch('Jagung')">ðŸŒ½ Jagung</span>
        <span class="tag-search" onclick="setPlantSearch('Cabai')">ðŸŒ¶ï¸ Cabai</span>
        <span class="tag-search" onclick="setPlantSearch('Tomat')">ðŸ… Tomat</span>
        <span class="tag-search" onclick="setPlantSearch('Bawang')">ðŸ§… Bawang</span>
        <span class="tag-search" onclick="setPlantSearch('')">ðŸ”„ Reset</span>
      </div>
    </div>

    <div class="tanaman-grid" id="tanamanGridContainer">
      @forelse($tanamans as $tan)
        <div class="tan-card" data-nama="{{ strtolower($tan->nama_tanaman) }}" data-latin="{{ strtolower($tan->nama_latin ?? '') }}">
          <div class="tan-header">
            <div class="tan-avatar">
              @if(!empty($tan->foto_tanaman))
                <img src="{{ asset('storage/' . $tan->foto_tanaman) }}" alt="{{ $tan->nama_tanaman }}">
              @else
                ðŸŒ¿
              @endif
            </div>
            <div>
              <div class="tan-name">{{ $tan->nama_tanaman }}</div>
              <div class="tan-latin" style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap; margin-top: 2px;">
                <span>{{ $tan->nama_latin ?? 'Species sp.' }}</span>
                @if(!empty($tan->jenis_tanaman))
                  <span class="badge b-selesai" style="font-size: 0.65rem; padding: 2px 6px; background: rgba(39,80,10,0.08); color: #27500A; border: 1px solid rgba(39,80,10,0.15); border-radius: 4px; font-weight: 700; font-style: normal;">{{ $tan->jenis_tanaman }}</span>
                @endif
              </div>
            </div>
          </div>
          <div class="tan-body">
            <div style="border-bottom: 1px solid var(--gray50); padding-bottom: 10px;">
              <div class="tan-section-title">ðŸšœ Metode Perawatan</div>
              <div class="tan-section-desc">{{ \Illuminate\Support\Str::limit($tan->metode_perawatan ?? 'Belum ada panduan perawatan.', 90) }}</div>
            </div>
            <div style="border-bottom: 1px solid var(--gray50); padding-bottom: 10px; margin-top: 6px;">
              <div class="tan-section-title">ðŸ§ª Protokol Pengobatan</div>
              <div class="tan-section-desc">{{ \Illuminate\Support\Str::limit($tan->protokol_pengobatan ?? 'Belum ada resep penanganan infeksi.', 90) }}</div>
            </div>
            <div style="margin-top: 6px;">
              <div class="tan-section-title">âš ï¸ Bahaya & Ancaman Utama</div>
              <div class="tan-badges">
                @if(is_array($tan->ancaman_hama) || is_object($tan->ancaman_hama))
                  @forelse($tan->ancaman_hama as $ancaman)
                    <div class="tan-badge-danger">{{ $ancaman }}</div>
                  @empty
                    <div style="color:var(--gray400); font-size:0.75rem; font-style:italic;">Aman dari ancaman patogen ekstrem.</div>
                  @endforelse
                @else
                  <div style="color:var(--gray400); font-size:0.75rem; font-style:italic;">Aman dari ancaman patogen ekstrem.</div>
                @endif
              </div>
            </div>

            <button class="btn-block btn-lihat-lebih" 
                    style="background: rgba(39, 80, 10, 0.06); color: #27500A; border: 1px solid rgba(39, 80, 10, 0.15); padding: 8px; border-radius: 8px; font-size: 0.8rem; font-weight: 700; cursor: pointer; text-align: center; margin-top: 15px; display: flex; align-items: center; justify-content: center; gap: 6px;"
                    data-nama="{{ $tan->nama_tanaman }}"
                    data-latin="{{ $tan->nama_latin ?? 'Species sp.' }}"
                    data-jenis="{{ $tan->jenis_tanaman ?? 'Umum' }}"
                    data-perawatan="{{ $tan->metode_perawatan ?? 'Belum ada panduan perawatan.' }}"
                    data-pengobatan="{{ $tan->protokol_pengobatan ?? 'Belum ada resep penanganan infeksi.' }}"
                    data-foto="{{ !empty($tan->foto_tanaman) ? asset('storage/' . $tan->foto_tanaman) : '' }}"
                    data-ancaman="{{ json_encode($tan->ancaman_hama ?? []) }}"
                    data-videos="{{ json_encode($tan->videos ?? []) }}"
                    onclick="openDetailTanaman(this)">
              ðŸ” Lihat Lebih Detail
            </button>
          </div>
        </div>
      @empty
        <div class="card" style="grid-column: 1/-1; text-align: center; color: var(--gray400); padding: 3rem;">
          ðŸŒ± Belum ada data pustaka tanaman terdaftar.
        </div>
      @endforelse
    </div>
  </div>

  <!-- TAB TOKO AGRI (DYNAMIC & HARMONIZED) -->
  <div id="tab-toko" class="tab-hidden">
    <!-- BERANDA TOKO AGRI (DAFTAR TOKO & GLOBAL SEARCH) -->
    <div id="tokoListContainer">
      <div class="topbar">
        <div>
          <div class="pg-title">ðŸ›’ Toko Agri & Saprotan</div>
          <div class="pg-sub">Beli sarana produksi pertanian berkualitas langsung dari distributor resmi terpercaya.</div>
        </div>
      </div>

      <!-- Bilah Pencarian Produk Global (Di Luar) -->
      <div class="ensik-search-wrapper" style="margin-bottom: 1.5rem;">
        <div class="ensik-search-icon">ðŸ”</div>
        <input type="text" id="globalProdukSearchInput" class="ensik-search-input" placeholder="Cari produk pertanian di seluruh mitra toko tani..." onkeyup="filterGlobalProduk()">
        <button type="button" class="ensik-search-btn" onclick="filterGlobalProduk()">Cari Produk</button>
      </div>

      <!-- KONTEN DAFTAR TOKO (Toko-First View) -->
      <div id="allTokosListContainer">
        <div style="font-size: 1.05rem; font-weight: 700; color: var(--g800); margin-bottom: 1.25rem; display: flex; align-items: center; gap: 6px;">
          <span>ðŸª</span> Mitra Toko Tani Resmi Doctreen
        </div>
        <div class="toko-grid">
          @forelse($tokos as $toko)
            <div class="toko-card" onclick="showTokoDetail({{ $toko->id }}, '{{ addslashes($toko->nama_toko) }}', '{{ addslashes($toko->alamat ?? 'Alamat Mitra') }}')">
              <div class="toko-avatar">
                {{ strtoupper(substr($toko->nama_toko, 0, 2)) }}
              </div>
              <div class="toko-name">{{ $toko->nama_toko }}</div>
              <div class="toko-alamat">ðŸ“ {{ $toko->alamat ?? 'Alamat distributor tidak terdaftar.' }}</div>
              <div class="toko-meta">
                <span class="toko-prod-count">ðŸ›ï¸ {{ $toko->produks->count() }} Produk</span>
                <span style="font-size: 0.85rem; color: var(--g600); font-weight: 700; display: flex; align-items: center; gap: 4px;">Kunjungi â†’</span>
              </div>
            </div>
          @empty
            <div class="card" style="grid-column: 1/-1; text-align: center; color: var(--gray400); padding: 3rem;">
              ðŸª Belum ada mitra toko tani aktif saat ini.
            </div>
          @endforelse
        </div>
      </div>

      <!-- KONTEN HASIL PENCARIAN PRODUK GLOBAL -->
      <div id="globalProdukResultsContainer" style="display: none;">
        <div style="font-size: 1.05rem; font-weight: 700; color: var(--g800); margin-bottom: 1.25rem; display: flex; align-items: center; gap: 6px;">
          <span>ðŸ”</span> Hasil Pencarian Produk Terkait
        </div>
        <div class="produk-grid" id="globalProdukGrid">
          @forelse($produks as $prod)
            @php
              $hargaRupiah = $prod->harga * 1000;
              $stokReady = $prod->stok > 0;
            @endphp
            <div class="prod-card global-prod-item" data-global-nama="{{ strtolower($prod->nama_produk) }}" style="display: flex;">
              <div class="prod-img">
                @if(!empty($prod->foto_produk))
                  <img src="{{ asset('storage/' . $prod->foto_produk) }}" alt="{{ $prod->nama_produk }}">
                @else
                  ðŸ“¦
                @endif
                <div class="prod-badge">{{ $prod->toko->nama_toko ?? 'Mitra Doctreen' }}</div>
              </div>
              <div class="prod-content">
                <div class="prod-cat">{{ $prod->kategori ?? 'Umum' }}</div>
                <div class="prod-title">{{ $prod->nama_produk }}</div>
                <div class="prod-desc">{{ $prod->deskripsi ?? 'Tidak ada deskripsi produk.' }}</div>
                
                <div class="prod-meta">
                  <div>
                    <div style="font-size: 0.7rem; color: var(--gray400); font-weight: 500;">Harga</div>
                    <div class="prod-price">Rp {{ number_format($hargaRupiah, 0, ',', '.') }}</div>
                  </div>
                  <div class="prod-stok">
                    @if($stokReady)
                      Stok: <span style="color: var(--g600); font-weight: bold;">{{ $prod->stok }} pcs</span>
                    @else
                      <span style="color: var(--r400); font-weight: bold; background: var(--r50); padding: 3px 8px; border-radius: 4px;">Habis</span>
                    @endif
                  </div>
                </div>

                @if($stokReady)
                  <div style="display: flex; gap: 8px; margin-top: 12px;">
                    <button type="button" class="btn-sm" style="flex: 1; padding: 0.65rem 0.5rem; background: var(--g600); color: white; display: flex; align-items: center; justify-content: center; gap: 4px; font-size: 0.8rem; font-weight: 700;" 
                            onclick="addToCart({{ $prod->id }}, '{{ addslashes($prod->nama_produk) }}', '{{ addslashes($prod->toko->nama_toko ?? 'Mitra Doctreen') }}', {{ $hargaRupiah }}, {{ $prod->stok }}, '{{ !empty($prod->foto_produk) ? asset('storage/' . $prod->foto_produk) : '' }}')">
                      ðŸ›’ +Keranjang
                    </button>
                    <button type="button" class="btn-sm" style="flex: 1; padding: 0.65rem 0.5rem; background: rgba(39, 80, 10, 0.08); color: #27500A; border: 1px solid rgba(39, 80, 10, 0.15); font-size: 0.8rem; font-weight: 700;" 
                            onclick="openBeliModal({{ $prod->id }}, '{{ addslashes($prod->nama_produk) }}', '{{ addslashes($prod->toko->nama_toko ?? 'Mitra Doctreen') }}', {{ $hargaRupiah }}, {{ $prod->stok }})">
                      Beli Instan
                    </button>
                  </div>
                @else
                  <button class="btn-block btn-disabled" disabled style="margin-top: 12px;">Stok Habis</button>
                @endif
              </div>
            </div>
          @empty
            <div class="card" style="grid-column: 1/-1; text-align: center; color: var(--gray400); padding: 3rem;">
              ðŸ›’ Belum ada produk aktif yang tersedia untuk dijual.
            </div>
          @endforelse
        </div>
        <div id="globalProdukEmptyMessage" class="card" style="text-align: center; color: var(--gray400); padding: 3rem; display: none;">
          ðŸ” Tidak ada produk yang cocok dengan pencarian Anda.
        </div>
      </div>
    </div>

    <!-- DETAIL PRODUK TOKO (SUB-VIEW CATALOG SPESIFIK TOKO) -->
    <div id="tokoDetailContainer" class="tab-hidden">
      <!-- Header dengan Tombol Kembali & Info Toko -->
      <button type="button" class="btn-sm" style="background: rgba(39, 80, 10, 0.08); color: #27500A; border: 1px solid rgba(39, 80, 10, 0.15); font-weight: 700; padding: 8px 16px; display: inline-flex; align-items: center; gap: 6px; margin-bottom: 1.5rem;" onclick="hideTokoDetail()">
        â† Kembali ke Daftar Toko
      </button>

      <div style="background: white; border: 1px solid rgba(99,153,34,0.1); border-radius: 20px; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 15px rgba(23,52,4,0.02); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
        <div>
          <div style="font-size: 0.72rem; color: var(--gray400); text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em; margin-bottom: 4px;">Distributor Terpilih</div>
          <h2 id="detailTokoNama" style="font-family: 'DM Serif Display'; font-size: 1.8rem; color: var(--g900); line-height: 1.2;">Nama Toko</h2>
          <p id="detailTokoAlamat" style="font-size: 0.88rem; color: var(--gray400); margin-top: 4px; display: flex; align-items: center; gap: 4px; font-weight: 500;">ðŸ“ Alamat Toko</p>
        </div>
        <!-- Input Pencarian Produk Toko Internal (Di Dalam) -->
        <div class="ensik-search-wrapper" style="max-width: 360px; width: 100%; margin-bottom: 0; padding: 4px 4px 4px 15px;">
          <div class="ensik-search-icon" style="font-size: 1rem; margin-right: 8px;">ðŸ”</div>
          <input type="text" id="produkSearchInput" class="ensik-search-input" placeholder="Cari produk di toko ini..." onkeyup="filterProduk()" style="padding: 6px 0; font-size: 0.88rem;">
        </div>
      </div>

      <!-- Grid Produk Katalog Toko -->
      <div class="produk-grid" id="detailTokoProdukGrid">
        @forelse($produks as $prod)
          @php
            $hargaRupiah = $prod->harga * 1000;
            $stokReady = $prod->stok > 0;
          @endphp
          <div class="prod-card" data-toko-id="{{ $prod->id_toko }}" data-nama="{{ strtolower($prod->nama_produk) }}" style="display: none;">
            <div class="prod-img">
              @if(!empty($prod->foto_produk))
                <img src="{{ asset('storage/' . $prod->foto_produk) }}" alt="{{ $prod->nama_produk }}">
              @else
                ðŸ“¦
              @endif
              <div class="prod-badge">{{ $prod->toko->nama_toko ?? 'Mitra Doctreen' }}</div>
            </div>
            <div class="prod-content">
              <div class="prod-cat">{{ $prod->kategori ?? 'Umum' }}</div>
              <div class="prod-title">{{ $prod->nama_produk }}</div>
              <div class="prod-desc">{{ $prod->deskripsi ?? 'Tidak ada deskripsi produk.' }}</div>
              
              <div class="prod-meta">
                <div>
                  <div style="font-size: 0.7rem; color: var(--gray400); font-weight: 500;">Harga</div>
                  <div class="prod-price">Rp {{ number_format($hargaRupiah, 0, ',', '.') }}</div>
                </div>
                <div class="prod-stok">
                  @if($stokReady)
                    Stok: <span style="color: var(--g600); font-weight: bold;">{{ $prod->stok }} pcs</span>
                  @else
                    <span style="color: var(--r400); font-weight: bold; background: var(--r50); padding: 3px 8px; border-radius: 4px;">Habis</span>
                  @endif
                </div>
              </div>

              @if($stokReady)
                <div style="display: flex; gap: 8px; margin-top: 12px;">
                  <button type="button" class="btn-sm" style="flex: 1; padding: 0.65rem 0.5rem; background: var(--g600); color: white; display: flex; align-items: center; justify-content: center; gap: 4px; font-size: 0.8rem; font-weight: 700;" 
                          onclick="addToCart({{ $prod->id }}, '{{ addslashes($prod->nama_produk) }}', '{{ addslashes($prod->toko->nama_toko ?? 'Mitra Doctreen') }}', {{ $hargaRupiah }}, {{ $prod->stok }}, '{{ !empty($prod->foto_produk) ? asset('storage/' . $prod->foto_produk) : '' }}')">
                    ðŸ›’ +Keranjang
                  </button>
                  <button type="button" class="btn-sm" style="flex: 1; padding: 0.65rem 0.5rem; background: rgba(39, 80, 10, 0.08); color: #27500A; border: 1px solid rgba(39, 80, 10, 0.15); font-size: 0.8rem; font-weight: 700;" 
                          onclick="openBeliModal({{ $prod->id }}, '{{ addslashes($prod->nama_produk) }}', '{{ addslashes($prod->toko->nama_toko ?? 'Mitra Doctreen') }}', {{ $hargaRupiah }}, {{ $prod->stok }})">
                    Beli Instan
                  </button>
                </div>
              @else
                <button class="btn-block btn-disabled" disabled style="margin-top: 12px;">Stok Habis</button>
              @endif
            </div>
          </div>
        @empty
          <div class="card" style="grid-column: 1/-1; text-align: center; color: var(--gray400); padding: 3rem;">
            ðŸ›’ Belum ada produk aktif yang tersedia.
          </div>
        @endforelse
      </div>

      <div id="tokoDetailEmptyMessage" class="card" style="text-align: center; color: var(--gray400); padding: 3rem; display: none;">
        ðŸ›’ Belum ada produk aktif yang tersedia di toko ini.
      </div>
    </div>
  </div>

  <!-- TAB RIWAYAT AKTIVITAS (D    <!-- SUB-TAB KONSULTASI -->
    <div id="subTabKonsul" class="card" style="padding: 1.5rem;">
      <div class="ct" style="margin-bottom: 1rem; font-size: 0.95rem; display: flex; justify-content: space-between; align-items: center;">
        <span>Log Pengaduan Tanaman Anda</span>
        <button type="button" id="btnBulkDeleteKonsul" class="btn-sm" style="display: none; background: var(--r400); border-color: var(--r400); font-size: 0.8rem; padding: 6px 14px;" onclick="performBulkDelete('Konsul')">
          🗑️ Hapus Terpilih (<span id="countKonsul">0</span>)
        </button>
      </div>
      <div style="overflow-x: auto;">
        <table>
          <thead>
            <tr>
              <th style="width: 40px; text-align: center;"><input type="checkbox" id="selectAllKonsul" onchange="toggleSelectAll('Konsul')"></th>
              <th>Tanggal</th>
              <th>Keluhan</th>
              <th>Konsultan</th>
              <th>Status</th>
              <th>Ulasan & Penilaian</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($riwayats as $riw)
              @php
                $sudahDiulas = \App\Models\Ulasan::where('id_konsultasi', $riw->id_konsultasi)->first();
                $status = $riw->status ?? 'menunggu';
                $badgeClass = $status === 'selesai' ? 'b-selesai' : ($status === 'proses' ? 'b-proses' : 'b-dijawab');
                $statusLabel = $status === 'selesai' ? 'Selesai' : ($status === 'proses' ? 'Proses Medis' : 'Menunggu');
              @endphp
              <tr>
                <td style="text-align: center;">
                  @if($riw->keluhan)
                    <input type="checkbox" class="cb-konsul" value="{{ $riw->keluhan->id }}" onchange="updateBulkDeleteBtn('Konsul')">
                  @endif
                </td>
                <td style="color: var(--gray400); font-size: 0.82rem; white-space: nowrap; font-weight: 500;">{{ $riw->tanggal_konsultasi }}</td>
                <td>
                  <div style="font-size: 0.88rem; font-weight: 700; color: var(--text);">{{ $riw->keluhan->judul_keluhan ?? 'Keluhan Tanaman' }}</div>
                  <div style="font-size: 0.78rem; color: var(--gray400); margin-top: 2px; font-weight: 500;">{{ Str::limit($riw->keluhan->isi_keluhan ?? '', 60) }}</div>
                </td>
                <td>
                  <div style="font-size: 0.85rem; font-weight: 600;">{{ $riw->konsultan->nama ?? '-' }}</div>
                  <div style="font-size: 0.72rem; color: var(--gray400); font-weight: 500;">{{ $riw->konsultan->keahlian ?? '-' }}</div>
                </td>
                <td>
                  <span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
                </td>
                <td>
                  @if($riw->status === 'selesai')
                    @if($sudahDiulas)
                      <div style="color: #FFA800; font-size: 0.85rem; font-weight: 700;">
                        ★ {{ $sudahDiulas->skor_rating }}/5
                        <div style="color: var(--gray400); font-size: 0.72rem; font-weight: normal; margin-top: 2px; font-style: italic;">"{{ Str::limit($sudahDiulas->komentar, 30) }}"</div>
                      </div>
                    @else
                      <button type="button" class="btn-sm" style="padding: 4px 10px; font-size: 0.75rem; background: var(--t600);" onclick="openUlasanModal({{ $riw->id_konsultasi }}, '{{ addslashes($riw->konsultan->nama ?? 'Konsultan') }}')">★ Beri Rating</button>
                    @endif
                  @else
                    <span style="font-size: 0.75rem; color: var(--gray400); font-style: italic; font-weight: 500;">Sesi belum selesai</span>
                  @endif
                </td>
                <td>
                  <div style="display: flex; gap: 6px; align-items: center;">
                    <button class="btn-sm" style="padding: 6px 12px; font-size: 0.75rem; background: var(--g600); color: white; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;"
                            data-id="{{ $riw->keluhan->id ?? '' }}"
                            data-judul="{{ $riw->keluhan->judul_keluhan ?? 'Keluhan Tanaman' }}"
                            data-isi="{{ $riw->keluhan->isi_keluhan ?? 'Detail keluhan tidak tersedia.' }}"
                            data-tanggal="{{ $riw->keluhan && $riw->keluhan->tanggal_keluhan ? \Carbon\Carbon::parse($riw->keluhan->tanggal_keluhan)->translatedFormat('d F Y') : ($riw->tanggal_konsultasi ?? '-') }}"
                            data-metode-bayar="{{ $riw->keluhan->metode_bayar ?? 'Transfer Bank' }}"
                            data-status-label="{{ $statusLabel }}"
                            data-status-badge="{{ $badgeClass }}"
                            data-konsultan-nama="{{ $riw->konsultan->nama ?? 'Belum Ditentukan' }}"
                            data-konsultan-keahlian="{{ $riw->konsultan->keahlian ?? '' }}"
                            data-foto="{{ $riw->keluhan && $riw->keluhan->foto_kendala ? asset('storage/' . $riw->keluhan->foto_kendala) : '' }}"
                            data-diagnosa="{{ $riw->diagnosa ?? '' }}"
                            data-rekomendasi="{{ $riw->rekomendasi ?? '' }}"
                            data-catatan="{{ $riw->catatan_konsultasi ?? '' }}"
                            data-status="{{ $riw->status ?? 'baru' }}"
                            data-bukti-bayar="{{ $riw->keluhan && $riw->keluhan->bukti_bayar ? asset('storage/' . $riw->keluhan->bukti_bayar) : '' }}"
                            data-updated-at="{{ $riw->keluhan && $riw->keluhan->updated_at ? $riw->keluhan->updated_at->toIso8601String() : '' }}"
                            data-status-bayar-konsul="{{ $riw->keluhan->status_bayar_konsultasi ?? 'menunggu' }}"
                            data-origin="riwayat"
                            onclick="openDetailKeluhan(this)">
                      Lihat
                    </button>
                    @if($riw->keluhan)
                      <form action="{{ route('petani.keluhan.destroy', $riw->keluhan->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus keluhan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-sm" style="padding: 6px 12px; font-size: 0.75rem; background: var(--r400); border-color: var(--r400); box-shadow: none;">Hapus</button>
                      </form>
                    @endif
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" style="color: var(--gray400); text-align: center; padding: 2rem; font-weight: 500;">Belum ada riwayat keluhan/konsultasi.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- SUB-TAB BELANJA -->
    <div id="subTabBelanja" class="card tab-hidden" style="padding: 1.5rem;">
      <div class="ct" style="margin-bottom: 1rem; font-size: 0.95rem; display: flex; justify-content: space-between; align-items: center;">
        <span>Log Pembelian Sarana Produksi Tani</span>
        <button type="button" id="btnBulkDeleteBelanja" class="btn-sm" style="display: none; background: var(--r400); border-color: var(--r400); font-size: 0.8rem; padding: 6px 14px;" onclick="performBulkDelete('Belanja')">
          🗑️ Hapus Terpilih (<span id="countBelanja">0</span>)
        </button>
      </div>
      <div style="overflow-x: auto;">
        <table>
          <thead>
            <tr>
              <th style="width: 40px; text-align: center;"><input type="checkbox" id="selectAllBelanja" onchange="toggleSelectAll('Belanja')"></th>
              <th>No. Pesanan</th>
              <th>Tanggal</th>
              <th>Toko Tani</th>
              <th>Detail Produk & Kuantitas</th>
              <th>Metode Kirim & Bayar</th>
              <th>Total Harga</th>
              <th>Status Bayar</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($pesanans as $pes)
              @php
                $hargaRupiah = $pes->total_harga * 1000;
                $statusBayar = $pes->status_bayar ?? 'menunggu';
                $badgeClass = $statusBayar === 'lunas' || $statusBayar === 'selesai' ? 'b-selesai' : ($statusBayar === 'proses' || $statusBayar === 'diproses' ? 'b-proses' : 'b-dijawab');
              @endphp
              <tr>
                <td style="text-align: center;">
                  <input type="checkbox" class="cb-belanja" value="{{ $pes->id }}" onchange="updateBulkDeleteBtn('Belanja')">
                </td>
                <td style="font-weight: bold; color: var(--g800); font-size: 0.85rem;">#TRX-{{ sprintf('%04d', $pes->id) }}</td>
                <td style="color: var(--gray400); font-size: 0.82rem; white-space: nowrap; font-weight: 500;">{{ $pes->tanggal_pesan }}</td>
                <td style="font-weight: 600; font-size: 0.85rem;">{{ $pes->toko->nama_toko ?? 'Mitra Doctreen' }}</td>
                <td>
                  <div style="font-size: 0.88rem; font-weight: 700; color: var(--text);">{{ $pes->nama_produk }}</div>
                  <div style="font-size: 0.75rem; color: var(--tm); font-weight: 500;">Kuantitas: <strong>{{ $pes->kuantitas }} pcs</strong></div>
                </td>
                <td>
                  <span style="background: var(--gray50); border: 1px solid var(--gray100); padding: 3px 8px; border-radius: 6px; font-size: 0.75rem; font-weight: 700; color: var(--text); display: inline-block;">🚚 {{ $pes->metode_kirim }}</span>
                  <span class="badge mp-bayar" style="margin-top: 4px; display: block; text-align: center;">💳 {{ $pes->metode_bayar ?? 'Transfer Bank' }}</span>
                </td>
                <td>
                  <div style="font-size: 0.95rem; font-weight: 800; color: var(--g900);">Rp {{ number_format($hargaRupiah, 0, ',', '.') }}</div>
                </td>
                <td>
                  <span class="badge {{ $badgeClass }}">{{ ucfirst($statusBayar) }}</span>
                </td>
                <td>
                  <div style="display: flex; gap: 6px; align-items: center;">
                    <button class="btn-sm" style="padding: 6px 12px; font-size: 0.75rem; background: var(--g600); color: white; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;"
                            data-id="{{ $pes->id }}"
                            data-trx="#TRX-{{ sprintf('%04d', $pes->id) }}"
                            data-tanggal="{{ $pes->tanggal_pesan }}"
                            data-toko="{{ $pes->toko->nama_toko ?? 'Mitra Doctreen' }}"
                            data-produk="{{ $pes->nama_produk }}"
                            data-qty="{{ $pes->kuantitas }}"
                            data-harga="{{ $pes->produk ? $pes->produk->harga * 1000 : ($pes->total_harga / max(1, $pes->kuantitas)) * 1000 }}"
                            data-subtotal="{{ $hargaRupiah }}"
                            data-kirim="{{ $pes->metode_kirim }}"
                            data-bayar="{{ $pes->metode_bayar ?? 'COD' }}"
                            data-status-label="{{ ucfirst($statusBayar) }}"
                            data-status-badge="{{ $badgeClass }}"
                            data-bukti-bayar="{{ $pes->bukti_bayar ? asset('storage/' . $pes->bukti_bayar) : '' }}"
                            onclick="openDetailBelanja(this)">
                      Lihat
                    </button>
                    <form action="{{ route('petani.pesanan.destroy', $pes->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn-sm" style="padding: 6px 12px; font-size: 0.75rem; background: var(--r400); border-color: var(--r400); box-shadow: none;">Hapus</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="9" style="color: var(--gray400); text-align: center; padding: 2rem; font-weight: 500;">Belum ada riwayat transaksi belanja.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- TAB KELUHAN SAYA -->
  <div id="tab-keluhan" class="tab-hidden">
    <div class="topbar">
      <div>
        <div class="pg-title">ðŸ’¬ Keluhan Saya</div>
        <div class="pg-sub">Kelola, edit, atau batalkan keluhan serta sesi konsultasi medis Anda.</div>
      </div>
      <button type="button" class="btn-sm" onclick="openModal('modalKeluhan')">+ Ajukan Keluhan</button>
    </div>

    <div class="keluhan-list">
      @forelse($keluhans as $kel)
        @php
          $konsulTerkait = $kel->konsultasi;
          $status = $kel->status ?? 'baru';
          $badgeClass = 'b-dijawab';
          $statusLabel = 'Menunggu';
          if ($status === 'proses') {
              $badgeClass = 'b-proses';
              $statusLabel = 'Proses Medis';
          } elseif ($status === 'selesai') {
              $badgeClass = 'b-selesai';
              $statusLabel = 'Selesai';
          }
          $icoClass = $status === 'selesai' ? 'background:var(--t50)' : ($status === 'proses' ? 'background:var(--a50)' : 'background:var(--g50)');
        @endphp
        <div class="kel-item">
          <div class="kel-item-ico" style="{{ $icoClass }}">ðŸƒ</div>
          <div class="kel-item-body">
            <div class="kel-item-title">{{ $kel->judul_keluhan }}</div>
            <div class="kel-item-desc">{{ $kel->isi_keluhan }}</div>
            <div class="kel-item-meta">
              <span>ðŸ“… {{ $kel->tanggal_keluhan ? \Carbon\Carbon::parse($kel->tanggal_keluhan)->translatedFormat('d F Y') : '-' }}</span>
              @if($konsulTerkait && $konsulTerkait->konsultan)
                <span style="color:var(--g600);font-weight:700;">ðŸ‘¨â€ðŸŒ¾ {{ $konsulTerkait->konsultan->nama }}</span>
              @else
                <span style="color:var(--gray400); font-weight: 500;">ðŸ‘¨â€ðŸŒ¾ Menunggu Konsultan</span>
              @endif
            </div>
          </div>
          <div class="kel-item-right">
            <span class="badge {{ $badgeClass }}">{{ $statusLabel }}</span>
            <div style="display: flex; gap: 8px; align-items: center;">
              <button class="btn-sm" style="padding: 6px 14px; font-size: 0.78rem;"
                      data-id="{{ $kel->id }}"
                      data-judul="{{ $kel->judul_keluhan }}"
                      data-isi="{{ $kel->isi_keluhan }}"
                      data-tanggal="{{ $kel->tanggal_keluhan ? \Carbon\Carbon::parse($kel->tanggal_keluhan)->translatedFormat('d F Y') : '-' }}"
                      data-metode-bayar="{{ $kel->metode_bayar ?? 'Transfer Bank' }}"
                      data-status="{{ $kel->status ?? 'baru' }}"
                      data-status-label="{{ $statusLabel }}"
                      data-status-badge="{{ $badgeClass }}"
                      data-konsultan-nama="{{ $konsulTerkait && $konsulTerkait->konsultan ? $konsulTerkait->konsultan->nama : 'Belum Ditentukan' }}"
                      data-konsultan-keahlian="{{ $konsulTerkait && $konsulTerkait->konsultan ? $konsulTerkait->konsultan->keahlian : '' }}"
                      data-konsultan-status="{{ $konsulTerkait && $konsulTerkait->konsultan ? $konsulTerkait->konsultan->status : 'Aktif' }}"
                      data-konsultan-tarif="{{ $konsulTerkait && $konsulTerkait->konsultan ? number_format(($konsulTerkait->konsultan->tarif_konsultasi ?? 0) * 1000, 0, ',', '.') : '0' }}"
                      data-konsultan-telepon="{{ $konsulTerkait && $konsulTerkait->konsultan ? ($konsulTerkait->konsultan->telepon ?? ($konsulTerkait->konsultan->user->telepon ?? '-')) : '-' }}"
                      data-konsultan-alamat="{{ $konsulTerkait && $konsulTerkait->konsultan ? addslashes($konsulTerkait->konsultan->alamat ?? 'Jl. Doctreen Agrikultur No. 24, Jakarta') : '' }}"
                      data-konsultan-foto="{{ $konsulTerkait && $konsulTerkait->konsultan && $konsulTerkait->konsultan->foto_profil ? asset('storage/' . $konsulTerkait->konsultan->foto_profil) : '' }}"
                      data-foto="{{ $kel->foto_kendala ? asset('storage/' . $kel->foto_kendala) : '' }}"
                      data-diagnosa="{{ $konsulTerkait ? $konsulTerkait->diagnosa : '' }}"
                      data-rekomendasi="{{ $konsulTerkait ? $konsulTerkait->rekomendasi : '' }}"
                      data-catatan="{{ $konsulTerkait ? $konsulTerkait->catatan_konsultasi : '' }}"
                      data-id-konsultan="{{ $konsulTerkait && $konsulTerkait->id_konsultan ? $konsulTerkait->id_konsultan : 'null' }}"
                      data-bukti-bayar="{{ $kel->bukti_bayar ? asset('storage/' . $kel->bukti_bayar) : '' }}"
                      data-updated-at="{{ $kel->updated_at ? $kel->updated_at->toIso8601String() : '' }}"
                      data-status-bayar-konsul="{{ $kel->status_bayar_konsultasi ?? 'menunggu' }}"
                      data-origin="keluhan"
                      onclick="openDetailKeluhan(this)">
                Lihat Detail
              </button>
              <form action="{{ route('petani.keluhan.destroy', $kel->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus keluhan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-sm" style="padding: 6px 14px; font-size: 0.78rem; background: var(--r400); border-color: var(--r400); box-shadow: none;">
                  Hapus
                </button>
              </form>
            </div>
          </div>
        </div>
      @empty
        <div style="background: white; border: 1px solid rgba(99,153,34,0.1); padding: 3rem; border-radius: 16px; text-align: center; color: var(--gray400);">
          <span style="font-size: 2.5rem; display: block; margin-bottom: 12px;">ðŸ’¬</span>
          <div style="font-weight: bold; color: var(--g800); margin-bottom: 4px;">Belum ada keluhan</div>
          <p style="font-size: 0.82rem; margin: 0; font-weight: 500;">Silakan klik tombol "+ Ajukan Keluhan" di kanan atas untuk berkonsultasi.</p>
        </div>
      @endforelse
    </div>
  </div>

<!-- MODAL DETAIL KELUHAN (REKAM MEDIS TANAMAN) -->
<div class="ov" id="modalDetailKeluhan" onclick="bgClose(event, 'modalDetailKeluhan')">
  <div class="modal" style="max-width: 650px; width: 95%; max-height: 92vh; overflow-y: auto; padding: 24px 28px;">
    <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #f2f2f2; padding-bottom: 16px; margin-bottom: 16px;">
      <h3 style="font-family: 'DM Serif Display', serif; font-size: 1.65rem; color: #172a0f; display: flex; align-items: center; gap: 8px; font-weight: bold; margin: 0;">
        <span style="font-size: 1.7rem;">ðŸ“‹</span> Rekam Medis & Detail Keluhan
      </h3>
      <button type="button" style="background: none; border: none; font-size: 1.5rem; color: #bbb; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: color 0.2s;" onclick="closeModal('modalDetailKeluhan')">âœ•</button>
    </div>
    
    <div style="display: flex; flex-direction: column; gap: 16px;">
      
      <!-- Diagram Workflow Proses Konsultasi -->
      <div style="background: #ffffff; border: 1.5px solid #eceee9; border-radius: 16px; padding: 18px 12px; display: flex; align-items: center; justify-content: center; gap: 6px; overflow-x: auto; white-space: nowrap;">
        <!-- Step 1 -->
        <div id="wfStep1" style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 6px; border: 1.2px solid #222; border-radius: 8px; width: 84px; height: 72px; background: white; text-align: center; transition: all 0.3s ease;">
          <div style="margin-bottom: 2px;">
            <svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="24" cy="20" r="10" fill="#FFE5D9" stroke="#222" stroke-width="2"/>
              <path d="M10 42C10 33 16 30 24 30C32 30 38 33 38 42" fill="#E07A5F" stroke="#222" stroke-width="2" stroke-linecap="round"/>
              <path d="M14 18C14 18 20 10 24 10C28 10 34 18 34 18" stroke="#222" stroke-linecap="round" fill="#F4A261" stroke-width="2"/>
              <path d="M10 19.5C18 17.5 30 17.5 38 19.5" stroke="#222" stroke-linecap="round" stroke-width="2"/>
            </svg>
          </div>
          <div style="font-size: 0.62rem; font-family: 'DM Sans', sans-serif; line-height: 1.1; color: #222; font-weight: bold;">
            Petani:<br><span style="font-weight: normal; color: #444; font-size: 0.58rem;">Kirim Keluhan</span>
          </div>
        </div>

        <!-- Arrow 1-2 -->
        <div id="wfArrow1" style="display: flex; align-items: center; justify-content: center; color: #222;">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </div>

        <!-- Step 2 -->
        <div id="wfStep2" style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 6px; border: 1.2px solid #222; border-radius: 8px; width: 84px; height: 72px; background: white; text-align: center; transition: all 0.3s ease;">
          <div style="margin-bottom: 2px;">
            <svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="21" cy="21" r="10" stroke="#222" stroke-width="2" fill="#E8F1F5"/>
              <path d="M28 28L38 38" stroke="#222" stroke-width="2.5" stroke-linecap="round"/>
              <path d="M15 15C17 13 19.5 13 21 14" stroke="#88B0C4" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
          </div>
          <div style="font-size: 0.62rem; font-family: 'DM Sans', sans-serif; line-height: 1.1; color: #222; font-weight: bold;">
            Sistem:<br><span style="font-weight: normal; color: #444; font-size: 0.58rem;">Tinjau Keluhan</span>
          </div>
        </div>

        <!-- Arrow 2-3 -->
        <div id="wfArrow2" style="display: flex; align-items: center; justify-content: center; color: #222;">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </div>

        <!-- Step 3 -->
        <div id="wfStep3" style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 6px; border: 1.2px solid #222; border-radius: 8px; width: 84px; height: 72px; background: white; text-align: center; transition: all 0.3s ease;">
          <div style="margin-bottom: 2px;">
            <svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="24" cy="20" r="10" fill="#FFE5D9" stroke="#222" stroke-width="2"/>
              <path d="M10 42C10 33 16 30 24 30C32 30 38 33 38 42" fill="#FFFFFF" stroke="#222" stroke-width="2" stroke-linecap="round"/>
              <path d="M18 30V34C18 36 20 37 24 37C28 37 30 36 30 34V30" stroke="#222" stroke-width="1.5" stroke-linecap="round"/>
              <circle cx="24" cy="38" r="2" fill="#81B29A" stroke="#222" stroke-width="1.2"/>
              <path d="M19 19H29" stroke="#222" stroke-width="1.2"/>
              <circle cx="19" cy="19" r="2.5" stroke="#222" stroke-width="1.2" fill="none"/>
              <circle cx="29" cy="19" r="2.5" stroke="#222" stroke-width="1.2" fill="none"/>
              <path d="M18 23C20 26 28 26 30 23" stroke="#6C584C" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
          </div>
          <div style="font-size: 0.58rem; font-family: 'DM Sans', sans-serif; line-height: 1.1; color: #222; font-weight: bold;">
            Konsultan Ahli:<br><span style="font-weight: normal; color: #444; font-size: 0.54rem;">Analisis & Diagnosis</span>
          </div>
        </div>

        <!-- Arrow 3-4 -->
        <div id="wfArrow3" style="display: flex; align-items: center; justify-content: center; color: #222;">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </div>

        <!-- Step 4 -->
        <div id="wfStep4" style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 6px; border: 1.2px solid #222; border-radius: 8px; width: 84px; height: 72px; background: white; text-align: center; transition: all 0.3s ease;">
          <div style="margin-bottom: 2px;">
            <svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M14 16V26C14 31.5 18.5 36 24 36C29.5 36 34 31.5 34 26V16" stroke="#222" stroke-width="2" stroke-linecap="round"/>
              <circle cx="14" cy="14" r="2" fill="#3D8B52" stroke="#222" stroke-width="1.2"/>
              <circle cx="34" cy="14" r="2" fill="#3D8B52" stroke="#222" stroke-width="1.2"/>
              <path d="M24 36V41" stroke="#222" stroke-width="2"/>
              <circle cx="24" cy="41" r="4" fill="#81B29A" stroke="#222" stroke-width="1.5"/>
              <path d="M27 38C29 35 33 35 34 37C34 39 31 41 27 38Z" fill="#81B29A" stroke="#222" stroke-width="1.2"/>
              <path d="M21 38C19 35 15 35 14 37C14 39 17 41 21 38Z" fill="#81B29A" stroke="#222" stroke-width="1.2"/>
            </svg>
          </div>
          <div style="font-size: 0.62rem; font-family: 'DM Sans', sans-serif; line-height: 1.1; color: #222; font-weight: bold;">
            Petani:<br><span style="font-weight: normal; color: #444; font-size: 0.58rem;">Terima Rekomendasi</span>
          </div>
        </div>

        <!-- Arrow 4-5 -->
        <div id="wfArrow4" style="display: flex; align-items: center; justify-content: center; color: #222;">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </div>

        <!-- Step 5 (Selesai) -->
        <div id="wfStep5" style="display: flex; align-items: center; justify-content: center; border: 1.2px solid #222; border-radius: 6px; width: 68px; height: 36px; background: white; text-align: center; transition: all 0.3s ease;">
          <span style="font-size: 0.72rem; font-family: 'DM Sans', sans-serif; font-weight: bold; color: #222;">Selesai</span>
        </div>
      </div>

      <!-- Foto Kendala -->
      <div id="detailKelFotoContainer" style="display: none; text-align: center; border-radius: 12px; overflow: hidden; max-height: 250px; background: var(--gray50); border: 1px solid var(--gray100);">
        <img id="detailKelFoto" src="" style="max-width: 100%; max-height: 250px; object-fit: contain;">
      </div>
      
      <!-- SEPARATED JUDUL & DESKRIPSI (Pemisahan Lebih Rapi) -->
      <div style="display: flex; flex-direction: column; gap: 14px;">
        <!-- Box 1: Judul Masalah -->
        <div style="background: #eef7e6; border: 1.2px solid rgba(99,153,34,0.15); border-radius: 14px; padding: 14px 18px;">
          <div style="font-size: 0.72rem; text-transform: uppercase; color: #3d662b; font-weight: 800; letter-spacing: 0.06em; margin-bottom: 6px;">JUDUL MASALAH</div>
          <h4 id="detailKelJudul" style="font-family: 'DM Serif Display', serif; font-size: 1.35rem; color: #172a0f; font-weight: bold; margin: 0; line-height: 1.3;">Judul Keluhan</h4>
        </div>

        <!-- Box 2: Deskripsi Kondisi Detail Tanaman -->
        <div style="background: #ffffff; border: 1.5px solid #eceee9; border-radius: 14px; padding: 18px 20px; box-shadow: 0 4px 12px rgba(23,52,4,0.01);">
          <div style="font-size: 0.72rem; text-transform: uppercase; color: #666666; font-weight: 800; letter-spacing: 0.06em; margin-bottom: 10px; border-bottom: 1px solid #f2f2f2; padding-bottom: 8px;">KONDISI DETAIL TANAMAN</div>
          <div id="detailKelIsi" style="font-size: 0.88rem; color: #33422a; line-height: 1.65; white-space: pre-wrap; word-break: break-word; margin: 0; max-width: 580px; text-align: justify;">
            Deskripsi keluhan...
          </div>
        </div>
      </div>

      <!-- Grid Informasi 4 Sel Premium -->
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
        <!-- Sel 1: Tanggal Pengajuan -->
        <div style="background: white; border: 1.5px solid #eceee9; padding: 14px 18px; border-radius: 16px;">
          <div style="font-size: 0.72rem; color: #888888; font-weight: bold; letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 6px;">TANGGAL PENGAJUAN</div>
          <div id="detailKelTanggal" style="font-size: 1rem; font-weight: bold; color: #111111; font-family: 'DM Sans', sans-serif;">-</div>
        </div>

        <!-- Sel 2: Metode Bayar -->
        <div style="background: white; border: 1.5px solid #eceee9; padding: 14px 18px; border-radius: 16px;">
          <div style="font-size: 0.72rem; color: #888888; font-weight: bold; letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 6px;">METODE BAYAR</div>
          <div id="detailKelBayar" style="font-size: 1rem; font-weight: bold; color: #111111; font-family: 'DM Sans', sans-serif;">-</div>
        </div>

        <!-- Sel 3: Konsultan Ahli Clickable -->
        <div id="detailKelKonsultanCell" style="background: white; border: 1.5px solid #eceee9; padding: 14px 18px; border-radius: 16px; display: flex; flex-direction: column; justify-content: center; transition: all 0.2s;" title="Klik untuk melihat profil lengkap">
          <div style="font-size: 0.72rem; color: #888888; font-weight: bold; letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 8px;">KONSULTAN AHLI</div>
          <div style="display: flex; align-items: center;">
            <img id="detailKelKonsultanFoto" src="" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 1px solid #e2e5e0; margin-right: 12px; display: block; background: #f5f5f5;">
            <div>
              <div id="detailKelKonsultanNama" style="font-size: 0.95rem; font-weight: bold; color: #111111; line-height: 1.2;">-</div>
              <div id="detailKelKonsultanKeahlian" style="font-size: 0.75rem; color: #666666; margin-top: 2px;">-</div>
            </div>
          </div>
        </div>

        <!-- Sel 4: Status Sesi -->
        <div style="background: white; border: 1.5px solid #eceee9; padding: 14px 18px; border-radius: 16px; display: flex; flex-direction: column; justify-content: center;">
          <div style="font-size: 0.72rem; color: #888888; font-weight: bold; letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 8px;">STATUS SESI</div>
          <div>
            <span id="detailKelStatus" style="background: #3d8b52; color: white; border-radius: 6px; font-weight: bold; padding: 6px 12px; font-size: 0.78rem; text-align: center; border: none; display: inline-block;">Aktif</span>
          </div>
        </div>
      </div>

      <!-- Pembayaran Sesi Keluhan/Konsultasi via Midtrans -->
      <div id="keluhanPayButtonContainer" style="display: none; border-top: 1.5px dashed var(--gray100); padding-top: 16px; flex-direction: column; gap: 12px;">
        <div style="font-size: 0.85rem; font-weight: bold; color: var(--g800); text-transform: uppercase; letter-spacing: 0.05em; display: flex; align-items: center; gap: 4px;">
          <span>💳</span> Pembayaran Konsultasi via Midtrans
        </div>
        <button type="button" id="btnKeluhanPayMidtrans" class="btn-sm" style="width: 100%; justify-content: center; background: #062f1e; color: white;">
          Bayar Sekarang (Midtrans)
        </button>
      </div>

      <!-- Resep / Diagnosa Medis (Hanya Muncul jika dijawab/proses/selesai) -->
      <div id="detailKelMedisSection" style="display: none; border-top: 1.5px dashed var(--gray100); padding-top: 16px; display: flex; flex-direction: column; gap: 12px;">
      <div id="detailKelMedisSection" style="display: none; border-top: 1.5px dashed var(--gray100); padding-top: 16px; flex-direction: column; gap: 12px;">
        <div style="font-size: 0.85rem; font-weight: bold; color: var(--g800); text-transform: uppercase; letter-spacing: 0.05em; display: flex; align-items: center; gap: 4px;">
          <span>🩺</span> Hasil Diagnosa & Tindakan Medis
        </div>
        
        <div style="background: #fbfcf7; border: 1.5px solid rgba(99,153,34,0.15); padding: 12px; border-radius: 10px;">
          <div style="font-size: 0.75rem; font-weight: bold; color: var(--g800); margin-bottom: 4px;">🎯 Diagnosa Penyakit / Masalah</div>
          <p id="detailKelDiagnosa" style="font-size: 0.85rem; color: var(--text); line-height: 1.4; font-style: italic;">Sedang dianalisis oleh konsultan...</p>
        </div>

        <div style="background: #fcfbfb; border: 1.5px solid rgba(226,75,74,0.15); padding: 12px; border-radius: 10px;">
          <div style="font-size: 0.75rem; font-weight: bold; color: #b22a29; margin-bottom: 4px;">🧪 Rekomendasi Obat & Penanganan</div>
          <p id="detailKelRekomendasi" style="font-size: 0.85rem; color: var(--text); line-height: 1.4;">Menunggu rekomendasi resep...</p>
        </div>

        <div style="background: var(--gray50); border: 1px solid var(--gray100); padding: 12px; border-radius: 10px;">
          <div style="font-size: 0.75rem; font-weight: bold; color: var(--gray600); margin-bottom: 4px;">📝 Catatan Tambahan Konsultan</div>
          <p id="detailKelCatatan" style="font-size: 0.85rem; color: var(--text); line-height: 1.4;">Tidak ada catatan tambahan.</p>
        </div>
      </div>

      <!-- Tanya Lagi / Re-open Section -->
      <div id="detailKelTanyaLagiSection" style="display: none; border-top: 1.5px dashed var(--gray100); padding-top: 16px; flex-direction: column; gap: 12px;">
        <div style="font-size: 0.85rem; font-weight: bold; color: var(--g800); text-transform: uppercase; letter-spacing: 0.05em; display: flex; align-items: center; gap: 4px;">
          <span>💬</span> Ajukan Pertanyaan Lanjutan (Tanya Lagi)
        </div>
        
        <div id="tanyaLagiFreePromo" style="display:none; background: #eef7e6; border: 1px solid rgba(99,153,34,0.2); padding: 10px; border-radius: 8px; font-size: 0.78rem; color: #3d662b; font-weight: 500;">
          🎉 <strong>Kabar Baik!</strong> Sesi ini selesai kurang dari 24 jam yang lalu. Anda dapat berdiskusi kembali secara <strong>GRATIS</strong>!
        </div>

        <div id="tanyaLagiPaidWarning" style="display:none; background: #fff9e6; border: 1px solid rgba(254,168,0,0.2); padding: 10px; border-radius: 8px; font-size: 0.78rem; color: #a87300; font-weight: 500;">
          💡 Sesi ini telah selesai lebih dari 24 jam yang lalu. Pertanyaan lanjutan akan dikenakan biaya sesi follow-up (<strong>Diskon 50%</strong> dari tarif normal konsultan).
        </div>

        <form id="tanyaLagiForm" method="POST" action="" enctype="multipart/form-data" style="margin: 0; display: flex; flex-direction: column; gap: 10px;">
          @csrf
          <div class="fg" style="margin: 0;">
            <label style="font-size: 0.75rem; color: var(--text); font-weight: 600; margin-bottom: 4px; display: block;">Judul Pertanyaan Lanjutan</label>
            <input type="text" name="judul_keluhan" id="tanyaLagiJudul" required style="padding: 8px 12px; font-size: 0.85rem; border-radius: 8px; border: 1.5px solid var(--gray100); width: 100%;">
          </div>
          <div class="fg" style="margin: 0;">
            <label style="font-size: 0.75rem; color: var(--text); font-weight: 600; margin-bottom: 4px; display: block;">Deskripsi Pertanyaan Baru / Kondisi Terkini</label>
            <textarea name="isi_keluhan" id="tanyaLagiIsi" required placeholder="Tuliskan pertanyaan tambahan Anda atau perubahan kondisi tanaman di sini..." style="padding: 8px 12px; font-size: 0.85rem; border-radius: 8px; border: 1.5px solid var(--gray100); width: 100%; min-height: 80px;"></textarea>
          </div>
          <div class="fg" style="margin: 0;">
            <label style="font-size: 0.75rem; color: var(--text); font-weight: 600; margin-bottom: 4px; display: block;">Foto Kendala Terbaru (Opsional)</label>
            <input type="file" name="foto_kendala" accept="image/*" style="padding: 6px 10px; font-size: 0.8rem; border: 1.5px solid var(--gray100); border-radius: 8px; width: 100%; background: white;">
          </div>
          <button type="submit" id="btnTanyaLagiSubmit" class="btn-sm" style="width: 100%; justify-content: center; font-weight: bold; background: var(--g800); color: white; margin-top: 5px;">
            Ajukan Pertanyaan Lanjutan
          </button>
        </form>
      </div>
    </div>
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1.5rem; border-top: 1px solid var(--gray50); padding-top: 12px; gap: 8px;">
      <div id="detailKelActions" style="display: none; gap: 8px; align-items: center;">
        <button id="btnDetailKelEdit" class="btn-sm" style="background: var(--g600); color: white;">âœï¸ Edit Keluhan</button>
        <form id="formDeleteDetailKeluhan" action="" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus keluhan ini beserta sesi konsultasinya secara permanen?')" style="margin: 0; display: inline-block;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn-sm" style="background: var(--r400); color: white;">ðŸ—‘ï¸ Hapus Keluhan</button>
        </form>
      </div>
      <button type="button" class="btn-sm" style="background: var(--g800); margin-left: auto;" onclick="closeModal('modalDetailKeluhan')">Tutup Rekam Medis</button>
    </div>
  </div>
</div>

<!-- MODAL DETAIL BELANJA (INVOICE STRUK BELANJA PREMIUM) -->
<div class="ov" id="modalDetailBelanja" onclick="bgClose(event, 'modalDetailBelanja')">
  <div class="modal" style="max-width: 500px; width: 90%; max-height: 90vh; overflow-y: auto; background: #fbfcf8;">
    <div style="text-align: center; border-bottom: 2px dashed rgba(0,0,0,0.08); padding-bottom: 1.5rem; margin-bottom: 1.25rem; position: relative;">
      <div style="font-size: 2rem; margin-bottom: 6px;">ðŸ›’</div>
      <h3 style="font-family: 'DM Serif Display', serif; font-size: 1.6rem; color: var(--g900); line-height: 1.2;">DOCTREEN TANI</h3>
      <p style="font-size: 0.75rem; color: var(--gray400); margin-top: 2px; text-transform: uppercase; letter-spacing: 0.05em;">Struk Belanja Sarana Produksi Resmi</p>
      <div style="position: absolute; left: -22px; bottom: -8px; width: 16px; height: 16px; border-radius: 50%; background: rgba(0,0,0,0.05);"></div>
      <div style="position: absolute; right: -22px; bottom: -8px; width: 16px; height: 16px; border-radius: 50%; background: rgba(0,0,0,0.05);"></div>
    </div>

    <div style="font-family: 'Courier New', Courier, monospace; font-size: 0.8rem; color: #444; display: flex; flex-direction: column; gap: 8px; margin-bottom: 1.5rem;">
      <div style="display: flex; justify-content: space-between;">
        <span>NO. TRANSAKSI:</span>
        <strong id="invoiceTrx" style="font-weight: bold; color: var(--text);">-</strong>
      </div>
      <div style="display: flex; justify-content: space-between;">
        <span>TANGGAL:</span>
        <span id="invoiceTanggal">-</span>
      </div>
      <div style="display: flex; justify-content: space-between;">
        <span>MITRA TOKO:</span>
        <span id="invoiceToko" style="font-weight: 600;">-</span>
      </div>
      <div style="display: flex; justify-content: space-between;">
        <span>STATUS BAYAR:</span>
        <div><span id="invoiceStatus" class="badge">Menunggu</span></div>
      </div>
    </div>

    <div style="border-top: 1px dashed rgba(0,0,0,0.08); border-bottom: 1px dashed rgba(0,0,0,0.08); padding: 12px 0; margin-bottom: 1.25rem;">
      <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 0.82rem; color: var(--text); margin-bottom: 8px;">
        <span>Item Deskripsi</span>
        <span>Subtotal</span>
      </div>
      <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 10px; font-size: 0.88rem; margin-bottom: 4px;">
        <div>
          <span id="invoiceProduk" style="font-weight: 600; color: var(--text); display: block;">Nama Produk</span>
          <span style="font-size: 0.78rem; color: var(--gray400);"><span id="invoiceQty">1</span> pcs x Rp <span id="invoiceHargaSatuan">0</span></span>
        </div>
        <span id="invoiceSubtotal" style="font-weight: 600; color: var(--text); white-space: nowrap;">Rp 0</span>
      </div>
    </div>

    <div style="display: flex; flex-direction: column; gap: 6px; font-size: 0.85rem; color: var(--text); margin-bottom: 1.5rem; border-bottom: 2px dashed rgba(0,0,0,0.08); padding-bottom: 12px;">
      <div style="display: flex; justify-content: space-between;">
        <span style="color: var(--gray400);">Biaya Pengiriman (<span id="invoiceKirim">JNE</span>):</span>
        <span id="invoiceOngkir">Rp 10.000</span>
      </div>
      <div style="display: flex; justify-content: space-between; font-size: 1.05rem; font-weight: 800; color: var(--g900); margin-top: 6px; padding-top: 6px; border-top: 1px solid rgba(0,0,0,0.04);">
        <span>TOTAL PEMBAYARAN:</span>
        <span id="invoiceTotal">Rp 0</span>
      </div>
    </div>

    <div style="text-align: center; color: var(--gray400); font-size: 0.72rem; line-height: 1.4; margin-top: 10px;">
      <div style="font-weight: bold; color: var(--g700); text-transform: uppercase; margin-bottom: 8px;">Metode Pembayaran: <span id="invoiceBayar">Transfer Bank</span></div>
    </div>

    <!-- Bukti Pembayaran Section -->
    <div id="invoiceBuktiSection" style="margin-top: 1rem; padding: 1rem; border-radius: 12px; background: white; border: 1.5px solid #eceee9; display: none; flex-direction: column; gap: 10px;">
      <div style="font-size: 0.8rem; font-weight: bold; color: var(--g800); text-transform: uppercase; letter-spacing: 0.05em; display: flex; align-items: center; gap: 4px;">
        <span>ðŸ“¸</span> Bukti Pembayaran
      </div>
      
      <!-- Preview Bukti yang Sudah Diunggah -->
      <div id="invoiceBuktiPreviewContainer" style="display: none; text-align: center; border-radius: 8px; overflow: hidden; border: 1px solid var(--gray100); background: var(--gray50); padding: 8px;">
        <img id="invoiceBuktiPreviewImg" src="" style="max-width: 100%; max-height: 200px; object-fit: contain; border-radius: 4px;">
      </div>

      <!-- Form untuk Unggah Bukti -->
      <form id="invoiceBuktiForm" method="POST" action="" enctype="multipart/form-data" style="display: none; flex-direction: column; gap: 8px; margin: 0;">
        @csrf
        <label style="display: block; font-size: 0.75rem; color: var(--gray600); font-weight: 600;">Unggah Bukti Transfer Baru</label>
        <div style="display: flex; gap: 8px; align-items: center;">
          <input type="file" name="bukti_bayar" accept="image/*" class="modal-input" style="flex: 1; padding: 6px 10px; font-size: 0.8rem;" required>
          <button type="submit" class="btn-sm" style="padding: 8px 16px; font-size: 0.8rem; font-weight: bold; background: var(--g600); color: white;">Unggah</button>
        </div>
        <span style="font-size: 0.68rem; color: var(--gray400);">Format: JPG, PNG, WEBP. Maks 50MB.</span>
      </form>
    </div>

    <div style="text-align: center; color: var(--gray400); font-size: 0.72rem; line-height: 1.4; margin-top: 10px;">
      <div style="margin-top: 6px;">Terima kasih telah berbelanja di Doctreen Tani! Simpan struk ini sebagai bukti transaksi resmi Anda.</div>
      <div style="margin-top: 10px; font-family: 'Courier New', Courier, monospace; letter-spacing: 0.2em; font-weight: bold; font-size: 0.8rem; opacity: 0.6;">* DOCTREEN-TANI-OK *</div>
    </div>

    <div style="display: flex; gap: 8px; margin-top: 1.5rem;">
      <button type="button" class="btn-block" style="background: var(--g800);" onclick="closeModal('modalDetailBelanja')">Tutup Struk</button>
    </div>
  </div>
</div>

<!-- MODAL DETAIL TANAMAN -->
<div class="ov" id="modalDetailTanaman" onclick="bgClose(event, 'modalDetailTanaman')">
  <div class="modal" style="max-width: 650px; width: 90%; max-height: 90vh; overflow-y: auto;">
    <div style="display: flex; align-items: flex-start; justify-content: space-between; border-bottom: 1px solid var(--gray50); padding-bottom: 12px; margin-bottom: 16px;">
      <div style="display: flex; gap: 15px; align-items: center;">
        <div class="tan-avatar" id="detailTanFoto" style="width: 64px; height: 64px; font-size: 2rem;">ðŸŒ¿</div>
        <div>
          <div class="m-title" id="detailTanNama" style="font-family:'DM Serif Display'; font-size: 1.8rem; line-height: 1.2;">Nama Tanaman</div>
          <div class="tan-latin" style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap; margin-top: 4px;">
            <span id="detailTanLatin" style="font-size: 0.9rem;">Species sp.</span>
            <span class="badge b-selesai" id="detailTanJenis" style="font-size: 0.7rem; padding: 2px 6px; background: rgba(39,80,10,0.08); color: #27500A; border: 1px solid rgba(39,80,10,0.15); border-radius: 4px; font-weight: 700; font-style: normal;">Jenis</span>
          </div>
        </div>
      </div>
      <button type="button" style="background: none; border: none; font-size: 1.25rem; color: var(--gray400); cursor: pointer;" onclick="closeModal('modalDetailTanaman')">âœ•</button>
    </div>

    <div style="display: flex; flex-direction: column; gap: 16px;">
      <div>
        <div class="tan-section-title" style="font-size: 0.9rem;">ðŸšœ Panduan Metode Perawatan Lengkap</div>
        <div class="tan-section-desc" id="detailTanPerawatan" style="font-size: 0.9rem; line-height: 1.6; background: #fcfdfa; border: 1.5px solid rgba(99,153,34,0.1); padding: 12px; border-radius: 10px;">Metode perawatan detail...</div>
      </div>

      <div>
        <div class="tan-section-title" style="font-size: 0.9rem;">ðŸ§ª Protokol Pengobatan Infeksi & Hama</div>
        <div class="tan-section-desc" id="detailTanPengobatan" style="font-size: 0.9rem; line-height: 1.6; background: #fdfcfc; border: 1.5px solid rgba(226,75,74,0.1); padding: 12px; border-radius: 10px; color: var(--text);">Protokol pengobatan detail...</div>
      </div>

      <div>
        <div class="tan-section-title" style="font-size: 0.9rem;">âš ï¸ Hama, Penyakit & Ancaman Utama</div>
        <div class="tan-badges" id="detailTanAncaman" style="gap: 8px; margin-top: 6px;">
          <!-- Will be populated dynamically -->
        </div>
      </div>

      <div>
        <div class="tan-section-title" style="font-size: 0.9rem;">ðŸŽ¥ Video Panduan & Edukasi Medis</div>
        <div id="detailTanVideosContainer" style="display: flex; flex-direction: column; gap: 10px; margin-top: 8px;">
          <!-- Will be populated dynamically -->
        </div>
      </div>
    </div>
  </div>
</div>

<!-- CART BACKDROP -->
<div class="cart-backdrop" id="cartBackdrop" onclick="closeCartDrawer()"></div>

<!-- SHOPPING CART DRAWER -->
<div class="cart-drawer" id="cartDrawer">
  <div class="cart-header">
    <div style="display: flex; align-items: center; gap: 8px;">
      <span style="font-size: 1.4rem;">ðŸ›’</span>
      <h3 style="font-family: 'DM Serif Display', serif; font-size: 1.4rem; color: var(--g900);">Keranjang Belanja</h3>
    </div>
    <button type="button" style="background: none; border: none; font-size: 1.25rem; color: var(--gray400); cursor: pointer;" onclick="closeCartDrawer()">âœ•</button>
  </div>
  
  <div class="cart-body" id="cartItemsList">
    <!-- Cart Items will be rendered here dynamically -->
  </div>
  
  <div class="cart-footer">
    <div class="cart-summary-row">
      <span>Metode Pengiriman:</span>
      <select id="cartCourierSelect" class="modal-input" style="width: auto; padding: 4px 8px; font-size: 0.8rem; height: 30px;" required>
        <option value="JNE" selected>JNE Express</option>
        <option value="J&T">J&T Express</option>
        <option value="Sicepat">Sicepat</option>
        <option value="Ambil Sendiri">Ambil di Tani</option>
      </select>
    </div>
    <div class="cart-summary-row" style="margin-bottom: 12px;">
      <span>Metode Pembayaran:</span>
      <select id="cartPaymentSelect" class="modal-input" style="width: auto; padding: 4px 8px; font-size: 0.8rem; height: 30px;" required>
        <option value="Transfer Bank" selected>Transfer Bank</option>
        <option value="E-Wallet">E-Wallet</option>
        <option value="COD">COD (Bayar di Tempat)</option>
      </select>
    </div>
    <div class="cart-summary-row" style="border-top: 1px solid rgba(0,0,0,0.06); padding-top: 10px;">
      <span style="font-weight: 600;">Total Harga Belanja:</span>
      <span class="cart-summary-total" id="cartTotalText">Rp 0</span>
    </div>
    <button type="button" class="btn-block" id="cartCheckoutBtn" onclick="checkoutCart()" style="margin-top: 12px; padding: 10px; font-size: 0.9rem; font-weight: bold; background: var(--g800);">
      Checkout Sekarang
    </button>
  </div>
</div>

<!-- FLOATING CART BUTTON (FAB) -->
<button type="button" id="cartFabButton" class="cart-fab" onclick="openCartDrawer()">
  ðŸ›’ Keranjang (<span id="cartFabCountText">0</span>)
</button>

<!-- MODAL DETAIL PROFIL KONSULTAN -->
<div class="ov" id="modalProfilKonsultan" onclick="bgClose(event, 'modalProfilKonsultan')">
  <div class="modal" style="max-width: 450px; width: 90%; text-align: center; padding: 2rem; position: relative;">
    <button type="button" style="position: absolute; right: 15px; top: 15px; background: none; border: none; font-size: 1.25rem; color: var(--gray400); cursor: pointer;" onclick="closeModal('modalProfilKonsultan')">âœ•</button>
    
    <div id="consProfileFotoContainer" style="width: 90px; height: 90px; border-radius: 50%; background: var(--g100); color: var(--g800); display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin: 0 auto 16px; overflow: hidden; border: 3px solid var(--g600);">
      ðŸ‘¨â€ðŸŒ¾
    </div>
    
    <h3 id="consProfileNama" style="font-family: 'DM Serif Display', serif; font-size: 1.6rem; color: var(--g900); margin-bottom: 4px;">Nama Konsultan</h3>
    <div id="consProfileKeahlian" style="font-size: 0.88rem; color: var(--g800); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 12px;">Spesialisasi</div>
    
    <div style="display: flex; justify-content: center; gap: 8px; margin-bottom: 20px;">
      <span id="consProfileStatus" class="badge b-selesai" style="font-size: 0.75rem; padding: 4px 10px;">Aktif</span>
      <span class="badge" style="background: rgba(99, 153, 34, 0.08); color: var(--g900); font-size: 0.75rem; padding: 4px 10px; border: 1px solid rgba(99,153,34,0.15); font-weight: 700;">â­ 4.9/5 Rating</span>
    </div>
    
    <div style="background: var(--gray50); border: 1px solid var(--gray100); border-radius: 12px; padding: 16px; text-align: left; display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px;">
      <div style="display: flex; justify-content: space-between; font-size: 0.85rem;">
        <span style="color: var(--gray600); font-weight: 500;">Tarif Konsultasi:</span>
        <strong id="consProfileTarif" style="color: var(--g900); font-weight: 700;">Rp 50.000 / sesi</strong>
      </div>
      <div style="display: flex; justify-content: space-between; font-size: 0.85rem;">
        <span style="color: var(--gray600); font-weight: 500;">No. HP/Telepon:</span>
        <strong id="consProfileTelepon" style="color: var(--text); font-weight: 700;">-</strong>
      </div>
      <div style="display: flex; justify-content: space-between; font-size: 0.85rem; flex-direction: column; gap: 4px;">
        <span style="color: var(--gray600); font-weight: 500;">Alamat Praktek/Kantor:</span>
        <strong id="consProfileAlamat" style="color: var(--text); font-weight: 700; text-align: left; line-height: 1.4;">-</strong>
      </div>
      <div style="display: flex; justify-content: space-between; font-size: 0.85rem;">
        <span style="color: var(--gray600); font-weight: 500;">Pengalaman:</span>
        <strong style="color: var(--text); font-weight: 700;">> 5 Tahun Praktik Medis</strong>
      </div>
      <div style="display: flex; justify-content: space-between; font-size: 0.85rem;">
        <span style="color: var(--gray600); font-weight: 500;">Total Sesi Selesai:</span>
        <strong style="color: var(--text); font-weight: 700;">140+ Sesi Medis</strong>
      </div>
    </div>
    
    <p style="font-size: 0.82rem; color: var(--gray600); line-height: 1.4; margin-bottom: 20px; font-style: italic; font-weight: 500;">
      "Dokter & konsultan tanaman tersertifikasi, ahli dalam diagnosis penyakit jamur, patogen, serta formulasi resep nutrisi dan pemulihan kesehatan tanaman agri."
    </p>
    
    <button type="button" class="btn-sm" style="width: 100%; padding: 12px; justify-content: center;" onclick="closeModal('modalProfilKonsultan'); openModal('modalKeluhan');">
      ðŸ’¬ Konsultasi Sekarang
    </button>
  </div>
</div>

<!-- MODAL PROFIL MANDIRI PETANI -->
<div class="ov" id="modalProfilPetani" onclick="bgClose(event, 'modalProfilPetani')">
  <form class="modal" method="POST" action="{{ route('petani.profil.update') }}" enctype="multipart/form-data" style="max-width: 480px; width: 90%;">
    @csrf
    @method('PUT')
    <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid var(--gray50); padding-bottom: 12px; margin-bottom: 16px;">
      <h3 style="font-family: 'DM Serif Display', serif; font-size: 1.5rem; color: var(--g900); display: flex; align-items: center; gap: 8px;">
        <span>ðŸ‘¨â€ðŸŒ¾</span> Profil Mandiri Petani
      </h3>
      <button type="button" style="background: none; border: none; font-size: 1.25rem; color: var(--gray400); cursor: pointer;" onclick="closeModal('modalProfilPetani')">âœ•</button>
    </div>

    <div style="display: flex; flex-direction: column; gap: 15px;">
      <!-- Avatar & Photo Upload -->
      <div style="display: flex; align-items: center; gap: 16px; background: var(--gray50); padding: 12px; border-radius: 12px; border: 1px solid var(--gray100);">
        <div style="width: 70px; height: 70px; border-radius: 50%; background: var(--g100); color: var(--g800); display: flex; align-items: center; justify-content: center; font-size: 1.8rem; font-weight: bold; overflow: hidden; flex-shrink: 0; border: 2.5px solid var(--g600);">
          @if(!empty($petani->foto_profil))
            <img src="{{ asset('storage/' . $petani->foto_profil) }}" style="width: 100%; height: 100%; object-fit: cover;">
          @else
            {{ strtoupper(substr($petani->nama ?? 'P', 0, 2)) }}
          @endif
        </div>
        <div style="flex: 1;">
          <label style="display: block; margin-bottom: 6px; font-size: 0.78rem; color: var(--gray600); font-weight: 700; text-transform: uppercase; letter-spacing: 0.02em;">Unggah Foto Profil Baru</label>
          <input name="foto_profil" type="file" accept="image/*" style="font-size: 0.8rem; width: 100%;">
          <span style="font-size: 0.68rem; color: var(--gray400); display: block; margin-top: 4px;">Maksimal 2MB (format: JPG, PNG, WEBP)</span>
        </div>
      </div>

      <!-- Nama -->
      <div>
        <label style="display: block; margin-bottom: 6px; font-size: 0.78rem; color: var(--gray600); font-weight: 700; text-transform: uppercase; letter-spacing: 0.02em;">Nama Lengkap</label>
        <input name="nama" type="text" value="{{ old('nama', $petani->nama ?? '') }}" placeholder="Masukkan nama lengkap Anda..." style="width: 100%; padding: 12px; border-radius: 10px; border: 1.5px solid var(--gray100);" required>
      </div>

      <!-- Daerah -->
      <div>
        <label style="display: block; margin-bottom: 6px; font-size: 0.78rem; color: var(--gray600); font-weight: 700; text-transform: uppercase; letter-spacing: 0.02em;">Daerah / Wilayah Pertanian</label>
        <input name="daerah" type="text" value="{{ old('daerah', $petani->daerah ?? '') }}" placeholder="Contoh: Lembang, Bandung Barat" style="width: 100%; padding: 12px; border-radius: 10px; border: 1.5px solid var(--gray100);" required>
      </div>

      <!-- Nomor Telepon -->
      <div>
        <label style="display: block; margin-bottom: 6px; font-size: 0.78rem; color: var(--gray600); font-weight: 700; text-transform: uppercase; letter-spacing: 0.02em;">Nomor Telepon / WhatsApp</label>
        <input name="telepon" type="text" value="{{ old('telepon', Auth::user()->telepon ?? '') }}" placeholder="Contoh: 08123456789" style="width: 100%; padding: 12px; border-radius: 10px; border: 1.5px solid var(--gray100);" required>
      </div>

      <div style="display: flex; gap: 10px; margin-top: 8px;">
        <button class="btn-sm" style="flex: 1; background: var(--gray100); color: var(--text); justify-content: center;" type="button" onclick="closeModal('modalProfilPetani')">Batal</button>
        <button class="btn-sm" style="flex: 1.5; background: var(--g800); color: white; justify-content: center;" type="submit">Simpan Profil</button>
      </div>
    </div>
  </form>
</div>

<!-- MODAL KELUHAN (AJUKAN KELUHAN) -->
<div class="ov" id="modalKeluhan" onclick="bgClose(event, 'modalKeluhan')">
  <form class="modal" method="POST" action="{{ route('petani.keluhan.store') }}" enctype="multipart/form-data" style="max-width: 465px; width: 90%; padding: 1.75rem; border-radius: 20px;">
    @csrf
    <div class="m-title" style="font-family:'DM Serif Display'; font-size: 1.5rem; margin-bottom: 1.25rem; color: var(--g900);">Kirim Keluhan Tanaman</div>
    <div style="display:flex; flex-direction:column; gap:14px;">
      <div>
        <input name="judul_keluhan" type="text" placeholder="Judul Masalah (Contoh: Daun layu menguning)" style="width:100%; padding:11px 13px; border-radius:10px; border:1.5px solid var(--gray100); font-family: inherit; font-size: 0.9rem;" required>
      </div>
      <div>
        <textarea name="isi_keluhan" placeholder="Deskripsikan kondisi detail tanaman Anda..." style="width:100%; padding:11px 13px; border-radius:10px; border:1.5px solid var(--gray100); height:90px; font-family: inherit; font-size: 0.9rem; resize: none;" required></textarea>
      </div>
      <div>
        <label style="display:block; margin-bottom:5px; font-size:.75rem; color:var(--gray400); font-weight:700; text-transform: uppercase; letter-spacing: 0.02em;">Pilih Konsultan Ahli</label>
        <select id="addIdKonsultan" name="id_konsultan" style="width:100%; padding:11px; border-radius:10px; border:1.5px solid var(--gray100); font-family: inherit; font-size: 0.88rem;" required onchange="showSelectedKonsultanInfo(this, 'addInfoKonsultanBox')" onclick="toggleSelectedKonsultanInfo(this, 'addInfoKonsultanBox')">
          <option value="" selected disabled>-- Pilih Konsultan Ahli --</option>
          @foreach($konsultans as $c)
            <option value="{{ $c->id }}"
                    data-nama="{{ $c->nama }}"
                    data-keahlian="{{ $c->keahlian ?? '-' }}"
                    data-tarif="Rp {{ number_format(($c->tarif_konsultasi ?? 0) * 1000, 0, ',', '.') }}"
                    data-status="{{ $c->status ?? 'Aktif' }}"
                    data-foto="{{ !empty($c->foto_profil) ? asset('storage/' . $c->foto_profil) : '' }}"
                    data-telepon="{{ $c->telepon ?? ($c->user->telepon ?? '-') }}"
                    data-alamat="{{ addslashes($c->alamat ?? 'Jl. Doctreen Agrikultur No. 24, Jakarta') }}">
              {{ $c->nama ?? '-' }}{{ isset($c->keahlian) ? ' â€¢ ' . $c->keahlian : '' }}
            </option>
          @endforeach
        </select>
        <div id="addInfoKonsultanBox" style="display: none; margin-top: 10px; padding: 12px; background: rgba(99, 153, 34, 0.05); border: 1px solid rgba(99, 153, 34, 0.15); border-radius: 8px;"></div>
      </div>
      <div>
        <label style="display:block; margin-bottom:5px; font-size:.75rem; color:var(--gray400); font-weight:700; text-transform: uppercase; letter-spacing: 0.02em;">Unggah Foto Kendala (Opsional)</label>
        <input name="foto_kendala" type="file" accept="image/*" style="width:100%; padding:8px; border-radius:10px; border:1.5px solid var(--gray100); font-family: inherit; font-size: 0.82rem;" onchange="validateFotoSize(this)">
        <span style="font-size:0.68rem; color:var(--gray400); display:block; margin-top:3px; font-weight: 500;">ðŸ“· Maksimal 50 MB. Format: JPG, PNG, WEBP.</span>
      </div>
      <div>
        <label style="display:block; margin-bottom:5px; font-size:.75rem; color:var(--gray400); font-weight:700; text-transform: uppercase; letter-spacing: 0.02em;">Pilih Metode Pembayaran</label>
        <select id="addMetodeBayar" name="metode_bayar" style="width:100%; padding:11px; border-radius:10px; border:1.5px solid var(--gray100); font-family: inherit; font-size: 0.88rem;" required onchange="updateMetodeBayarDetail('add')">
          <option value="Transfer Bank" selected>Transfer Bank</option>
          <option value="E-Wallet">E-Wallet</option>
        </select>
      </div>
      <div id="addMetodeBayarDetailBox" style="display:block; margin-top:2px;">
        <label style="display:block; margin-bottom:5px; font-size:.75rem; color:var(--gray400); font-weight:700; text-transform: uppercase; letter-spacing: 0.02em;">Pilih Bank / E-Wallet</label>
        <select id="addMetodeBayarDetail" name="metode_bayar_detail" style="width:100%; padding:11px; border-radius:10px; border:1.5px solid var(--gray100); font-family: inherit; font-size: 0.88rem;" required>
          <option value="Mandiri">Mandiri</option>
          <option value="BCA">BCA</option>
          <option value="BRI">BRI</option>
          <option value="BNI">BNI</option>
          <option value="Bank Lainnya">Bank Lainnya</option>
        </select>
      </div>

      <div style="display:flex; gap:10px; margin-top: 6px;">
        <button class="btn-sm" style="flex:1; background:var(--gray100); color:var(--text); justify-content: center;" type="button" onclick="closeModal('modalKeluhan')">Batal</button>
        <button class="btn-sm" style="flex:1.5; justify-content: center;" type="submit">Kirim Keluhan</button>
      </div>
    </div>
  </form>
</div>

<!-- MODAL EDIT KELUHAN -->
<div class="ov" id="modalEditKeluhan" onclick="bgClose(event, 'modalEditKeluhan')">
  <form id="formEditKeluhan" class="modal" method="POST" action="" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="m-title" style="font-family:'DM Serif Display'; font-size: 1.5rem; margin-bottom:1rem; color: var(--g900);">âœï¸ Edit Keluhan Tanaman</div>
    <div style="display:flex; flex-direction:column; gap:15px;">
      <div>
        <label style="display:block;margin-bottom:6px;font-size:.78rem;color:var(--gray400);font-weight:700; text-transform: uppercase; letter-spacing: 0.02em;">Judul Masalah</label>
        <input id="editJudulKeluhan" name="judul_keluhan" type="text" placeholder="Judul Masalah (Contoh: Daun layu menguning)" style="width:100%; padding:12px; border-radius:10px; border:1.5px solid var(--gray100);" required>
      </div>
      <div>
        <label style="display:block;margin-bottom:6px;font-size:.78rem;color:var(--gray400);font-weight:700; text-transform: uppercase; letter-spacing: 0.02em;">Kondisi Detail Tanaman</label>
        <textarea id="editIsiKeluhan" name="isi_keluhan" placeholder="Deskripsikan kondisi detail tanaman Anda..." style="width:100%; padding:12px; border-radius:10px; border:1.5px solid var(--gray100); height:100px; resize: none;" required></textarea>
      </div>
      <div>
        <label style="display:block;margin-bottom:6px;font-size:.78rem;color:var(--gray400);font-weight:700; text-transform: uppercase; letter-spacing: 0.02em;">Pilih Konsultan Ahli</label>
        <select id="editIdKonsultan" name="id_konsultan" style="width:100%; padding:12px; border-radius:10px; border:1.5px solid var(--gray100);" required onchange="showSelectedKonsultanInfo(this, 'editInfoKonsultanBox')" onclick="toggleSelectedKonsultanInfo(this, 'editInfoKonsultanBox')">
          <option value="" disabled>-- Pilih Konsultan Ahli --</option>
          @foreach($konsultans as $c)
            <option value="{{ $c->id }}"
                    data-nama="{{ $c->nama }}"
                    data-keahlian="{{ $c->keahlian ?? '-' }}"
                    data-tarif="Rp {{ number_format(($c->tarif_konsultasi ?? 0) * 1000, 0, ',', '.') }}"
                    data-status="{{ $c->status ?? 'Aktif' }}"
                    data-foto="{{ !empty($c->foto_profil) ? asset('storage/' . $c->foto_profil) : '' }}"
                    data-telepon="{{ $c->telepon ?? ($c->user->telepon ?? '-') }}"
                    data-alamat="{{ addslashes($c->alamat ?? 'Jl. Doctreen Agrikultur No. 24, Jakarta') }}">
              {{ $c->nama ?? '-' }}{{ isset($c->keahlian) ? ' â€¢ ' . $c->keahlian : '' }}
            </option>
          @endforeach
        </select>
        <div id="editInfoKonsultanBox" style="display: none; margin-top: 10px; padding: 12px; background: rgba(99, 153, 34, 0.05); border: 1px solid rgba(99, 153, 34, 0.15); border-radius: 8px;"></div>
      </div>
      <div>
        <label style="display:block;margin-bottom:6px;font-size:.78rem;color:var(--gray400);font-weight:700; text-transform: uppercase; letter-spacing: 0.02em;">Perbarui Foto Kendala (Opsional)</label>
        <input name="foto_kendala" type="file" accept="image/*" style="width:100%; padding:10px; border-radius:10px; border:1.5px solid var(--gray100);" onchange="validateFotoSize(this)">
        <span style="font-size: 0.72rem; color: var(--gray400); display: block; margin-top: 4px; font-weight: 500;">ðŸ“· Biarkan kosong jika tidak ingin mengubah. Maks 50 MB.</span>
      </div>
      <div>
        <label style="display:block;margin-bottom:6px;font-size:.78rem;color:var(--gray400);font-weight:700; text-transform: uppercase; letter-spacing: 0.02em;">Pilih Metode Pembayaran</label>
        <select id="editMetodeBayar" name="metode_bayar" style="width:100%; padding:12px; border-radius:10px; border:1.5px solid var(--gray100);" required onchange="updateMetodeBayarDetail('edit')">
          <option value="Transfer Bank" selected>Transfer Bank</option>
          <option value="E-Wallet">E-Wallet</option>
        </select>
      </div>
      <div id="editMetodeBayarDetailBox" style="display:block; margin-top:10px;">
        <label style="display:block;margin-bottom:6px;font-size:.78rem;color:var(--gray400);font-weight:700; text-transform: uppercase; letter-spacing: 0.02em;">Pilih Bank / E-Wallet</label>
        <select id="editMetodeBayarDetail" name="metode_bayar_detail" style="width:100%; padding:12px; border-radius:10px; border:1.5px solid var(--gray100);" required>
          <option value="Mandiri">Mandiri</option>
          <option value="BCA">BCA</option>
          <option value="BRI">BRI</option>
          <option value="BNI">BNI</option>
          <option value="Bank Lainnya">Bank Lainnya</option>
        </select>
      </div>

      <div style="display:flex; gap:10px;">
        <button class="btn-sm" style="flex:1; background:var(--gray100); color:var(--text); justify-content: center;" type="button" onclick="closeModal('modalEditKeluhan')">Batal</button>
        <button class="btn-sm" style="flex:1.5; justify-content: center;" type="submit">Simpan Perubahan</button>
      </div>
    </div>
  </form>
</div>

<!-- MODAL PEMBELIAN PRODUK -->
<div class="ov" id="modalBeliProduk" onclick="bgClose(event, 'modalBeliProduk')">
  <div class="modal" style="max-width: 460px;">
    <div class="m-title" style="font-family:'DM Serif Display'; font-size: 1.5rem; margin-bottom: 0.5rem; color: var(--g900);">ðŸ›’ Formulir Pemesanan</div>
    <p style="font-size: 0.8rem; color: var(--gray400); margin-bottom: 1.25rem; font-weight: 500;">Lengkapi kuantitas dan metode pengiriman untuk melanjutkan pesanan Anda.</p>
    
    <form method="POST" action="{{ route('petani.pesanan.store') }}">
      @csrf
      <input type="hidden" name="id_produk" id="beliIdProduk">
      
      <div class="modal-fg">
        <label>Produk Terpilih</label>
        <input type="text" id="beliNamaProduk" class="modal-input" style="background: var(--gray50); color: var(--gray400); font-weight: bold;" readonly>
      </div>

      <div class="modal-fg">
        <label>Toko Penyedia</label>
        <input type="text" id="beliNamaToko" class="modal-input" style="background: var(--gray50); color: var(--gray400);" readonly>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 1rem;">
        <div class="modal-fg" style="margin-bottom: 0;">
          <label>Jumlah Kuantitas</label>
          <input type="number" name="kuantitas" id="beliKuantitas" class="modal-input" value="1" min="1" oninput="hitungTotalBeli()" required>
          <span style="font-size: 0.72rem; color: var(--gray400); margin-top: 4px;" id="beliStokTersedia">Stok: 0</span>
        </div>
        <div class="modal-fg" style="margin-bottom: 0;">
          <label>Metode Pengiriman</label>
          <select name="metode_kirim" class="modal-input" required>
            <option value="JNE" selected>JNE Express</option>
            <option value="J&T">J&T Express</option>
            <option value="Sicepat">Sicepat</option>
            <option value="Ambil Sendiri">Ambil di Tani</option>
          </select>
        </div>
      </div>

      <div class="modal-fg">
        <label>Metode Pembayaran</label>
        <select id="beliMetodeBayar" name="metode_bayar" class="modal-input" required onchange="updateMetodeBayarDetail('beli')">
          <option value="Transfer Bank" selected>Transfer Bank (Virtual Account)</option>
          <option value="E-Wallet">E-Wallet (OVO, Dana, GoPay)</option>
          <option value="COD">COD (Bayar di Tempat)</option>
        </select>
      </div>
      <div class="modal-fg" id="beliMetodeBayarDetailBox" style="display: block;">
        <label>Pilih Bank / E-Wallet</label>
        <select id="beliMetodeBayarDetail" name="metode_bayar_detail" class="modal-input" required>
          <option value="Mandiri">Mandiri</option>
          <option value="BCA">BCA</option>
          <option value="BRI">BRI</option>
          <option value="Bank Lainnya">Bank Lainnya</option>
        </select>
      </div>

      <div style="background: var(--g50); padding: 1rem; border-radius: 12px; border: 1px solid var(--g100); margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between;">
        <div>
          <div style="font-size: 0.72rem; color: var(--g800); font-weight: bold; text-transform: uppercase; letter-spacing: 0.02em;">Total Pembayaran</div>
          <div style="font-size: 1.35rem; font-weight: 800; color: var(--g900);" id="beliTotalHargaText">Rp 0</div>
        </div>
        <div style="font-size: 0.7rem; color: var(--g600); font-weight: 600; text-align: right; line-height: 1.3;">Stok otomatis dikurangi<br>setelah konfirmasi.</div>
      </div>

      <div style="display: flex; gap: 10px;">
        <button type="button" class="btn-sm" style="flex: 1; background: var(--gray100); color: var(--text); justify-content: center;" onclick="closeModal('modalBeliProduk')">Batal</button>
        <button type="submit" class="btn-sm" style="flex: 1.5; background: var(--g600); justify-content: center;">Konfirmasi Beli</button>
      </div>
    </form>
  </div>
</div>

<!-- MODAL ULASAN & RATING -->
<div class="ov" id="modalUlasan" onclick="bgClose(event, 'modalUlasan')">
  <div class="modal" style="max-width: 440px;">
    <div class="m-title" style="font-family:'DM Serif Display'; font-size: 1.5rem; margin-bottom: 0.5rem; color: var(--g900);">â­ Beri Ulasan & Rating</div>
    <p style="font-size: 0.8rem; color: var(--gray400); margin-bottom: 1.25rem; font-weight: 500;">Bantu kami menilai kinerja konsultan untuk terus meningkatkan kualitas layanan Doctreen.</p>
    
    <form method="POST" action="{{ route('petani.ulasan.store') }}">
      @csrf
      <input type="hidden" name="id_konsultasi" id="ulasanIdKonsultasi">
      <input type="hidden" name="skor_rating" id="ulasanRatingValue" value="5">

      <div class="modal-fg">
        <label>Konsultan Ahli</label>
        <input type="text" id="ulasanNamaKonsultan" class="modal-input" style="background: var(--gray50); color: var(--gray400); font-weight: bold;" readonly>
      </div>

      <div class="modal-fg">
        <label>Berikan Rating Anda</label>
        <div class="rating-wrap">
          <span class="rating-star active" onclick="setRatingStar(1)">â˜…</span>
          <span class="rating-star active" onclick="setRatingStar(2)">â˜…</span>
          <span class="rating-star active" onclick="setRatingStar(3)">â˜…</span>
          <span class="rating-star active" onclick="setRatingStar(4)">â˜…</span>
          <span class="rating-star active" onclick="setRatingStar(5)">â˜…</span>
        </div>
      </div>

      <div class="modal-fg">
        <label>Komentar / Masukan</label>
        <textarea name="komentar" class="modal-input" placeholder="Tuliskan pengalaman atau feedback Anda terkait konsultasi..." style="height: 100px; resize: none;" required></textarea>
      </div>

      <div style="display: flex; gap: 10px; margin-top: 1.5rem;">
        <button type="button" class="btn-sm" style="flex: 1; background: var(--gray100); color: var(--text); justify-content: center;" onclick="closeModal('modalUlasan')">Batal</button>
        <button type="submit" class="btn-sm" style="flex: 1.5; background: var(--g600); justify-content: center;">Kirim Ulasan</button>
      </div>
    </form>
  </div>
</div>

<script>
  // Tab controller
  function showTab(name, el) {
    ['dashboard', 'tanaman', 'toko', 'riwayat', 'keluhan'].forEach(t => {
      const tabEl = document.getElementById('tab-' + t);
      if (tabEl) tabEl.classList.add('tab-hidden');
    });
    const activeTab = document.getElementById('tab-' + name);
    if (activeTab) activeTab.classList.remove('tab-hidden');
    
    document.querySelectorAll('.sbi').forEach(b => b.classList.remove('active'));
    if (el) el.classList.add('active');

    // Toggle floating cart FAB
    const cartFab = document.getElementById('cartFabButton');
    if (cartFab) {
      cartFab.style.display = (name === 'toko') ? 'flex' : 'none';
    }
  }

  // Riwayat Subtab Toggler
  function switchRiwayatTab(sub) {
    const isKonsul = sub === 'konsul';
    
    // Toggle active classes on subtab buttons
    document.getElementById('btnSubTabKonsul').classList.toggle('active', isKonsul);
    document.getElementById('btnSubTabBelanja').classList.toggle('active', !isKonsul);
    
    // Toggle hidden classes on containers
    document.getElementById('subTabKonsul').classList.toggle('tab-hidden', !isKonsul);
    document.getElementById('subTabBelanja').classList.toggle('tab-hidden', isKonsul);
  }

  // General Modal controllers
  function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) modal.classList.add('show');
  }

  function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) modal.classList.remove('show');
  }

  // Menutup modal saat klik background overlay
  function bgClose(e, modalId) {
    if (e.target.classList.contains('ov')) closeModal(modalId);
  }

  // Validasi ukuran foto (max 50MB)
  function validateFotoSize(input) {
    const file = input.files[0];
    if (file && file.size > 50 * 1024 * 1024) {
      alert('File terlalu besar! Maksimal 50 MB.');
      input.value = '';
    }
  }

  // â”€â”€â”€ LOGIKA SAKELAR (TOGGLE) PROFILE KONSULTAN â”€â”€â”€
  let _lastKonsultanValue = { add: null, edit: null };

  // Fungsi dipicu saat memilih elemen dropdown (onchange)
  function showSelectedKonsultanInfo(selectEl, boxId) {
    const box = document.getElementById(boxId);
    const contextKey = boxId.startsWith('add') ? 'add' : 'edit';

    if (!selectEl.value) {
      box.style.display = 'none';
      _lastKonsultanValue[contextKey] = null;
      return;
    }

    // Perbarui riwayat nilai terpilih terakhir
    _lastKonsultanValue[contextKey] = selectEl.value;

    const opt = selectEl.options[selectEl.selectedIndex];
    const nama = opt.dataset.nama;
    const keahlian = opt.dataset.keahlian;
    const tarif = opt.dataset.tarif;
    const status = opt.dataset.status;
    const foto = opt.dataset.foto;
    const telepon = opt.dataset.telepon || '-';
    const alamat = opt.dataset.alamat || 'Jl. Doctreen Agrikultur No. 24, Jakarta';
    
    let avatarHtml = `<div style="width: 40px; height: 40px; border-radius: 50%; background: var(--g100); color: var(--g800); display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.1rem; overflow: hidden; flex-shrink: 0; border: 1.5px solid var(--g400);">ðŸ‘¨â€ðŸŒ¾</div>`;
    if (foto) {
      avatarHtml = `<img src="${foto}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 1.5px solid var(--g600); flex-shrink: 0;">`;
    }
    
    box.innerHTML = `
      <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
        ${avatarHtml}
        <div>
          <div style="font-weight: 700; color: var(--text); font-size: 0.88rem;">${nama}</div>
          <div style="font-size: 0.75rem; color: var(--gray600);">${keahlian} â€¢ <span class="badge b-selesai" style="font-size: 0.65rem; padding: 2px 6px;">${status}</span></div>
        </div>
      </div>
      <div style="display: flex; flex-direction: column; gap: 4px; border-top: 1.5px dashed rgba(99, 153, 34, 0.12); padding-top: 8px; margin-top: 8px;">
        <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.8rem;">
          <span style="color: var(--gray600);">Tarif Konsultasi:</span>
          <strong style="color: var(--g900);">${tarif} / Sesi</strong>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.8rem;">
          <span style="color: var(--gray600);">No. HP/Telepon:</span>
          <strong style="color: var(--text);">${telepon}</strong>
        </div>
        <div style="display: flex; flex-direction: column; gap: 2px; font-size: 0.8rem; margin-top: 2px; text-align: left;">
          <span style="color: var(--gray600);">Alamat Praktek:</span>
          <strong style="color: var(--text); font-size: 0.78rem;">${alamat}</strong>
        </div>
      </div>
    `;
    box.style.display = 'block';
  }

  // Fungsi dipicu saat mengklik elemen dropdown (onclick) untuk menutup/reset
  function toggleSelectedKonsultanInfo(selectEl, boxId) {
    const box = document.getElementById(boxId);
    const contextKey = boxId.startsWith('add') ? 'add' : 'edit';

    // Jika belum ada nilai terpilih atau box sedang tersembunyi, jangan lakukan apa-apa
    if (!selectEl.value || box.style.display === 'none') {
      return;
    }

    // Jika nilai klik saat ini sama dengan nilai yang sudah terpilih aktif sebelumnya, lakukan toggle-off (tutup)
    if (_lastKonsultanValue[contextKey] === selectEl.value) {
      box.style.display = 'none';
      _lastKonsultanValue[contextKey] = null;
      selectEl.value = ''; // Reset dropdown ke pilihan kosong (placeholder)
    }
  }

  // Open Detail Profil Konsultan Modal
  function openProfilKonsultan(nama, keahlian, status, tarif, foto, telepon, alamat) {
    document.getElementById('consProfileNama').textContent = nama;
    document.getElementById('consProfileKeahlian').textContent = keahlian;
    document.getElementById('consProfileTarif').textContent = 'Rp ' + tarif + ' / sesi';
    document.getElementById('consProfileTelepon').textContent = telepon || '-';
    document.getElementById('consProfileAlamat').textContent = alamat || 'Jl. Doctreen Agrikultur No. 24, Jakarta';
    
    const statusEl = document.getElementById('consProfileStatus');
    statusEl.textContent = status;
    if (status === 'Aktif') {
      statusEl.className = 'badge b-selesai';
    } else {
      statusEl.className = 'badge b-proses';
    }
    
    const fotoCont = document.getElementById('consProfileFotoContainer');
    if (foto) {
      fotoCont.innerHTML = `<img src="${foto}" style="width: 100%; height: 100%; object-fit: cover;">`;
    } else {
      fotoCont.innerHTML = `ðŸ‘¨â€ðŸŒ¾`;
    }
    
    openModal('modalProfilKonsultan');
  }

  // Live plants search filter
  function filterTanaman() {
    const input = document.getElementById('tanamanSearchInput').value.toLowerCase();
    const cards = document.querySelectorAll('#tanamanGridContainer .tan-card');
    
    cards.forEach(card => {
      const name = card.dataset.nama;
      const latin = card.dataset.latin;
      if (name.includes(input) || latin.includes(input)) {
        card.style.display = '';
      } else {
        card.style.display = 'none';
      }
    });
  }

  // Detail Tanaman Modal mapping
  function openDetailTanaman(btn) {
    const nama = btn.dataset.nama;
    const latin = btn.dataset.latin;
    const jenis = btn.dataset.jenis;
    const perawatan = btn.dataset.perawatan;
    const pengobatan = btn.dataset.pengobatan;
    const foto = btn.dataset.foto;
    const ancaman = JSON.parse(btn.dataset.ancaman || '[]');
    const videos = JSON.parse(btn.dataset.videos || '[]');

    document.getElementById('detailTanNama').textContent = nama;
    document.getElementById('detailTanLatin').textContent = latin;
    document.getElementById('detailTanJenis').textContent = jenis;
    document.getElementById('detailTanPerawatan').textContent = perawatan;
    document.getElementById('detailTanPengobatan').textContent = pengobatan;

    const fotoEl = document.getElementById('detailTanFoto');
    if (foto) {
      fotoEl.innerHTML = `<img src="${foto}" style="width: 100%; height: 100%; object-fit: cover;">`;
    } else {
      fotoEl.innerHTML = 'ðŸŒ¿';
    }

    const ancamanContainer = document.getElementById('detailTanAncaman');
    ancamanContainer.innerHTML = '';
    if (ancaman.length > 0) {
      ancaman.forEach(a => {
        const div = document.createElement('div');
        div.className = 'tan-badge-danger';
        div.textContent = a;
        ancamanContainer.appendChild(div);
      });
    } else {
      ancamanContainer.innerHTML = '<div style="color:var(--gray400); font-size:0.75rem; font-style:italic;">Aman dari ancaman patogen ekstrem.</div>';
    }

    const videosContainer = document.getElementById('detailTanVideosContainer');
    videosContainer.innerHTML = '';
    if (videos.length > 0) {
      const maxVisible = 2;
      videos.forEach((v, idx) => {
        const item = document.createElement('div');
        item.className = 'video-item';
        if (idx >= maxVisible) {
          item.style.display = 'none';
          item.classList.add('video-extra');
        }
        
        let embedHtml = '';
        if (v.url) {
          const ytMatch = v.url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]{11})/);
          const ytId = ytMatch ? ytMatch[1] : null;
          if (ytId) {
            embedHtml = `<div class="video-embed"><iframe src="https://www.youtube.com/embed/${ytId}" frameborder="0" allowfullscreen></iframe></div>`;
          } else {
            embedHtml = `<div style="padding: 10px; font-size: 0.8rem;"><a href="${v.url}" target="_blank" style="color: var(--g600); font-weight: 600;">ðŸ”— Buka Video Edukasi Medis</a></div>`;
          }
        } else if (v.file_path) {
          const path = `/storage/${v.file_path}`;
          embedHtml = `<div class="video-embed"><video controls style="width: 100%; height: 100% "><source src="${path}" type="video/mp4"></video></div>`;
        }

        item.innerHTML = `
          <div class="video-item-header">
            <span class="video-title">${v.judul_video || 'Video Panduan Perawatan'}</span>
          </div>
          ${embedHtml}
        `;
        videosContainer.appendChild(item);
      });

      // Tombol "Lihat Selengkapnya" jika ada lebih dari maxVisible
      if (videos.length > maxVisible) {
        const remaining = videos.length - maxVisible;
        const toggleBtn = document.createElement('button');
        toggleBtn.className = 'btn-sm';
        toggleBtn.style.cssText = 'width:100%; background: rgba(99,153,34,0.06); color: var(--g600); border: 1px solid var(--g100); margin-top: 4px; font-size: 0.8rem; justify-content: center;';
        toggleBtn.textContent = `â–¼ Lihat ${remaining} Video Lainnya`;
        let expanded = false;
        toggleBtn.onclick = function() {
          expanded = !expanded;
          videosContainer.querySelectorAll('.video-extra').forEach(el => {
            el.style.display = expanded ? '' : 'none';
          });
          toggleBtn.textContent = expanded
            ? 'â–² Sembunyikan Video'
            : `â–¼ Lihat ${remaining} Video Lainnya`;
        };
        videosContainer.appendChild(toggleBtn);
      }
    } else {
      videosContainer.innerHTML = '<div style="color:var(--gray400); font-size:0.75rem; font-style:italic; padding: 4px 0;">Belum ada video edukasi terkait tanaman ini.</div>';
    }

    openModal('modalDetailTanaman');
  }


  // SHOPPING CART (LOCAL STORAGE PERSISTED)
  let cart = [];
  try {
    cart = JSON.parse(localStorage.getItem('doctreen_cart') || '[]');
  } catch (e) {
    cart = [];
  }

  function saveCart() {
    localStorage.setItem('doctreen_cart', JSON.stringify(cart));
    updateCartFabCount();
  }

  function updateCartFabCount() {
    const totalQty = cart.reduce((sum, item) => sum + item.qty, 0);
    const countText = document.getElementById('cartFabCountText');
    if (countText) countText.textContent = totalQty;
  }

  function addToCart(id, name, shopName, price, maxStock, img) {
    const existing = cart.find(item => item.id === id);
    if (existing) {
      if (existing.qty >= maxStock) {
        alert('Jumlah di keranjang sudah mencapai batas stok yang tersedia!');
        return;
      }
      existing.qty += 1;
    } else {
      cart.push({
        id: id,
        name: name,
        shopName: shopName,
        price: price,
        maxStock: maxStock,
        img: img,
        qty: 1
      });
    }
    saveCart();
    alert('Produk "' + name + '" berhasil ditambahkan ke keranjang!');
    renderCart();
  }

  // Hapus item dari Keranjang Belanja
  function removeFromCart(id) {
    cart = cart.filter(item => item.id !== id);
    saveCart();
    renderCart();
  }

  function updateCartQty(id, qty) {
    const item = cart.find(item => item.id === id);
    if (item) {
      item.qty = parseInt(qty) || 1;
      if (item.qty < 1) item.qty = 1;
      if (item.qty > item.maxStock) {
        alert('Stok tidak mencukupi untuk jumlah tersebut!');
        item.qty = item.maxStock;
      }
      saveCart();
      renderCart();
    }
  }

  function openCartDrawer() {
    renderCart();
    document.getElementById('cartDrawer').classList.add('open');
    document.getElementById('cartBackdrop').classList.add('show');
  }

  function closeCartDrawer() {
    document.getElementById('cartDrawer').classList.remove('open');
    document.getElementById('cartBackdrop').classList.remove('show');
  }

  function renderCart() {
    const list = document.getElementById('cartItemsList');
    if (!list) return;
    list.innerHTML = '';
    
    if (cart.length === 0) {
      list.innerHTML = `
        <div style="text-align: center; color: var(--gray400); padding: 3rem 1rem; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 10px; height: 100%;">
          <span style="font-size: 3rem;">ðŸ›’</span>
          <p style="font-size: 0.85rem; font-weight: 600;">Keranjang belanja Anda masih kosong.</p>
        </div>
      `;
      document.getElementById('cartTotalText').textContent = 'Rp 0';
      return;
    }
    
    let total = 0;
    cart.forEach(item => {
      const itemTotal = item.price * item.qty;
      total += itemTotal;
      
      const div = document.createElement('div');
      div.className = 'cart-item';
      div.innerHTML = `
        <div class="cart-item-img">
          ${item.img ? `<img src="${item.img}">` : 'ðŸ“¦'}
        </div>
        <div class="cart-item-info">
          <div class="cart-item-title">${item.name}</div>
          <div style="font-size: 0.72rem; color: var(--gray400); margin-top: 2px; font-weight: 500;">Toko: ${item.shopName}</div>
          <div class="cart-item-price">Rp ${itemTotal.toLocaleString('id-ID')}</div>
          <div class="cart-item-qty">
            <button type="button" class="qty-btn" onclick="updateCartQty(${item.id}, ${item.qty - 1})">-</button>
            <span style="font-size: 0.8rem; font-weight: bold; min-width: 15px; text-align: center;">${item.qty}</span>
            <button type="button" class="qty-btn" onclick="updateCartQty(${item.id}, ${item.qty + 1})">+</button>
            <span style="font-size: 0.68rem; color: var(--gray400); margin-left: 5px; font-weight: 500;">(Maks: ${item.maxStock})</span>
          </div>
        </div>
        <button type="button" class="cart-item-remove" onclick="removeFromCart(${item.id})">ðŸ—‘ï¸</button>
      `;
      list.appendChild(div);
    });
    
    document.getElementById('cartTotalText').textContent = 'Rp ' + total.toLocaleString('id-ID');
  }

  // DYNAMIC SEQUENTIAL AJAX CART CHECKOUT
  async function checkoutCart() {
    if (cart.length === 0) return;
    
    const courier = document.getElementById('cartCourierSelect').value;
    const payment = document.getElementById('cartPaymentSelect').value;
    const csrfToken = document.querySelector('input[name="_token"]').value;
    
    const checkoutBtn = document.getElementById('cartCheckoutBtn');
    checkoutBtn.disabled = true;
    checkoutBtn.textContent = 'Memproses Transaksi...';
    
    try {
      for (let item of cart) {
        const response = await fetch("{{ route('petani.pesanan.store') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            id_produk: item.id,
            kuantitas: item.qty,
            metode_kirim: courier,
            metode_bayar: payment
          })
        });
        
        const data = await response.json();
        if (!response.ok || !data.success) {
          throw new Error(data.message || 'Terjadi kesalahan saat memproses produk ' + item.name);
        }
      }
      
      alert('Checkout Keranjang Berhasil! Silakan cek menu Riwayat Belanja Anda.');
      cart = [];
      saveCart();
      renderCart();
      closeCartDrawer();
      window.location.reload();
    } catch (error) {
      alert('Gagal melakukan checkout: ' + error.message);
      checkoutBtn.disabled = false;
      checkoutBtn.textContent = 'Checkout Sekarang';
    }
  }

  // Product Purchasing Modal controller (for instant purchase)
  let selectedProductPrice = 0;
  let selectedProductMaxStock = 0;

  function openBeliModal(id, namaProduk, namaToko, price, stock) {
    selectedProductPrice = price;
    selectedProductMaxStock = stock;
    
    document.getElementById('beliIdProduk').value = id;
    document.getElementById('beliNamaProduk').value = namaProduk;
    document.getElementById('beliNamaToko').value = namaToko;
    document.getElementById('beliKuantitas').value = 1;
    document.getElementById('beliKuantitas').max = stock;
    document.getElementById('beliStokTersedia').textContent = 'Stok: ' + stock + ' pcs';
    
    document.getElementById('beliMetodeBayar').value = 'Transfer Bank';
    updateMetodeBayarDetail('beli');
    
    hitungTotalBeli();
    openModal('modalBeliProduk');
  }

  function hitungTotalBeli() {
    const qtyInput = document.getElementById('beliKuantitas');
    let qty = parseInt(qtyInput.value) || 1;
    
    // Cap to min 1 and max stock
    if (qty < 1) {
      qty = 1;
      qtyInput.value = 1;
    } else if (qty > selectedProductMaxStock) {
      qty = selectedProductMaxStock;
      qtyInput.value = selectedProductMaxStock;
    }
    
    const total = qty * selectedProductPrice;
    document.getElementById('beliTotalHargaText').textContent = 'Rp ' + total.toLocaleString('id-ID');
  }

  function updateMetodeBayarDetail(context) {
    const typeSelect = document.getElementById(context + 'MetodeBayar');
    const detailBox = document.getElementById(context + 'MetodeBayarDetailBox');
    const detailSelect = document.getElementById(context + 'MetodeBayarDetail');

    if (!typeSelect || !detailBox || !detailSelect) return;

    const type = typeSelect.value;
    let options = [];
    let label = 'Pilih Bank / E-Wallet';
    let showDetail = true;

    if (type === 'E-Wallet') {
      options = [
        { value: 'Dana', text: 'Dana' },
        { value: 'GoPay', text: 'GoPay' },
        { value: 'OVO', text: 'OVO' },
        { value: 'ShopeePay', text: 'ShopeePay' },
        { value: 'LinkAja', text: 'LinkAja' }
      ];
      label = 'Pilih E-Wallet';
    } else if (type === 'Transfer Bank') {
      options = [
        { value: 'Mandiri', text: 'Mandiri' },
        { value: 'BCA', text: 'BCA' },
        { value: 'BRI', text: 'BRI' },
        { value: 'BNI', text: 'BNI' },
        { value: 'Bank Lainnya', text: 'Bank Lainnya' }
      ];
      label = 'Pilih Bank';
    } else {
      options = [
        { value: 'COD', text: 'COD' }
      ];
      label = 'Metode Bayar';
      showDetail = false;
    }

    detailBox.style.display = showDetail ? 'block' : 'none';
    const detailLabel = detailBox.querySelector('label');
    if (detailLabel) {
      detailLabel.textContent = label;
    }
    detailSelect.innerHTML = options.map(opt => `<option value="${opt.value}">${opt.text}</option>`).join('');
    detailSelect.required = showDetail;
    detailSelect.disabled = !showDetail;
    if (!showDetail) {
      detailSelect.value = options[0]?.value || '';
    }
  }

  // Review Modal controller
  function openUlasanModal(idKonsultasi, namaKonsultan) {
    document.getElementById('ulasanIdKonsultasi').value = idKonsultasi;
    document.getElementById('ulasanNamaKonsultan').value = namaKonsultan;
    
    // Reset stars to 5 default
    setRatingStar(5);
    openModal('modalUlasan');
  }

  function setRatingStar(rating) {
    document.getElementById('ulasanRatingValue').value = rating;
    const stars = document.querySelectorAll('#modalUlasan .rating-star');
    
    stars.forEach((star, index) => {
      if (index < rating) {
        star.classList.add('active');
      } else {
        star.classList.remove('active');
      }
    });
  }

  // Open Edit Keluhan Modal & populate fields
  function openEditKeluhanModal(id, judul, isi, idKonsultan, metodeBayar) {
    const form = document.getElementById('formEditKeluhan');
    form.action = `/petani/keluhan/${id}`;

    // Clean prefix of edited label
    let cleanedJudul = judul;
    if (cleanedJudul.startsWith('âœï¸ [EDIT] ')) {
      cleanedJudul = cleanedJudul.substring('âœï¸ [EDIT] '.length);
    } else if (cleanedJudul.startsWith('[EDIT] ')) {
      cleanedJudul = cleanedJudul.substring('[EDIT] '.length);
    }

    document.getElementById('editJudulKeluhan').value = cleanedJudul;
    document.getElementById('editIsiKeluhan').value = isi;
    
    const selectKonsultan = document.getElementById('editIdKonsultan');
    selectKonsultan.value = idKonsultan ? idKonsultan : '';
    
    // Trigger dinamis load info konsultan
    showSelectedKonsultanInfo(selectKonsultan, 'editInfoKonsultanBox');
    
    const selectMetode = document.getElementById('editMetodeBayar');
    selectMetode.value = metodeBayar ? metodeBayar : 'Transfer Bank';
    updateMetodeBayarDetail('edit');

    openModal('modalEditKeluhan');
  }

  // Helper to update the workflow process diagram dynamically
  function updateWorkflowDiagram(status) {
    const steps = {
      1: document.getElementById('wfStep1'),
      2: document.getElementById('wfStep2'),
      3: document.getElementById('wfStep3'),
      4: document.getElementById('wfStep4'),
      5: document.getElementById('wfStep5')
    };
    const arrows = {
      1: document.getElementById('wfArrow1'),
      2: document.getElementById('wfArrow2'),
      3: document.getElementById('wfArrow3'),
      4: document.getElementById('wfArrow4')
    };

    function setStepActive(el, isActive, isSelesaiStep = false) {
      if (!el) return;
      if (isActive) {
        el.style.background = '#eef7e6';
        el.style.borderColor = '#3d8b52';
        el.style.borderStyle = 'solid';
        el.style.boxShadow = '0 4px 12px rgba(61,139,82,0.1)';
        
        const textEl = el.querySelector('div, span');
        if (textEl) {
          textEl.style.color = '#172a0f';
        }
        const subText = el.querySelector('span');
        if (subText) {
          subText.style.color = '#3d662b';
        }
        const svg = el.querySelector('svg');
        if (svg) {
          svg.style.opacity = '1';
        }
        if (isSelesaiStep) {
          el.style.color = '#3d8b52';
        }
      } else {
        el.style.background = '#ffffff';
        el.style.borderColor = '#d1d5db';
        el.style.borderStyle = 'dashed';
        el.style.boxShadow = 'none';
        
        const textEl = el.querySelector('div, span');
        if (textEl) {
          textEl.style.color = '#9ca3af';
        }
        const subText = el.querySelector('span');
        if (subText) {
          subText.style.color = '#9ca3af';
        }
        const svg = el.querySelector('svg');
        if (svg) {
          svg.style.opacity = '0.35';
        }
        if (isSelesaiStep) {
          el.style.color = '#9ca3af';
        }
      }
    }

    function setArrowActive(el, isActive) {
      if (!el) return;
      if (isActive) {
        el.style.color = '#3d8b52';
      } else {
        el.style.color = '#d1d5db';
      }
    }

    if (status === 'baru') {
      setStepActive(steps[1], true);
      setArrowActive(arrows[1], true);
      setStepActive(steps[2], true);
      setArrowActive(arrows[2], false);
      setStepActive(steps[3], false);
      setArrowActive(arrows[3], false);
      setStepActive(steps[4], false);
      setArrowActive(arrows[4], false);
      setStepActive(steps[5], false, true);
    } else if (status === 'proses') {
      setStepActive(steps[1], true);
      setArrowActive(arrows[1], true);
      setStepActive(steps[2], true);
      setArrowActive(arrows[2], true);
      setStepActive(steps[3], true);
      setArrowActive(arrows[3], true);
      setStepActive(steps[4], true);
      setArrowActive(arrows[4], false);
      setStepActive(steps[5], false, true);
    } else if (status === 'selesai') {
      setStepActive(steps[1], true);
      setArrowActive(arrows[1], true);
      setStepActive(steps[2], true);
      setArrowActive(arrows[2], true);
      setStepActive(steps[3], true);
      setArrowActive(arrows[3], true);
      setStepActive(steps[4], true);
      setArrowActive(arrows[4], true);
      setStepActive(steps[5], true, true);
    }
  }

  // Open Detail Keluhan / Rekam Medis Modal
  function openDetailKeluhan(btn) {
    const id = btn.dataset.id;
    const judul = btn.dataset.judul;
    const isi = btn.dataset.isi;
    const tanggal = btn.dataset.tanggal;
    const metodeBayar = btn.dataset.metodeBayar;
    const rawStatus = btn.dataset.status || 'baru';
    const statusLabel = btn.dataset.statusLabel;
    const statusBadge = btn.dataset.statusBadge;
    const konsultanNama = btn.dataset.konsultanNama;
    const konsultanKeahlian = btn.dataset.konsultanKeahlian;
    const idKonsultan = btn.dataset.idKonsultan === 'null' ? null : btn.dataset.idKonsultan;
    const foto = btn.dataset.foto;
    const diagnosa = btn.dataset.diagnosa;
    const rekomendasi = btn.dataset.rekomendasi;
    const catatan = btn.dataset.catatan;
    const buktiBayar = btn.dataset.buktiBayar;
    const origin = btn.dataset.origin || 'keluhan';

    const konsultanStatus = btn.dataset.konsultanStatus || 'Aktif';
    const konsultanTarif = btn.dataset.konsultanTarif || '0';
    const konsultanTelepon = btn.dataset.konsultanTelepon || '-';
    const konsultanAlamat = btn.dataset.konsultanAlamat || 'Jl. Doctreen Agrikultur No. 24, Jakarta';
    const konsultanFoto = btn.dataset.konsultanFoto || '';

    // Menampilkan judul dan deskripsi yang terpisah secara terstruktur
    document.getElementById('detailKelJudul').textContent = judul;
    document.getElementById('detailKelIsi').textContent = isi; // Ditata rapi secara paragraf via css pre-wrap
    document.getElementById('detailKelTanggal').textContent = tanggal;
    document.getElementById('detailKelBayar').textContent = metodeBayar;

    // Set Consultant info inside grid
    document.getElementById('detailKelKonsultanNama').textContent = konsultanNama || 'Belum Ditentukan';
    document.getElementById('detailKelKonsultanKeahlian').textContent = konsultanKeahlian || 'Ahli Tanaman';
    
    const fotoKonsEl = document.getElementById('detailKelKonsultanFoto');
    if (konsultanFoto) {
      fotoKonsEl.src = konsultanFoto;
      fotoKonsEl.style.display = 'block';
    } else {
      fotoKonsEl.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(konsultanNama || 'Konsultan')}&background=e2e5e0&color=172a0f`;
      fotoKonsEl.style.display = 'block';
    }

    const cellKons = document.getElementById('detailKelKonsultanCell');
    if (idKonsultan && idKonsultan !== 'null' && konsultanNama !== 'Belum Ditentukan') {
      cellKons.style.cursor = 'pointer';
      cellKons.style.opacity = '1';
      cellKons.title = 'Klik untuk melihat profil lengkap';
      cellKons.onclick = function() {
        closeModal('modalDetailKeluhan');
        openProfilKonsultan(konsultanNama, konsultanKeahlian, konsultanStatus, konsultanTarif, konsultanFoto, konsultanTelepon, konsultanAlamat);
      };
    } else {
      cellKons.style.cursor = 'default';
      cellKons.style.opacity = '0.7';
      cellKons.title = 'Konsultan belum ditentukan';
      cellKons.onclick = null;
    }

    const badgeEl = document.getElementById('detailKelStatus');
    badgeEl.textContent = statusLabel || 'Baru';
    if (rawStatus === 'baru') {
      badgeEl.style.background = '#e5e7eb';
      badgeEl.style.color = '#374151';
    } else if (rawStatus === 'proses') {
      badgeEl.style.background = '#dbeafe';
      badgeEl.style.color = '#1e40af';
    } else if (rawStatus === 'selesai') {
      badgeEl.style.background = '#d1fae5';
      badgeEl.style.color = '#065f46';
    } else {
      badgeEl.style.background = '#3d8b52';
      badgeEl.style.color = 'white';
    }

    // Update the visual horizontal workflow diagram
    updateWorkflowDiagram(rawStatus);

    const fotoCont = document.getElementById('detailKelFotoContainer');
    const fotoEl = document.getElementById('detailKelFoto');
    if (foto) {
      fotoEl.src = foto;
      fotoCont.style.display = 'block';
    } else {
      fotoEl.src = '';
      fotoCont.style.display = 'none';
    }

    const medisSect = document.getElementById('detailKelMedisSection');
    if (rawStatus !== 'baru') {
      medisSect.style.display = 'flex';
      document.getElementById('detailKelDiagnosa').textContent = diagnosa ? diagnosa : 'Sedang dianalisis oleh konsultan...';
      document.getElementById('detailKelRekomendasi').textContent = rekomendasi ? rekomendasi : 'Menunggu rekomendasi resep...';
      document.getElementById('detailKelCatatan').textContent = catatan ? catatan : 'Tidak ada catatan tambahan.';
    } else {
      medisSect.style.display = 'none';
    }

    // â”€â”€â”€ LOGIKA TOMBOL EDIT & HAPUS SELALU DIAKTIFKAN SAAT MASUK KE LIHAT â”€â”€â”€
    const detailActions = document.getElementById('detailKelActions');
    const btnEdit = document.getElementById('btnDetailKelEdit');
    const deleteForm = document.getElementById('formDeleteDetailKeluhan');

    detailActions.style.display = 'flex';
    deleteForm.style.display = 'inline-block';
    deleteForm.action = `/petani/keluhan/${id}`;

    btnEdit.style.display = 'inline-block';
    btnEdit.onclick = function() {
      closeModal('modalDetailKeluhan');
      openEditKeluhanModal(id, judul, isi, idKonsultan, metodeBayar);
    };

    // Bukti bayar handling
    const kelBuktiSection = document.getElementById('detailKelBuktiSection');
    const kelPreviewContainer = document.getElementById('detailKelBuktiPreviewContainer');
    const kelPreviewImg = document.getElementById('detailKelBuktiPreviewImg');
    const kelBuktiForm = document.getElementById('detailKelBuktiForm');

    if (metodeBayar === 'COD') {
      kelBuktiSection.style.display = 'none';
    } else {
      kelBuktiSection.style.display = 'flex';
      if (buktiBayar) {
        kelPreviewImg.src = buktiBayar;
        kelPreviewContainer.style.display = 'block';
        kelBuktiForm.style.display = 'none';
      } else {
        kelPreviewContainer.style.display = 'none';
        kelPreviewImg.src = '';
        kelBuktiForm.action = `/petani/keluhan/${id}/bukti`;
        kelBuktiForm.style.display = 'flex';
      }
    }

    // Tanya Lagi / Re-open logic
    const tanyaLagiSection = document.getElementById('detailKelTanyaLagiSection');
    const freePromo = document.getElementById('tanyaLagiFreePromo');
    const paidWarning = document.getElementById('tanyaLagiPaidWarning');
    const tanyaLagiForm = document.getElementById('tanyaLagiForm');
    const tanyaLagiJudul = document.getElementById('tanyaLagiJudul');
    const tanyaLagiIsi = document.getElementById('tanyaLagiIsi');
    const btnTanyaLagiSubmit = document.getElementById('btnTanyaLagiSubmit');

    if (rawStatus === 'selesai') {
      tanyaLagiSection.style.display = 'flex';
      
      // Parse updated_at to check 24 hours diff
      const updatedAtStr = btn.dataset.updatedAt;
      let diffHours = 999; // Default to paid if not found
      if (updatedAtStr) {
        const updatedAt = new Date(updatedAtStr);
        const diffMs = new Date() - updatedAt;
        diffHours = diffMs / (1000 * 60 * 60);
      }

      if (diffHours < 24) {
        // Free follow-up
        freePromo.style.display = 'block';
        paidWarning.style.display = 'none';
        tanyaLagiJudul.value = judul + ' (Tanya Lagi)';
        tanyaLagiIsi.value = '';
        btnTanyaLagiSubmit.textContent = 'Kirim Pertanyaan Lanjutan (Gratis)';
        btnTanyaLagiSubmit.style.background = 'var(--g600)';
        tanyaLagiForm.action = `/petani/keluhan/${id}/edit-gratis`;
      } else {
        // Paid follow-up (50% off)
        freePromo.style.display = 'none';
        paidWarning.style.display = 'block';
        tanyaLagiJudul.value = judul + ' - Tanya Lagi';
        tanyaLagiIsi.value = '';
        btnTanyaLagiSubmit.textContent = 'Ajukan Tanya Lagi (Bayar Sesi 50%)';
        btnTanyaLagiSubmit.style.background = 'var(--g800)';
        tanyaLagiForm.action = `/petani/keluhan/${id}/tanya-lagi-bayar`;
      }
    } else {
      tanyaLagiSection.style.display = 'none';
    }

    openModal('modalDetailKeluhan');
  }

  // Open Detail Belanja / Invoice Receipt Modal
  function openDetailBelanja(btn) {
    const id = btn.dataset.id;
    const trx = btn.dataset.trx;
    const tanggal = btn.dataset.tanggal;
    const toko = btn.dataset.toko;
    const produk = btn.dataset.produk;
    const qty = parseInt(btn.dataset.qty) || 1;
    const harga = parseFloat(btn.dataset.harga) || 0;
    const subtotal = parseFloat(btn.dataset.subtotal) || 0;
    const kirim = btn.dataset.kirim;
    const bayar = btn.dataset.bayar;
    const statusLabel = btn.dataset.statusLabel;
    const statusBadge = btn.dataset.statusBadge;
    const buktiBayar = btn.dataset.buktiBayar;

    document.getElementById('invoiceTrx').textContent = trx;
    document.getElementById('invoiceTanggal').textContent = tanggal;
    document.getElementById('invoiceToko').textContent = toko;
    document.getElementById('invoiceProduk').textContent = produk;
    document.getElementById('invoiceQty').textContent = qty;
    document.getElementById('invoiceHargaSatuan').textContent = harga.toLocaleString('id-ID');
    document.getElementById('invoiceSubtotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
    document.getElementById('invoiceKirim').textContent = kirim;
    document.getElementById('invoiceBayar').textContent = bayar;

    const statusEl = document.getElementById('invoiceStatus');
    statusEl.className = 'badge ' + statusBadge;
    statusEl.textContent = statusLabel;

    const total = subtotal + 10000; // Mock Ongkir Rp 10.000
    document.getElementById('invoiceTotal').textContent = 'Rp ' + total.toLocaleString('id-ID');

    // Bukti bayar handling
    const buktiSection = document.getElementById('invoiceBuktiSection');
    const previewContainer = document.getElementById('invoiceBuktiPreviewContainer');
    const previewImg = document.getElementById('invoiceBuktiPreviewImg');
    const buktiForm = document.getElementById('invoiceBuktiForm');

    if (bayar === 'COD') {
      buktiSection.style.display = 'none';
    } else {
      buktiSection.style.display = 'flex';
      if (buktiBayar) {
        // Bukti bayar exists
        previewImg.src = buktiBayar;
        previewContainer.style.display = 'block';
        buktiForm.style.display = 'none';
      } else {
        // Bukti bayar doesn't exist
        previewContainer.style.display = 'none';
        previewImg.src = '';
        if (statusLabel.toLowerCase() === 'menunggu') {
          buktiForm.action = `/petani/pesanan/${id}/bukti`;
          buktiForm.style.display = 'flex';
        } else {
          buktiForm.style.display = 'none';
        }
      }
    }

    openModal('modalDetailBelanja');
  }

  // Set Plant Search tag filter
  function setPlantSearch(term) {
    const input = document.getElementById('tanamanSearchInput');
    if (input) {
      input.value = term;
      filterTanaman();
    }
  }

  // Shop First directory views
  let currentActiveTokoId = null;

  function showTokoDetail(id, name, address) {
    currentActiveTokoId = id;
    document.getElementById('allTokosListContainer').style.display = 'none';
    document.getElementById('globalProdukResultsContainer').style.display = 'none';
    
    const detailContainer = document.getElementById('tokoDetailContainer');
    detailContainer.classList.remove('tab-hidden');
    detailContainer.style.display = 'block';

    document.getElementById('detailTokoNama').textContent = name;
    document.getElementById('detailTokoAlamat').textContent = 'ðŸ“ ' + address;

    // Reset search
    document.getElementById('produkSearchInput').value = '';

    // Filter products
    let count = 0;
    const products = document.querySelectorAll('#detailTokoProdukGrid .prod-card');
    products.forEach(p => {
      if (parseInt(p.dataset.tokoId) === id) {
        p.style.display = '';
        count++;
      } else {
        p.style.display = 'none';
      }
    });

    document.getElementById('tokoDetailEmptyMessage').style.display = (count === 0) ? 'block' : 'none';
  }

  function hideTokoDetail() {
    currentActiveTokoId = null;
    const detailContainer = document.getElementById('tokoDetailContainer');
    detailContainer.classList.add('tab-hidden');
    detailContainer.style.display = 'none';

    document.getElementById('allTokosListContainer').style.display = 'block';
    
    // If global search has value, keep results showing
    const query = document.getElementById('globalProdukSearchInput').value.trim();
    if (query !== '') {
      filterGlobalProduk();
    }
  }

  function filterProduk() {
    const query = document.getElementById('produkSearchInput').value.toLowerCase().trim();
    const products = document.querySelectorAll('#detailTokoProdukGrid .prod-card');
    let count = 0;
    
    products.forEach(p => {
      if (parseInt(p.dataset.tokoId) === currentActiveTokoId) {
        const name = p.dataset.nama;
        if (name.includes(query)) {
          p.style.display = '';
          count++;
        } else {
          p.style.display = 'none';
        }
      }
    });

    document.getElementById('tokoDetailEmptyMessage').style.display = (count === 0) ? 'block' : 'none';
  }

  // Global search outside / inside toko tab
  function filterGlobalProduk() {
    const query = document.getElementById('globalProdukSearchInput').value.toLowerCase().trim();
    
    // Always hide toko detail when typing globally
    const detailContainer = document.getElementById('tokoDetailContainer');
    if (detailContainer) {
      detailContainer.classList.add('tab-hidden');

      detailContainer.style.display = 'none';
    }

    if (query === '') {
      document.getElementById('allTokosListContainer').style.display = 'block';
      document.getElementById('globalProdukResultsContainer').style.display = 'none';
    } else {
      document.getElementById('allTokosListContainer').style.display = 'none';
      document.getElementById('globalProdukResultsContainer').style.display = 'block';

      const products = document.querySelectorAll('#globalProdukGrid .global-prod-item');
      let count = 0;

      products.forEach(p => {
        const name = p.dataset.globalNama;
        if (name.includes(query)) {
          p.style.display = 'flex';
          count++;
        } else {
          p.style.display = 'none';
        }
      });

      document.getElementById('globalProdukEmptyMessage').style.display = (count === 0) ? 'block' : 'none';
    }
  }

  // Dashboard search box trigger
  function triggerDashboardSearch() {
    const val = document.getElementById('dashboardProdukSearchInput').value;
    const tokoTabButton = document.querySelector('.sbi[onclick*="showTab(\'toko\'"]') || document.querySelector('[onclick*="showTab(\'toko\'"]');
    showTab('toko', tokoTabButton);
    const globalInput = document.getElementById('globalProdukSearchInput');
    if (globalInput) {
      globalInput.value = val;
      filterGlobalProduk();
    }
  }

  // On DOM Load
  document.addEventListener('DOMContentLoaded', () => {
    updateCartFabCount();
  });

  // â”€â”€ Bunga Mekar saat Dashboard Pertama Dimuat â”€â”€
  window.addEventListener('load', function() {
    // Hanya tampilkan sekali per sesi (pakai sessionStorage)
    if (!sessionStorage.getItem('doctreen_bloom_shown')) {
      const overlay = document.getElementById('flower-intro-overlay');
      const flowerSvg = document.getElementById('flower-intro-svg');
      const lbl = document.getElementById('flowerIntroLbl');
      // Mulai animasi mekar
      setTimeout(() => { flowerSvg.classList.add('bloom'); }, 100);
      setTimeout(() => { lbl.classList.add('show'); }, 700);
      // Hilangkan overlay setelah animasi selesai
      setTimeout(() => {
        overlay.classList.add('fade-out');
        setTimeout(() => { overlay.style.display = 'none'; }, 900);
      }, 2000);
      sessionStorage.setItem('doctreen_bloom_shown', '1');
    } else {
      // Jika sudah ditampilkan, langsung sembunyikan
      document.getElementById('flower-intro-overlay').style.display = 'none';
    }
  });

  // â”€â”€ Pohon Layu saat Logout â”€â”€
  function triggerWiltLogout() {
    const overlay = document.getElementById('wilt-overlay');
    const wiltTree = document.getElementById('wilt-tree');
    const wiltLbl = document.getElementById('wiltLbl');
    overlay.classList.add('show');
    setTimeout(() => { wiltTree.classList.add('wilt'); }, 100);
    setTimeout(() => { wiltLbl.classList.add('show'); }, 900);
    setTimeout(() => {
      document.getElementById('logoutForm').submit();
    }, 1800);
  }
</script>
</body>
</html>
