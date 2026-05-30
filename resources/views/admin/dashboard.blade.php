<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0"><title>Dashboard Admin — Doctreen</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
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
      padding: 0 2rem 2rem; 
      border-bottom: 1px solid rgba(255,255,255,.05); 
      margin-bottom: 1.25rem;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .sb-logo img {
      width: 90px;
      height: auto;
      object-fit: contain;
      filter: drop-shadow(0 4px 12px rgba(196,242,215,0.2));
      transition: filter 0.3s ease;
    }
    .sb-logo img:hover {
      filter: drop-shadow(0 4px 18px rgba(196,242,215,0.4));
    }
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
    
    .sb-menu-container {
      display: flex;
      flex-direction: column;
      flex: 1;
      overflow-y: auto;
    }
    .sb-menu-container::-webkit-scrollbar {
      width: 6px;
    }
    .sb-menu-container::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.05);
      border-radius: 10px;
    }
    .sb-menu-container::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.25);
      border-radius: 10px;
    }
    .sb-menu-container::-webkit-scrollbar-thumb:hover {
      background: var(--mint);
    }
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
    .u-name {
      font-size: .85rem;
      color: #fff;
      font-weight: 600;
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
      flex-wrap: wrap;
      gap: 1.5rem;
    }
    .pg-title { 
      font-family: 'Playfair Display', serif; 
      font-size: 2.3rem; 
      color: var(--g800); 
      font-weight: 700;
      letter-spacing: -0.02em;
    }
    .pg-sub { font-size: .95rem; color: var(--tm); margin-top: 6px; font-weight: 500; }
    .tr {
      display: flex;
      align-items: center;
      gap: 1.25rem;
    }
    .nb {
      width: 42px;
      height: 42px;
      border-radius: 50%;
      background: var(--glass-bg);
      border: 1px solid var(--glass-border);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      position: relative;
      font-size: 1.1rem;
      transition: all 0.3s;
      box-shadow: var(--shadow-sm);
      backdrop-filter: blur(10px);
    }
    .nb:hover {
      transform: translateY(-2px);
      border-color: var(--g100);
      box-shadow: 0 4px 15px rgba(196, 242, 215, 0.3);
    }
    .nd {
      position: absolute;
      top: 10px;
      right: 10px;
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: var(--r400);
      border: 2px solid white;
    }

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
    .b-aktif, .b-selesai { background: var(--g50); color: var(--g600); border: 1px solid rgba(59,125,63,0.15); }
    .b-proses { background: var(--a50); color: var(--a400); border: 1px solid rgba(254,168,0,0.15); }
    .b-baru { background: var(--r50); color: var(--r400); border: 1px solid rgba(216,75,75,0.15); }
    .b-nonaktif { background: var(--gray50); color: var(--gray400); border: 1px solid var(--gray100); }
    
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
      margin-bottom: .75rem;
      display: flex;
      align-items: center;
      gap: 8px;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }
    .sc-num {
      font-family: 'Playfair Display', serif;
      font-size: 2.4rem;
      font-weight: 700;
      color: var(--g900);
      line-height: 1;
    }
    .sc-sub {
      font-size: .78rem;
      color: var(--g600);
      margin-top: .5rem;
      font-weight: 500;
    }
    .sc-sub.a {
      color: var(--a400);
    }

    /* ── GRID CONFIG ── */
    .grid2 {
      display: grid;
      grid-template-columns: 1.6fr 1fr;
      gap: 2rem;
      margin-bottom: 2rem;
    }
    .grid3 {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2rem;
      margin-bottom: 2rem;
    }

    @media (max-width: 1200px) {
      .grid2, .grid3 {
        grid-template-columns: 1fr;
      }
    }

    /* ── CARDS & SECTIONS ── */
    .card {
      background: var(--glass-bg);
      border: 1px solid var(--glass-border);
      border-radius: var(--radius-lg);
      padding: 2rem;
      backdrop-filter: blur(20px);
      box-shadow: var(--shadow-lg);
      margin-bottom: 2rem;
      position: relative;
      transition: all 0.3s;
    }
    .ct {
      font-family: 'Playfair Display', serif;
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--g900);
      margin-bottom: 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      letter-spacing: -0.01em;
    }
    .ct a {
      font-size: .85rem;
      color: var(--g600);
      text-decoration: none;
      font-weight: 600;
      cursor: pointer;
      background: none;
      border: none;
      font-family: 'DM Sans', sans-serif;
      transition: color 0.2s;
    }
    .ct a:hover {
      color: var(--g800);
    }

    /* ── TABLES ── */
    .tbl-wrapper {
      width: 100%;
      overflow-x: auto;
      margin-top: 0.5rem;
    }
    .tbl {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0 10px;
      font-size: .9rem;
    }
    .tbl th {
      text-align: left;
      padding: 1rem 1.25rem;
      color: var(--gray400);
      font-weight: 600;
      font-size: .8rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      border-bottom: 2px solid var(--gray100);
    }
    .tbl td {
      padding: 1.25rem;
      background: rgba(255, 255, 255, 0.4);
      border-top: 1px solid rgba(6, 47, 30, 0.02);
      border-bottom: 1px solid rgba(6, 47, 30, 0.02);
      transition: all 0.3s;
    }
    .tbl td:first-child {
      border-left: 1px solid rgba(6, 47, 30, 0.02);
      border-top-left-radius: var(--radius-sm);
      border-bottom-left-radius: var(--radius-sm);
    }
    .tbl td:last-child {
      border-right: 1px solid rgba(6, 47, 30, 0.02);
      border-top-right-radius: var(--radius-sm);
      border-bottom-right-radius: var(--radius-sm);
    }
    .tbl tr:hover td {
      background: rgba(255, 255, 255, 0.95);
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(6, 47, 30, 0.03);
      border-color: rgba(6, 47, 30, 0.06);
    }

    /* ── BADGES & LABELS ── */
    .badge {
      display: inline-flex;
      align-items: center;
      padding: .35rem .85rem;
      border-radius: 100px;
      font-size: .75rem;
      font-weight: 700;
      letter-spacing: 0.02em;
      box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.02);
    }
    .b-aktif { background: var(--g50); color: var(--g600); border: 1px solid rgba(15, 118, 67, 0.15); }
    .b-proses { background: var(--a50); color: var(--a400); border: 1px solid rgba(217, 119, 6, 0.15); }
    .b-selesai { background: var(--g50); color: var(--g600); border: 1px solid rgba(15, 118, 67, 0.15); }
    .b-baru { background: var(--r50); color: var(--r400); border: 1px solid rgba(220, 38, 38, 0.15); }
    .b-nonaktif { background: var(--gray50); color: var(--gray400); border: 1px solid var(--gray100); }

    /* ── BUTTONS ── */
    .btn-xs {
      padding: .45rem .9rem;
      border-radius: var(--radius-sm);
      font-size: .78rem;
      font-weight: 600;
      cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      border: 1px solid transparent;
      transition: all 0.2s;
    }
    .btn-xs.g {
      background: var(--g50);
      color: var(--g600);
      border-color: rgba(15, 118, 67, 0.15);
    }
    .btn-xs.g:hover {
      background: var(--g100);
    }
    .btn-xs.r {
      background: var(--r50);
      color: var(--r400);
      border-color: rgba(220, 38, 38, 0.15);
    }
    .btn-xs.r:hover {
      background: rgba(220, 38, 38, 0.1);
    }
    .btn-xs.a {
      background: var(--a50);
      color: var(--a400);
      border-color: rgba(217, 119, 6, 0.15);
    }
    .btn-xs.a:hover {
      background: rgba(217, 119, 6, 0.1);
    }
    .btn-sm {
      padding: .65rem 1.25rem;
      background: linear-gradient(135deg, var(--g600) 0%, var(--g800) 100%);
      color: white;
      border: none;
      border-radius: var(--radius-md);
      font-size: .85rem;
      font-weight: 600;
      cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      box-shadow: 0 4px 15px rgba(6, 47, 30, 0.15);
      transition: all 0.3s;
    }
    .btn-sm:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(6, 47, 30, 0.25);
    }
    .act-row {
      display: flex;
      gap: .5rem;
      flex-wrap: wrap;
    }

    /* ── USER ITEMS & TIMELINES ── */
    .u-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 1rem 0;
      border-bottom: 1px solid var(--gray100);
      transition: padding 0.2s;
    }
    .u-item:hover {
      padding-left: 5px;
    }
    .u-item:last-child {
      border-bottom: none;
    }
    .uav {
      width: 42px;
      height: 42px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: .9rem;
      font-weight: 700;
      flex-shrink: 0;
      box-shadow: var(--shadow-sm);
    }
    .uav.g { background: var(--g50); color: var(--g600); }
    .uav.t { background: var(--g100); color: var(--g800); }
    .uav.a { background: var(--a50); color: var(--a400); }
    .un {
      font-size: .9rem;
      font-weight: 600;
      color: var(--text);
    }
    .um {
      font-size: .78rem;
      color: var(--gray400);
      margin-top: 1px;
    }

    /* ── MODALS ── */
    .ov {
      position: fixed;
      inset: 0;
      background: rgba(3, 27, 17, 0.65);
      z-index: 200;
      display: none;
      align-items: flex-start;
      justify-content: center;
      padding: 2rem;
      overflow-y: auto;
      backdrop-filter: blur(12px);
      transition: all 0.3s;
    }
    .ov.show {
      display: flex;
      animation: fadeIn 0.3s forwards;
    }
    .modal {
      background: white;
      border-radius: var(--radius-lg);
      padding: 2.5rem;
      width: 100%;
      max-width: 580px;
      box-shadow: 0 40px 100px rgba(3, 27, 17, 0.25);
      margin: auto;
      border: 1px solid rgba(6, 47, 30, 0.05);
      transform: scale(0.95);
      opacity: 0;
      transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .ov.show .modal {
      transform: scale(1);
      opacity: 1;
    }
    .m-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.6rem;
      font-weight: 700;
      color: var(--g900);
      margin-bottom: 1.75rem;
      letter-spacing: -0.01em;
    }
    .fg {
      margin-bottom: 1.25rem;
    }
    .fg label {
      display: block;
      font-size: .85rem;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 6px;
    }
    .fg input, .fg textarea, .fg select {
      width: 100%;
      padding: .8rem 1rem;
      border: 1.5px solid var(--gray100);
      border-radius: var(--radius-sm);
      font-size: .9rem;
      font-family: 'DM Sans', sans-serif;
      color: var(--text);
      background: #fafcf9;
      outline: none;
      transition: all 0.3s;
    }
    .fg input:focus, .fg textarea:focus, .fg select:focus {
      border-color: var(--g600);
      background: white;
      box-shadow: 0 0 0 4px rgba(196, 242, 215, 0.4);
    }
    .fg textarea {
      resize: vertical;
      min-height: 100px;
    }
    .m-act {
      display: flex;
      gap: 1rem;
      margin-top: 2rem;
    }
    .btn-c {
      flex: 1;
      padding: .85rem;
      border: 1.5px solid var(--gray100);
      border-radius: var(--radius-sm);
      background: white;
      font-family: 'DM Sans', sans-serif;
      font-size: .95rem;
      font-weight: 600;
      cursor: pointer;
      color: var(--gray400);
      transition: all 0.2s;
    }
    .btn-c:hover {
      background: var(--gray50);
      border-color: var(--gray400);
    }
    .btn-s {
      flex: 2;
      padding: .85rem;
      background: linear-gradient(135deg, var(--g600) 0%, var(--g800) 100%);
      color: white;
      border: none;
      border-radius: var(--radius-sm);
      font-family: 'DM Sans', sans-serif;
      font-size: .95rem;
      font-weight: 600;
      cursor: pointer;
      box-shadow: 0 4px 15px rgba(6, 47, 30, 0.15);
      transition: all 0.3s;
    }
    .btn-s:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(6, 47, 30, 0.25);
    }
    .tab-hidden {
      display: none;
    }
    
    /* ── ALERTS & NOTIFICATIONS ── */
    .alert-item {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      padding: 1.1rem;
      border-radius: var(--radius-md);
      margin-bottom: 1rem;
      transition: all 0.2s;
    }
    .alert-item.r {
      background: var(--r50);
      border: 1px solid rgba(220, 38, 38, 0.15);
      color: var(--r600);
    }
    .alert-item.a {
      background: var(--a50);
      border: 1px solid rgba(217, 119, 6, 0.15);
      color: var(--a400);
    }
    .alert-item.g {
      background: var(--g50);
      border: 1px solid rgba(15, 118, 67, 0.15);
      color: var(--g600);
    }
    .al-ico {
      font-size: 1.3rem;
      flex-shrink: 0;
      margin-top: 1px;
    }
    .al-ttl {
      font-size: .88rem;
      font-weight: 700;
      color: var(--text);
    }
    .al-sub {
      font-size: .78rem;
      color: var(--gray400);
      margin-top: 2px;
    }

    /* ── CHART BAR GRAPH ── */
    .cht-bar {
      display: flex;
      flex-direction: column;
      gap: .9rem;
    }
    .cht-row {
      display: flex;
      align-items: center;
      gap: 1rem;
      font-size: .85rem;
    }
    .cht-lbl {
      width: 90px;
      color: var(--text);
      font-weight: 600;
      text-align: right;
      flex-shrink: 0;
    }
    .cht-track {
      flex: 1;
      height: 12px;
      background: var(--gray100);
      border-radius: 100px;
      overflow: hidden;
      box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
    }
    .cht-fill {
      height: 100%;
      border-radius: 100px;
      background: linear-gradient(90deg, var(--g200) 0%, var(--g600) 100%);
      transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .cht-fill.t { background: linear-gradient(90deg, var(--g100) 0%, var(--g400) 100%); }
    .cht-fill.a { background: linear-gradient(90deg, var(--a50) 0%, var(--a400) 100%); }
    .cht-val {
      width: 40px;
      font-weight: 700;
      color: var(--text);
    }

    /* ── TABS ── */
    .tabs-horiz {
      display: flex;
      gap: .5rem;
      margin-bottom: 1.75rem;
      border-bottom: 2px solid var(--gray100);
      padding-bottom: .75rem;
    }
    .th-btn {
      padding: .5rem 1.1rem;
      border-radius: var(--radius-sm);
      font-size: .85rem;
      font-weight: 600;
      cursor: pointer;
      border: none;
      background: none;
      color: var(--gray400);
      font-family: 'DM Sans', sans-serif;
      transition: all 0.3s;
    }
    .th-btn.active {
      background: var(--g50);
      color: var(--g600);
    }

    /* ── PUSTAKA TANAMAN GRID ── */
    .search-box {
      padding: .75rem 1.1rem;
      border: 1.5px solid var(--gray100);
      border-radius: var(--radius-sm);
      font-size: .88rem;
      width: 260px;
      outline: none;
      font-family: 'DM Sans', sans-serif;
      background: white;
      transition: all 0.3s;
    }
    .search-box:focus {
      border-color: var(--g600);
      box-shadow: 0 0 0 4px rgba(196, 242, 215, 0.4);
    }
    .tanaman-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
      gap: 2rem;
      margin-top: 1.5rem;
    }
    .t-card {
      background: var(--glass-bg);
      border: 1px solid var(--glass-border);
      border-radius: var(--radius-lg);
      padding: 1.75rem;
      box-shadow: var(--shadow-lg);
      backdrop-filter: blur(20px);
      transition: all 0.3s;
      position: relative;
    }
    .t-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 20px 40px rgba(6, 47, 30, 0.08);
      border-color: var(--g100);
    }
    .t-header {
      display: flex;
      align-items: center;
      gap: 15px;
      border-bottom: 1px dashed var(--gray100);
      padding-bottom: 1.25rem;
      margin-bottom: 1.25rem;
      position: relative;
    }
    .t-icon {
      width: 52px;
      height: 52px;
      border-radius: var(--radius-md);
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      background: var(--g50);
      box-shadow: var(--shadow-sm);
      flex-shrink: 0;
    }
    .t-icon img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .t-name {
      font-family: 'Playfair Display', serif;
      font-size: 1.3rem;
      font-weight: 700;
      color: var(--g900);
    }
    .t-latin {
      font-size: .85rem;
      color: var(--gray400);
      font-style: italic;
      margin-top: 1px;
    }
    .t-actions-wrapper {
      position: absolute;
      right: 0;
      top: 0;
      display: flex;
      gap: 6px;
      align-items: center;
      flex-wrap: wrap;
      justify-content: flex-end;
    }
    .t-edit-btn, .t-delete-btn {
      background: none;
      border: none;
      cursor: pointer;
      font-size: .8rem;
      font-weight: 700;
      font-family: 'DM Sans', sans-serif;
      padding: .2rem .4rem;
      border-radius: 4px;
      transition: all 0.2s;
    }
    .t-edit-btn { color: var(--g600); }
    .t-edit-btn:hover { background: var(--g50); }
    .t-delete-btn { color: var(--r400); }
    .t-delete-btn:hover { background: var(--r50); }
    
    .t-section {
      margin-bottom: 1.1rem;
      font-size: .88rem;
    }
    .t-section-title {
      font-weight: 700;
      font-size: .8rem;
      text-transform: uppercase;
      color: var(--g600);
      letter-spacing: .08em;
      margin-bottom: 5px;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .t-section-desc {
      color: var(--tm);
      line-height: 1.6;
    }
    .t-danger-list {
      display: flex;
      flex-direction: column;
      gap: 6px;
      margin-top: 6px;
    }
    .t-danger-item {
      background: var(--r50);
      color: var(--r400);
      padding: .4rem .8rem;
      border-radius: var(--radius-sm);
      font-size: .8rem;
      font-weight: 600;
      border: 1px solid rgba(220, 38, 38, 0.1);
    }
    .topbar-actions {
      display: flex;
      gap: 12px;
      align-items: center;
    }
    .table-prod-img {
      width: 38px;
      height: 38px;
      border-radius: var(--radius-sm);
      object-fit: cover;
      border: 1px solid var(--gray100);
    }

    /* ── IMAGE PREVIEWS ── */
    .img-preview-wrap {
      width: 100%;
      height: 130px;
      border: 2px dashed var(--gray100);
      border-radius: var(--radius-md);
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      margin-bottom: .5rem;
      background: #fafcf9;
      cursor: pointer;
      transition: all 0.3s;
    }
    .img-preview-wrap:hover {
      border-color: var(--g600);
      background: var(--g50);
    }
    .img-preview-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .img-preview-wrap .ph {
      color: var(--gray400);
      text-align: center;
      font-size: .85rem;
      pointer-events: none;
    }
    .img-preview-wrap .ph span {
      font-size: 1.8rem;
      display: block;
      margin-bottom: 4px;
    }
    .avatar-preview-wrap {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      border: 2px dashed var(--gray100);
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      cursor: pointer;
      background: #fafcf9;
      transition: all 0.3s;
      flex-shrink: 0;
    }
    .avatar-preview-wrap:hover {
      border-color: var(--g600);
      background: var(--g50);
    }
    .avatar-preview-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .avatar-preview-wrap .ph {
      color: var(--gray400);
      text-align: center;
      font-size: .8rem;
      pointer-events: none;
    }
    .avatar-preview-wrap .ph span {
      font-size: 1.6rem;
      display: block;
    }
    .avatar-row {
      display: flex;
      align-items: center;
      gap: 1.5rem;
      margin-bottom: 1.25rem;
    }
    .avatar-row-info {
      font-size: .8rem;
      color: var(--gray400);
      line-height: 1.6;
    }

    /* ── VIDEO SECTIONS ── */
    .video-list {
      display: flex;
      flex-direction: column;
      gap: .75rem;
      margin-top: .5rem;
    }
    .video-item {
      background: rgba(255,255,255,0.6);
      border: 1px solid var(--gray100);
      border-radius: var(--radius-md);
      overflow: hidden;
    }
    .video-item-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: .75rem 1.1rem;
      background: var(--g50);
      border-bottom: 1px solid var(--gray100);
    }
    .v-name {
      font-size: .88rem;
      font-weight: 700;
      color: var(--g800);
    }
    .v-sub {
      font-size: .75rem;
      color: var(--gray400);
      margin-top: 1px;
    }
    .video-embed {
      width: 100%;
      height: 180px;
      background: var(--g900);
    }
    .video-embed iframe, .video-embed video {
      width: 100%;
      height: 100%;
      display: block;
    }

    /* ── TOGGLE SETTINGS ── */
    .setting-toggle-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1.1rem;
      border: 1.5px solid var(--gray100);
      border-radius: var(--radius-md);
      margin-bottom: .75rem;
      background: #fafcf9;
      transition: all 0.3s;
    }
    .setting-toggle-row:hover {
      border-color: var(--g200);
    }
    .toggle-label {
      font-size: .9rem;
      font-weight: 600;
      color: var(--text);
    }
    .toggle-sub {
      font-size: .78rem;
      color: var(--gray400);
      margin-top: 2px;
    }
    .toggle-switch {
      position: relative;
      width: 48px;
      height: 26px;
      flex-shrink: 0;
    }
    .toggle-switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }
    .toggle-slider {
      position: absolute;
      inset: 0;
      background: var(--gray100);
      border-radius: 100px;
      cursor: pointer;
      transition: .3s;
    }
    .toggle-slider:before {
      content: '';
      position: absolute;
      width: 20px;
      height: 20px;
      left: 3px;
      bottom: 3px;
      background: white;
      border-radius: 50%;
      transition: .3s;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .toggle-switch input:checked + .toggle-slider {
      background: linear-gradient(135deg, var(--g400) 0%, var(--g600) 100%);
    }
    .toggle-switch input:checked + .toggle-slider:before {
      transform: translateX(22px);
    }
    .setting-section-title {
      font-size: .82rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .1em;
      color: var(--g600);
      margin-bottom: 1.1rem;
      margin-top: 1rem;
    }

    /* ── PILLS ── */
    .method-pill {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: .25rem .75rem;
      border-radius: 100px;
      font-size: .75rem;
      font-weight: 700;
    }
    .mp-bayar { background: var(--a50); color: var(--a400); border: 1px solid rgba(217, 119, 6, 0.15); }
    .mp-kirim { background: var(--t50); color: var(--t400); border: 1px solid rgba(45, 106, 79, 0.15); }
    .mp-none { background: var(--gray50); color: var(--gray400); border: 1px solid var(--gray100); }

    .vtab-btn {
      flex: 1;
      padding: .65rem;
      border-radius: var(--radius-sm);
      font-size: .85rem;
      font-weight: 600;
      cursor: pointer;
      border: 1.5px solid var(--gray100);
      background: white;
      font-family: 'DM Sans', sans-serif;
      color: var(--gray400);
      transition: all 0.3s;
    }
    .vtab-btn.active {
      background: linear-gradient(135deg, var(--g600) 0%, var(--g800) 100%);
      color: white;
      border-color: transparent;
      box-shadow: 0 4px 10px rgba(6, 47, 30, 0.15);
    }

    .sub-tabs {
      display: flex;
      gap: 10px;
      margin-bottom: 2rem;
      border-bottom: 2px solid var(--gray100);
      padding-bottom: 10px;
    }
    .sub-tabs button {
      padding: .65rem 1.4rem;
      background: none;
      border: none;
      font-family: 'DM Sans', sans-serif;
      font-size: .9rem;
      font-weight: 600;
      color: var(--gray400);
      cursor: pointer;
      border-radius: var(--radius-sm);
      transition: all 0.3s;
    }
    .sub-tabs button.active {
      background: linear-gradient(135deg, var(--g600) 0%, var(--g800) 100%);
      color: white;
      box-shadow: 0 4px 10px rgba(6, 47, 30, 0.15);
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    /* ── KONSULTAN PROFILE DRAWER ── */
    .kpd-backdrop {
      position: fixed;
      inset: 0;
      background: rgba(3, 27, 17, 0.55);
      backdrop-filter: blur(8px);
      z-index: 300;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.35s ease;
    }
    .kpd-backdrop.show {
      opacity: 1;
      pointer-events: all;
    }
    .kpd-drawer {
      position: fixed;
      top: 0;
      right: 0;
      width: 420px;
      max-width: 95vw;
      height: 100vh;
      background: white;
      z-index: 301;
      display: flex;
      flex-direction: column;
      box-shadow: -20px 0 60px rgba(3, 27, 17, 0.18);
      transform: translateX(100%);
      transition: transform 0.38s cubic-bezier(0.34, 1.56, 0.64, 1);
      overflow: hidden;
    }
    .kpd-drawer.show {
      transform: translateX(0);
    }
    .kpd-header {
      background: linear-gradient(135deg, var(--g800) 0%, var(--g600) 100%);
      padding: 1.8rem 1.6rem 1.4rem;
      position: relative;
      flex-shrink: 0;
    }
    .kpd-close {
      position: absolute;
      top: 1rem;
      right: 1rem;
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: rgba(255,255,255,0.12);
      border: 1px solid rgba(255,255,255,0.18);
      color: white;
      font-size: 1rem;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s;
    }
    .kpd-close:hover {
      background: rgba(255,255,255,0.25);
      transform: rotate(90deg);
    }
    .kpd-avatar {
      width: 72px;
      height: 72px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--g100) 0%, var(--g200) 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.6rem;
      font-weight: 700;
      color: var(--g900);
      border: 3px solid rgba(255,255,255,0.3);
      overflow: hidden;
      margin-bottom: 1rem;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }
    .kpd-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .kpd-name {
      font-family: 'Playfair Display', serif;
      font-size: 1.35rem;
      font-weight: 700;
      color: white;
      letter-spacing: -0.01em;
      margin-bottom: 0.3rem;
    }
    .kpd-specialty {
      font-size: .82rem;
      color: rgba(255,255,255,0.7);
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .kpd-status-badge {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      padding: .3rem .8rem;
      border-radius: 100px;
      font-size: .72rem;
      font-weight: 700;
      margin-top: 0.7rem;
    }
    .kpd-status-badge.aktif   { background: rgba(196,242,215,0.2); color: var(--g100); border: 1px solid rgba(196,242,215,0.3); }
    .kpd-status-badge.verifikasi { background: rgba(217,119,6,0.2); color: #fde68a; border: 1px solid rgba(217,119,6,0.3); }
    .kpd-status-badge.nonaktif  { background: rgba(220,38,38,0.2); color: #fca5a5; border: 1px solid rgba(220,38,38,0.3); }
    .kpd-body {
      flex: 1;
      overflow-y: auto;
      padding: 1.6rem;
    }
    .kpd-section {
      margin-bottom: 1.5rem;
    }
    .kpd-sec-title {
      font-size: .7rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .12em;
      color: var(--gray400);
      margin-bottom: 0.8rem;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .kpd-sec-title::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--gray100);
    }
    .kpd-info-row {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      padding: 0.65rem 0;
      border-bottom: 1px solid var(--gray100);
      font-size: .87rem;
    }
    .kpd-info-row:last-child { border-bottom: none; }
    .kpd-info-ico {
      width: 28px;
      height: 28px;
      border-radius: 8px;
      background: var(--g50);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: .9rem;
      flex-shrink: 0;
      margin-top: 1px;
    }
    .kpd-info-label {
      font-size: .73rem;
      color: var(--gray400);
      margin-bottom: 2px;
    }
    .kpd-info-val {
      font-weight: 600;
      color: var(--text);
    }
    .kpd-doc-card {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: .75rem 1rem;
      background: var(--g50);
      border: 1px solid var(--g100);
      border-radius: var(--radius-sm);
      margin-bottom: 0.5rem;
      transition: all 0.2s;
    }
    .kpd-doc-card:hover {
      background: var(--g100);
      transform: translateX(3px);
    }
    .kpd-doc-ico {
      font-size: 1.4rem;
      flex-shrink: 0;
    }
    .kpd-doc-name {
      flex: 1;
      font-size: .82rem;
      font-weight: 600;
      color: var(--g800);
    }
    .kpd-doc-actions {
      display: flex;
      gap: 6px;
    }
    .kpd-doc-btn {
      padding: .3rem .65rem;
      border-radius: 7px;
      font-size: .72rem;
      font-weight: 700;
      cursor: pointer;
      border: none;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 3px;
      transition: all 0.2s;
    }
    .kpd-doc-btn.view { background: white; color: var(--g600); border: 1px solid var(--g100); }
    .kpd-doc-btn.view:hover { background: var(--g600); color: white; }
    .kpd-doc-btn.download { background: var(--g600); color: white; }
    .kpd-doc-btn.download:hover { background: var(--g800); }
    .kpd-footer {
      padding: 1.2rem 1.6rem;
      border-top: 1px solid var(--gray100);
      display: flex;
      flex-direction: column;
      gap: .6rem;
      flex-shrink: 0;
      background: var(--gray50);
    }
    .kpd-act-row {
      display: flex;
      gap: .6rem;
    }
    .kpd-btn {
      flex: 1;
      padding: .75rem;
      border-radius: var(--radius-sm);
      font-size: .85rem;
      font-weight: 700;
      cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      border: none;
      transition: all 0.25s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
    }
    .kpd-btn.edit { background: var(--g50); color: var(--g600); border: 1.5px solid var(--g100); }
    .kpd-btn.edit:hover { background: var(--g100); transform: translateY(-2px); }
    .kpd-btn.verify { background: linear-gradient(135deg, #d97706 0%, #92400e 100%); color: white; box-shadow: 0 4px 12px rgba(217,119,6,0.25); }
    .kpd-btn.verify:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(217,119,6,0.35); }
    .kpd-btn.del { background: var(--r50); color: var(--r400); border: 1.5px solid rgba(220,38,38,0.15); }
    .kpd-btn.del:hover { background: rgba(220,38,38,0.1); transform: translateY(-2px); }
    .kpd-btn-primary {
      width: 100%;
      padding: .9rem;
      border-radius: var(--radius-sm);
      font-size: .9rem;
      font-weight: 700;
      cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      border: none;
      background: linear-gradient(135deg, var(--g600) 0%, var(--g800) 100%);
      color: white;
      box-shadow: 0 4px 15px rgba(6,47,30,0.2);
      transition: all 0.25s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }
    .kpd-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(6,47,30,0.3); }
    /* Lihat Profil button in table */
    .btn-profil {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: .5rem 1rem;
      background: linear-gradient(135deg, var(--g800) 0%, var(--g600) 100%);
      color: white;
      border: none;
      border-radius: var(--radius-sm);
      font-size: .8rem;
      font-weight: 700;
      cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      box-shadow: 0 3px 10px rgba(6,47,30,0.15);
      transition: all 0.25s;
      white-space: nowrap;
    }
    .btn-profil:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(6,47,30,0.25);
    }

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
      background-image: linear-gradient(135deg, rgba(243, 248, 238, 0.88) 0%, rgba(255, 255, 255, 0.94) 100%), url('/images/admin_bg.png');
      background-size: cover;
      background-position: center;
      filter: blur(4px); /* Soft blur to keep dashboard UI elements perfectly readable */
      transform-origin: center center;
      animation: slowPanAdmin 45s infinite ease-in-out;
    }

    @keyframes slowPanAdmin {
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
  <!-- High-Tech Modern Greenhouse Dynamic Background -->
  <div class="dashboard-bg-container">
    <div class="dashboard-pan-bg"></div>
  </div>

<aside class="sb">
  <div class="sb-logo"><img src="/images/doctreen_logo.png" alt="Doctreen — Nature's Doctor" title="Doctreen"></div>
  
  <div class="sb-menu-container">
  <span class="sb-lbl">Menu Utama</span>
  <button class="sbi active" onclick="showTab('dashboard',this)"><span class="sbi-ico">📊</span>Dashboard</button>
  <button class="sbi" onclick="showTab('petani',this)"><span class="sbi-ico">🌾</span>Data Petani</button>
  <button class="sbi" onclick="showTab('konsultan',this)"><span class="sbi-ico">👨‍🌾</span>Data Konsultan</button>
    <button class="sbi" onclick="showTab('tanaman',this)"><span class="sbi-ico">🌱</span>Data Tanaman</button>
  <button class="sbi" onclick="showTab('keluhan',this)"><span class="sbi-ico">🗡</span>Keluhan Masuk</button>
    <button class="sbi" onclick="showTab('toko',this)"><span class="sbi-ico">🏪</span>Toko &amp; Produk</button>
  <button class="sbi" onclick="showTab('riwayat',this)"><span class="sbi-ico">📋</span>Riwayat</button>
  <span class="sb-lbl">Sistem</span>
    <button class="sbi" onclick="showTab('pengaturan',this)"><span class="sbi-ico">⚙️</span>Pengaturan</button>
  </div>

  <div class="sb-bot">
    <div class="u-card">
      <div class="u-av">AD</div>
      <div style="flex: 1;">
        <div class="u-name">Admin Doctreen</div>
        <div class="u-role">Super Admin</div>
      </div>
      <form action="{{ route('loginadmin') }}" method="POST" id="logoutForm" style="margin:0;">
        @csrf
        <button type="button" onclick="document.getElementById('logoutForm').submit()" style="background:none;border:none;color:var(--r400);cursor:pointer;padding:8px;border-radius:8px;transition:all 0.2s;" onmouseover="this.style.background='rgba(216,75,75,0.1)'" onmouseout="this.style.background='none'" title="Keluar">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
        </button>
      </form>
    </div>
  </div>
</aside>

<main class="main">
    @if(session('success'))
        <div class="card" style="border-color:rgba(99,153,34,.2);margin-bottom:1rem;">
            <div style="color:var(--g600);font-weight:600;">{{ session('success') }}</div>
        </div>
    @endif
    @if($errors->any())
        <div class="card alert-item r" style="margin-bottom:1rem;border-color:#f5c6c6;background:#FDE8E8;display:block;padding:1rem;">
            <div style="font-weight:600;margin-bottom:5px;color:var(--r600);">⚠️ Terdapat Kesalahan Validasi:</div>
            <ul style="margin-left:20px;font-size:.85rem;color:var(--text);">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
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
    <div class="sc a"><div class="sc-lbl">🌱 Jenis Tanaman</div><div class="sc-num">{{ count($tanamans ?? []) }}</div><div class="sc-sub">Sistem Edukasi</div></div>
    <div class="sc a"><div class="sc-lbl">💬 Keluhan Aktif</div><div class="sc-num">{{ $totalKeluhan }}</div><div class="sc-sub a">{{ $selesai }} sudah selesai</div></div>
    <div class="sc r"><div class="sc-lbl">🏪 Total Toko</div><div class="sc-num">{{ count($tokos) }}</div><div class="sc-sub">Mitra terdaftar</div></div>
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
        @php 
          $maxGrafik = max($totalKeluhan, 1);
          $valJan = min(45, $maxGrafik); $pctJan = ($valJan / $maxGrafik) * 100;
          $valFeb = min(62, $maxGrafik); $pctFeb = ($valFeb / $maxGrafik) * 100;
          $valMar = min($totalKeluhan, $maxGrafik); $pctMar = ($valMar / $maxGrafik) * 100;
        @endphp
        <div class="cht-row"><span class="cht-lbl">Jan</span><div class="cht-track"><div class="cht-fill" style="width: {{ $pctJan }}%"></div></div><span class="cht-val">{{ $valJan }}</span></div>
        <div class="cht-row"><span class="cht-lbl">Feb</span><div class="cht-track"><div class="cht-fill" style="width: {{ $pctFeb }}%"></div></div><span class="cht-val">{{ $valFeb }}</span></div>
        <div class="cht-row"><span class="cht-lbl">Mar (Aktif)</span><div class="cht-track"><div class="cht-fill t" style="width: {{ $pctMar }}%"></div></div><span class="cht-val">{{ $valMar }}</span></div>
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
          $petaniName = $k->petani->nama ?? '—';
        @endphp
        <div class="u-item">
          <div class="uav {{ $avatarClass }}">{{ strtoupper(substr($petaniName,0,2)) }}</div>
          <div style="flex:1"><div class="un">{{ $k->judul_keluhan }}</div><div class="um">{{ $petaniName }} · {{ $k->tanggal_keluhan }}</div></div>
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
          <div style="flex:1"><div class="un">{{ $name }}</div><div class="um">{{ $c->keahlian??'—' }}</div></div>
          <span style="font-size:.8rem;color:#f5a623">★</span>
        </div>
      @empty
        <div class="u-item"><div style="flex:1;color:var(--gray400);font-size:.85rem">Belum ada data konsultan</div></div>
      @endforelse
    </div>
    <div class="card">
      <div class="ct">Distribusi Kategori Keluhan</div>
      <div class="cht-bar">
        @php 
          $totalSpesies = max(count($tanamans ?? []), 1);
          $pctPadi = ($totalKeluhan > 0) ? min(72, 100) : 0;
        @endphp
        <div class="cht-row"><span class="cht-lbl">Padi</span><div class="cht-track"><div class="cht-fill" style="width: {{ $pctPadi }}%"></div></div><span class="cht-val">{{ $pctPadi }}%</span></div>
        <div class="cht-row"><span class="cht-lbl">Komoditas Lain</span><div class="cht-track"><div class="cht-fill a" style="width: 25%"></div></div><span class="cht-val">25%</span></div>
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
              <div class="uav g" style="width:36px;height:36px;font-size:.8rem;overflow:hidden;">
                @if(!empty($p->foto_profil))
                  <img src="{{ asset('storage/'.$p->foto_profil) }}" style="width:100%;height:100%;object-fit:cover;border-radius:50%">
                @elseif(!empty($p->user->foto_profil))
                  <img src="{{ asset('storage/'.$p->user->foto_profil) }}" style="width:100%;height:100%;object-fit:cover;border-radius:50%">
                @else
                  {{ strtoupper(substr($petaniName,0,2)) }}
                @endif
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
              <div class="uav g" style="width:36px;height:36px;font-size:.8rem;overflow:hidden;">
                @if(!empty($k->foto_profil))
                  <img src="{{ asset('storage/'.$k->foto_profil) }}" style="width:100%;height:100%;object-fit:cover;border-radius:50%">
                @elseif(!empty($k->user->foto_profil))
                  <img src="{{ asset('storage/'.$k->user->foto_profil) }}" style="width:100%;height:100%;object-fit:cover;border-radius:50%">
                @else
                  {{ strtoupper(substr($k->nama??'K',0,2)) }}
                @endif
              </div>
            </td>
            <td><div style="font-size:.85rem;font-weight:500">{{ $k->nama??'-' }}</div></td>
            <td>{{ $k->telepon??$k->user->telepon??'-' }}</td>
            <td>
              {{ $k->keahlian??'-' }}
              @if(!empty($k->dokumen_tipe))
                <div style="font-size:.72rem;color:var(--gray500);margin-top:4px;">{{ $k->dokumen_tipe }}</div>
              @endif
              @if(!empty($k->dokumen_path))
                @php
                  // Cek apakah dokumen_path adalah JSON array (multi-file) atau string tunggal
                  $dokPaths = [];
                  $decoded = json_decode($k->dokumen_path, true);
                  if (is_array($decoded)) {
                    $dokPaths = $decoded;
                  } elseif (!empty($k->dokumen_path)) {
                    $dokPaths = [$k->dokumen_path];
                  }
              @endphp
                @if(!empty($dokPaths))
                  <div style="margin-top:6px;display:flex;flex-wrap:wrap;gap:5px;">
                    @foreach($dokPaths as $dokIdx => $dokPath)
                      @php
                        $ext = strtolower(pathinfo($dokPath, PATHINFO_EXTENSION));
                        $isPdf = $ext === 'pdf';
                        $isImg = in_array($ext, ['jpg','jpeg','png','webp']);
                        $isDoc = in_array($ext, ['doc','docx']);
                        $fileIco = $isPdf ? '📄' : ($isImg ? '🖼️' : ($isDoc ? '📝' : '📎'));
                        $fileLabel = 'File ' . ($dokIdx + 1);
                      @endphp
                      <a href="{{ asset('storage/'.$dokPath) }}" target="_blank"
                         style="display:inline-flex;align-items:center;gap:3px;background:var(--g50);
                                border:1px solid var(--g100);border-radius:5px;padding:2px 7px;
                                font-size:.68rem;color:var(--g600);text-decoration:none;font-weight:600;"
                         title="Buka {{ $fileLabel }}"
                      >{{ $fileIco }} {{ $fileLabel }}</a>
                    @endforeach
                  </div>
                @endif
              @endif
            </td>
            <td>@php $biaya=$k->tarif_konsultasi??$k->biaya;echo(!empty($biaya)||$biaya===0)?'Rp '.number_format((int)$biaya*1000,0,',','.'):'Rp -'; @endphp</td>
            @php
              $ratings = \App\Models\Keluhan::whereHas('konsultasi', function($q) use ($k) {
                  $q->where('id_konsultan', $k->id)->where('status', 'selesai');
              })->whereNotNull('rating')->pluck('rating');
              $avgRating = $ratings->count() > 0 ? round($ratings->average(), 1) : null;
            @endphp
            <td>
              @if($avgRating)
                @php $fullStars = round($avgRating); @endphp
                <div style="color: #FFA800; font-weight: bold; font-size: 0.85rem; white-space: nowrap;">
                  {{ str_repeat('★', $fullStars) }}{{ str_repeat('☆', 5 - $fullStars) }}
                  <span style="color:var(--gray400); font-size:0.72rem; font-weight:normal;">({{ number_format($avgRating, 1) }})</span>
                </div>
              @else
                <span style="color:var(--gray400); font-size:0.75rem; font-style:italic;">Belum ada ulasan</span>
                @endif
            </td>
            <td>
              @php
                $statusKons = $k->status ?? 'verifikasi';
                $statusBadge = $statusKons === 'aktif' ? 'b-aktif' : ($statusKons === 'nonaktif' ? 'b-nonaktif' : 'b-proses');
              @endphp
              <span class="badge {{ $statusBadge }}">{{ ucfirst($statusKons) }}</span>
            </td>
            <td>
              @php
                $dokPaths2 = [];
                $decoded2 = json_decode($k->dokumen_path ?? '', true);
                if (is_array($decoded2)) {
                  $dokPaths2 = $decoded2;
                } elseif (!empty($k->dokumen_path)) {
                  $dokPaths2 = [$k->dokumen_path];
                }
                $verifikasiUrl2 = route('admin.konsultan.verifikasi', $k->id);
                $hapusUrl2 = route('admin.konsultan.hapus', $k->id);
                $fotoUrl2 = !empty($k->foto_profil) ? asset('storage/'.$k->foto_profil) : (!empty($k->user->foto_profil) ? asset('storage/'.$k->user->foto_profil) : '');
                $dokJsonEncoded = htmlspecialchars(json_encode(array_map(fn($p) => ['path' => $p, 'url' => asset('storage/'.$p)], $dokPaths2)), ENT_QUOTES, 'UTF-8');
              @endphp
              <button type="button" class="btn-profil"
                data-id="{{ $k->id }}"
                data-nama="{{ $k->nama }}"
                data-email="{{ $k->user->email??'' }}"
                data-telepon="{{ $k->user->telepon??'' }}"
                data-keahlian="{{ $k->keahlian??'' }}"
                data-tarif="{{ $k->tarif_konsultasi??'' }}"
                data-status="{{ $k->status??'verifikasi' }}"
                data-dokumen-tipe="{{ $k->dokumen_tipe ?? '' }}"
                data-foto="{{ $fotoUrl2 }}"
                data-verifikasi-url="{{ $verifikasiUrl2 }}"
                data-hapus-url="{{ $hapusUrl2 }}"
                data-status-aktif="{{ ($k->status??'')!=='aktif' ? '1' : '0' }}"
                data-dokumens='{{ $dokJsonEncoded }}'
                onclick="openKonsultanProfil(this)"
              >👁 Lihat Profil</button>
            </td>
          </tr>
        @empty
          <tr><td colspan="7" style="color:var(--gray400);text-align:center;padding:1rem">Belum ada data konsultan</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<!-- ── KONSULTAN PROFILE DRAWER ── -->
<div class="kpd-backdrop" id="kpdBackdrop" onclick="closeKonsultanProfil()"></div>
<div class="kpd-drawer" id="kpdDrawer">
  <div class="kpd-header">
    <button class="kpd-close" onclick="closeKonsultanProfil()">✕</button>
    <div class="kpd-avatar" id="kpdAvatar">KS</div>
    <div class="kpd-name" id="kpdName">—</div>
    <div class="kpd-specialty" id="kpdSpecialty"><span>🌿</span><span id="kpdSpecialtyText">—</span></div>
    <div class="kpd-status-badge" id="kpdStatusBadge">—</div>
  </div>
  <div class="kpd-body">
    <div class="kpd-section">
      <div class="kpd-sec-title">📋 Informasi Kontak</div>
      <div class="kpd-info-row">
        <div class="kpd-info-ico">✉️</div>
        <div><div class="kpd-info-label">Alamat Email</div><div class="kpd-info-val" id="kpdEmail">—</div></div>
      </div>
      <div class="kpd-info-row">
        <div class="kpd-info-ico">📱</div>
        <div><div class="kpd-info-label">Nomor Kontak</div><div class="kpd-info-val" id="kpdTelepon">—</div></div>
      </div>
    </div>
    <div class="kpd-section">
      <div class="kpd-sec-title">💼 Detail Profesional</div>
      <div class="kpd-info-row">
        <div class="kpd-info-ico">🎓</div>
        <div><div class="kpd-info-label">Spesialisasi / Keahlian</div><div class="kpd-info-val" id="kpdKeahlian">—</div></div>
      </div>
      <div class="kpd-info-row">
        <div class="kpd-info-ico">💰</div>
        <div><div class="kpd-info-label">Tarif Konsultasi (per sesi)</div><div class="kpd-info-val" id="kpdTarif">—</div></div>
      </div>
      <div class="kpd-info-row" id="kpdDokTipeRow" style="display:none">
        <div class="kpd-info-ico">📂</div>
        <div><div class="kpd-info-label">Jenis Dokumen</div><div class="kpd-info-val" id="kpdDokTipe">—</div></div>
      </div>
    </div>
    <div class="kpd-section" id="kpdDocsSection">
      <div class="kpd-sec-title">📄 Dokumen & Portofolio</div>
      <div id="kpdDocsList"></div>
    </div>
    <!-- hidden forms for verifikasi & hapus -->
    <form id="kpdVerifikasiForm" method="POST" action="" style="display:none">@csrf</form>
    <form id="kpdHapusForm" method="POST" action="" style="display:none">@csrf @method('DELETE')</form>
  </div>
  <div class="kpd-footer">
    <div class="kpd-act-row">
      <button type="button" class="kpd-btn edit" id="kpdBtnEdit" onclick="kpdEditAction()">✏️ Edit</button>
      <button type="button" class="kpd-btn verify" id="kpdBtnVerify" onclick="kpdVerifyAction()">✅ Verifikasi</button>
    </div>
    <button type="button" class="kpd-btn del" onclick="kpdHapusAction()">🗑️ Hapus Konsultan</button>
  </div>
</div>

<div id="tab-tanaman" class="tab-hidden">
  <div class="topbar">
    <div>
      <div class="pg-title">Ensiklopedia Komoditas & Pustaka Proteksi</div>
      <div class="pg-sub">Panduan klinis perawatan tanaman, metode pengobatan penyakit, and bahaya patogen.</div>
    </div>
    <div class="topbar-actions">
      <input type="text" id="pustakaSearch" class="search-box" placeholder="Cari nama komoditas tanaman..." onkeyup="cariTanaman()">
      <button type="button" class="btn-sm" onclick="openModal('modalAddTanaman')">➕ Tambah Komoditas</button>
    </div>
  </div>
  <div class="tanaman-grid" id="containerPustaka">
    @forelse($tanamans??[] as $tn)
      <div class="t-card" data-id="{{ $tn->id }}">
        <div class="t-header">
          <div class="t-icon">
            @if(!empty($tn->foto_tanaman))
              <img src="{{ asset('storage/'.$tn->foto_tanaman) }}" alt="{{ $tn->nama_tanaman }}">
            @else
              🌱
            @endif
          </div>
          <div>
            <div class="t-name">{{ $tn->nama_tanaman }}</div>
            <div class="t-latin">{{ $tn->nama_latin??'Species sp.' }}</div>
          </div>
          <div class="t-actions-wrapper">
            <button class="t-edit-btn"
                    data-id="{{ $tn->id }}"
                    data-nama="{{ $tn->nama_tanaman }}"
                    data-latin="{{ $tn->nama_latin??'' }}"
                    data-perawatan="{{ $tn->metode_perawatan??'' }}"
                    data-pengobatan="{{ $tn->protokol_pengobatan??'' }}"
                    data-ancaman1="{{ is_array($tn->ancaman_hama)&&isset($tn->ancaman_hama[0])?$tn->ancaman_hama[0]:'' }}"
                    data-ancaman2="{{ is_array($tn->ancaman_hama)&&isset($tn->ancaman_hama[1])?$tn->ancaman_hama[1]:'' }}"
                    data-video-url="{{ isset($tn->videos) && $tn->videos->first() ? $tn->videos->first()->url : '' }}"
                    onclick="openEditTanaman(this)">✏️ Edit</button>
                    
            <button class="btn-xs a" style="font-size:.72rem" onclick="openVideoModal({{ $tn->id }},'{{ $tn->nama_tanaman }}')">▶ Video</button>
            <form method="POST" action="{{ route('admin.tanaman.hapus',$tn->id) }}" onsubmit="return confirm('Hapus komoditas ini?')">@csrf @method('DELETE')<button type="submit" class="t-delete-btn">❌ Hapus</button></form>
          </div>
        </div>
        <div class="t-section"><div class="t-section-title">🚜 Metode Perawatan</div><div class="t-section-desc">{{ $tn->metode_perawatan??'Belum ada panduan.' }}</div></div>
        <div class="t-section"><div class="t-section-title">🧪 Protokol Pengobatan</div><div class="t-section-desc">{{ $tn->protokol_pengobatan??'Belum ada resep penanganan infeksi.' }}</div></div>
        <div class="t-section">
          <div class="t-section-title">⚠️ Bahaya & Ancaman Utama</div>
          <div class="t-danger-list">
            @if(is_array($tn->ancaman_hama)||is_object($tn->ancaman_hama))
              @forelse($tn->ancaman_hama as $ancaman)
                <div class="t-danger-item">{{ $ancaman }}</div>
              @empty
                <div style="color:var(--gray400);font-size:.75rem">Aman dari ancaman patogen ekstrem.</div>
              @endforelse
            @else
              <div style="color:var(--gray400);font-size:.75rem">Aman dari ancaman patogen ekstrem.</div>
            @endif
          </div>
        </div>

        <div class="t-section" style="margin-top: 1rem; border-top: 1px dashed var(--gray100); padding-top: 0.75rem;">
          <div class="t-section-title">▶ Video Panduan Sistem</div>
          <div class="video-list">
            @if(isset($tn->videos) && count($tn->videos) > 0)
              @foreach($tn->videos as $v)
                <div class="video-item" style="margin-bottom: 0.75rem;">
                  <div class="video-item-header">
                    <div>
                      <div class="v-name">{{ $v->judul }}</div>
                      <div class="v-sub">Oleh: {{ ucfirst($v->uploader) }}</div>
                    </div>
                    <form method="POST" action="{{ route('admin.video.hapus', $v->id) }}" onsubmit="return confirm('Hapus video panduan ini?')">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn-xs r">Hapus</button>
                    </form>
                  </div>
                  
                  {{-- Player Pemutar Video --}}
                  @if(!empty($v->url))
                    @php
                      preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]{11})/', $v->url, $matches);
                      $youtubeId = $matches[1] ?? null;
                    @endphp
                    @if($youtubeId)
                      <div class="video-embed"><iframe src="https://www.youtube.com/embed/{{ $youtubeId }}" frameborder="0" allowfullscreen></iframe></div>
                    @else
                      <div style="padding:.5rem; font-size:.75rem; color:var(--r400)">⚠️ Tautan video eksternal umum: <a href="{{ $v->url }}" target="_blank">Buka Link</a></div>
                    @endif
                  @elseif(!empty($v->file_path))
                    <div class="video-embed">
                      <video controls style="width: 100%; height: 100%;"><source src="{{ asset('storage/' . $v->file_path) }}" type="video/mp4"></video>
                    </div>
                  @endif
                </div>
              @endforeach
            @else
              <div style="color:var(--gray400); font-size:.75rem; font-style:italic; padding:.25rem 0;">Belum dikaitkan dengan video tutorial.</div>
            @endif
          </div>
        </div>

      </div>
    @empty
      <div class="card" style="grid-column:1/-1;text-align:center;color:var(--gray400);padding:2rem">
        Belum ada data pustaka komoditas tanaman di database.
      </div>
    @endforelse
  </div>
