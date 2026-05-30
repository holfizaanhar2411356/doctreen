<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Dashboard Konsultan — Doctreen</title>
  
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
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
      border-radius: 10px;
      object-fit: contain;
      filter: drop-shadow(0 4px 12px rgba(0,0,0,0.15));
      transition: all 0.3s ease;
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
    .u-av img { width: 100%; height: 100%; object-fit: cover; }
    .u-name { font-size: .85rem; color: #fff; font-weight: 600; }
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
      grid-template-columns: 1fr 1.5fr;
      gap: 2rem;
      margin-bottom: 2rem;
    }
    @media (max-width: 1100px) {
      .grid2 {
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
    }
    .b-selesai { background: var(--g50); color: var(--g600); border: 1px solid rgba(15, 118, 67, 0.15); }
    .b-proses { background: var(--a50); color: var(--a400); border: 1px solid rgba(217, 119, 6, 0.15); }
    .b-menunggu { background: var(--gray50); color: var(--gray400); border: 1px solid var(--gray100); }
    .b-baru { background: var(--r50); color: var(--r400); border: 1px solid rgba(220, 38, 38, 0.15); }

    /* ── BUTTONS ── */
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
    .btn-xs.t {
      background: var(--g50);
      color: var(--g600);
      border-color: rgba(15, 118, 67, 0.15);
    }
    .btn-xs.t:hover {
      background: var(--g100);
    }
    .btn-xs.a {
      background: var(--a50);
      color: var(--a400);
      border-color: rgba(217, 119, 6, 0.15);
    }
    .btn-xs.a:hover {
      background: rgba(217, 119, 6, 0.1);
    }

    /* ── KELUHAN CARDS ── */
    .keluhan-card {
      border: 1px solid var(--glass-border);
      border-radius: var(--radius-md);
      padding: 1.5rem;
      margin-bottom: 1rem;
      background: rgba(255, 255, 255, 0.6);
      box-shadow: var(--shadow-sm);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .keluhan-card:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow-lg);
      border-color: var(--g100);
      background: white;
    }
    .kc-top {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      margin-bottom: 1rem;
      gap: 1rem;
    }
    .kc-ttl {
      font-family: 'Playfair Display', serif;
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--g900);
      margin-bottom: .25rem;
      word-break: break-word;
      overflow-wrap: break-word;
    }
    .kc-meta {
      font-size: .78rem;
      color: var(--gray400);
      word-break: break-word;
      overflow-wrap: break-word;
    }
    .kc-body {
      font-size: .88rem;
      color: var(--tm);
      line-height: 1.6;
      margin-bottom: 1.25rem;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      word-break: break-word;
      overflow-wrap: break-word;
    }
    .kc-foot {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 1rem;
      border-top: 1px dashed var(--gray100);
      padding-top: 1rem;
    }
    .kc-tag {
      display: flex;
      gap: .5rem;
      flex-wrap: wrap;
    }
    .tag {
      padding: .3rem .75rem;
      border-radius: 100px;
      font-size: .75rem;
      font-weight: 600;
      background: var(--g50);
      color: var(--g600);
      border: 1px solid rgba(15, 118, 67, 0.1);
    }
    .kc-act {
      display: flex;
      gap: .5rem;
    }
    .tab-hidden {
      display: none;
    }

    /* ── MODALS ── */
    .ov {
      position: fixed;
      inset: 0;
      background: rgba(3, 27, 17, 0.65);
      z-index: 200;
      display: none;
      align-items: center;
      justify-content: center;
      padding: 2rem;
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
      max-height: 90vh;
      overflow-y: auto;
      box-shadow: 0 40px 100px rgba(3, 27, 17, 0.25);
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

    /* ── TABLES ── */
    .tbl {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0 10px;
      font-size: .9rem;
    }
    .tbl thead tr {
      border-bottom: 2px solid var(--gray100);
    }
    .tbl th {
      text-align: left;
      padding: 1rem 1.25rem;
      color: var(--gray400);
      font-weight: 600;
      font-size: .8rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
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

    /* ── SEARCH BOX ── */
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

    /* ── ENSIKLOPEDIA GRID ── */
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
      backdrop-filter: blur(20px);
      box-shadow: var(--shadow-lg);
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
      word-break: break-word;
      overflow-wrap: anywhere;
      white-space: normal;
      padding-right: 120px;
    }
    .t-latin {
      font-size: .85rem;
      color: var(--gray400);
      font-style: italic;
      margin-top: 1px;
      word-break: break-word;
      overflow-wrap: anywhere;
      white-space: normal;
      padding-right: 120px;
    }
    .t-jenis {
      font-size: .72rem;
      background: var(--g100);
      color: var(--g800);
      padding: .25rem .65rem;
      border-radius: 100px;
      font-weight: 700;
      display: inline-block;
      margin-top: 4px;
    }
    .t-actions-wrapper {
      position: absolute;
      right: 0;
      top: 0;
      display: flex;
      gap: 6px;
      align-items: center;
    }
    .t-edit-btn, .t-delete-btn {
      background: none;
      border: none;
      cursor: pointer;
      font-size: .8rem;
      font-weight: 700;
      font-family: 'DM Sans', sans-serif;
    }
    .t-edit-btn { color: var(--g600); }
    .t-delete-btn { color: var(--r400); }
    
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
      border: 1px solid rgba(220, 38, 38, 0.15);
    }
    .topbar-actions {
      display: flex;
      gap: 12px;
      align-items: center;
    }

    /* ── PROFILE SECTION ── */
    .profil-grid {
      display: grid;
      grid-template-columns: 1fr 1.5fr;
      gap: 2rem;
    }
    @media (max-width: 900px) {
      .profil-grid {
        grid-template-columns: 1fr;
      }
    }
    .profil-foto-wrap {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1.5rem;
      padding: 2.5rem 1.5rem;
      background: var(--glass-bg);
      border: 1px solid var(--glass-border);
      border-radius: var(--radius-lg);
      backdrop-filter: blur(20px);
      box-shadow: var(--shadow-lg);
    }
    .profil-av {
      width: 110px;
      height: 110px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--g100) 0%, var(--g200) 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2.4rem;
      font-weight: 700;
      color: var(--g900);
      overflow: hidden;
      box-shadow: 0 10px 25px rgba(6, 47, 30, 0.15);
      border: 3px solid white;
    }
    .profil-av img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .info-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: .85rem 0;
      border-bottom: 1px solid var(--gray100);
    }
    .info-row:last-child {
      border-bottom: none;
    }
    .info-label {
      font-size: .85rem;
      color: var(--gray400);
      font-weight: 600;
    }
    .info-val {
      font-size: .92rem;
      color: var(--text);
      font-weight: 600;
    }
    .alert-success {
      background: var(--g50);
      color: var(--g600);
      padding: 1.1rem 1.5rem;
      border-radius: var(--radius-md);
      margin-bottom: 2rem;
      font-size: .9rem;
      font-weight: 600;
      border-left: 4px solid var(--g400);
      box-shadow: var(--shadow-sm);
    }
    .empty-state {
      text-align: center;
      padding: 3.5rem;
      color: var(--gray400);
      font-size: .95rem;
    }
    .riwayat-row td .diagnosa-text {
      font-size: .85rem;
      color: var(--tm);
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
      overflow: hidden;
      max-width: 200px;
    }
    .vtab-btn {
      flex: 1;
      padding: .65rem;
      background: var(--gray50);
      border: none;
      border-radius: var(--radius-sm);
      font-size: .85rem;
      font-weight: 600;
      color: var(--gray400);
      cursor: pointer;
      transition: all 0.3s;
    }
    .vtab-btn.active {
      background: linear-gradient(135deg, var(--g600) 0%, var(--g800) 100%);
      color: white;
      box-shadow: 0 4px 10px rgba(6, 47, 30, 0.15);
    }
    .video-item {
      background: rgba(255,255,255,0.6);
      border: 1px solid var(--gray100);
      border-radius: var(--radius-md);
      overflow: hidden;
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

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    [style*="background:var(--g50)"], [style*="background:#fdf2f2"] {
      animation: slideInDown 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }
    @keyframes slideInDown {
      0% { transform: translateY(-20px); opacity: 0; }
      100% { transform: translateY(0); opacity: 1; }
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
      background-image: linear-gradient(135deg, rgba(244, 247, 242, 0.88) 0%, rgba(255, 255, 255, 0.94) 100%), url('/images/konsultan_bg.png');
      background-size: cover;
      background-position: center;
      filter: blur(4px); /* Soft blur to keep dashboard UI elements perfectly readable */
      transform-origin: center center;
      animation: slowPanBotanist 50s infinite ease-in-out;
    }

    @keyframes slowPanBotanist {
      0% {
        transform: translate3d(0, 0, 0) scale(1);
      }
      50% {
        transform: translate3d(-4%, -3%, 0) scale(1.06);
      }
      100% {
        transform: translate3d(0, 0, 0) scale(1);
      }
    }
  </style>
</head>
<body>
  <div class="dashboard-bg-container">
    <div class="dashboard-pan-bg"></div>
  </div>

{{-- ==================== SIDEBAR ==================== --}}
<aside class="sb">
  <div class="sb-logo"><img src="/images/doctreen_logo.png" alt="Doctreen — Nature's Doctor" title="Doctreen"></div>
  
  <div class="sb-menu-container">
  <span class="sb-lbl">Menu Utama</span>
    <button class="sbi active" onclick="showTab('dashboard',this)"><span class="sbi-ico">📊</span>Dashboard</button>
  <button class="sbi" onclick="showTab('keluhan',this)"><span class="sbi-ico">🛡️</span>Keluhan Masuk</button>
    <button class="sbi" onclick="showTab('ensiklopedia',this)"><span class="sbi-ico">🌿</span>Ensiklopedia Tanaman</button>
  <button class="sbi" onclick="showTab('riwayat',this)"><span class="sbi-ico">📋</span>Riwayat Saya</button>
  </div>

  <div class="sb-bot">
    <div class="u-card">
      <div class="u-av" style="cursor:pointer;" onclick="showTab('profil', null); document.querySelectorAll('.sbi').forEach(b=>b.classList.remove('active'));" title="Klik untuk lihat profil">
        @if(isset($konsultan) && $konsultan->foto_profil)
          <img src="{{ asset('storage/'.$konsultan->foto_profil) }}" alt="Foto Profil">
        @else
          {{ strtoupper(substr($konsultan->nama ?? 'K', 0, 2)) }}
        @endif
      </div>
      <div style="flex: 1; cursor:pointer;" onclick="showTab('profil', null); document.querySelectorAll('.sbi').forEach(b=>b.classList.remove('active'));" title="Klik untuk lihat profil">
        <div class="u-name">{{ $konsultan->nama ?? '-' }}</div>
        <div class="u-role">{{ ($konsultan->keahlian ?? false) ? 'Ahli '.ucfirst($konsultan->keahlian) : 'Konsultan Pertanian' }}</div>
        @php
          $sidebarRatings = \App\Models\Keluhan::whereHas('konsultasi', function($q) use ($konsultan) {
              $q->where('id_konsultan', $konsultan->id)->where('status', 'selesai');
          })->whereNotNull('rating')->pluck('rating');
          $sidebarAvgRating = $sidebarRatings->count() > 0 ? round($sidebarRatings->average(), 1) : null;
          $sidebarFullStars = $sidebarAvgRating ? round($sidebarAvgRating) : 0;
        @endphp
        @if($sidebarAvgRating)
          <div style="color: #FFA800; font-size: 0.75rem; margin-top: 3px; font-weight: bold; display: flex; align-items: center; gap: 2px;">
            {{ str_repeat('★', $sidebarFullStars) }}{{ str_repeat('☆', 5 - $sidebarFullStars) }}
            <span style="color: rgba(255,255,255,0.6); font-size: 0.68rem; font-weight: normal; margin-left: 2px;">({{ number_format($sidebarAvgRating, 1) }})</span>
          </div>
        @endif
      </div>
      <form action="{{ route('logout') }}" method="POST" id="logoutForm" style="margin:0;">
    @csrf
        <button type="button" onclick="document.getElementById('logoutForm').submit()" style="background:none;border:none;color:var(--r400);cursor:pointer;padding:8px;border-radius:8px;transition:all 0.2s;" onmouseover="this.style.background='rgba(216,75,75,0.1)'" onmouseout="this.style.background='none'" title="Keluar">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
        </button>
  </form>
    </div>
  </div>
</aside>

{{-- ==================== MAIN ==================== --}}
<main class="main">

  @if(session('success'))
    <div style="background:var(--g50);border:1.5px solid var(--g100);color:var(--g800);padding:1rem;border-radius:10px;margin-bottom:1.5rem;font-weight:500;font-size:.875rem;display:flex;align-items:center;justify-content:space-between;">
      <span>✓ {{ session('success') }}</span>
      <button style="background:none;border:none;color:var(--g800);font-weight:bold;font-size:1rem;cursor:pointer;" onclick="this.parentElement.remove()">✕</button>
    </div>
  @endif
  @if(session('error'))
    <div style="background:#fdf2f2;border:1.5px solid #f8b4b4;color:#9b1c1c;padding:1rem;border-radius:10px;margin-bottom:1.5rem;font-weight:500;font-size:.875rem;display:flex;align-items:center;justify-content:space-between;">
      <span>⚠️ {{ session('error') }}</span>
      <button style="background:none;border:none;color:#9b1c1c;font-weight:bold;font-size:1rem;cursor:pointer;" onclick="this.parentElement.remove()">✕</button>
    </div>
  @endif

  {{-- ===== TAB: DASHBOARD ===== --}}
  <div id="tab-dashboard">
    <div class="topbar">
      <div>
        <div class="pg-title">Selamat Datang, {{ $konsultan->nama ?? 'Konsultan' }}</div>
        <div class="pg-sub">Dashboard konsultan berbasis data real-time</div>
      </div>
      <div class="nb">🔔</div>
    </div>

    <div class="stats">
      <div class="sc"><div class="sc-lbl">💬 Total Konsultasi</div><div class="sc-num">{{ $totalDitangani }}</div><div class="sc-sub">Data dari database</div></div>
      <div class="sc"><div class="sc-lbl">⏳ Sedang Diproses</div><div class="sc-num">{{ $konsultasiAktif->count() }}</div><div class="sc-sub a">Berjalan</div></div>
      <div class="sc"><div class="sc-lbl">✅ Selesai</div><div class="sc-num">{{ $selesai }}</div><div class="sc-sub">Keluhan selesai</div></div>
      <div class="sc">
        <div class="sc-lbl">💬 Total Konsultasi</div>
        <div class="sc-num">{{ $totalDitangani ?? 0 }}</div>
        <div class="sc-sub">Sepanjang waktu</div>
        </div>

      <div class="sc">
        <div class="sc-lbl">⏳ Sedang Berjalan</div>
        <div class="sc-num">{{ isset($konsultasiAktif) ? $konsultasiAktif->count() : 0 }}</div>
        <div class="sc-sub a">Menunggu &amp; Proses</div>
      </div>

      <div class="sc">
        <div class="sc-lbl">✅ Selesai</div>
        <div class="sc-num">{{ $selesai ?? 0 }}</div>
        <div class="sc-sub">Konsultasi tuntas</div>
      </div>

      <div class="sc">
        <div class="sc-lbl">💰 Pendapatan Konsultasi</div>
        <div class="sc-num" style="font-size:1.2rem">
          @if(isset($pendapatanKonsultasi))
            Rp {{ number_format($pendapatanKonsultasi * 1000, 0, ',', '.') }}
          @else
            Rp 0
          @endif
        </div>
        <div class="sc-sub">Dari {{ $selesai ?? 0 }} sesi selesai</div>
      </div>
    </div>

    <div class="grid2">
      <div>
        <div class="ct" style="margin-bottom:1rem">
          Keluhan Menunggu Jawaban
          <span class="badge b-baru">{{ isset($keluhanBaru) ? $keluhanBaru->count() : 0 }} baru</span>
        </div>

        @if(isset($keluhanBaru))
        @forelse($keluhanBaru as $kel)
          <div class="keluhan-card">
            <div class="kc-top">
              <div>
                <div class="kc-ttl">{{ $kel->judul_keluhan }}</div>
                  <div class="kc-meta">
                    {{ $kel->tanaman->nama_tanaman ?? 'Tanaman tidak dicantumkan' }}
                    · {{ $kel->petani->nama ?? '-' }}
                    @if($kel->petani && $kel->petani->daerah)
                      · {{ $kel->petani->daerah }}
                    @endif
                    · {{ \Carbon\Carbon::parse($kel->tanggal_keluhan)->format('d M Y') }}
                    @if($kel->metode_bayar)
                      · <span style="font-weight:600;color:var(--g600);">💳 {{ $kel->metode_bayar }}</span>
                    @endif
              </div>
              <span class="badge b-baru">Baru</span>
            </div>
                <span class="badge b-{{ $kel->status ?? 'baru' }}">{{ ucfirst($kel->status ?? 'baru') }}</span>
              </div>

              <div class="kc-body">{{ $kel->isi_keluhan }}</div>

              @if($kel->foto_kendala)
                <div style="margin-bottom:.85rem">
                  <img src="{{ asset('storage/'.$kel->foto_kendala) }}"
                       style="max-width:120px;border-radius:8px;border:1px solid var(--gray100)"
                       alt="Foto Kendala">
                </div>
              @endif

            <div class="kc-foot">
                <div class="kc-tag">
                  <span class="tag">{{ $kel->tanaman->nama_tanaman ?? 'Umum' }}</span>
                  @if($kel->petani && $kel->petani->daerah)
                    <span class="tag" style="background:var(--t50);color:var(--t600)">{{ $kel->petani->daerah }}</span>
                  @endif
                </div>
                <div class="kc-act" style="display: flex; gap: 6px; align-items: center;">
                  @php
                    $konsultasiTerkait = $kel->konsultasi->first();
                  @endphp
                  @if($konsultasiTerkait)
                    <button class="btn-xs a"
                      onclick="bukaModalJawab('{{ $kel->id }}', '{{ $konsultasiTerkait->id_konsultasi }}')">
                      Beri Jawaban
                    </button>
                  @else
                    <button class="btn-xs g" disabled>Belum ada konsultasi</button>
                  @endif
                  <button type="button" class="btn-xs r" onclick="hapusKeluhanMasuk(event, '{{ $kel->id }}', this)" style="background: var(--r50); color: var(--r400); border: 1px solid rgba(220,38,38,0.15); font-weight: 700; cursor: pointer; transition: all 0.2s;">Hapus</button>
                    <span class="tag" style="background:var(--t50);color:var(--t600)">{{ $kel->petani->daerah }}</span>
                  @endif
                </div>
                <div class="kc-act" style="display: flex; gap: 6px; align-items: center;">
                  @php
                    $konsultasiTerkait = $kel->konsultasi->first();
                  @endphp
                  @if($konsultasiTerkait)
                    <button class="btn-xs a"
                      onclick="bukaModalJawab('{{ $kel->id }}', '{{ $konsultasiTerkait->id_konsultasi }}')">
                      Beri Jawaban
                    </button>
                  @else
                    <button class="btn-xs g" disabled>Belum ada konsultasi</button>
                  @endif
                  <button type="button" class="btn-xs r" onclick="hapusKeluhanMasuk(event, '{{ $kel->id }}', this)" style="background: var(--r50); color: var(--r400); border: 1px solid rgba(220,38,38,0.15); font-weight: 700; cursor: pointer; transition: all 0.2s;">Hapus</button>
              </div>
            </div>
          @empty
            <div class="keluhan-card">
              <div class="empty-state">🎉 Tidak ada keluhan baru saat ini.</div>
          </div>
        @empty
          <div class="keluhan-card"><div style="color:var(--gray400);font-size:.85rem">Tidak ada keluhan baru.</div></div>
        @endforelse
        @endif
      </div>

      <div>
        <div class="card" style="margin-bottom:1.5rem">
          <div class="ct">Konsultasi Aktif</div>
          @if(isset($konsultasiAktif))
            @forelse($konsultasiAktif as $k)
              <div style="display:flex;align-items:flex-start;justify-content:space-between;padding:.65rem 0;border-bottom:1px solid var(--gray50)">
                <div>
                  <div style="font-size:.85rem;font-weight:600;color:var(--text)">
                    {{ $k->keluhan->judul_keluhan ?? '—' }}
          </div>
                  <div style="font-size:.75rem;color:var(--gray400);margin-top:2px">
                    {{ $k->keluhan->petani->nama ?? '-' }}
                    · {{ \Carbon\Carbon::parse($k->tanggal_konsultasi)->format('d M Y') }}
                    @if(isset($k->keluhan->metode_bayar))
                      · <span style="font-weight:600;color:var(--g600);">💳 {{ $k->keluhan->metode_bayar }}</span>
                    @endif
                  </div>
                </div>
                <span class="badge b-{{ $k->status }}">{{ ucfirst($k->status) }}</span>
              </div>
            @empty
              <div class="empty-state">Tidak ada konsultasi aktif.</div>
            @endforelse
          @endif
        </div>

        <div class="card">
          <div class="ct">Profil Singkat</div>
          <div class="info-row">
            <span class="info-label">Nama</span>
            <span class="info-val">{{ $konsultan->nama ?? '-' }}</span>
          </div>
          <div class="info-row">
            <span class="info-label">Keahlian</span>
            <span class="info-val">{{ $konsultan->keahlian ?? '—' }}</span>
          </div>
          <div class="info-row">
            <span class="info-label">Status</span>
            <span class="badge b-{{ ($konsultan->status ?? '') === 'aktif' ? 'selesai' : 'menunggu' }}">
              {{ ucfirst($konsultan->status ?? 'menunggu') }}
                </span>
                <span style="color:var(--gray400); font-size:.72rem;">{{ \Carbon\Carbon::parse($ul->tanggal_ulasan)->translatedFormat('d M Y') }}</span>
              </div>
          <div class="info-row">
            <span class="info-label">Tarif</span>
            <span class="info-val">
              {{ ($konsultan->tarif_konsultasi ?? null) ? 'Rp '.number_format($konsultan->tarif_konsultasi,0,',','.') : '—' }}
            </span>
            </div>
          @empty
            <div style="color:var(--gray400);font-size:.85rem">Belum ada ulasan dari petani.</div>
          @endforelse
        </div>
      </div>
    </div>
  </div>

  {{-- ===== TAB: KELUHAN MASUK ===== --}}
  <div id="tab-keluhan" class="tab-hidden">
    <div class="topbar">
      <div>
        <div class="pg-title">Keluhan Masuk</div>
        <div class="pg-sub">Semua keluhan yang ditugaskan kepada Anda</div>
      </div>
      <div>
        <select id="filterStatus" onchange="filterKeluhan()"
          style="padding:.55rem 1rem;border:1.5px solid var(--gray100);border-radius:8px;font-family:'DM Sans',sans-serif;font-size:.82rem;background:white;outline:none">
          <option value="">Semua Status</option>
          <option value="baru">Baru</option>
          <option value="proses">Proses</option>
          <option value="selesai">Selesai</option>
        </select>
      </div>
    </div>
    
    <div class="card">
      @if(isset($semuaKeluhan) && $semuaKeluhan->count() > 0)
        <table class="tbl">
        <thead>
          <tr>
              <th>Judul Keluhan</th>
              <th>Petani</th>
              <th>Daerah</th>
              <th>Tanaman</th>
              <th>Tanggal</th>
              <th>Status Keluhan</th>
              <th>Status Konsultasi</th>
              <th>Penilaian</th>
              <th>Aksi</th>
          </tr>
        </thead>
          <tbody id="tblKeluhanBody">
            @foreach($semuaKeluhan as $kel)
              @php $kons = $kel->konsultasi->first(); @endphp
              <tr data-status="{{ $kel->status }}">
                <td style="font-weight:600;max-width:160px">{{ $kel->judul_keluhan }}</td>
                <td>{{ $kel->petani->nama ?? '—' }}</td>
                <td>{{ $kel->petani->daerah ?? '—' }}</td>
                <td>{{ $kel->tanaman->nama_tanaman ?? 'Umum' }}</td>
                <td>{{ \Carbon\Carbon::parse($kel->tanggal_keluhan)->format('d M Y') }}</td>
                <td><span class="badge b-{{ $kel->status }}">{{ ucfirst($kel->status) }}</span></td>
                <td>
                  @if($kons)
                    <span class="badge b-{{ $kons->status }}">{{ ucfirst($kons->status) }}</span>
                  @else
                    <span style="color:var(--gray400);font-size:.78rem">—</span>
                  @endif
                </td>
                <td>
                  @if($kel->status === 'selesai' && isset($kel->rating))
                    @php $ratingVal = max(0, min(5, intval($kel->rating))); @endphp
                    <div style="color: #FFA800; font-weight: bold; font-size: 0.85rem; white-space: nowrap;">
                      {{ str_repeat('★', $ratingVal) }}{{ str_repeat('☆', 5 - $ratingVal) }}
                    </div>
                    @if($kel->ulasan)
                      <div style="font-size: 0.72rem; color: var(--gray400); font-style: italic; margin-top: 4px; max-width: 150px; line-height: 1.2;">
                        "{{ Str::limit($kel->ulasan, 40) }}"
                      </div>
                    @endif
                  @else
                    <span style="color:var(--gray400);font-size:.75rem">—</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('konsultan.keluhan.show', $kel->id) }}" class="btn-xs g" style="text-decoration: none; display: inline-block; text-align: center;">
                    Lihat
                  </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <div class="empty-state">Belum ada keluhan yang ditugaskan kepada Anda.</div>
      @endif
    </div>
  </div>

  {{-- ===== TAB: ENSIKLOPEDIA TANAMAN ===== --}}
  <div id="tab-ensiklopedia" class="tab-hidden">
    <div class="topbar">
      <div>
        <div class="pg-title">Ensiklopedia Komoditas</div>
        <div class="pg-sub">Panduan perawatan tanaman, protokol pengobatan, dan ancaman hama.</div>
      </div>
      <div class="topbar-actions">
        <input type="text" id="pustakaSearch" class="search-box"
          placeholder="Cari nama komoditas..." onkeyup="cariTanaman()">
        <button class="btn-sm" onclick="bukaModalTambah()">➕ Tambah Komoditas</button>
      </div>
    </div>

    <div class="tanaman-grid" id="containerPustaka">
      @if(isset($daftarTanaman))
        @forelse($daftarTanaman as $t)
            @php
            $ancamanList = [];
            if ($t->ancaman_hama) {
              $raw = $t->ancaman_hama;
              $decoded = is_array($raw) ? $raw : json_decode($raw, true);
              if (is_array($decoded)) $ancamanList = array_filter($decoded);
            }
            @endphp
          <div class="t-card" data-id="{{ $t->id }}" data-nama="{{ $t->nama_tanaman }}" data-latin="{{ $t->nama_latin }}" data-jenis="{{ $t->jenis_tanaman }}" data-deskripsi="{{ $t->deskripsi }}" data-perawatan="{{ $t->metode_perawatan }}" data-pengobatan="{{ $t->protokol_pengobatan }}" data-ancaman="{{ json_encode($ancamanList) }}" data-video-url="{{ isset($t->videos) && $t->videos->first() ? $t->videos->first()->url : '' }}" data-videos="{{ json_encode($t->videos ?? []) }}">
            <div class="t-header">
              <div class="t-icon">
                @if($t->foto_tanaman)
                  <img src="{{ asset('storage/'.$t->foto_tanaman) }}" alt="{{ $t->nama_tanaman }}">
                @else
                  🌱
            @endif
              </div>
              <div>
                <div class="t-name">{{ $t->nama_tanaman }}</div>
                @if($t->nama_latin)
                  <div class="t-latin">{{ $t->nama_latin }}</div>
                @endif
                @if($t->jenis_tanaman)
                  <span class="t-jenis">{{ $t->jenis_tanaman }}</span>
                @endif
              </div>
              <div class="t-actions-wrapper">
                <button class="t-edit-btn" onclick="bukaModalEdit({{ $t->id }})">✏️ Edit</button>
                <button class="t-delete-btn" onclick="hapusTanaman({{ $t->id }})">❌ Hapus</button>
              </div>
            </div>

            @if($t->deskripsi)
              <div class="t-section">
                <div class="t-section-title">📝 Deskripsi</div>
                <div class="t-section-desc">{{ $t->deskripsi }}</div>
              </div>
            @endif

            @if($t->metode_perawatan)
              <div class="t-section">
                <div class="t-section-title">🚜 Metode Perawatan</div>
                <div class="t-section-desc">{{ $t->metode_perawatan }}</div>
              </div>
            @endif

            @if($t->protokol_pengobatan)
              <div class="t-section">
                <div class="t-section-title">🧪 Protokol Pengobatan</div>
                <div class="t-section-desc">{{ $t->protokol_pengobatan }}</div>
              </div>
            @endif

            @if(count($ancamanList) > 0)
              <div class="t-section">
                <div class="t-section-title">⚠️ Bahaya & Ancaman Hama</div>
                <div class="t-danger-list">
                  @foreach($ancamanList as $ancaman)
                    <div class="t-danger-item">{{ $ancaman }}</div>
                  @endforeach
                </div>
              </div>
            @endif

            @php $videoList = $t->videos ?? collect(); @endphp
            @if(is_countable($videoList) && count($videoList) > 0)
              <div class="t-section t-video-section-dynamic" style="margin-top:.5rem;border-top:1px dashed var(--gray100);padding-top:.6rem;">
                <div class="t-section-title" style="margin-bottom: 8px;">📹 Video Panduan</div>
                <div style="display: flex; flex-direction: column; gap: 2px;">
                  @foreach(collect($videoList)->take(2) as $vid)
                    @php 
                      $playArgs = ''; 
                      $icon = '📹'; 
                      $sub = '';
                      if ($vid->url) {
                        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([\w-]{11})/', $vid->url, $m)) {
                          $playArgs = "playGlobalVideo('youtube', '{$m[1]}', '".addslashes($vid->judul)."')";
                          $icon = '🔗';
                          $sub = 'YouTube';
                        }
                      } elseif ($vid->file_path) {
                        $src = asset('storage/'.$vid->file_path);
                        $playArgs = "playGlobalVideo('file', '{$src}', '".addslashes($vid->judul)."')";
                        $icon = '📁';
                        $sub = 'File Video';
                      }
                    @endphp
                    @if($playArgs)
                      <div onclick="{{ $playArgs }}" style="display: flex; align-items: center; gap: 10px; background: #f8faf4; border: 1px solid var(--g100); border-radius: 10px; padding: 8px 12px; margin-bottom: 6px; cursor: pointer; transition: all 0.2s ease-in-out;" onmouseover="this.style.background='var(--g50)'; this.style.borderColor='var(--g300)'; this.style.transform='translateY(-1px)';" onmouseout="this.style.background='#f8faf4'; this.style.borderColor='var(--g100)'; this.style.transform='translateY(0)';" title="Putar Video">
                        <span style="font-size: 0.9rem; display: flex; align-items: center; justify-content: center; width: 24px; height: 24px; border-radius: 50%; background: var(--g100); color: var(--g800); flex-shrink: 0;">▶️</span>
                        <div style="flex: 1; min-width: 0; text-align: left;">
                          <div style="font-size: 0.78rem; font-weight: 700; color: var(--g800); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 1.2;">{{ $vid->judul }}</div>
                          <span style="font-size: 0.65rem; color: var(--gray400); display: block; margin-top: 1px;">{{ $icon }} {{ $sub }}</span>
                        </div>
                      </div>
                    @endif
                  @endforeach
                </div>
                @if(collect($videoList)->count() > 2)
                  <div style="text-align:center;margin-top:4px;">
                    <button type="button" style="background:var(--g50);color:var(--g800);border:1px solid var(--g100);padding:3px 12px;border-radius:20px;font-size:.75rem;cursor:pointer;font-weight:600;font-family:'DM Sans',sans-serif;" onclick="const d=this.nextElementSibling;const h=d.style.display==='none';d.style.display=h?'flex':'none';this.innerHTML=h?'⬆️ Lebih Sedikit':'⬇️ Lihat Lebih Banyak (+{{ collect($videoList)->count() - 2 }});">⬇️ Lihat Lebih Banyak (+{{ collect($videoList)->count() - 2 }})</button>
                    <div style="display:none; flex-direction:column; gap:2px; margin-top:4px;">
                      @foreach(collect($videoList)->skip(2) as $vid)
                        @php 
                          $playArgs = ''; 
                          $icon = '📹'; 
                          $sub = '';
                          if ($vid->url) {
                            if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([\w-]{11})/', $vid->url, $m)) {
                              $playArgs = "playGlobalVideo('youtube', '{$m[1]}', '".addslashes($vid->judul)."')";
                              $icon = '🔗';
                              $sub = 'YouTube';
                            }
                          } elseif ($vid->file_path) {
                            $src = asset('storage/'.$vid->file_path);
                            $playArgs = "playGlobalVideo('file', '{$src}', '".addslashes($vid->judul)."')";
                            $icon = '📁';
                            $sub = 'File Video';
                          }
                        @endphp
                        @if($playArgs)
                          <div onclick="{{ $playArgs }}" style="display: flex; align-items: center; gap: 10px; background: #f8faf4; border: 1px solid var(--g100); border-radius: 10px; padding: 8px 12px; margin-bottom: 6px; cursor: pointer; transition: all 0.2s ease-in-out;" onmouseover="this.style.background='var(--g50)'; this.style.borderColor='var(--g300)'; this.style.transform='translateY(-1px)';" onmouseout="this.style.background='#f8faf4'; this.style.borderColor='var(--g100)'; this.style.transform='translateY(0)';" title="Putar Video">
                            <span style="font-size: 0.9rem; display: flex; align-items: center; justify-content: center; width: 24px; height: 24px; border-radius: 50%; background: var(--g100); color: var(--g800); flex-shrink: 0;">▶️</span>
                            <div style="flex: 1; min-width: 0; text-align: left;">
                              <div style="font-size: 0.78rem; font-weight: 700; color: var(--g800); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 1.2;">{{ $vid->judul }}</div>
                              <span style="font-size: 0.65rem; color: var(--gray400); display: block; margin-top: 1px;">{{ $icon }} {{ $sub }}</span>
                            </div>
                          </div>
                        @endif
                      @endforeach
                    </div>
                  </div>
                @endif
              </div>
            @endif
          </div>
          @empty
          <div style="grid-column:1/-1">
            <div class="empty-state">Belum ada data komoditas tanaman. Klik "Tambah Komoditas" untuk memulai.</div>
          </div>
          @endforelse

          @if($keluhanBaru->isEmpty() && $konsultasiAktif->isEmpty())
            <tr>
              <td colspan="7" style="color:var(--gray400); text-align:center; padding:2rem;">Belum ada keluhan masuk yang ditugaskan kepada Anda.</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>

  {{-- ===== TAB: RIWAYAT ===== --}}
  <div id="tab-riwayat" class="tab-hidden">
    <div class="topbar">
      <div>
        <div class="pg-title">Riwayat Konsultasi</div>
        <div class="pg-sub">Rekap seluruh konsultasi yang Anda tangani</div>
    </div>
    </div>
    <div class="card">
      @if(isset($riwayatKonsultasi) && $riwayatKonsultasi->count() > 0)
      <table class="tbl">
        <thead>
          <tr>
              <th>#</th>
              <th>Judul Keluhan</th>
            <th>Petani</th>
              <th>Tanggal Konsultasi</th>
            <th>Diagnosa</th>
            <th>Rekomendasi</th>
              <th>Status</th>
              <th>Penilaian</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
            @foreach($riwayatKonsultasi as $i => $k)
              <tr class="riwayat-row">
                <td style="color:var(--gray400)">{{ $i + 1 }}</td>
                <td style="font-weight:600">{{ $k->keluhan->judul_keluhan ?? '—' }}</td>
                <td>{{ $k->keluhan->petani->nama ?? '—' }}</td>
                <td>{{ $k->tanggal_konsultasi
                    ? \Carbon\Carbon::parse($k->tanggal_konsultasi)->format('d M Y')
                    : '—' }}
                </td>
                <td>
                  @if($k->diagnosa)
                    <div class="diagnosa-text">{{ $k->diagnosa }}</div>
                  @else
                    <span style="color:var(--gray400);font-size:.75rem">Belum diisi</span>
                  @endif
                </td>
                <td>
                  @if($k->rekomendasi)
                    <div class="diagnosa-text">{{ $k->rekomendasi }}</div>
                  @else
                    <span style="color:var(--gray400);font-size:.75rem">Belum diisi</span>
            @endif
                </td>
                <td><span class="badge b-{{ $k->status }}">{{ ucfirst($k->status) }}</span></td>
                <td>
                  @if($k->status === 'selesai' && isset($k->keluhan->rating))
                    @php $ratingVal = max(0, min(5, intval($k->keluhan->rating))); @endphp
                    <div style="color: #FFA800; font-weight: bold; font-size: 0.85rem; white-space: nowrap;">
                      {{ str_repeat('★', $ratingVal) }}{{ str_repeat('☆', 5 - $ratingVal) }}
                    </div>
                    @if($k->keluhan->ulasan)
                      <div style="font-size: 0.72rem; color: var(--gray400); font-style: italic; margin-top: 4px; max-width: 150px; line-height: 1.2;">
                        "{{ Str::limit($k->keluhan->ulasan, 40) }}"
                      </div>
                    @endif
                  @else
                    <span style="color:var(--gray400);font-size:.75rem">—</span>
                  @endif
                </td>
                <td>
                  <button type="button" onclick="hapusRiwayatKonsultasi(event, '{{ $k->id_konsultasi }}', this)" style="padding: .45rem .9rem; border-radius: var(--radius-sm); font-size: .78rem; font-weight: 600; cursor: pointer; font-family: 'DM Sans', sans-serif; background: var(--r50); color: var(--r400); border: 1px solid rgba(220, 38, 38, 0.15); transition: all 0.2s;">Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
      @else
        <div class="empty-state">Belum ada riwayat konsultasi.</div>
      @endif
    </div>
  </div>

  {{-- ===== TAB: PROFIL ===== --}}
  <div id="tab-profil" class="tab-hidden">
    <div class="topbar">
      <div>
        <div class="pg-title">Profil Saya</div>
        <div class="pg-sub">Informasi akun konsultan</div>
    </div>
    </div>

    <div class="profil-grid">
      <div class="profil-foto-wrap">
        <div class="profil-av">
          @if(isset($konsultan) && $konsultan->foto_profil)
            <img src="{{ asset('storage/'.$konsultan->foto_profil) }}" alt="Foto Profil">
          @else
            {{ strtoupper(substr($konsultan->nama ?? 'K', 0, 2)) }}
          @endif
        </div>
        <div style="text-align:center">
          <div style="font-family:'DM Serif Display',serif;font-size:1.2rem;color:var(--g900)">{{ $konsultan->nama ?? '-' }}</div>
          <div style="font-size:.82rem;color:var(--gray400);margin-top:4px">{{ ($konsultan->keahlian ?? false) ? 'Ahli '.ucfirst($konsultan->keahlian) : 'Konsultan Pertanian' }}</div>
          <div style="margin-top:.75rem">
            <span class="badge b-{{ ($konsultan->status ?? '') === 'aktif' ? 'selesai' : 'menunggu' }}">
              {{ ucfirst($konsultan->status ?? 'menunggu') }}
            </span>
            <span style="color:var(--gray400); font-size:.78rem;">{{ \Carbon\Carbon::parse($ul->tanggal_ulasan)->translatedFormat('d M Y') }}</span>
          </div>
          <p style="color:var(--text); font-size:.875rem; line-height:1.6; font-style:italic; background:var(--bg); border-radius:8px; padding:12px;">
            "{{ $ul->komentar ?? 'Tidak ada komentar tertulis.' }}"
          </p>
        </div>
      @empty
        <div style="color:var(--gray400); font-size:.875rem; text-align:center; padding:2rem;">Belum ada ulasan dari petani untuk Anda saat ini.</div>
      @endforelse
    </div>
  </div>

      <div class="card">
        <div class="ct">
          Informasi Akun
          <button type="button" class="btn-sm" onclick="openModal('modalProfilKonsultanEdit')" style="padding: 6px 14px; font-size: 0.78rem;">✏️ Edit Profil</button>
    </div>
        <div class="info-row">
          <span class="info-label">Nama Lengkap</span>
          <span class="info-val">{{ $konsultan->nama ?? '-' }}</span>
        </div>
        <div class="info-row">
          <span class="info-label">Email</span>
          <span class="info-val">{{ auth()->user()->email ?? '—' }}</span>
        </div>
        <div class="info-row">
          <span class="info-label">Telepon</span>
          <span class="info-val">{{ auth()->user()->telepon ?? '—' }}</span>
        </div>
        <div class="info-row">
          <span class="info-label">Alamat Kantor/Praktek</span>
          <span class="info-val">{{ $konsultan->alamat ?? '—' }}</span>
        </div>
        <div class="info-row">
          <span class="info-label">Keahlian</span>
          <span class="info-val">{{ $konsultan->keahlian ?? '—' }}</span>
        </div>
        <div class="info-row">
          <span class="info-label">Rating Konsultan</span>
          <span class="info-val">
            @if(isset($sidebarAvgRating) && $sidebarAvgRating)
              <span style="color: #FFA800; font-weight: bold;">⭐ {{ number_format($sidebarAvgRating, 1) }}</span>
              <span style="color: var(--gray400); font-size: 0.8rem; margin-left: 4px;">
                ({{ str_repeat('★', $sidebarFullStars) }}{{ str_repeat('☆', 5 - $sidebarFullStars) }} - {{ $sidebarRatings->count() }} ulasan)
              </span>
            @else
              <span style="color: var(--gray400); font-style: italic;">Belum ada ulasan</span>
            @endif
          </span>
        </div>
        <div class="info-row">
          <span class="info-label">Tarif Konsultasi</span>
          <span class="info-val">
            {{ ($konsultan->tarif_konsultasi ?? null)
                ? 'Rp '.number_format($konsultan->tarif_konsultasi < 1000 ? $konsultan->tarif_konsultasi * 1000 : $konsultan->tarif_konsultasi, 0, ',', '.')
                : '—' }}
          </span>
        </div>
        <div class="info-row" style="flex-direction: column; align-items: flex-start; gap: 8px;">
          <span class="info-label" style="margin-bottom: 2px;">Berkas Portofolio / Sertifikat</span>
          @php
            $dokPaths = [];
            $decoded = json_decode($konsultan->dokumen_path ?? '', true);
            if (is_array($decoded)) {
                $dokPaths = $decoded;
            } elseif (!empty($konsultan->dokumen_path)) {
                $dokPaths = [$konsultan->dokumen_path];
            }
          @endphp
          @if(!empty($dokPaths))
            <div style="display:flex; flex-wrap:wrap; gap:8px; width: 100%;">
              @foreach($dokPaths as $index => $path)
                @php
                  $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                  $fileLabel = "Dokumen " . ($index + 1);
                  $fileIco = in_array($ext, ['jpg','jpeg','png','webp']) ? '🖼️' : ($ext === 'pdf' ? '📄' : '📎');
                @endphp
                <a href="{{ asset('storage/' . $path) }}" target="_blank"
                   style="display:inline-flex;align-items:center;gap:5px;background:var(--g50);
                          border:1px solid var(--g100);border-radius:8px;padding:6px 12px;
                          font-size:.78rem;color:var(--g600);text-decoration:none;font-weight:600;
                          transition: all 0.2s;"
                   onmouseover="this.style.background='var(--g100)'"
                   onmouseout="this.style.background='var(--g50)'"
                >{{ $fileIco }} {{ $fileLabel }}</a>
              @endforeach
            </div>
          @else
            <span style="color:var(--gray400); font-size:0.8rem; font-style:italic;">Tidak ada berkas yang diunggah</span>
          @endif
        </div>
        <div class="info-row">
          <span class="info-label">Status Akun</span>
          <span class="badge b-{{ ($konsultan->status ?? '') === 'aktif' ? 'selesai' : 'menunggu' }}">
            {{ ucfirst($konsultan->status ?? 'menunggu') }}
          </span>
        </div>
        <div class="info-row">
          <span class="info-label">Bergabung Sejak</span>
          <span class="info-val">
            {{ ($konsultan->created_at ?? null)
                ? \Carbon\Carbon::parse($konsultan->created_at)->format('d M Y')
                : '—' }}
          </span>
        </div>
      </div>
    </div>
  </div>
