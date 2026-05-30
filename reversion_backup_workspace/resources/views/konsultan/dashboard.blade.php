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
      --shadow-lg: 0
<truncated 22716 bytes>
rap: anywhere;
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
The above content does NOT show the entire file contents. If you need to view any lines of the file which were not shown to complete your task, call this tool again to view those lines.