</div>

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
            $petaniName=$kl->petani->nama??'-';
            $status=$kl->status??'baru';
            $badge=$status==='selesai'?'b-selesai':($status==='proses'?'b-proses':'b-baru');
            $kons=$kl->konsultasi->first();
            $kon=$kons&&$kons->konsultan?$kons->konsultan->nama:'-';
            $metodeBayar=$kl->metode_bayar??null;
          @endphp
          <tr>
            <td>{{ $petaniName }}</td>
            <td><div style="font-size:.85rem;font-weight:500">{{ $kl->judul_keluhan }}</div><div style="font-size:.72rem;color:var(--gray400)">—</div></td>
            <td>{{ $kl->tanggal_keluhan }}</td>
            <td><span class="badge {{ $badge }}">{{ ucfirst($status) }}</span></td>
            <td>
              @if($metodeBayar)
                <span class="method-pill mp-bayar">💳 {{ $metodeBayar }}</span>
              @else
                <span class="method-pill mp-none">— Belum dipilih</span>
              @endif
            </td>
            <td><span style="color:var(--gray400);font-size:.8rem">{{ $kon }}</span></td>
            <td>
              @if($status === 'selesai' && isset($kl->rating))
                @php $ratingVal = max(0, min(5, intval($kl->rating))); @endphp
                <div style="color: #FFA800; font-weight: bold; font-size: 0.85rem; white-space: nowrap;">
                  {{ str_repeat('★', $ratingVal) }}{{ str_repeat('☆', 5 - $ratingVal) }}
                </div>
                @if($kl->ulasan)
                  <div style="font-size: 0.72rem; color: var(--gray400); font-style: italic; margin-top: 4px; max-width: 150px; line-height: 1.2;">
                    "{{ Str::limit($kl->ulasan, 40) }}"
                  </div>
                @endif
              @else
                <span style="color:var(--gray400);font-size:.75rem">—</span>
              @endif
            </td>
          </tr>
        @empty
          <tr><td colspan="7" style="color:var(--gray400);text-align:center;padding:1rem">Belum ada keluhan masuk</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<!-- TOKO & PRODUK -->