</main>


{{-- ==================== MODAL: BERI JAWABAN ==================== --}}
<div class="ov" id="modalBeri" onclick="bgClose(event,'modalBeri')">
  <div class="modal">
    <div class="m-title">Beri Jawaban Konsultasi</div>
    <form id="jawabKonsultasiForm" onsubmit="submitJawabKonsultasi(event)">
        @csrf
      <input type="hidden" name="id_konsultasi" id="modal_id_konsultasi">
      <input type="hidden" name="id_keluhan" id="modal_id_keluhan">
          
          <div class="fg">
        <label for="diagnosa">Diagnosa Gejala Penyakit</label>
        <input type="text" id="diagnosa" name="diagnosa"
          placeholder="Contoh: Hawar Daun Bakteri / Defisiensi Kalium" required>
          </div>

          <div class="fg">
        <label for="rekomendasi">Rekomendasi Penanganan</label>
        <textarea id="rekomendasi" name="rekomendasi"
          placeholder="Tulis langkah taktis perawatan atau resep fungisida/pestisida..." required></textarea>
      </div>
      <div class="fg">
        <label for="catatan_konsultasi">Catatan Tambahan (opsional)</label>
        <textarea id="catatan_konsultasi" name="catatan_konsultasi"
          placeholder="Catatan internal konsultasi..."></textarea>
          </div>

      <div class="m-act">
        <button type="button" class="btn-c" onclick="closeModal('modalBeri')">Batal</button>
        <button type="submit" class="btn-s">Kirim Solusi</button>
      </div>
    </form>
  </div>