<div id="tab-toko" class="tab-hidden">
  <div class="topbar">
    <div><div class="pg-title">Toko &amp; Produk Mitra</div><div class="pg-sub">Kelola profil toko agri dan daftar produk dagang hulu ke hilir</div></div>
    <div class="tr" style="display:flex;gap:10px;">
      <button type="button" class="btn-sm" onclick="openModal('modalAddToko')">+ Tambah Toko</button>
      <button type="button" class="btn-sm" style="background:var(--t600)" onclick="openModal('modalAddProduk')">+ Tambah Produk</button>
    </div>
  </div>
  <div class="card">
    <div class="ct" style="margin-bottom:1rem">Daftar Toko Terdaftar</div>
    <table class="tbl">
      <thead><tr><th>Logo Toko</th><th>Nama Toko</th><th>Email</th><th>Lokasi</th><th>Status</th><th>Aksi</th></tr></thead>
      <tbody>
        @forelse($tokos as $t)
          <tr>
            <td>
              <div class="uav g" style="width:36px;height:36px;border-radius:50%;overflow:hidden;">
                @if(!empty($t->foto_profil))
                  <img src="{{ asset('storage/'.$t->foto_profil) }}" style="width:100%;height:100%;object-fit:cover;border-radius:50%">
                @elseif(!empty($t->user->foto_profil))
                  <img src="{{ asset('storage/'.$t->user->foto_profil) }}" style="width:100%;height:100%;object-fit:cover;border-radius:50%">
                @else
                  {{ strtoupper(substr($t->nama_toko??'T',0,2)) }}
                @endif
              </div>
            </td>
            <td>
              <div><div style="font-size:.85rem;font-weight:500">{{ $t->nama_toko??'-' }}</div><div style="font-size:.72rem;color:var(--gray400)">{{ $t->user->telepon??'-' }}</div></div>
            </td>
            <td>{{ $t->user->email??'-' }}</td><td>{{ $t->alamat??'-' }}</td>
            <td><span class="badge {{ $t->status==='aktif'?'b-aktif':($t->status==='verifikasi'?'b-proses':'b-nonaktif') }}">{{ ucfirst($t->status??'verifikasi') }}</span></td>
            <td>
              <div class="act-row">
                <button type="button" class="btn-xs g" data-id="{{ $t->id }}" data-nama="{{ $t->nama_toko??'' }}" data-email="{{ $t->user->email??'' }}" data-telepon="{{ $t->user->telepon??'' }}" data-alamat="{{ $t->alamat??'' }}" data-status="{{ $t->status??'verifikasi' }}" onclick="openEditToko(this)">Edit</button>
                @if($t->status!=='aktif')
                  <form method="POST" action="{{ route('admin.toko.verifikasi',$t->id) }}">@csrf<button type="submit" class="btn-xs a">Verifikasi</button></form>
                @endif
                <form method="POST" action="{{ route('admin.toko.hapus',$t->id) }}" onsubmit="return confirm('Hapus toko ini?')">@csrf @method('DELETE')<button type="submit" class="btn-xs r">Hapus</button></form>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" style="color:var(--gray400);text-align:center;padding:1rem">Belum ada data toko</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="card">
    <div class="ct" style="margin-bottom:1rem">Katalog Produk Mitra</div>
    <table class="tbl">
      <thead><tr><th>Nama Produk</th><th>Toko Pemilik</th><th>Kategori</th><th>Stok</th><th>Harga Satuan</th><th>Aksi</th></tr></thead>
      <tbody>
        @foreach($tokos as $tk)
          @if(isset($tk->produks))
            @foreach($tk->produks as $pr)
              <tr>
                <td>
                  <div style="display:flex;align-items:center;gap:8px">
                    <div class="uav t" style="width:30px;height:30px;font-size:.75rem;overflow:hidden;">
                      @if(!empty($pr->foto_produk))
                        <img src="{{ asset('storage/'.$pr->foto_produk) }}" class="table-prod-img" alt="Produk">
                      @else
                        📦
                      @endif
                    </div>
                    <div style="font-size:.85rem;font-weight:500">{{ $pr->nama_produk }}</div>
                  </div>
                </td>
                <td><span style="color:var(--g600);font-weight:500">{{ $tk->nama_toko }}</span></td>
                <td>{{ $pr->kategori }}</td><td>{{ $pr->stok }} unit</td>
                <td>@php $nilaiHarga=$pr->harga;echo 'Rp '.number_format((int)$nilaiHarga*1000,0,',','.'); @endphp</td>
                <td>
                  <div class="act-row">
                    <button type="button" class="btn-xs g" data-id="{{ $pr->id }}" data-id_toko="{{ $tk->id }}" data-nama_produk="{{ $pr->nama_produk }}" data-kategori="{{ $pr->kategori }}" data-stok="{{ $pr->stok }}" data-harga="{{ $pr->harga }}" data-deskripsi="{{ $pr->deskripsi??'' }}" onclick="openEditProduk(this)">Edit</button>
                    <form method="POST" action="{{ route('admin.produk.hapus',$pr->id) }}" onsubmit="return confirm('Hapus produk ini?')">@csrf @method('DELETE')<button type="submit" class="btn-xs r">Hapus</button></form>
                  </div>
                </td>
              </tr>
            @endforeach
          @endif
        @endforeach
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

  <div class="sub-tabs">
    <button id="subtabRiwayatKonsultasiBtn" class="active" onclick="switchSubRiwayat('konsultasi')">💬 Histori Sesi Konsultasi</button>
    <button id="subtabRiwayatPemesananBtn" onclick="switchSubRiwayat('pemesanan')">🛒 Log Transaksi Pemesanan Toko</button>
  </div>

  <div id="sec-riwayat-konsultasi" class="card">
    <table class="tbl">
      <thead><tr>
        <th>Tanggal</th><th>Petani</th><th>Masalah</th><th>Konsultan</th><th>Tindakan</th><th>Status</th>
      </tr></thead>
      <tbody>
        @forelse($riwayats as $r)
          <tr>
            <td>{{ $r->tanggal_konsultasi?date('d M Y',strtotime($r->tanggal_konsultasi)):'-' }}</td>
            <td>{{ $r->keluhan->petani->nama??'-' }}</td>
            <td>{{ $r->keluhan->judul_keluhan??'-' }}</td>
            <td>{{ $r->konsultan->nama??'Belum ditugaskan' }}</td>
            <td>{{ $r->diagnosa?\Illuminate\Support\Str::limit($r->diagnosa,45):($r->rekomendasi?\Illuminate\Support\Str::limit($r->rekomendasi,45):'Belum selesai') }}</td>
            <td><span class="badge {{ $r->status==='selesai'?'b-aktif':($r->status==='proses'?'b-proses':'b-nonaktif') }}">{{ ucfirst($r->status) }}</span></td>
            <td>
              <form action="{{ route('admin.riwayat-konsultasi.hapus', $r->id_konsultasi) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus riwayat sesi konsultasi ini secara permanen dari sistem?')" style="margin: 0; display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-xs r" style="font-weight: 700; padding: 4px 8px;">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="7" style="color:var(--gray400);text-align:center;padding:1rem">Belum ada riwayat konsultasi klinik</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div id="sec-riwayat-pemesanan" class="card" style="display:none">
    <table class="tbl">
      <thead><tr><th>ID Order</th><th>Tanggal</th><th>Nama Petani</th><th>Toko Pemilik</th><th>Item Produk</th><th>Total Pembayaran</th><th>Pengiriman & Pembayaran</th><th>Status</th><th>Aksi</th></tr></thead>
      <tbody>
        @forelse($pesanans??[] as $order)
          <tr>
            <td>#ORD-{{ $order->id }}</td>
            <td>{{ date('d M Y', strtotime($order->created_at)) }}</td>
            <td>{{ $order->petani->nama??'-' }}</td>
            <td>{{ $order->toko->nama_toko??'-' }}</td>
            <td>{{ $order->nama_produk }} ({{ $order->kuantitas }} unit)</td>
            <td>Rp {{ number_format($order->total_harga * 1000, 0, ',', '.') }}</td>
            <td>
              <span class="method-pill mp-kirim">🚚 {{ $order->metode_kirim??'J&T' }}</span>
              <span class="method-pill mp-bayar" style="margin-left:5px;">💳 {{ $order->metode_bayar??'Transfer Bank' }}</span>
            </td>
            <td><span class="badge b-selesai">Selesai</span></td>
            <td>
              <form action="{{ route('admin.riwayat-pesanan.hapus', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus riwayat transaksi pesanan ini secara permanen dari sistem?')" style="margin: 0; display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-xs r" style="font-weight: 700; padding: 4px 8px;">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="9" style="color:var(--gray400);text-align:center;padding:2rem;font-weight:500;">Belum ada riwayat transaksi belanja.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div id="tab-pengaturan" class="tab-hidden">
  <div class="topbar">
    <div><div class="pg-title">Pengaturan Sistem</div><div class="pg-sub">Kelola metode pembayaran dan pengiriman yang tersedia di platform</div></div>
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
    <form method="POST" action="{{ route('admin.petani.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="avatar-row">
        <div class="avatar-preview-wrap" id="prevFotoPetaniAdd" onclick="document.getElementById('fotoInputPetaniAdd').click()">
          <div class="ph"><span>👤</span>Foto</div>
        </div>
        <div class="avatar-row-info">Klik foto untuk mengunggah<br>gambar profil petani<br><span style="color:var(--gray400)">(opsional, maks 5 MB)</span></div>
      </div>
      <input type="file" id="fotoInputPetaniAdd" name="foto_profil" accept="image/jpeg, image/png, image/jpg, image/webp" style="display:none" onchange="previewAvatar(this,'prevFotoPetaniAdd')">
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

<div class="ov" id="modalEditPetani" onclick="bgClose(event,'modalEditPetani')">
  <div class="modal">
    <div class="m-title">Edit Petani</div>
    <form id="editPetaniForm" method="POST" action="" enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="avatar-row">
        <div class="avatar-preview-wrap" id="prevFotoPetaniEdit" onclick="document.getElementById('fotoInputPetaniEdit').click()">
          <div class="ph"><span>👤</span>Ganti</div>
        </div>
        <div class="avatar-row-info">Klik untuk mengganti foto profil<br><span style="color:var(--gray400)">Kosongkan jika tidak diganti (Maks 5 MB)</span></div>
      </div>
      <input type="file" id="fotoInputPetaniEdit" name="foto_profil" accept="image/jpeg, image/png, image/jpg, image/webp" style="display:none" onchange="previewAvatar(this,'prevFotoPetaniEdit')">
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

<div class="ov" id="modalAddKonsultan" onclick="bgClose(event,'modalAddKonsultan')">
  <div class="modal">
    <div class="m-title">Tambah Konsultan Baru</div>
    <form method="POST" action="{{ route('admin.konsultan.store') }}">
      @csrf
      <div class="avatar-row">
        <div class="avatar-preview-wrap" id="prevFotoKonsultanAdd" onclick="document.getElementById('fotoInputKonsultanAdd').click()">
          <div class="ph"><span>👨‍🌾</span>Foto</div>
        </div>
        <div class="avatar-row-info">Klik foto untuk mengunggah<br>gambar profil konsultan<br><span style="color:var(--gray400)">(opsional, maks 5 MB)</span></div>
      </div>
      <input type="file" id="fotoInputKonsultanAdd" name="foto_profil" accept="image/jpeg, image/png, image/jpg, image/webp" style="display:none" onchange="previewAvatar(this,'prevFotoKonsultanAdd')">
      <div class="fg"><label>Nama Konsultan</label><input type="text" name="nama" placeholder="cth: Dr. Budi Santoso, SP" required></div>
      <div class="fg"><label>Email</label><input type="email" name="email" placeholder="email@contoh.com" required></div>
      <div class="fg"><label>No. Kontak</label><input type="tel" name="telepon" placeholder="08xxxxxxxxxx" required></div>
      <div class="fg"><label>Spesialisasi</label><input type="text" name="keahlian" placeholder="cth: Padi, Jagung, Hama"></div>
      <div class="fg"><label>Jenis Dokumen</label>
        <select name="dokumen_tipe">
          <option value="" selected disabled>-- Pilih jenis dokumen --</option>
          <option value="Piagam">Piagam</option>
          <option value="Portofolio">Portofolio</option>
          <option value="Sertifikat">Sertifikat</option>
          <option value="Lainnya">Lainnya</option>
        </select>
      </div>
      <div class="fg"><label>Upload Dokumen Piagam / Portofolio</label><input type="file" name="dokumen_konsultan" accept=".pdf,image/*,.doc,.docx"></div>
      <div class="fg">
        <label>Biaya Konsultasi (Kelipatan Ribu Rp)</label>
        <input type="number" name="tarif_konsultasi" step="1" placeholder="cth: isi 50 untuk Rp 50.000" required>
      </div>
      <div class="fg"><label>Password Sementara</label><input type="password" name="password" placeholder="Min. 8 karakter"></div>
      <div class="m-act">
        <button type="button" class="btn-c" onclick="closeModal('modalAddKonsultan')">Batal</button>
        <button type="submit" class="btn-s">Simpan</button>
      </div>
    </form>
  </div>