</div>

{{-- ==================== MODAL: TAMBAH / EDIT TANAMAN ==================== --}}
<div class="ov" id="modalEditTanaman" onclick="bgClose(event,'modalEditTanaman')">
  <div class="modal">
    <div class="m-title" id="modalPustakaTitle">Informasi Pustaka Komoditas</div>
    <input type="hidden" id="editIdTanaman">

          <div class="fg">
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
        <div>
          <label>Nama Tanaman</label>
          <input type="text" id="editNama" placeholder="Contoh: Kentang">
        </div>
        <div>
          <label>Nama Latin</label>
          <input type="text" id="editLatin" placeholder="Contoh: Solanum tuberosum">
        </div>
      </div>
          </div>

          <div class="fg">
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
        <div>
          <label>Jenis Tanaman</label>
          <select id="editJenis">
            <option value="">— Pilih Jenis —</option>
            <option value="Pangan">Pangan</option>
            <option value="Hortikultura">Hortikultura</option>
            <option value="Perkebunan">Perkebunan</option>
            <option value="Palawija">Palawija</option>
            <option value="Lainnya">Lainnya</option>
          </select>
        </div>
        <div>
          <label>Foto Tanaman</label>
          <input type="file" id="editGambarFile" accept="image/*">
        </div>
      </div>
          </div>

          <div class="fg">
      <label>Deskripsi Singkat</label>
      <textarea id="editDeskripsi" placeholder="Deskripsi umum komoditas..."></textarea>
          </div>
    <div class="fg">
      <label>🚜 Metode Perawatan</label>
      <textarea id="editPerawatan" placeholder="Tulis metode perawatan operasional kebun..."></textarea>
    </div>
    <div class="fg">
      <label>🧪 Protokol Pengobatan</label>
      <textarea id="editPengobatan" placeholder="Tulis penanganan infeksi patogen / resep fungisida..."></textarea>
    </div>
    <div class="fg">
      <label>⚠️ Ancaman Hama 1</label>
      <input type="text" id="editAncaman1" placeholder="Nama hama/penyakit ancaman pertama">
    </div>
    <div class="fg">
      <label>⚠️ Ancaman Hama 2</label>
      <input type="text" id="editAncaman2" placeholder="Nama hama/penyakit ancaman kedua">
    </div>
    <div class="fg">
      <label>⚠️ Ancaman Hama 3 (opsional)</label>
      <input type="text" id="editAncaman3" placeholder="Nama hama/penyakit ancaman ketiga">
        </div>

    <div class="fg" style="border-top: 1px solid var(--g100); padding-top: 10px; margin-top: 10px;">
      <label style="font-weight: 600; color: var(--g800); display: flex; align-items: center; gap: 6px;">📹 Daftar Video Terkait</label>
      <div id="editTanamanVideoList" style="margin-top: 8px; margin-bottom: 12px; display: flex; flex-direction: column; gap: 8px;"></div>
      <div style="margin-bottom: 15px;">
        <button type="button" style="background: var(--g600); color: white; padding: 8px 16px; border: none; border-radius: 8px; font-size: 0.85rem; font-weight: 600; cursor: pointer; font-family: 'DM Sans', sans-serif; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 4px 12px rgba(59, 125, 63, 0.2); transition: all 0.2s;" onmouseover="this.style.background='#316834'; this.style.transform='translateY(-1px)';" onmouseout="this.style.background='var(--g600)'; this.style.transform='translateY(0)';" onclick="openVideoModalFromEdit()">
          <span style="color: #c084fc; font-weight: bold; font-size: 1.1rem; line-height: 1; margin-right: 2px;">+</span> Tambah Video Baru
        </button>
      </div>
    </div>

    <div class="m-act">
      <button class="btn-c" onclick="closeModal('modalEditTanaman')">Batal</button>
      <button class="btn-s" onclick="submitTanaman()">Simpan</button>
            </div>
            <div style="flex:1;">
              <label>Foto Profil</label>
              <input type="file" name="foto_profil" accept="image/*">
            </div>
          </div>