</div>

<div class="ov" id="modalEditKonsultan" onclick="bgClose(event,'modalEditKonsultan')">
  <div class="modal">
    <div class="m-title">Edit Konsultan</div>
    <form id="editKonsultanForm" method="POST" action="" enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="avatar-row">
        <div class="avatar-preview-wrap" id="prevFotoKonsultanEdit" onclick="document.getElementById('fotoInputKonsultanEdit').click()">
          <div class="ph"><span>👨‍🌾</span>Ganti</div>
        </div>
        <div class="avatar-row-info">Klik untuk mengganti foto profil<br><span style="color:var(--gray400)">Kosongkan jika tidak diganti (Maks 5 MB)</span></div>
      </div>
      <input type="file" id="fotoInputKonsultanEdit" name="foto_profil" accept="image/jpeg, image/png, image/jpg, image/webp" style="display:none" onchange="previewAvatar(this,'prevFotoKonsultanEdit')">
      <div class="fg"><label>Nama Konsultan</label><input id="editKonsultanNama" type="text" name="nama" required></div>
      <div class="fg"><label>Email</label><input id="editKonsultanEmail" type="email" name="email" required></div>
      <div class="fg"><label>No. Kontak</label><input id="editKonsultanTelepon" type="tel" name="telepon" required></div>
      <div class="fg"><label>Spesialisasi</label><input id="editKonsultanKeahlian" type="text" name="keahlian"></div>
      <div class="fg"><label>Jenis Dokumen</label>
        <select id="editKonsultanDokumenTipe" name="dokumen_tipe">
          <option value="" selected>-- Pilih jenis dokumen --</option>
          <option value="Piagam">Piagam</option>
          <option value="Portofolio">Portofolio</option>
          <option value="Sertifikat">Sertifikat</option>
          <option value="Lainnya">Lainnya</option>
        </select>
      </div>
      <div class="fg"><label>Upload Dokumen Piagam / Portofolio</label><input id="editKonsultanDokumen" type="file" name="dokumen_konsultan" accept=".pdf,image/*,.doc,.docx"></div>
      <div class="fg" id="editDokumenInfo" style="font-size:.82rem;color:var(--gray400);"></div>
      <div class="fg">
        <label>Biaya Konsultasi (Kelipatan Ribu Rp)</label>
        <input id="editKonsultanTarif" type="number" name="tarif_konsultasi" step="1">
      </div>
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

<div class="ov" id="modalAddTanaman" onclick="bgClose(event,'modalAddTanaman')">
  <div class="modal" style="max-width:540px">
    <div class="m-title">Tambah Komoditas Pustaka Baru</div>
    <form method="POST" action="{{ route('admin.tanaman.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="fg">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
          <div><label>Nama Tanaman</label><input type="text" name="nama_tanaman" placeholder="cth: Kentang" required></div>
          <div><label>Nama Latin / Ilmiah</label><input type="text" name="nama_latin" placeholder="cth: Solanum tuberosum"></div>
        </div>
      </div>
      <div class="fg">
        <label>Upload Gambar Komoditas</label>
        <div class="img-preview-wrap" id="prevFotoTanamanAdd" onclick="document.getElementById('fotoTanamanAddInput').click()">
          <div class="ph"><span>🌿</span>Klik untuk unggah gambar</div>
        </div>
        <input type="file" id="fotoTanamanAddInput" name="foto_tanaman" accept="image/*" style="display:none" onchange="previewImg(this,'prevFotoTanamanAdd')">
      </div>
      <div class="fg"><label>🚜 Metode Perawatan</label><textarea name="metode_perawatan" placeholder="Tulis metode perawatan operasional berkala kebun..."></textarea></div>
      <div class="fg"><label>🧪 Protokol Pengobatan</label><textarea name="protokol_pengobatan" placeholder="Tulis penanganan infeksi klinis patogen / fungisida harian..."></textarea></div>
      <div class="fg"><label>⚠️ Bahaya & Ancaman Hama 1</label><input type="text" name="ancaman_1" placeholder="Nama hama/virus ancaman pertama"></div>
      <div class="fg"><label>⚠️ Bahaya & Ancaman Hama 2</label><input type="text" name="ancaman_2" placeholder="Nama hama/virus ancaman kedua"></div>
      
      <div class="fg" style="border-top: 1px solid var(--g100); padding-top: 10px; margin-top: 10px;">
        <label style="font-weight: 600; color: var(--g800);">📹 Video Panduan Perawatan (Opsional)</label>
        <div style="display:grid; grid-template-columns:1fr; gap:10px; margin-top:5px;">
          <div>
            <label style="font-size: 0.75rem; color: var(--gray400);">Link YouTube / URL Video</label>
            <input type="url" name="video_url" placeholder="https://youtube.com/watch?v=...">
          </div>
          <div>
            <label style="font-size: 0.75rem; color: var(--gray400);">Atau Upload File Video</label>
            <input type="file" name="video_file" accept="video/mp4,video/x-matroska,video/x-msvideo">
          </div>
        </div>
      </div>

      <div class="m-act">
        <button type="button" class="btn-c" onclick="closeModal('modalAddTanaman')">Batal</button>
        <button type="submit" class="btn-s">Simpan Komoditas</button>
      </div>
    </form>
  </div>
</div>