<div class="ov" id="modalVideoTanaman" onclick="bgClose(event,'modalVideoTanaman')">
  <div class="modal" style="max-width:560px; padding: 0; overflow: hidden; border-radius: 20px;">
    <div style="background: linear-gradient(135deg, var(--g800) 0%, #0a3d25 100%); padding: 1.5rem 2rem; display: flex; align-items: center; justify-content: space-between;">
      <div>
        <div id="videoModalTitle" style="font-family:'DM Serif Display',serif; font-size:1.3rem; color:white; font-weight:700;">📹 Tambah Video Panduan</div>
        <div style="font-size:0.78rem; color:rgba(255,255,255,0.55); margin-top:3px;">Tautkan video YouTube atau unggah file MP4 langsung.</div>
      </div>
      <button type="button" onclick="closeModal('modalVideoTanaman')" style="background:rgba(255,255,255,0.1); border:none; color:rgba(255,255,255,0.7); width:34px; height:34px; border-radius:50%; cursor:pointer; font-size:1.1rem; display:flex; align-items:center; justify-content:center; transition:all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">✕</button>
    </div>
    <form id="addVideoForm" method="POST" action="" enctype="multipart/form-data" style="padding: 1.75rem 2rem 1.5rem;">
      @csrf
      <div style="display:flex; gap:0; background:var(--gray50); border-radius:10px; padding:4px; margin-bottom:1.5rem; border:1px solid var(--gray100);">
        <button type="button" id="vtabLinkBtn" onclick="switchVTab('link')" style="flex:1; padding:8px 12px; border-radius:8px; border:none; cursor:pointer; font-size:0.85rem; font-weight:600; font-family:'DM Sans',sans-serif; background:white; color:var(--g800); box-shadow:0 2px 6px rgba(6,47,30,0.08); transition:all 0.2s;">🔗 Link YouTube / URL</button>
        <button type="button" id="vtabFileBtn" onclick="switchVTab('file')" style="flex:1; padding:8px 12px; border-radius:8px; border:none; cursor:pointer; font-size:0.85rem; font-weight:600; font-family:'DM Sans',sans-serif; background:transparent; color:var(--gray400); transition:all 0.2s;">📁 Upload File Video</button>
      </div>
      <div id="vtabLink">
          <div class="fg">
          <label>Judul Video <span style="color:var(--r400)">*</span></label>
          <input type="text" name="judul" id="videoJudul" placeholder="cth: Cara mengatasi wereng coklat pada padi">
        </div>
        <div class="fg">
          <label>Link YouTube / URL Video <span style="color:var(--r400)">*</span></label>
          <input type="url" name="video_url" id="videoUrl" placeholder="https://youtube.com/watch?v=..." oninput="updateVideoPreview()">
        </div>
      </div>
      <div id="vtabFile" style="display:none">
        <div class="fg">
          <label>Judul Video <span style="color:var(--r400)">*</span></label>
          <input type="text" id="videoJudulFile" placeholder="cth: Tutorial pemupukan berimbang">
        </div>
        <div class="fg">
          <label>Upload File Video <span style="color:var(--gray400); font-weight:400;">(MP4 / MKV / AVI — maks. 50 MB)</span></label>
          <div onclick="document.getElementById('videoFileInput').click()" style="border: 2px dashed var(--gray100); border-radius: 10px; padding: 1.5rem; text-align: center; cursor: pointer; background: var(--gray50); transition: all 0.2s;" onmouseover="this.style.borderColor='var(--g400)'; this.style.background='var(--g50)'" onmouseout="this.style.borderColor='var(--gray100)'; this.style.background='var(--gray50)'">
            <div style="font-size:2rem; margin-bottom:6px;">🎬</div>
            <div style="font-size:0.85rem; color:var(--gray400); font-weight:500;">Klik untuk pilih file video</div>
            <div id="videoFileName" style="font-size:0.78rem; color:var(--g600); margin-top:6px; font-weight:600;"></div>
          </div>
          <input type="file" id="videoFileInput" name="video_file" accept="video/mp4,video/x-matroska,video/x-msvideo" style="display:none" onchange="previewVideoFile(this)">
        </div>
      </div>
      <input type="hidden" name="uploader" value="konsultan">
      <div id="videoPreviewArea" style="display:none; margin-top:1rem; border-radius:10px; overflow:hidden; background:#000; aspect-ratio:16/9; max-width:100%; border:1px solid var(--g100);"></div>
      <div style="display:flex; gap:10px; justify-content:flex-end; margin-top:1.5rem; padding-top:1.25rem; border-top:1px solid var(--gray100);">
        <button type="button" onclick="closeModal('modalVideoTanaman')" style="padding:.65rem 1.4rem; background:var(--gray50); color:var(--text); border:1px solid var(--gray100); border-radius:10px; font-weight:600; font-size:0.88rem; font-family:'DM Sans',sans-serif; cursor:pointer; transition:all 0.2s;" onmouseover="this.style.background='var(--gray100)'" onmouseout="this.style.background='var(--gray50)'">Batal</button>
        <button type="button" onclick="addVideoLocal()" style="padding:.65rem 1.6rem; background:linear-gradient(135deg, var(--g600), var(--g800)); color:white; border:none; border-radius:10px; font-weight:700; font-size:0.88rem; font-family:'DM Sans',sans-serif; cursor:pointer; box-shadow:0 4px 12px rgba(6,47,30,0.2); transition:all 0.2s;" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 16px rgba(6,47,30,0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(6,47,30,0.2)'">✅ Tambahkan Video</button>
      </div>
    </form>
  </div>
          </div>

<div class="ov" id="modalWatchVideo" onclick="bgClose(event,'modalWatchVideo')" style="z-index: 11000; background: rgba(3, 27, 17, 0.85); backdrop-filter: blur(8px);">
  <div class="modal" style="max-width: 760px; width: 90%; padding: 0; overflow: hidden; border-radius: 20px; border: 1.5px solid rgba(255,255,255,0.15); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);">
    <div style="background: linear-gradient(135deg, var(--g800) 0%, #0a3d25 100%); padding: 1.25rem 1.75rem; display: flex; align-items: center; justify-content: space-between; border-bottom: 1.5px solid rgba(255,255,255,0.05);">
      <div>
        <div style="font-size: 0.72rem; color: var(--mint); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Memutar Panduan</div>
        <div id="watchVideoTitle" style="font-family:'DM Serif Display',serif; font-size: 1.2rem; color: white; font-weight: 700; margin-top: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 500px;">📹 Video Panduan</div>
                  </div>
      <button type="button" onclick="closeWatchVideoModal()" style="background: rgba(255,255,255,0.1); border: none; color: rgba(255,255,255,0.8); width: 34px; height: 34px; border-radius: 50%; cursor: pointer; font-size: 1.1rem; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">✕</button>
              </div>
    <div id="watchVideoContainer" style="width: 100%; aspect-ratio: 16/9; background: #000; display: flex; align-items: center; justify-content: center;"></div>
  </div>
          </div>

<div class="ov" id="modalProfilKonsultanEdit" onclick="bgClose(event, 'modalProfilKonsultanEdit')">
  <form class="modal" method="POST" action="{{ route('konsultan.profil.update') }}" enctype="multipart/form-data" style="max-width: 480px; width: 90%;">
    @csrf @method('PUT')
    <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid var(--gray50); padding-bottom: 12px; margin-bottom: 16px;">
      <h3 style="font-family: 'DM Serif Display', serif; font-size: 1.5rem; color: var(--g900); display: flex; align-items: center; gap: 8px;">
        <span>👨‍🌾</span> Edit Profil Konsultan
      </h3>
      <button type="button" style="background: none; border: none; font-size: 1.25rem; color: var(--gray400); cursor: pointer;" onclick="closeModal('modalProfilKonsultanEdit')">✕</button>
        </div>
    <div style="display: flex; flex-direction: column; gap: 15px;">
      <div style="display: flex; align-items: center; gap: 16px; background: var(--gray50); padding: 12px; border-radius: 12px; border: 1px solid var(--gray100);">
        <div style="width: 70px; height: 70px; border-radius: 50%; background: var(--g100); color: var(--g800); display: flex; align-items: center; justify-content: center; font-size: 1.8rem; font-weight: bold; overflow: hidden; flex-shrink: 0; border: 2.5px solid var(--g600);">
          @if(isset($konsultan) && $konsultan->foto_profil)
            <img src="{{ asset('storage/' . $konsultan->foto_profil) }}" style="width: 100%; height: 100%; object-fit: cover;">
    @else
            {{ strtoupper(substr($konsultan->nama ?? 'K', 0, 2)) }}
    @endif
  </div>
        <div style="flex: 1;">
          <label style="display: block; margin-bottom: 6px; font-size: 0.78rem; color: var(--gray600); font-weight: 700; text-transform: uppercase; letter-spacing: 0.02em;">Unggah Foto Profil Baru</label>
          <input name="foto_profil" type="file" accept="image/*" style="font-size: 0.8rem; width: 100%;">
          <span style="font-size: 0.68rem; color: var(--gray400); display: block; margin-top: 4px;">Maksimal 50MB (format: JPG, PNG, WEBP)</span>
        </div>
      </div>
      <div class="fg" style="margin-bottom: 0;">
        <label style="display: block; margin-bottom: 6px; font-size: 0.78rem; color: var(--gray600); font-weight: 700; text-transform: uppercase; letter-spacing: 0.02em;">Nama Lengkap</label>
        <input name="nama" type="text" value="{{ old('nama', $konsultan->nama ?? '') }}" placeholder="Masukkan nama lengkap Anda..." required>
      </div>
      <div class="fg" style="margin-bottom: 0;">
        <label style="display: block; margin-bottom: 6px; font-size: 0.78rem; color: var(--gray600); font-weight: 700; text-transform: uppercase; letter-spacing: 0.02em;">Spesialisasi / Keahlian</label>
        <input name="keahlian" type="text" value="{{ old('keahlian', $konsultan->keahlian ?? '') }}" placeholder="Contoh: Penyakit Daun, Jamur Tanaman" required>
      </div>
      <div class="fg" style="margin-bottom: 0;">
        <label style="display: block; margin-bottom: 6px; font-size: 0.78rem; color: var(--gray600); font-weight: 700; text-transform: uppercase; letter-spacing: 0.02em;">Nomor Telepon / WhatsApp</label>
        <input name="telepon" type="text" value="{{ old('telepon', auth()->user()->telepon ?? $konsultan->telepon ?? '') }}" placeholder="Contoh: 08123456789" required>
      </div>
      <div class="fg" style="margin-bottom: 0;">
        <label style="display: block; margin-bottom: 6px; font-size: 0.78rem; color: var(--gray600); font-weight: 700; text-transform: uppercase; letter-spacing: 0.02em;">Tarif Konsultasi per Sesi (Rupiah)</label>
        @php
          $rawTarif = $konsultan->tarif_konsultasi ?? 0;
          $cleanTarif = $rawTarif < 1000 ? $rawTarif * 1000 : $rawTarif;
        @endphp
        <input name="tarif_konsultasi" type="number" value="{{ old('tarif_konsultasi', intval($cleanTarif)) }}" placeholder="Contoh: 50000" min="0" required>
        <span style="font-size: 0.68rem; color: var(--gray400); display: block; margin-top: 4px;">Tulis angka bulat saja tanpa tanda titik.</span>
      </div>
      <div class="fg" style="margin-bottom: 0;">
        <label style="display: block; margin-bottom: 6px; font-size: 0.78rem; color: var(--gray600); font-weight: 700; text-transform: uppercase; letter-spacing: 0.02em;">Alamat Kantor / Praktek</label>
        <textarea name="alamat" placeholder="Masukkan alamat lengkap kantor atau tempat praktek Anda..." required style="height: 80px; resize: none;">{{ old('alamat', $konsultan->alamat ?? '') }}</textarea>
      </div>
      <div style="display: flex; gap: 10px; margin-top: 8px;">
        <button class="btn-c" style="flex: 1; justify-content: center;" type="button" onclick="closeModal('modalProfilKonsultanEdit')">Batal</button>
        <button class="btn-s" style="flex: 1.5; justify-content: center;" type="submit">Simpan Profil</button>
      </div>
    </div>
  </form>
</div>

<script>
// ==================== NAVIGASI TAB ====================
function showTab(name, el) {
  ['dashboard','keluhan','ensiklopedia','riwayat','profil'].forEach(t => {
    const tabEl = document.getElementById('tab-' + t);
    if (tabEl) tabEl.className = 'tab-hidden';
  });
  const active = document.getElementById('tab-' + name);
  if (active) active.classList.remove('tab-hidden');
  document.querySelectorAll('.sbi').forEach(b => b.classList.remove('active'));
  if (el) el.classList.add('active');
}

const defaultKonsultanTab = @json($activeTab ?? 'dashboard');
document.addEventListener('DOMContentLoaded', () => {
  const defaultButton = document.querySelector(`[onclick="showTab('${defaultKonsultanTab}',this)"]`);
  showTab(defaultKonsultanTab, defaultButton || null);

  const videoUrlInput = document.getElementById('videoUrl');
  if (videoUrlInput) {
    videoUrlInput.addEventListener('input', updateVideoPreview);
  }
});

function openModal(id) { document.getElementById(id).classList.add('show'); }
function closeModal(id) { document.getElementById(id).classList.remove('show'); }
function bgClose(e, id) { if (e.target.id === id) closeModal(id); }

// ==================== MODAL JAWAB ====================
function bukaModalJawab(idKeluhan, idKonsultasi) {
  document.getElementById('modal_id_keluhan').value = idKeluhan;
  document.getElementById('modal_id_konsultasi').value = idKonsultasi;
  document.getElementById('diagnosa').value = '';
  document.getElementById('rekomendasi').value = '';
  document.getElementById('catatan_konsultasi').value = '';
  openModal('modalBeri');
  }

// ==================== FILTER KELUHAN ====================
function filterKeluhan() {
  const val = document.getElementById('filterStatus').value.toLowerCase();
  const rows = document.querySelectorAll('#tblKeluhanBody tr');
  rows.forEach(row => {
    const status = row.getAttribute('data-status') || '';
    row.style.display = (!val || status === val) ? '' : 'none';
  });
}

// ==================== CARI TANAMAN ====================
function cariTanaman() {
  const input = document.getElementById('pustakaSearch').value.toLowerCase();
  document.querySelectorAll('.t-card').forEach(card => {
    const nama = card.querySelector('.t-name')?.textContent.toLowerCase() || '';
    const latin = card.querySelector('.t-latin')?.textContent.toLowerCase() || '';
    const jenis = card.querySelector('.t-jenis')?.textContent.toLowerCase() || '';
    card.style.display = (nama.includes(input) || latin.includes(input) || jenis.includes(input)) ? '' : 'none';
  });
}

// ==================== MODAL TAMBAH & EDIT TANAMAN ====================
let tempVideos = [];
let showAllVideos = false;
let activeVideoContainerId = 'editTanamanVideoList';

function bukaModalTambah() {
  document.getElementById('editIdTanaman').value = '';
  document.getElementById('modalPustakaTitle').textContent = 'Tambah Komoditas Baru';
  ['editNama','editLatin','editDeskripsi','editPerawatan','editPengobatan','editAncaman1','editAncaman2','editAncaman3'].forEach(id => {
    document.getElementById(id).value = '';
  });
  document.getElementById('editJenis').value = '';
  document.getElementById('editGambarFile').value = '';
  
  tempVideos = [];
  showAllVideos = false;
  renderTempVideos('editTanamanVideoList');
  
  openModal('modalEditTanaman');
  }

function bukaModalEdit(id) {
  const card = document.querySelector(`.t-card[data-id="${id}"]`);
  if (!card) return;

  const nama = card.dataset.nama || '';
  const latin = card.dataset.latin || '';
  const jenis = card.dataset.jenis || '';
  const deskripsi = card.dataset.deskripsi || '';
  const perawatan = card.dataset.perawatan || '';
  const pengobatan = card.dataset.pengobatan || '';
  
  let ancaman = [];
  try {
    ancaman = JSON.parse(card.dataset.ancaman || '[]');
  } catch(e) {
    console.error(e);
  }

  document.getElementById('editIdTanaman').value = id;
  document.getElementById('modalPustakaTitle').textContent = `Ubah: ${nama}`;
  document.getElementById('editNama').value = nama;
  document.getElementById('editLatin').value = latin;
  document.getElementById('editJenis').value = jenis;
  document.getElementById('editDeskripsi').value = deskripsi;
  document.getElementById('editPerawatan').value = perawatan;
  document.getElementById('editPengobatan').value = pengobatan;
  document.getElementById('editGambarFile').value = '';
  document.getElementById('editAncaman1').value = ancaman[0] || '';
  document.getElementById('editAncaman2').value = ancaman[1] || '';
  document.getElementById('editAncaman3').value = ancaman[2] || '';

  try {
    const videos = JSON.parse(card.dataset.videos || '[]');
    tempVideos = videos.map(v => ({
      id: v.id,
      action: 'keep',
      judul: v.judul,
      url: v.url,
      filePath: v.file_path,
      isNew: false
    }));
    showAllVideos = false;
    renderTempVideos('editTanamanVideoList');
  } catch (e) {
    console.error('Error parsing plant videos JSON:', e);
    tempVideos = [];
    showAllVideos = false;
    renderTempVideos('editTanamanVideoList');
  }

  openModal('modalEditTanaman');
}

function renderTempVideos(containerId) {
  const container = document.getElementById(containerId);
  if (!container) return;
  
  container.innerHTML = '';
  const visibleVideos = tempVideos.filter(v => v.action !== 'delete');
  
  if (visibleVideos.length === 0) {
    container.innerHTML = '<div style="color:var(--gray400); font-size:0.78rem; font-style:italic;">Belum dikaitkan dengan video panduan.</div>';
    return;
  }
  
  const limit = 2;
  const needsMoreBtn = visibleVideos.length > limit;
  const videosToRender = (needsMoreBtn && !showAllVideos) ? visibleVideos.slice(0, limit) : visibleVideos;
  
  videosToRender.forEach(v => {
    const item = document.createElement('div');
    item.style.cssText = 'background:#f4f7f2; border-radius:12px; border:1px solid rgba(6, 47, 30, 0.04); padding:14px 18px; display:flex; flex-direction:column; gap:8px; margin-bottom:8px; box-shadow: 0 2px 8px rgba(6,47,30,0.02);';
    
    let sourceText = '';
    if (v.file) {
      sourceText = `📁 File: ${v.file.name}`;
    } else if (v.url) {
      sourceText = `🔗 Link: ${v.url}`;
    } else if (v.filePath) {
      sourceText = `📁 Video Upload`;
    }
    
    const idKey = v.id || v.tempId;
    const activeTab = (v.file || (v.filePath && !v.url)) ? 'file' : 'link';
    
    item.innerHTML = `
      <div style="display:flex; justify-content:space-between; align-items:center; width:100%;">
        <div style="flex: 1; text-align: left; padding-right: 10px; min-width: 0;">
          <strong style="color:#062f1e; display:block; font-size:1rem; font-weight:700; font-family:\'DM Sans\',sans-serif; letter-spacing:-0.01em; word-break:break-word; overflow-wrap:anywhere; white-space:normal; line-height:1.25;">${v.judul}</strong>
          <span style="font-size:0.8rem; color:#8c8b82; display:block; margin-top:4px; word-break:break-word; overflow-wrap:anywhere; white-space:normal;">${sourceText}</span>
    </div>
        <div style="display:flex; gap:16px; flex-shrink:0; align-items:center;">
          <button type="button" onclick="toggleEditVideoLocal(${idKey})" style="background:none; border:none; font-size:1.25rem; cursor:pointer; padding:0; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.15)'" onmouseout="this.style.transform='scale(1)'" title="Ubah Video">✏️</button>
          <button type="button" onclick="deleteVideoLocal(${idKey}, '${containerId}')" style="background:none; border:none; font-size:1.25rem; cursor:pointer; padding:0; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.15)'" onmouseout="this.style.transform='scale(1)'" title="Hapus Video">❌</button>
  </div>
</div>
      <div id="vid-edit-form-${idKey}" style="display:none; border-top:1px dashed #e2e8e0; padding-top:8px; margin-top:8px; width:100%;">
        <div style="display:flex; flex-direction:column; gap:6px; margin:0;">
          <div style="display:flex; gap:4px; margin-bottom:4px;">
            <button type="button" id="vtabLinkEditBtn-${idKey}" class="vtab-btn-mini" onclick="switchEditVTab(${idKey}, 'link')" style="padding: 2px 6px; font-size: 0.7rem; border-radius: 4px; cursor: pointer; border: 1px solid #ccc; background: ${activeTab === 'link' ? 'var(--g600)' : 'white'}; color: ${activeTab === 'link' ? 'white' : 'var(--text)'};">🔗 Link</button>
            <button type="button" id="vtabFileEditBtn-${idKey}" class="vtab-btn-mini" onclick="switchEditVTab(${idKey}, 'file')" style="padding: 2px 6px; font-size: 0.7rem; border-radius: 4px; cursor: pointer; border: 1px solid #ccc; background: ${activeTab === 'file' ? 'var(--g600)' : 'white'}; color: ${activeTab === 'file' ? 'white' : 'var(--text)'};">📁 File</button>
          </div>
          <div>
            <label style="font-size:0.7rem; font-weight:600; color:var(--gray400); display:block; text-align:left; margin-bottom:2px;">Judul Video</label>
            <input type="text" id="vid-judul-input-${idKey}" value="${v.judul}" style="width:100%; padding:4px 8px; font-size:0.75rem; border:1px solid #e5e5e0; border-radius:4px; font-family:'DM Sans',sans-serif;" required>
          </div>
          <div id="vid-url-field-${idKey}" style="display: ${activeTab === 'link' ? 'block' : 'none'};">
            <label style="font-size:0.7rem; font-weight:600; color:var(--gray400); display:block; text-align:left; margin-bottom:2px;">Link YouTube / URL Video</label>
            <input type="url" id="vid-url-input-${idKey}" value="${v.url || ''}" oninput="updateEditVideoPreview(${idKey})" style="width:100%; padding:4px 8px; font-size:0.75rem; border:1px solid #e5e5e0; border-radius:4px; font-family:'DM Sans',sans-serif;">
          </div>
          <div id="vid-file-field-${idKey}" style="display: ${activeTab === 'file' ? 'block' : 'none'};">
            <label style="font-size:0.7rem; font-weight:600; color:var(--gray400); display:block; text-align:left; margin-bottom:2px;">Ganti File Video (MP4, maks 50 MB)</label>
            <div onclick="document.getElementById('vid-file-input-${idKey}').click()" style="padding:6px; cursor:pointer; background:white; border:1px dashed var(--gray100); border-radius:6px; display:flex; align-items:center; justify-content:center; margin-bottom:4px;">
              <span style="font-size:0.7rem; color:var(--gray400);" id="vid-file-preview-text-${idKey}">🎬 Klik untuk pilih/ganti video</span>
            </div>
            <input type="file" id="vid-file-input-${idKey}" accept="video/mp4,video/x-matroska,video/x-msvideo" style="display:none;" onchange="previewEditVideoFile(this, ${idKey})">
            <div id="vid-file-name-${idKey}" style="font-size:0.7rem; color:var(--g600); margin-top:2px;">${v.file ? '✅ Terpilih: ' + v.file.name : ''}</div>
          </div>
          <div id="vid-edit-preview-area-${idKey}" style="margin-top: 10px; display: none; border: 1px solid var(--g100); border-radius: 8px; overflow: hidden; background: #000; aspect-ratio: 16/9; max-width: 100%;"></div>
          <div style="display:flex; gap:6px; justify-content:flex-end; margin-top:4px;">
            <button type="button" onclick="toggleEditVideoLocal(${idKey})" style="padding:4px 8px; font-size:0.7rem; border-radius:4px; border:1px solid #e5e5e0; background:white; cursor:pointer;">Batal</button>
            <button type="button" onclick="submitVideoEditLocal(${idKey}, '${containerId}')" style="padding:4px 8px; font-size:0.7rem; border-radius:4px; border:none; background:var(--g600); color:white; font-weight:600; cursor:pointer;">Simpan</button>
          </div>
        </div>
      </div>
    `;
    container.appendChild(item);
  });
  
  if (needsMoreBtn) {
    const btnWrap = document.createElement('div');
    btnWrap.style.cssText = 'text-align: center; margin-top: 10px; margin-bottom: 10px;';
    const moreBtn = document.createElement('button');
    moreBtn.type = 'button';
    moreBtn.style.cssText = 'background: var(--g50); color: var(--g800); border: 1px solid var(--g100); padding: 6px 16px; border-radius: 20px; font-size: 0.8rem; cursor: pointer; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s ease;';
    moreBtn.innerHTML = showAllVideos ? ' Lihat Lebih Sedikit ⬆️' : ' Lihat Lebih Banyak (+' + (visibleVideos.length - limit) + ') ⬇️';
    moreBtn.onclick = () => {
      showAllVideos = !showAllVideos;
      renderTempVideos(containerId);
    };
    btnWrap.appendChild(moreBtn);
    container.appendChild(btnWrap);
  }
}

function toggleEditVideoLocal(idKey) {
  const form = document.getElementById(`vid-edit-form-${idKey}`);
  if (form) {
    const isShowing = form.style.display === 'none';
    form.style.display = isShowing ? 'block' : 'none';
    if (isShowing) {
      updateEditVideoPreview(idKey);
    }
  }
}

function switchEditVTab(idKey, tab) {
  const isLink = tab === 'link';
  const urlField = document.getElementById(`vid-url-field-${idKey}`);
  const fileField = document.getElementById(`vid-file-field-${idKey}`);
  const linkBtn = document.getElementById(`vtabLinkEditBtn-${idKey}`);
  const fileBtn = document.getElementById(`vtabFileEditBtn-${idKey}`);
  
  if (urlField) urlField.style.display = isLink ? 'block' : 'none';
  if (fileField) fileField.style.display = isLink ? 'none' : 'block';
  if (linkBtn) {
    linkBtn.style.background = isLink ? 'var(--g600)' : 'white';
    linkBtn.style.color = isLink ? 'white' : 'var(--text)';
  }
  if (fileBtn) {
    fileBtn.style.background = isLink ? 'white' : 'var(--g600)';
    fileBtn.style.color = isLink ? 'var(--text)' : 'white';
  }
  updateEditVideoPreview(idKey);
}

function previewEditVideoFile(input, idKey) {
  const file = input.files[0];
  if (file) {
    const fileNameDiv = document.getElementById(`vid-file-name-${idKey}`);
    if (fileNameDiv) fileNameDiv.textContent = '✅ File baru: ' + file.name;
    const judulInput = document.getElementById(`vid-judul-input-${idKey}`);
    if (judulInput && !judulInput.value.trim()) {
      judulInput.value = file.name.substring(0, file.name.lastIndexOf('.')) || file.name;
    }
    updateEditVideoPreview(idKey);
  }
}

function submitVideoEditLocal(idKey, containerId) {
  const judul = document.getElementById(`vid-judul-input-${idKey}`).value.trim();
  if (!judul) {
    alert('Judul video wajib diisi.');
    return;
  }
  
  const videoIndex = tempVideos.findIndex(v => (v.id === idKey || v.tempId === idKey));
  if (videoIndex > -1) {
    const isLinkActive = document.getElementById(`vid-url-field-${idKey}`).style.display !== 'none';
    tempVideos[videoIndex].judul = judul;
    
    if (isLinkActive) {
      const urlVal = document.getElementById(`vid-url-input-${idKey}`).value.trim();
      if (!urlVal) {
        alert('Tautan video wajib diisi jika memilih tab Link.');
        return;
      }
      tempVideos[videoIndex].url = urlVal;
      tempVideos[videoIndex].file = null;
      tempVideos[videoIndex].filePath = null;
      tempVideos[videoIndex].type = 'link';
    } else {
      const fileInput = document.getElementById(`vid-file-input-${idKey}`);
      if (fileInput && fileInput.files[0]) {
        tempVideos[videoIndex].file = fileInput.files[0];
        tempVideos[videoIndex].url = null;
        tempVideos[videoIndex].filePath = null;
        tempVideos[videoIndex].type = 'file';
      } else {
        if (!tempVideos[videoIndex].file && !tempVideos[videoIndex].filePath) {
          alert('Silakan pilih berkas video.');
          return;
        }
        tempVideos[videoIndex].url = null;
        tempVideos[videoIndex].type = 'file';
      }
    }
    
    if (!tempVideos[videoIndex].isNew) {
      tempVideos[videoIndex].action = 'update';
    }
  }
  renderTempVideos(containerId);
}

function deleteVideoLocal(idKey, containerId) {
  if (!confirm('Apakah Anda yakin ingin menghapus video panduan ini?')) return;
  const videoIndex = tempVideos.findIndex(v => (v.id === idKey || v.tempId === idKey));
  if (videoIndex > -1) {
    if (tempVideos[videoIndex].isNew) {
      tempVideos.splice(videoIndex, 1);
    } else {
      tempVideos[videoIndex].action = 'delete';
    }
  }
  renderTempVideos(containerId);
}

function openVideoModalFromEdit() {
  activeVideoContainerId = 'editTanamanVideoList';
  closeModal('modalEditTanaman');
  openVideoModalLocally();
}

function openVideoModalLocally() {
  document.getElementById('videoJudul').value      = '';
  document.getElementById('videoUrl').value        = '';
  document.getElementById('videoJudulFile').value  = '';
  document.getElementById('videoFileName').textContent = '';
  document.getElementById('videoFileInput').value  = '';
  switchVTab('link');
  openModal('modalVideoTanaman');
}

function addVideoLocal() {
  const isLink = document.getElementById('vtabLink').style.display !== 'none';
  let judul = '';
  let url = '';
  let file = null;
  
  if (isLink) {
    judul = document.getElementById('videoJudul').value.trim();
    url = document.getElementById('videoUrl').value.trim();
    if (!judul) { alert('Judul video wajib diisi.'); return; }
    if (!url) { alert('Tautan video wajib diisi.'); return; }
  } else {
    judul = document.getElementById('videoJudulFile').value.trim();
    const fileInput = document.getElementById('videoFileInput');
    file = fileInput.files[0];
    if (!judul) { alert('Judul video wajib diisi.'); return; }
    if (!file) { alert('Silakan pilih file video.'); return; }
  }
  
  const tempId = Date.now();
  tempVideos.push({
    tempId: tempId,
    action: 'create',
    type: isLink ? 'link' : 'file',
    judul: judul,
    url: url,
    file: file,
    isNew: true
  });
  
  renderTempVideos(activeVideoContainerId);
  closeModal('modalVideoTanaman');
  openModal('modalEditTanaman');
}

// ==================== FUNGSI SIMPAN KE DATABASE ====================
function submitTanaman() {
  const id = document.getElementById('editIdTanaman').value;
  const nama = document.getElementById('editNama').value.trim();
  
  if (!nama) { 
    alert('Nama tanaman wajib diisi.'); 
    return; 
  }

  const saveBtn = document.querySelector('#modalEditTanaman .btn-s');
  let originalBtnHtml = '';
  if (saveBtn) {
    originalBtnHtml = saveBtn.innerHTML;
    saveBtn.innerHTML = `<span style="display:inline-block; width:12px; height:12px; border:2px solid white; border-top-color:transparent; border-radius:50%; margin-right:6px; animation:spin 0.8s linear infinite; vertical-align:middle;"></span> Menyimpan...`;
    saveBtn.disabled = true;
  }

  const formData = new FormData();
  formData.append('nama_tanaman', nama);
  formData.append('nama_latin', document.getElementById('editLatin').value);
  formData.append('jenis_tanaman', document.getElementById('editJenis').value);
  formData.append('deskripsi', document.getElementById('editDeskripsi').value);
  formData.append('metode_perawatan', document.getElementById('editPerawatan').value);
  formData.append('protokol_pengobatan', document.getElementById('editPengobatan').value);

  const ancaman = [
    document.getElementById('editAncaman1').value.trim(),
    document.getElementById('editAncaman2').value.trim(),
    document.getElementById('editAncaman3').value.trim(),
  ].filter(Boolean);
  
  formData.append('ancaman_hama', JSON.stringify(ancaman));
  formData.append('ancaman_1', document.getElementById('editAncaman1').value.trim());
  formData.append('ancaman_2', document.getElementById('editAncaman2').value.trim());
  formData.append('ancaman_3', document.getElementById('editAncaman3').value.trim());

  const fileInput = document.getElementById('editGambarFile');
  if (fileInput && fileInput.files[0]) {
    formData.append('foto_tanaman', fileInput.files[0]);
  }

  const videosMetadata = tempVideos.map(v => {
    if (v.isNew) {
      return { tempId: v.tempId, action: 'create', type: v.type, judul: v.judul, url: v.url };
    } else {
      return { id: v.id, action: v.action, judul: v.judul, url: v.url };
    }
  });
  formData.append('videos_data', JSON.stringify(videosMetadata));
  
  tempVideos.forEach(v => {
    if (v.file) {
      const key = v.isNew ? `video_files_${v.tempId}` : `video_files_${v.id}`;
      formData.append(key, v.file);
    }
  });

  const isEdit = id !== '';
  const url = isEdit ? `/konsultan/tanaman/update/${id}` : '/konsultan/tanaman/simpan';

  const tokenElement = document.querySelector('meta[name="csrf-token"]');
  const token = tokenElement ? tokenElement.getAttribute('content') : '{{ csrf_token() }}';
  
  formData.append('_token', token);
  if (isEdit) {
    formData.append('_method', 'PUT');
  }

  fetch(url, { 
    method: 'POST', 
    body: formData,
    headers: {
      'X-CSRF-TOKEN': token,
      'X-Requested-With': 'XMLHttpRequest'
    }
  })
  .then(async res => {
    const contentType = res.headers.get('content-type') || '';
    if (!contentType.includes('application/json')) {
      throw new Error(`Server mengembalikan respons tidak valid (HTTP ${res.status}). Pastikan Anda sudah login.`);
    }
    const data = await res.json();
    if (!res.ok) {
      if (res.status === 422 && data.errors) {
        const firstError = Object.values(data.errors)[0];
        throw new Error(Array.isArray(firstError) ? firstError[0] : firstError);
      }
      throw new Error(data.message || `Permintaan gagal (HTTP ${res.status}).`);
    }
    return data;
  })
  .then(data => {
    if (data.success) {
      closeModal('modalEditTanaman');
      showToastKonsultan(data.message || 'Berhasil disimpan!', 'success');
      
      // KEMBALIKAN STATE TOMBOL SIMPAN
      if (saveBtn) {
        saveBtn.innerHTML = originalBtnHtml;
        saveBtn.disabled = false;
      }

      if (data.tanaman) {
        if (isEdit) {
          updateTanamanCard(data.tanaman);
        } else {
          addTanamanCard(data.tanaman);
        }
      }
    } else {
      throw new Error(data.message || 'Gagal menyimpan');
    }
  })
  .catch(err => {
    console.error('submitTanaman error:', err);
    if (saveBtn) {
      saveBtn.innerHTML = originalBtnHtml;
      saveBtn.disabled = false;
    }
    showToastKonsultan('⚠️ ' + (err.message || 'Gagal menyimpan data komoditas. Coba lagi.'), 'error');
  });
}

function hapusTanaman(id) {
  if (!confirm('Apakah Anda yakin ingin menghapus data komoditas ini?')) return;

  const tokenElement = document.querySelector('meta[name="csrf-token"]');
  const token = tokenElement ? tokenElement.getAttribute('content') : '{{ csrf_token() }}';

  fetch(`/konsultan/tanaman/hapus/${id}`, {
    method: 'POST',
    headers: { 
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-CSRF-TOKEN': token,
        'X-Requested-With': 'XMLHttpRequest'
    },
    body: `_method=DELETE&_token=${token}`
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      const card = document.querySelector(`.t-card[data-id="${id}"]`);
      if (card) {
        card.style.transition = 'opacity 0.3s, transform 0.3s';
        card.style.opacity = '0';
        card.style.transform = 'scale(0.95)';
        setTimeout(() => card.remove(), 300);
      }
      closeModal('modalEditTanaman');
      showToastKonsultan(data.message || 'Komoditas berhasil dihapus.', 'success');
    } else {
      showToastKonsultan('Gagal menghapus data.', 'error');
    }
  })
  .catch(err => {
    console.error(err);
    showToastKonsultan('Terjadi kesalahan. Coba lagi.', 'error');
  });
}

function showToastKonsultan(msg, type = 'success') {
  const existing = document.getElementById('konsultanToast');
  if (existing) existing.remove();
  const toast = document.createElement('div');
  toast.id = 'konsultanToast';
  const bg = type === 'success' ? 'var(--g800)' : 'var(--r400)';
  const icon = type === 'success' ? '✅' : '❌';
  toast.style.cssText = `position:fixed;bottom:1.5rem;right:1.5rem;background:${bg};color:white;padding:.75rem 1.25rem;border-radius:12px;font-size:.875rem;z-index:9999;font-family:'DM Sans',sans-serif;display:flex;align-items:center;gap:8px;box-shadow:0 8px 25px rgba(6,47,30,0.3);animation:slideInToastK 0.35s cubic-bezier(0.175,0.885,0.32,1.275) forwards;max-width:360px;`;
  toast.innerHTML = `<span>${icon}</span><span style="flex:1">${msg}</span><button onclick="this.parentElement.remove()" style="background:none;border:none;color:rgba(255,255,255,0.7);cursor:pointer;font-size:1rem;margin-left:6px;">✕</button>`;
  if (!document.getElementById('toastKStyle')) {
    const s = document.createElement('style');
    s.id = 'toastKStyle';
    s.textContent = '@keyframes slideInToastK{from{transform:translateY(20px);opacity:0}to{transform:translateY(0);opacity:1}}';
    document.head.appendChild(s);
  }
  document.body.appendChild(toast);
  setTimeout(() => { if(toast.parentElement){ toast.style.animation='slideInToastK 0.3s reverse forwards'; setTimeout(()=>toast.remove(),300); } }, 4000);
}