<div class="ov" id="modalEditTanaman" onclick="bgClose(event,'modalEditTanaman')">
  <div class="modal" style="max-width:540px">
    <div class="m-title" id="modalPustakaTitle">Ubah Informasi Komoditas</div>
    <form id="editTanamanForm" method="POST" action="" enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="fg">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
          <div><label>Nama Tanaman</label><input type="text" id="editTanamanNama" name="nama_tanaman" required></div>
          <div><label>Nama Latin / Ilmiah</label><input type="text" id="editTanamanLatin" name="nama_latin"></div>
        </div>
      </div>
      <div class="fg">
        <label>Ganti Gambar Komoditas</label>
        <div class="img-preview-wrap" id="prevFotoTanamanEdit" onclick="document.getElementById('fotoTanamanEditInput').click()">
          <div class="ph"><span>🌿</span>Klik untuk ganti gambar</div>
        </div>
        <input type="file" id="fotoTanamanEditInput" name="foto_tanaman" accept="image/*" style="display:none" onchange="previewImg(this,'prevFotoTanamanEdit')">
      </div>
      <div class="fg"><label>🚜 Metode Perawatan</label><textarea id="editTanamanPerawatan" name="metode_perawatan"></textarea></div>
      <div class="fg"><label>🧪 Protokol Pengobatan</label><textarea id="editTanamanPengobatan" name="protokol_pengobatan"></textarea></div>
      <div class="fg"><label>⚠️ Bahaya & Ancaman Hama 1</label><input type="text" id="editTanamanAncaman1" name="ancaman_1"></div>
      <div class="fg"><label>⚠️ Bahaya & Ancaman Hama 2</label><input type="text" id="editTanamanAncaman2" name="ancaman_2"></div>
      
      <div class="fg" style="border-top: 1px solid var(--g100); padding-top: 10px; margin-top: 10px;">
        <label style="font-weight: 600; color: var(--g800);">📹 Video Panduan Perawatan (Opsional)</label>
        <div style="display:grid; grid-template-columns:1fr; gap:10px; margin-top:5px;">
          <div>
            <label style="font-size: 0.75rem; color: var(--gray400);">Link YouTube / URL Video</label>
            <input type="url" id="editTanamanVideoUrl" name="video_url" placeholder="https://youtube.com/watch?v=...">
          </div>
          <div>
            <label style="font-size: 0.75rem; color: var(--gray400);">Atau Upload File Video</label>
            <input type="file" name="video_file" accept="video/mp4,video/x-matroska,video/x-msvideo">
          </div>
        </div>
      </div>

      <div class="m-act">
        <button type="button" class="btn-c" onclick="closeModal('modalEditTanaman')">Batal</button>
        <button type="submit" class="btn-s">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>

<div class="ov" id="modalVideoTanaman" onclick="bgClose(event,'modalVideoTanaman')">
  <div class="modal" style="max-width:540px">
    <div class="m-title" id="videoModalTitle">📹 Tambah Video Panduan</div>
    <p style="font-size:.8rem;color:var(--gray400);margin-bottom:1rem">Tambahkan link YouTube/URL atau upload file video langsung untuk panduan perawatan tanaman.</p>

    <form id="addVideoForm" method="POST" action="" enctype="multipart/form-data">
      @csrf
      <div style="display:flex;gap:.5rem;margin-bottom:1.1rem">
        <button type="button" id="vtabLinkBtn" class="vtab-btn active" onclick="switchVTab('link')">🔗 Link YouTube / URL</button>
        <button type="button" id="vtabFileBtn" class="vtab-btn" onclick="switchVTab('file')">📁 Upload File Video</button>
      </div>

      <div id="vtabLink">
        <div class="fg"><label>Judul Video</label><input type="text" name="judul" id="videoJudul" placeholder="cth: Cara mengatasi wereng coklat pada padi"></div>
        <div class="fg"><label>Link YouTube / URL Video</label><input type="url" name="video_url" id="videoUrl" placeholder="https://youtube.com/watch?v=..."></div>
      </div>
      <div id="vtabFile" style="display:none">
        <div class="fg"><label>Judul Video</label><input type="text" id="videoJudulFile" placeholder="cth: Tutorial pemupukan berimbang"></div>
        <div class="fg">
          <label>Upload File Video (MP4, maks 50 MB)</label>
          <div class="img-preview-wrap" style="height:80px" onclick="document.getElementById('videoFileInput').click()">
            <div class="ph"><span>🎬</span>Klik untuk pilih file video</div>
          </div>
          <input type="file" id="videoFileInput" name="video_file" accept="video/mp4,video/x-matroska,video/x-msvideo" style="display:none" onchange="previewVideoFile(this)">
          <div id="videoFileName" style="font-size:.75rem;color:var(--g600);margin-top:4px"></div>
        </div>
      </div>

      <div class="fg"><label>Diunggah oleh</label>
        <select name="uploader" id="videoUploader">
          <option value="admin">Admin Doctreen</option>
          <option value="konsultan">Konsultan</option>
        </select>
      </div>
      <div class="m-act">
        <button type="button" class="btn-c" onclick="closeModal('modalVideoTanaman')">Batal</button>
        <button type="submit" class="btn-s">✅ Simpan ke Database</button>
      </div>
    </form>
  </div>
</div>

<div class="ov" id="modalAddToko" onclick="bgClose(event,'modalAddToko')">
  <div class="modal">
    <div class="m-title">Tambah Toko Baru</div>
    <form method="POST" action="{{ route('admin.toko.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="avatar-row">
        <div class="avatar-preview-wrap" id="prevFotoTokoAdd" onclick="document.getElementById('fotoInputTokoAdd').click()">
          <div class="ph"><span>🏪</span>Foto</div>
        </div>
        <div class="avatar-row-info">Klik ikon untuk mengunggah<br>foto profil atau logo toko<br><span style="color:var(--gray400)">(opsional, maks 5 MB)</span></div>
      </div>
      <input type="file" id="fotoInputTokoAdd" name="foto_profil" accept="image/jpeg, image/png, image/jpg, image/webp" style="display:none" onchange="previewAvatar(this,'prevFotoTokoAdd')">

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

<div class="ov" id="modalAddProduk" onclick="bgClose(event,'modalAddProduk')">
  <div class="modal">
    <div class="m-title">Tambah Produk Toko</div>
    <form method="POST" action="{{ route('admin.produk.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="fg"><label>Pilih Toko Pemilik</label>
        <select name="id_toko" required>
          <option value="">-- Pilih Toko Mitra --</option>
          @foreach($tokos as $t)<option value="{{ $t->id }}">{{ $t->nama_toko }}</option>@endforeach
        </select>
      </div>
      <div class="fg"><label>Nama Produk</label><input type="text" name="nama_produk" placeholder="cth: Pupuk Urea NPK 1KG" required></div>
      <div class="fg"><label>Kategori</label><input type="text" name="kategori" placeholder="cth: Pupuk, Obat Hama, Benih" required></div>
      <div class="fg"><label>Stok Produk</label><input type="number" name="stok" min="0" placeholder="cth: 50" required></div>
      <div class="fg">
        <label>Harga Satuan (Kelipatan Ribu Rp)</label>
        <input type="number" name="harga" min="0" placeholder="cth: isi 45 untuk Rp 45.000" required>
      </div>
      <div class="fg"><label>Deskripsi Produk</label><textarea name="deskripsi" placeholder="Tulis deskripsi atau spesifikasi produk..."></textarea></div>
      <div class="fg">
        <label>Upload Gambar Produk</label>
        <div class="img-preview-wrap" id="prevFotoProdukAdd" onclick="document.getElementById('fotoProdukAddInput').click()">
          <div class="ph"><span>📦</span>Klik untuk unggah foto produk</div>
        </div>
        <input type="file" id="fotoProdukAddInput" name="foto_produk" accept="image/jpeg, image/png, image/jpg, image/webp" style="display:none" onchange="previewImg(this,'prevFotoProdukAdd')">
        <small style="color:var(--gray400);font-size:.72rem;display:block;margin-top:4px">Format: JPG, JPEG, PNG, WEBP (Maksimal 10 MB)</small>
      </div>
      <div class="m-act">
        <button type="button" class="btn-c" onclick="closeModal('modalEditPetani')">Batal</button>
        <button type="submit" class="btn-s">Simpan</button>
      </div>
    </form>
  </div>
</div>

<div class="ov" id="modalEditProduk" onclick="bgClose(event,'modalEditProduk')">
  <div class="modal">
    <div class="m-title">Edit Produk Toko</div>
    <form id="editProdukForm" method="POST" action="" enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="fg"><label>Toko Pemilik</label>
        <select id="editProdukToko" name="id_toko" required>
          @foreach($tokos as $t)<option value="{{ $t->id }}">{{ $t->nama_toko }}</option>@endforeach
        </select>
      </div>
      <div class="fg"><label>Nama Produk</label><input id="editProdukNama" type="text" name="nama_produk" required></div>
      <div class="fg"><label>Kategori</label><input id="editProdukKategori" type="text" name="kategori" required></div>
      <div class="fg"><label>Stok Produk</label><input id="editProdukStok" type="number" name="stok" min="0" required></div>
      <div class="fg">
        <label>Harga Satuan (Kelipatan Ribu Rp)</label>
        <input id="editProdukHarga" type="number" name="harga" min="0" required>
      </div>
      <div class="fg"><label>Deskripsi Produk</label><textarea id="editProdukDeskripsi" name="deskripsi"></textarea></div>
      <div class="fg">
        <label>Ganti Gambar Produk</label>
        <div class="img-preview-wrap" id="prevFotoProdukEdit" onclick="document.getElementById('fotoProdukEditInput').click()">
          <div class="ph"><span>📦</span>Klik untuk ganti foto produk</div>
        </div>
        <input type="file" id="fotoProdukEditInput" name="foto_produk" accept="image/jpeg, image/png, image/jpg, image/webp" style="display:none" onchange="previewImg(this,'prevFotoProdukEdit')">
        <small style="color:var(--gray400);font-size:.72rem;display:block;margin-top:4px">Kosongkan jika tidak ingin mengubah gambar (Maks. 10 MB)</small>
      </div>
      <div class="m-act">
        <button type="button" class="btn-c" onclick="closeModal('modalEditProduk')">Batal</button>
        <button type="submit" class="btn-s" style="background:var(--t600)">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>

<div class="ov" id="modalEditToko" onclick="bgClose(event,'modalEditToko')">
  <div class="modal">
    <div class="m-title">Edit Toko</div>
    <form id="editTokoForm" method="POST" action="" enctype="multipart/form-data">
      @csrf @method('PUT')
      
      <div class="avatar-row">
        <div class="avatar-preview-wrap" id="prevFotoTokoEdit" onclick="document.getElementById('fotoInputTokoEdit').click()">
          <div class="ph"><span>🏪</span>Ganti</div>
        </div>
        <div class="avatar-row-info">Klik logo untuk mengganti gambar profil toko<br><span style="color:var(--gray400)">Kosongkan jika tidak ingin diganti (Maks 5 MB)</span></div>
      </div>
      <input type="file" id="fotoInputTokoEdit" name="foto_profil" accept="image/jpeg, image/png, image/jpg, image/webp" style="display:none" onchange="previewAvatar(this,'prevFotoTokoEdit')">

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
/* ─── TABS MANAGEMENT ───────────────────────────────────── */
function showTab(name, el) {
  ['dashboard','petani','konsultan','tanaman','keluhan','toko','riwayat','pengaturan'].forEach(t => {
    const tab = document.getElementById('tab-' + t);
    if (tab) tab.className = 'tab-hidden';
  });
  const active = document.getElementById('tab-' + name);
  if (active) active.className = '';
  document.querySelectorAll('.sbi').forEach(b => b.classList.remove('active'));
  if (el) el.classList.add('active');
}

/* ─── SUB-RIWAYAT NAVIGATION ────────────────────────────── */
function switchSubRiwayat(type) {
  const isKonsultasi = type === 'konsultasi';
  document.getElementById('sec-riwayat-konsultasi').style.display = isKonsultasi ? '' : 'none';
  document.getElementById('sec-riwayat-pemesanan').style.display = isKonsultasi ? 'none' : '';
  
  document.getElementById('subtabRiwayatKonsultasiBtn').classList.toggle('active', isKonsultasi);
  document.getElementById('subtabRiwayatPemesananBtn').classList.toggle('active', !isKonsultasi);
}

/* ─── MODALS ────────────────────────────────────────────── */
function openModal(id) { document.getElementById(id).classList.add('show') }
function closeModal(id) { document.getElementById(id).classList.remove('show') }
function bgClose(e, id) { if (e.target.id === id) closeModal(id) }

/* ─── CHART TAB ─────────────────────────────────────────── */
function setChartTab(el) {
  document.querySelectorAll('.th-btn').forEach(b => b.classList.remove('active'));
  el.classList.add('active');
}

/* ─── CORES & SCRIPT PREVIEWS ───────────────────────────── */
function previewImg(input, previewId) {
  const file = input.files[0]; if (!file) return;
  const reader = new FileReader();
  reader.onload = e => {
    const wrap = document.getElementById(previewId);
    wrap.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover">`;
  };
  reader.readAsDataURL(file);
}

// Sinkronisasi teks judul sinkronisasi antar-input tab file & link eksternal
function previewVideoFile(input) {
  const file = input.files[0];
  if (file) {
    document.getElementById('videoFileName').textContent = '✅ File dipilih: ' + file.name;
    // Otomatis salin nama file ke input judul jika kolom judul file kosong
    const judulFile = document.getElementById('videoJudulFile');
    if(judulFile && !judulFile.value.trim()){
       judulFile.value = file.name.split('.').slice(0, -1).join('.');
    }
  }
}