function updateTanamanCard(t) {
  const card = document.querySelector(`.t-card[data-id="${t.id}"]`);
  if (!card) return;

  card.dataset.nama = t.nama_tanaman || '';
  card.dataset.latin = t.nama_latin || '';
  card.dataset.jenis = t.jenis_tanaman || '';
  card.dataset.deskripsi = t.deskripsi || '';
  card.dataset.perawatan = t.metode_perawatan || '';
  card.dataset.pengobatan = t.protokol_pengobatan || '';
  card.dataset.videos = JSON.stringify(t.videos || []);
  card.dataset.videoUrl = (t.videos && t.videos[0] && t.videos[0].url) ? t.videos[0].url : '';
  
  const ancaman = Array.isArray(t.ancaman_hama) ? t.ancaman_hama : JSON.parse(t.ancaman_hama || '[]');
  card.dataset.ancaman = JSON.stringify(ancaman);

  card.innerHTML = `
    <div class="t-header">
      <div class="t-icon">
        ${t.foto_url ? `<img src="${t.foto_url}" alt="${t.nama_tanaman}">` : (t.foto_tanaman ? `<img src="/storage/${t.foto_tanaman}" alt="${t.nama_tanaman}">` : '🌱')}
      </div>
      <div>
        <div class="t-name">${t.nama_tanaman}</div>
        ${t.nama_latin ? `<div class="t-latin">${t.nama_latin}</div>` : ''}
        ${t.jenis_tanaman ? `<span class="t-jenis">${t.jenis_tanaman}</span>` : ''}
      </div>
      <div class="t-actions-wrapper">
        <button class="t-edit-btn" onclick="bukaModalEdit(${t.id})">✏️ Edit</button>
        <button class="t-delete-btn" onclick="hapusTanaman(${t.id})">❌ Hapus</button>
      </div>
    </div>
    ${t.deskripsi ? `<div class="t-section"><div class="t-section-title">📝 Deskripsi</div><div class="t-section-desc">${t.deskripsi}</div></div>` : ''}
    ${t.metode_perawatan ? `<div class="t-section"><div class="t-section-title">🚜 Metode Perawatan</div><div class="t-section-desc">${t.metode_perawatan}</div></div>` : ''}
    ${t.protokol_pengobatan ? `<div class="t-section"><div class="t-section-title">🧪 Protokol Pengobatan</div><div class="t-section-desc">${t.protokol_pengobatan}</div></div>` : ''}
    ${ancaman.length > 0 ? `<div class="t-section"><div class="t-section-title">⚠️ Bahaya &amp; Ancaman Hama</div><div class="t-danger-list">${ancaman.map(a=>`<div class="t-danger-item">${a}</div>`).join('')}</div></div>` : ''}
    <div class="t-video-section-dynamic"></div>
  `;

  refreshVideoSectionKonsultan(card, t.videos || []);
}

function addTanamanCard(t) {
  const container = document.getElementById('containerPustaka');
  if (!container) return;
  const emptyState = container.querySelector('.empty-state');
  if (emptyState) emptyState.parentElement?.remove();

  const ancaman = Array.isArray(t.ancaman_hama) ? t.ancaman_hama : JSON.parse(t.ancaman_hama || '[]');

  const card = document.createElement('div');
  card.className = 't-card';
  card.dataset.id = t.id;
  card.dataset.nama = t.nama_tanaman || '';
  card.dataset.latin = t.nama_latin || '';
  card.dataset.jenis = t.jenis_tanaman || '';
  card.dataset.deskripsi = t.deskripsi || '';
  card.dataset.perawatan = t.metode_perawatan || '';
  card.dataset.pengobatan = t.protokol_pengobatan || '';
  card.dataset.ancaman = JSON.stringify(ancaman);
  card.dataset.videos = JSON.stringify(t.videos || []);
  card.dataset.videoUrl = (t.videos && t.videos[0] && t.videos[0].url) ? t.videos[0].url : '';
  
  card.style.opacity = '0';
  card.style.transform = 'scale(0.95)';
  card.innerHTML = `
    <div class="t-header">
      <div class="t-icon">
        ${t.foto_url ? `<img src="${t.foto_url}" alt="${t.nama_tanaman}">` : (t.foto_tanaman ? `<img src="/storage/${t.foto_tanaman}" alt="${t.nama_tanaman}">` : '🌱')}
      </div>
      <div>
        <div class="t-name">${t.nama_tanaman}</div>
        ${t.nama_latin ? `<div class="t-latin">${t.nama_latin}</div>` : ''}
        ${t.jenis_tanaman ? `<span class="t-jenis">${t.jenis_tanaman}</span>` : ''}
      </div>
      <div class="t-actions-wrapper">
        <button class="t-edit-btn" onclick="bukaModalEdit(${t.id})">✏️ Edit</button>
        <button class="t-delete-btn" onclick="hapusTanaman(${t.id})">❌ Hapus</button>
      </div>
    </div>
    ${t.deskripsi ? `<div class="t-section"><div class="t-section-title">📝 Deskripsi</div><div class="t-section-desc">${t.deskripsi}</div></div>` : ''}
    ${t.metode_perawatan ? `<div class="t-section"><div class="t-section-title">🚜 Metode Perawatan</div><div class="t-section-desc">${t.metode_perawatan}</div></div>` : ''}
    ${t.protokol_pengobatan ? `<div class="t-section"><div class="t-section-title">🧪 Protokol Pengobatan</div><div class="t-section-desc">${t.protokol_pengobatan}</div></div>` : ''}
    ${ancaman.length > 0 ? `<div class="t-section"><div class="t-section-title">⚠️ Bahaya &amp; Ancaman Hama</div><div class="t-danger-list">${ancaman.map(a=>`<div class="t-danger-item">${a}</div>`).join('')}</div></div>` : ''}
    <div class="t-video-section-dynamic"></div>
  `;

  container.prepend(card);
  requestAnimationFrame(() => {
    card.style.transition = 'opacity 0.4s, transform 0.4s';
    card.style.opacity = '1';
    card.style.transform = 'scale(1)';
  });
  refreshVideoSectionKonsultan(card, t.videos || []);
}