function previewAvatar(input, previewId) {
  const file = input.files[0]; if (!file) return;
  const reader = new FileReader();
  reader.onload = e => {
    const wrap = document.getElementById(previewId);
    wrap.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;border-radius:50%">`;
  };
  reader.readAsDataURL(file);
}

function cariTanaman() {
  const q = document.getElementById('pustakaSearch').value.toLowerCase();
  document.querySelectorAll('.t-card').forEach(c => {
    const n = c.querySelector('.t-name')?.textContent.toLowerCase() || '';
    const l = c.querySelector('.t-latin')?.textContent.toLowerCase() || '';
    c.style.display = (n.includes(q) || l.includes(q)) ? '' : 'none';
  });
}

function openEditPetani(button) {
  document.getElementById('editPetaniForm').action = '/admin/petani/' + button.dataset.id;
  document.getElementById('editPetaniNama').value    = button.dataset.nama;
  document.getElementById('editPetaniEmail').value   = button.dataset.email;
  document.getElementById('editPetaniTelepon').value = button.dataset.telepon;
  document.getElementById('editPetaniDaerah').value = button.dataset.daerah;
  document.getElementById('editPetaniPassword').value = '';
  openModal('modalEditPetani');
}
function openEditKonsultan(button) {
  document.getElementById('editKonsultanForm').action     = '/admin/konsultan/' + button.dataset.id;
  document.getElementById('editKonsultanNama').value      = button.dataset.nama;
  document.getElementById('editKonsultanEmail').value     = button.dataset.email;
  document.getElementById('editKonsultanTelepon').value   = button.dataset.telepon;
  document.getElementById('editKonsultanKeahlian').value  = button.dataset.keahlian;
  document.getElementById('editKonsultanTarif').value     = button.dataset.tarif;
  document.getElementById('editKonsultanStatus').value    = button.dataset.status;
  document.getElementById('editKonsultanDokumenTipe').value = button.dataset.dokumenTipe || '';
  document.getElementById('editDokumenInfo').innerHTML   = button.dataset.dokumenPath ? `Dokumen saat ini: <a href="${button.dataset.dokumenPath}" target="_blank" style="color:inherit;text-decoration:underline;">Lihat dokumen</a>` : 'Belum ada dokumen terunggah.';
  document.getElementById('editKonsultanDokumen').value = null;
  document.getElementById('prevFotoKonsultanEdit').innerHTML = '<div class="ph"><span>👨‍🌾</span>Ganti</div>';
  openModal('modalEditKonsultan');
}
function openEditToko(button) {
  document.getElementById('editTokoForm').action    = '/admin/toko/' + button.dataset.id;
  document.getElementById('editTokoNama').value     = button.dataset.nama;
  document.getElementById('editTokoEmail').value    = button.dataset.email;
  document.getElementById('editTokoTelepon').value  = button.dataset.telepon;
  document.getElementById('editTokoAlamat').value   = button.dataset.alamat;
  document.getElementById('editTokoStatus').value   = button.dataset.status;
  document.getElementById('prevFotoTokoEdit').innerHTML = '<div class="ph"><span>🏪</span>Ganti</div>';
  openModal('modalEditToko');
}
function openEditProduk(button) {
  document.getElementById('editProdukForm').action      = '/admin/produk/' + button.dataset.id;
  document.getElementById('editProdukToko').value       = button.dataset.id_toko;
  document.getElementById('editProdukNama').value       = button.dataset.nama_produk;
  document.getElementById('editProdukKategori').value   = button.dataset.kategori;
  document.getElementById('editProdukStok').value       = button.dataset.stok;
  document.getElementById('editProdukHarga').value      = button.dataset.harga;
  document.getElementById('editProdukDeskripsi').value  = button.dataset.deskripsi;
  openModal('modalEditProduk');
}
function openEditTanaman(button) {
  document.getElementById('editTanamanForm').action = '/admin/tanaman/' + button.dataset.id;
  document.getElementById('editTanamanNama').value       = button.dataset.nama;
  document.getElementById('editTanamanLatin').value      = button.dataset.latin;
  document.getElementById('editTanamanPerawatan').value  = button.dataset.perawatan;
  document.getElementById('editTanamanPengobatan').value = button.dataset.pengobatan;
  document.getElementById('editTanamanAncaman1').value   = button.dataset.ancaman1;
  document.getElementById('editTanamanAncaman2').value   = button.dataset.ancaman2;
  document.getElementById('editTanamanVideoUrl').value   = button.dataset.videoUrl || '';
  openModal('modalEditTanaman');
}
// Fungsi membuka modal unggah video dengan endpoint dinamis
function openVideoModal(id, namaTanaman) {
    // 1. Tampilkan nama tanaman pada teks judul modal
    document.getElementById('vModalNamaTanaman').innerText = namaTanaman;
    
    // 2. Set action URL Form secara dinamis mengarah ke endpoint Laravel StoreVideo
    const form = document.getElementById('formUploadVideo');
    form.action = `/admin/tanaman/${id}/video`;
    
    // 3. Bersihkan input data sebelumnya (reset)
    document.getElementById('judul_video').value = '';
    document.getElementById('file_video').value = '';
    
    // 4. Buka modal ke permukaan layar
    openModal('modalVideoTanaman');
}

// Fungsi dasar pembantu kontrol modal (pastikan ini ada di berkas Anda)
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if(modal) modal.classList.add('show');
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if(modal) modal.classList.remove('show');
}

/* ─── VIDEO MANAGEMENT (DIPERBARUI UNTUK DATABASE KONSTRUKSI) ─── */
let currentVidTanamanId = null;

function openVideoModal(tanamanId, tanamanNama) {
  currentVidTanamanId = tanamanId;
  document.getElementById('videoModalTitle').textContent = '📹 Video Panduan: ' + tanamanNama;
  
  // Set Action Form secara dinamis mengarah ke server Laravel route store video tanaman
  document.getElementById('addVideoForm').action = '/admin/tanaman/' + tanamanId + '/video';
  
  // Reset fields
  document.getElementById('videoJudul').value      = '';
  document.getElementById('videoUrl').value        = '';
  document.getElementById('videoJudulFile').value  = '';
  document.getElementById('videoFileName').textContent = '';
  document.getElementById('videoFileInput').value  = '';
  switchVTab('link');
  openModal('modalVideoTanaman');
}

function switchVTab(tab) {
  const isLink = tab === 'link';
  document.getElementById('vtabLink').style.display    = isLink ? '' : 'none';
  document.getElementById('vtabFile').style.display    = isLink ? 'none' : '';
  document.getElementById('vtabLinkBtn').classList.toggle('active', isLink);
  document.getElementById('vtabFileBtn').classList.toggle('active', !isLink);
  
  // Sinkronisasi atribut name input text judul agar tidak bentrok saat dikirim ke Controller
  if(isLink) {
    document.getElementById('videoJudul').setAttribute('name', 'judul');
    document.getElementById('videoJudulFile').removeAttribute('name');
  } else {
    document.getElementById('videoJudulFile').setAttribute('name', 'judul');
    document.getElementById('videoJudul').removeAttribute('name');
  }
}

function saveSettings() {
  const toast = document.createElement('div');
  toast.style.cssText = 'position:fixed;bottom:1.5rem;right:1.5rem;background:var(--g800);color:white;padding:.65rem 1.2rem;border-radius:10px;font-size:.85rem;z-index:999';
  toast.textContent = '✅ Pengaturan disimpan';
  document.body.appendChild(toast);
  setTimeout(() => toast.remove(), 2200);
}

/* ── KONSULTAN PROFILE DRAWER LOGIC ── */
let _kpdCurrentData = null;

function openKonsultanProfil(btn) {
  const d = btn.dataset;
  _kpdCurrentData = d;

  // Avatar
  const avatarEl = document.getElementById('kpdAvatar');
  if (d.foto && d.foto.trim() !== '') {
    avatarEl.innerHTML = `<img src="${d.foto}" alt="${d.nama}">`;
  } else {
    avatarEl.innerHTML = (d.nama || 'KS').slice(0, 2).toUpperCase();
  }

  // Header info
  document.getElementById('kpdName').textContent = d.nama || '—';
  document.getElementById('kpdSpecialtyText').textContent = d.keahlian || 'Umum';

  // Status badge
  const statusEl = document.getElementById('kpdStatusBadge');
  const statusMap = { aktif: { text: '✅ Aktif', cls: 'aktif' }, verifikasi: { text: '⏳ Menunggu Verifikasi', cls: 'verifikasi' }, nonaktif: { text: '🔴 Nonaktif', cls: 'nonaktif' } };
  const sm = statusMap[d.status] || { text: d.status, cls: 'verifikasi' };
  statusEl.textContent = sm.text;
  statusEl.className = 'kpd-status-badge ' + sm.cls;

  // Body info
  document.getElementById('kpdEmail').textContent = d.email || '—';
  document.getElementById('kpdTelepon').textContent = d.telepon || '—';
  document.getElementById('kpdKeahlian').textContent = d.keahlian || '—';
  const tarif = d.tarif ? 'Rp ' + parseInt(d.tarif).toLocaleString('id-ID') + '.000' : 'Gratis / Negosiasi';
  document.getElementById('kpdTarif').textContent = tarif;

  // Document type
  const dokTipeRow = document.getElementById('kpdDokTipeRow');
  if (d.dokumenTipe) {
    document.getElementById('kpdDokTipe').textContent = d.dokumenTipe;
    dokTipeRow.style.display = 'flex';
  } else {
    dokTipeRow.style.display = 'none';
  }

  // Documents list
  const docsList = document.getElementById('kpdDocsList');
  const docsSection = document.getElementById('kpdDocsSection');
  docsList.innerHTML = '';
  let dokumens = [];
  try { dokumens = JSON.parse(btn.getAttribute('data-dokumens') || '[]'); } catch(e) { dokumens = []; }

  if (dokumens.length > 0) {
    docsSection.style.display = 'block';
    dokumens.forEach((dok, idx) => {
      const ext = dok.path ? dok.path.split('.').pop().toLowerCase() : '';
      const isPdf = ext === 'pdf';
      const isImg = ['jpg','jpeg','png','webp'].includes(ext);
      const ico = isPdf ? '📄' : (isImg ? '🖼️' : '📎');
      const label = 'Dokumen ' + (idx + 1);
      docsList.innerHTML += `
        <div class="kpd-doc-card">
          <div class="kpd-doc-ico">${ico}</div>
          <div class="kpd-doc-name">${label}</div>
          <div class="kpd-doc-actions">
            <a href="${dok.url}" target="_blank" class="kpd-doc-btn view">👁 Lihat</a>
            <a href="${dok.url}" download class="kpd-doc-btn download">⬇ Unduh</a>
          </div>
        </div>`;
    });
  } else {
    docsSection.style.display = 'block';
    docsList.innerHTML = '<p style="font-size:.83rem;color:var(--gray400);padding:.5rem 0">Belum ada dokumen yang diunggah.</p>';
  }

  // Verify button visibility
  const verifyBtn = document.getElementById('kpdBtnVerify');
  if (d.statusAktif === '1') {
    verifyBtn.style.display = 'flex';
    document.getElementById('kpdVerifikasiForm').action = d.verifikasiUrl || '';
  } else {
    verifyBtn.style.display = 'none';
  }
  document.getElementById('kpdHapusForm').action = d.hapusUrl || '';

  // Stash data for Edit button
  document.getElementById('kpdBtnEdit').dataset.btnRef = '';
  document.getElementById('kpdBtnEdit')._sourceBtn = btn;

  // Show drawer
  document.getElementById('kpdBackdrop').classList.add('show');
  document.getElementById('kpdDrawer').classList.add('show');
  document.body.style.overflow = 'hidden';
}

function closeKonsultanProfil() {
  document.getElementById('kpdBackdrop').classList.remove('show');
  document.getElementById('kpdDrawer').classList.remove('show');
  document.body.style.overflow = '';
}

function kpdEditAction() {
  const editBtn = document.getElementById('kpdBtnEdit');
  const origBtn = editBtn._sourceBtn;
  if (origBtn) {
    closeKonsultanProfil();
    setTimeout(() => openEditKonsultan(origBtn), 300);
  }
}

function kpdVerifyAction() {
  if (confirm('Verifikasi konsultan ini dan ubah status menjadi Aktif?')) {
    document.getElementById('kpdVerifikasiForm').submit();
  }
}

function kpdHapusAction() {
  if (confirm('Hapus konsultan ini secara permanen? Tindakan ini tidak dapat dibatalkan.')) {
    document.getElementById('kpdHapusForm').submit();
  }
}
</script>
</body>
</html>