function refreshVideoSectionKonsultan(card, videos) {
  const existing = card.querySelector('.t-video-section-dynamic');
  if (existing) existing.remove();
  if (!videos || videos.length === 0) return;
  
  const sec = document.createElement('div');
  sec.className = 't-video-section-dynamic t-section';
  sec.style.cssText = 'margin-top:.5rem;border-top:1px dashed var(--gray100);padding-top:.6rem;';
  
  const buildItem = v => {
    let playArgs = '';
    let icon = '📹';
    let sub = '';
    if (v.url) {
      const m = v.url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([\w-]{11})/);
      if (m) {
        playArgs = `playGlobalVideo('youtube', '${m[1]}', '${v.judul.replace(/'/g, "\\'")}')`;
        icon = '🔗';
        sub = 'YouTube';
      }
    } else if (v.file_path || v.file_url) {
      const src = v.file_url || ('/storage/' + v.file_path);
      playArgs = `playGlobalVideo('file', '${src}', '${v.judul.replace(/'/g, "\\'")}')`;
      icon = '📁';
      sub = 'File Video';
    }
    
    if (!playArgs) return '';
    
    return `
      <div onclick="${playArgs}" style="
        display: flex; align-items: center; gap: 10px; background: #f8faf4;
        border: 1px solid var(--g100); border-radius: 10px; padding: 8px 12px;
        margin-bottom: 6px; cursor: pointer; transition: all 0.2s ease-in-out;
      " onmouseover="this.style.background='var(--g50)'; this.style.borderColor='var(--g300)'; this.style.transform='translateY(-1px)';" onmouseout="this.style.background='#f8faf4'; this.style.borderColor='var(--g100)'; this.style.transform='translateY(0)';" title="Putar Video">
        <span style="font-size: 0.9rem; display: flex; align-items: center; justify-content: center; width: 24px; height: 24px; border-radius: 50%; background: var(--g100); color: var(--g800); flex-shrink: 0;">▶️</span>
        <div style="flex: 1; min-width: 0; text-align: left;">
          <div style="font-size: 0.78rem; font-weight: 700; color: var(--g800); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 1.2;">${v.judul}</div>
          <span style="font-size: 0.65rem; color: var(--gray400); display: block; margin-top: 1px;">${icon} ${sub}</span>
        </div>
      </div>
    `;
  };
  
  let html = `
    <div class="t-section-title" style="margin-bottom: 8px;">📹 Video Panduan</div>
    <div style="display: flex; flex-direction: column; gap: 2px;">
      ${videos.slice(0, 2).map(buildItem).join('')}
    </div>
  `;

  if (videos.length > 2) {
    const hiddenCount = videos.length - 2;
    html += `
      <div style="text-align:center;margin-top:4px;">
        <button type="button" style="background:var(--g50);color:var(--g800);border:1px solid var(--g100);padding:3px 12px;border-radius:20px;font-size:.75rem;cursor:pointer;font-weight:600;font-family:'DM Sans',sans-serif;" onclick="const d=this.nextElementSibling;const h=d.style.display==='none';d.style.display=h?'flex':'none';this.innerHTML=h?'⬆️ Lebih Sedikit':'⬇️ Lihat Lebih Banyak (+${hiddenCount})';">⬇️ Lihat Lebih Banyak (+${hiddenCount})</button>
        <div style="display:none; flex-direction:column; gap:2px; margin-top:4px;">
          ${videos.slice(2).map(buildItem).join('')}
        </div>
      </div>
    `;
  }
  
  sec.innerHTML = html;
  card.appendChild(sec);
}

function playGlobalVideo(type, source, title) {
  const watchModal = document.getElementById('modalWatchVideo');
  const container = document.getElementById('watchVideoContainer');
  const titleEl = document.getElementById('watchVideoTitle');
  if (!watchModal || !container) return;
  
  if (titleEl) titleEl.textContent = title;
  
  if (type === 'youtube') {
    container.innerHTML = `<iframe src="https://www.youtube.com/embed/${source}?autoplay=1" style="width: 100%; height: 100%; border: none;" allow="autoplay; encrypted-media" allowfullscreen></iframe>`;
  } else {
    container.innerHTML = `<video controls autoplay src="${source}" style="width: 100%; height: 100%; object-fit: contain; background: #000;"></video>`;
  }
  
  openModal('modalWatchVideo');
}

function closeWatchVideoModal() {
  const container = document.getElementById('watchVideoContainer');
  if (container) container.innerHTML = '';
  closeModal('modalWatchVideo');
}

function switchVTab(tab) {
  const isLink = tab === 'link';
  document.getElementById('vtabLink').style.display    = isLink ? '' : 'none';
  document.getElementById('vtabFile').style.display    = isLink ? 'none' : '';
  
  const linkBtn = document.getElementById('vtabLinkBtn');
  const fileBtn = document.getElementById('vtabFileBtn');
  
  if (linkBtn) {
    linkBtn.classList.toggle('active', isLink);
    linkBtn.style.background = isLink ? 'white' : 'transparent';
    linkBtn.style.color = isLink ? 'var(--g800)' : 'var(--gray400)';
    linkBtn.style.boxShadow = isLink ? '0 2px 6px rgba(6,47,30,0.08)' : 'none';
  }
  
  if (fileBtn) {
    fileBtn.classList.toggle('active', !isLink);
    fileBtn.style.background = !isLink ? 'white' : 'transparent';
    fileBtn.style.color = !isLink ? 'var(--g800)' : 'var(--gray400)';
    fileBtn.style.boxShadow = !isLink ? '0 2px 6px rgba(6,47,30,0.08)' : 'none';
  }
  
  updateVideoPreview();
}

function previewVideoFile(input) {
  const file = input.files[0];
  if(file) {
    document.getElementById('videoFileName').textContent = '✅ File dipilih: ' + file.name;
    const judulFile = document.getElementById('videoJudulFile');
    if(judulFile && !judulFile.value.trim()) {
      judulFile.value = file.name.substring(0, file.name.lastIndexOf('.')) || file.name;
    }
    updateVideoPreview();
  }
}

function updateVideoPreview() {
  const previewArea = document.getElementById('videoPreviewArea');
  if (!previewArea) return;

  const isLinkActive = document.getElementById('vtabLinkBtn').classList.contains('active');
  
  if (isLinkActive) {
    const urlInput = document.getElementById('videoUrl');
    const url = urlInput ? urlInput.value.trim() : '';
    const youtubeReg = /(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([\w-]{11})/;
    const match = url.match(youtubeReg);
    const youtubeId = match ? match[1] : null;

    if (youtubeId) {
      previewArea.innerHTML = `<iframe src="https://www.youtube.com/embed/${youtubeId}" style="width: 100%; height: 100%; border: none;" allowfullscreen></iframe>`;
      previewArea.style.display = 'block';
    } else {
      previewArea.innerHTML = '';
      previewArea.style.display = 'none';
    }
  } else {
    const fileInput = document.getElementById('videoFileInput');
    const file = fileInput && fileInput.files ? fileInput.files[0] : null;

    if (file) {
      const objectUrl = URL.createObjectURL(file);
      previewArea.innerHTML = `<video controls src="${objectUrl}" style="width: 100%; height: 100%; object-fit: contain;"></video>`;
      previewArea.style.display = 'block';
    } else {
      previewArea.innerHTML = '';
      previewArea.style.display = 'none';
    }
  }
}

function updateEditVideoPreview(idKey) {
  const previewArea = document.getElementById(`vid-edit-preview-area-${idKey}`);
  if (!previewArea) return;

  const isLinkActive = document.getElementById(`vtabLinkEditBtn-${idKey}`).style.backgroundColor === 'var(--g600)' || document.getElementById(`vtabLinkEditBtn-${idKey}`).style.color === 'white';
  
  if (isLinkActive) {
    const urlInput = document.getElementById(`vid-url-input-${idKey}`);
    const url = urlInput ? urlInput.value.trim() : '';
    const youtubeReg = /(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([\w-]{11})/;
    const match = url.match(youtubeReg);
    const youtubeId = match ? match[1] : null;

    if (youtubeId) {
      previewArea.innerHTML = `<iframe src="https://www.youtube.com/embed/${youtubeId}" style="width: 100%; height: 100%; border: none;" allowfullscreen></iframe>`;
      previewArea.style.display = 'block';
    } else {
      previewArea.innerHTML = '';
      previewArea.style.display = 'none';
    }
  } else {
    const fileInput = document.getElementById(`vid-file-input-${idKey}`);
    const file = fileInput && fileInput.files ? fileInput.files[0] : null;

    if (file) {
      const objectUrl = URL.createObjectURL(file);
      previewArea.innerHTML = `<video controls src="${objectUrl}" style="width: 100%; height: 100%; object-fit: contain;"></video>`;
      previewArea.style.display = 'block';
    } else {
      const v = tempVideos.find(vid => (vid.id || vid.tempId) == idKey);
      if (v && v.filePath) {
        previewArea.innerHTML = `<video controls src="/storage/${v.filePath}" style="width: 100%; height: 100%; object-fit: contain;"></video>`;
        previewArea.style.display = 'block';
      } else {
        previewArea.innerHTML = '';
        previewArea.style.display = 'none';
      }
    }
  }
}

function submitJawabKonsultasi(e) {
  e.preventDefault();
  const form = document.getElementById('jawabKonsultasiForm');
  if (!form) return;
  
  const saveBtn = form.querySelector('.btn-s');
  let originalBtnHtml = '';
  if (saveBtn) {
    originalBtnHtml = saveBtn.innerHTML;
    saveBtn.innerHTML = `<span style="display:inline-block; width:12px; height:12px; border:2px solid white; border-top-color:transparent; border-radius:50%; margin-right:6px; animation:spin 0.8s linear infinite; vertical-align:middle;"></span> Mengirim...`;
    saveBtn.disabled = true;
  }
  
  const formData = new FormData(form);
  const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
  
  fetch('/konsultasi/simpan', {
    method: 'POST',
    body: formData,
    headers: {
      'X-CSRF-TOKEN': token,
      'X-Requested-With': 'XMLHttpRequest'
    }
  })
  .then(res => {
    if (res.ok || res.redirected) {
      window.location.reload();
    } else {
      return res.json().then(err => { throw err; });
    }
  })
  .catch(err => {
    console.error(err);
    if (saveBtn) {
      saveBtn.innerHTML = originalBtnHtml;
      saveBtn.disabled = false;
    }
    alert('Gagal mengirim solusi konsultasi.');
  });
}

function hapusKeluhanMasuk(e, id, btn) {
  e.preventDefault();
  if (!confirm('Apakah Anda yakin ingin menghapus keluhan masuk ini secara permanen?')) return;
  
  const originalHtml = btn.innerHTML;
  btn.innerHTML = '⏳';
  btn.disabled = true;
  
  const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
  
  fetch(`/konsultan/keluhan/hapus/${id}`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
      'X-CSRF-TOKEN': token,
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: `_method=DELETE&_token=${token}`
  })
  .then(res => {
    if (res.ok || res.redirected) {
      window.location.reload();
    } else {
      btn.innerHTML = originalHtml;
      btn.disabled = false;
      alert('Gagal menghapus keluhan.');
    }
  })
  .catch(err => {
    console.error(err);
    btn.innerHTML = originalHtml;
    btn.disabled = false;
  });
}

function hapusRiwayatKonsultasi(e, id, btn) {
  e.preventDefault();
  if (!confirm('Apakah Anda yakin ingin menghapus riwayat konsultasi ini secara permanen?')) return;
  
  const originalHtml = btn.innerHTML;
  btn.innerHTML = '⏳';
  btn.disabled = true;
  
  const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
  
  fetch(`/konsultan/riwayat/${id}`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
      'X-CSRF-TOKEN': token,
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: `_method=DELETE&_token=${token}`
  })
  .then(res => {
    if (res.ok || res.redirected) {
      window.location.reload();
    } else {
      btn.innerHTML = originalHtml;
      btn.disabled = false;
      alert('Gagal menghapus riwayat.');
    }
  })
  .catch(err => {
    console.error(err);
    btn.innerHTML = originalHtml;
    btn.disabled = false;
  });
}
</script>
</body>
</html>

