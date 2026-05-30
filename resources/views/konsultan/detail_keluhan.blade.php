<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Detail Keluhan #{{ $keluhan->id }} — Doctreen</title>
  
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
    
    /* Ambient Glowing Orbs */
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
    }
    .sb-lbl { 
      font-size: .72rem; 
<!-- MISSING LINE 101 -->
<!-- MISSING LINE 102 -->
<!-- MISSING LINE 103 -->
<!-- MISSING LINE 104 -->
<!-- MISSING LINE 105 -->
<!-- MISSING LINE 106 -->
<!-- MISSING LINE 107 -->
<!-- MISSING LINE 108 -->
<!-- MISSING LINE 109 -->
<!-- MISSING LINE 110 -->
<!-- MISSING LINE 111 -->
<!-- MISSING LINE 112 -->
<!-- MISSING LINE 113 -->
<!-- MISSING LINE 114 -->
<!-- MISSING LINE 115 -->
<!-- MISSING LINE 116 -->
<!-- MISSING LINE 117 -->
<!-- MISSING LINE 118 -->
<!-- MISSING LINE 119 -->
<!-- MISSING LINE 120 -->
<!-- MISSING LINE 121 -->
<!-- MISSING LINE 122 -->
<!-- MISSING LINE 123 -->
<!-- MISSING LINE 124 -->
<!-- MISSING LINE 125 -->
<!-- MISSING LINE 126 -->
<!-- MISSING LINE 127 -->
<!-- MISSING LINE 128 -->
<!-- MISSING LINE 129 -->
<!-- MISSING LINE 130 -->
<!-- MISSING LINE 131 -->
<!-- MISSING LINE 132 -->
<!-- MISSING LINE 133 -->
<!-- MISSING LINE 134 -->
<!-- MISSING LINE 135 -->
<!-- MISSING LINE 136 -->
<!-- MISSING LINE 137 -->
<!-- MISSING LINE 138 -->
<!-- MISSING LINE 139 -->
<!-- MISSING LINE 140 -->
<!-- MISSING LINE 141 -->
<!-- MISSING LINE 142 -->
      background: rgba(255,255,255,.04); 
      border: 1px solid rgba(255,255,255,.05); 
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
    
    /* Background panning */
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
      filter: blur(4px);
    }
    
    .topbar { 
      display: flex; 
      align-items: center; 
      justify-content: space-between; 
      margin-bottom: 2.5rem; 
      flex-wrap: wrap;
      gap: 1.5rem;
<!-- MISSING LINE 201 -->
<!-- MISSING LINE 202 -->
<!-- MISSING LINE 203 -->
<!-- MISSING LINE 204 -->
<!-- MISSING LINE 205 -->
<!-- MISSING LINE 206 -->
<!-- MISSING LINE 207 -->
<!-- MISSING LINE 208 -->
<!-- MISSING LINE 209 -->
<!-- MISSING LINE 210 -->
<!-- MISSING LINE 211 -->
<!-- MISSING LINE 212 -->
<!-- MISSING LINE 213 -->
<!-- MISSING LINE 214 -->
<!-- MISSING LINE 215 -->
<!-- MISSING LINE 216 -->
<!-- MISSING LINE 217 -->
<!-- MISSING LINE 218 -->
<!-- MISSING LINE 219 -->
      margin-bottom: 1.5rem;
      transition: transform 0.2s;
    }
    .back-btn:hover {
      transform: translateX(-4px);
      color: var(--g800);
    }

    /* Grid Layout */
    .detail-grid {
      display: grid;
      grid-template-columns: 1.2fr 1fr;
      gap: 2rem;
    }
    @media (max-width: 992px) {
      .detail-grid {
        grid-template-columns: 1fr;
      }
    }

    /* Cards */
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
<!-- MISSING LINE 251 -->
<!-- MISSING LINE 252 -->
<!-- MISSING LINE 253 -->
<!-- MISSING LINE 254 -->
<!-- MISSING LINE 255 -->
<!-- MISSING LINE 256 -->
<!-- MISSING LINE 257 -->
<!-- MISSING LINE 258 -->
<!-- MISSING LINE 259 -->
<!-- MISSING LINE 260 -->
<!-- MISSING LINE 261 -->
<!-- MISSING LINE 262 -->
<!-- MISSING LINE 263 -->
<!-- MISSING LINE 264 -->
<!-- MISSING LINE 265 -->
<!-- MISSING LINE 266 -->
<!-- MISSING LINE 267 -->
<!-- MISSING LINE 268 -->
<!-- MISSING LINE 269 -->
<!-- MISSING LINE 270 -->
<!-- MISSING LINE 271 -->
<!-- MISSING LINE 272 -->
<!-- MISSING LINE 273 -->
<!-- MISSING LINE 274 -->
<!-- MISSING LINE 275 -->
<!-- MISSING LINE 276 -->
<!-- MISSING LINE 277 -->
<!-- MISSING LINE 278 -->
<!-- MISSING LINE 279 -->
<!-- MISSING LINE 280 -->
<!-- MISSING LINE 281 -->
<!-- MISSING LINE 282 -->
<!-- MISSING LINE 283 -->
<!-- MISSING LINE 284 -->
<!-- MISSING LINE 285 -->
<!-- MISSING LINE 286 -->
<!-- MISSING LINE 287 -->
<!-- MISSING LINE 288 -->
<!-- MISSING LINE 289 -->
<!-- MISSING LINE 290 -->
<!-- MISSING LINE 291 -->
<!-- MISSING LINE 292 -->
<!-- MISSING LINE 293 -->
<!-- MISSING LINE 294 -->
<!-- MISSING LINE 295 -->
<!-- MISSING LINE 296 -->
<!-- MISSING LINE 297 -->
<!-- MISSING LINE 298 -->
<!-- MISSING LINE 299 -->
<!-- MISSING LINE 300 -->
<!-- MISSING LINE 301 -->
<!-- MISSING LINE 302 -->
<!-- MISSING LINE 303 -->
<!-- MISSING LINE 304 -->
<!-- MISSING LINE 305 -->
<!-- MISSING LINE 306 -->
<!-- MISSING LINE 307 -->
<!-- MISSING LINE 308 -->
<!-- MISSING LINE 309 -->
<!-- MISSING LINE 310 -->
<!-- MISSING LINE 311 -->
<!-- MISSING LINE 312 -->
<!-- MISSING LINE 313 -->
<!-- MISSING LINE 314 -->
<!-- MISSING LINE 315 -->
<!-- MISSING LINE 316 -->
<!-- MISSING LINE 317 -->
<!-- MISSING LINE 318 -->
<!-- MISSING LINE 319 -->
<!-- MISSING LINE 320 -->
<!-- MISSING LINE 321 -->
<!-- MISSING LINE 322 -->
<!-- MISSING LINE 323 -->
<!-- MISSING LINE 324 -->
<!-- MISSING LINE 325 -->
<!-- MISSING LINE 326 -->
<!-- MISSING LINE 327 -->
<!-- MISSING LINE 328 -->
<!-- MISSING LINE 329 -->
<!-- MISSING LINE 330 -->
<!-- MISSING LINE 331 -->
<!-- MISSING LINE 332 -->
<!-- MISSING LINE 333 -->
<!-- MISSING LINE 334 -->
<!-- MISSING LINE 335 -->
<!-- MISSING LINE 336 -->
<!-- MISSING LINE 337 -->
<!-- MISSING LINE 338 -->
<!-- MISSING LINE 339 -->
<!-- MISSING LINE 340 -->
<!-- MISSING LINE 341 -->
<!-- MISSING LINE 342 -->
<!-- MISSING LINE 343 -->
<!-- MISSING LINE 344 -->
<!-- MISSING LINE 345 -->
<!-- MISSING LINE 346 -->
<!-- MISSING LINE 347 -->
<!-- MISSING LINE 348 -->
<!-- MISSING LINE 349 -->
<!-- MISSING LINE 350 -->
<!-- MISSING LINE 351 -->
<!-- MISSING LINE 352 -->
<!-- MISSING LINE 353 -->
<!-- MISSING LINE 354 -->
<!-- MISSING LINE 355 -->
<!-- MISSING LINE 356 -->
<!-- MISSING LINE 357 -->
<!-- MISSING LINE 358 -->
<!-- MISSING LINE 359 -->
<!-- MISSING LINE 360 -->
<!-- MISSING LINE 361 -->
<!-- MISSING LINE 362 -->
<!-- MISSING LINE 363 -->
<!-- MISSING LINE 364 -->
<!-- MISSING LINE 365 -->
<!-- MISSING LINE 366 -->
<!-- MISSING LINE 367 -->
<!-- MISSING LINE 368 -->
<!-- MISSING LINE 369 -->
<!-- MISSING LINE 370 -->
<!-- MISSING LINE 371 -->
<!-- MISSING LINE 372 -->
<!-- MISSING LINE 373 -->
<!-- MISSING LINE 374 -->
<!-- MISSING LINE 375 -->
<!-- MISSING LINE 376 -->
<!-- MISSING LINE 377 -->
<!-- MISSING LINE 378 -->
<!-- MISSING LINE 379 -->
<!-- MISSING LINE 380 -->
<!-- MISSING LINE 381 -->
<!-- MISSING LINE 382 -->
<!-- MISSING LINE 383 -->
<!-- MISSING LINE 384 -->
<!-- MISSING LINE 385 -->
<!-- MISSING LINE 386 -->
<!-- MISSING LINE 387 -->
<!-- MISSING LINE 388 -->
<!-- MISSING LINE 389 -->
<!-- MISSING LINE 390 -->
<!-- MISSING LINE 391 -->
<!-- MISSING LINE 392 -->
<!-- MISSING LINE 393 -->
<!-- MISSING LINE 394 -->
<!-- MISSING LINE 395 -->
<!-- MISSING LINE 396 -->
<!-- MISSING LINE 397 -->
<!-- MISSING LINE 398 -->
<!-- MISSING LINE 399 -->
<!-- MISSING LINE 400 -->
<!-- MISSING LINE 401 -->
<!-- MISSING LINE 402 -->
<!-- MISSING LINE 403 -->
<!-- MISSING LINE 404 -->
<!-- MISSING LINE 405 -->
<!-- MISSING LINE 406 -->
<!-- MISSING LINE 407 -->
<!-- MISSING LINE 408 -->
<!-- MISSING LINE 409 -->
<!-- MISSING LINE 410 -->
<!-- MISSING LINE 411 -->
<!-- MISSING LINE 412 -->
<!-- MISSING LINE 413 -->
<!-- MISSING LINE 414 -->
<!-- MISSING LINE 415 -->
<!-- MISSING LINE 416 -->
<!-- MISSING LINE 417 -->
<!-- MISSING LINE 418 -->
<!-- MISSING LINE 419 -->
<!-- MISSING LINE 420 -->
<!-- MISSING LINE 421 -->
<!-- MISSING LINE 422 -->
<!-- MISSING LINE 423 -->
<!-- MISSING LINE 424 -->
<!-- MISSING LINE 425 -->
<!-- MISSING LINE 426 -->
<!-- MISSING LINE 427 -->
<!-- MISSING LINE 428 -->
<!-- MISSING LINE 429 -->
<!-- MISSING LINE 430 -->
<!-- MISSING LINE 431 -->
<!-- MISSING LINE 432 -->
<!-- MISSING LINE 433 -->
<!-- MISSING LINE 434 -->
<!-- MISSING LINE 435 -->
<!-- MISSING LINE 436 -->
<!-- MISSING LINE 437 -->
<!-- MISSING LINE 438 -->
<!-- MISSING LINE 439 -->
<!-- MISSING LINE 440 -->
<!-- MISSING LINE 441 -->
<!-- MISSING LINE 442 -->
<!-- MISSING LINE 443 -->
<!-- MISSING LINE 444 -->
<!-- MISSING LINE 445 -->
<!-- MISSING LINE 446 -->
<!-- MISSING LINE 447 -->
<!-- MISSING LINE 448 -->
<!-- MISSING LINE 449 -->
<!-- MISSING LINE 450 -->
<!-- MISSING LINE 451 -->
<!-- MISSING LINE 452 -->
<!-- MISSING LINE 453 -->
<!-- MISSING LINE 454 -->
<!-- MISSING LINE 455 -->
<!-- MISSING LINE 456 -->
<!-- MISSING LINE 457 -->
<!-- MISSING LINE 458 -->
<!-- MISSING LINE 459 -->
<!-- MISSING LINE 460 -->
<!-- MISSING LINE 461 -->
<!-- MISSING LINE 462 -->
<!-- MISSING LINE 463 -->
<!-- MISSING LINE 464 -->
<!-- MISSING LINE 465 -->
<!-- MISSING LINE 466 -->
<!-- MISSING LINE 467 -->
<!-- MISSING LINE 468 -->
<!-- MISSING LINE 469 -->
<!-- MISSING LINE 470 -->
<!-- MISSING LINE 471 -->
<!-- MISSING LINE 472 -->
<!-- MISSING LINE 473 -->
<!-- MISSING LINE 474 -->
<!-- MISSING LINE 475 -->
<!-- MISSING LINE 476 -->
<!-- MISSING LINE 477 -->
<!-- MISSING LINE 478 -->
<!-- MISSING LINE 479 -->
<!-- MISSING LINE 480 -->
<!-- MISSING LINE 481 -->
<!-- MISSING LINE 482 -->
<!-- MISSING LINE 483 -->
<!-- MISSING LINE 484 -->
<!-- MISSING LINE 485 -->
<!-- MISSING LINE 486 -->
<!-- MISSING LINE 487 -->
<!-- MISSING LINE 488 -->
<!-- MISSING LINE 489 -->
    </a>

    <!-- Session Notifications -->
    @if(session('success'))
      <div style="background: var(--g50); border: 1.5px solid var(--g200); color: var(--g800); padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between; font-weight: 600; font-size: 0.9rem; box-shadow: var(--shadow-sm);">
        <span>🎉 {{ session('success') }}</span>
        <button type="button" style="background:none; border:none; color:var(--g800); font-weight:bold; cursor:pointer;" onclick="this.parentElement.remove()">✕</button>
      </div>
    @endif
    @if(session('error'))
      <div style="background: var(--r50); border: 1.5px solid var(--r400); color: var(--r400); padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between; font-weight: 600; font-size: 0.9rem; box-shadow: var(--shadow-sm);">
        <span>⚠️ {{ session('error') }}</span>
        <button type="button" style="background:none; border:none; color:var(--r400); font-weight:bold; cursor:pointer;" onclick="this.parentElement.remove()">✕</button>
      </div>
    @endif

    <div class="topbar">
      <div>
        <div class="pg-title">Detail Keluhan #{{ $keluhan->id }}</div>
        <div class="pg-sub">Diajukan oleh petani pada tanggal {{ \Carbon\Carbon::parse($keluhan->tanggal_keluhan)->translatedFormat('d F Y') }}</div>
      </div>
      <div>
        <span class="badge b-{{ $keluhan->status }}">{{ ucfirst($keluhan->status) }}</span>
      </div>
    </div>

    <div class="detail-grid">
      <!-- LEFT COLUMN: Keluhan details -->
      <div>
        <div class="card">
          <div class="card-title">📝 Deskripsi Permasalahan Tanaman</div>
          
          <div class="meta-row">
            <div class="meta-item">
              <div class="meta-lbl">Judul Keluhan</div>
              <div class="meta-val">{{ $keluhan->judul_keluhan }}</div>
            </div>
            <div class="meta-item">
              <div class="meta-lbl">Status Keluhan</div>
              <div class="meta-val" style="text-transform: capitalize;">
                @php
                  $statusIcon = match($keluhan->status) {
                    'baru'      => '🔴',
                    'proses'    => '🟡',
                    'selesai'   => '🟢',
                    default     => '⚪',
                  };
                @endphp
                {{ $statusIcon }} {{ ucfirst($keluhan->status) }}
              </div>
            </div>
          </div>

          {{-- ===== ISI KELUHAN: Ditampilkan sebagai paragraf rapi ===== --}}
          <div style="margin-top: 0.25rem;">
            <div style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--gray400); margin-bottom: 0.75rem; display: flex; align-items: center; gap: 6px;">
              <span style="display:inline-block; width:18px; height:2px; background:var(--g400); border-radius:2px;"></span>
              Isi Keluhan
            </div>
            <div style="
              background: linear-gradient(135deg, rgba(255,255,255,0.7) 0%, rgba(244,247,242,0.5) 100%);
              border: 1px solid rgba(123, 185, 120, 0.15);
              border-left: 4px solid var(--g400);
              border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
              padding: 1.5rem 1.75rem;
              position: relative;
              max-height: 260px;
              overflow-y: auto;
            ">
              {{-- Kutip dekoratif --}}
              <span style="
                position: absolute; top: -6px; left: 16px;
                font-size: 4rem; line-height: 1;
                color: var(--g200); font-family: 'Playfair Display', serif;
                pointer-events: none; user-select: none;
              ">"</span>

              @php
                // Pisahkan teks menjadi paragraf berdasarkan baris kosong / newline
                $paragraphs = array_filter(
                  preg_split('/\n{2,}/', trim($keluhan->isi_keluhan)),
                  fn($p) => trim($p) !== ''
                );
                if (empty($paragraphs)) {
                  $paragraphs = [trim($keluhan->isi_keluhan)];
                }
              @endphp

              @foreach($paragraphs as $para)
                <p style="
                  font-size: 1rem;
                  line-height: 1.85;
                  color: var(--text);
                  font-weight: 400;
                  margin: 0 0 1rem 0;
                  letter-spacing: -0.01em;
                  text-align: justify;
                  hyphens: auto;
                ">{{ nl2br(e(trim($para))) }}</p>
              @endforeach

              {{-- Custom premium scrollbar & rules --}}
              <style>
                .keluhan-text-box::-webkit-scrollbar {
                  width: 6px;
                }
                .keluhan-text-box::-webkit-scrollbar-track {
                  background: rgba(244,247,242,0.3);
                  border-radius: 4px;
                }
                .keluhan-text-box::-webkit-scrollbar-thumb {
                  background: var(--g200);
                  border-radius: 4px;
                  transition: background 0.2s;
                }
                .keluhan-text-box::-webkit-scrollbar-thumb:hover {
                  background: var(--g400);
                }
                .keluhan-text-box p:last-child {
                  margin-bottom: 0 !important;
                }
              </style>
            </div>
          </div>

          @if($keluhan->foto_kendala)
            <div class="foto-box" style="margin-top: 1.75rem;">
              <div style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--gray400); margin-bottom: 0.75rem; display: flex; align-items: center; gap: 6px; padding: 0 4px;">
                <span style="display:inline-block; width:18px; height:2px; background:var(--g400); border-radius:2px;"></span>
                Foto Bukti Kendala
              </div>
              <img src="{{ asset('storage/'.$keluhan->foto_kendala) }}" alt="Foto Kendala Tanaman"
                   style="max-width:100%; max-height:480px; object-fit:contain; border-radius:var(--radius-sm); box-shadow: 0 6px 24px rgba(6,47,30,0.08); display:block; margin: 0 auto;">
              <div class="foto-caption" style="margin-top: 10px;">📷 Gambar visualisasi penyakit/kendala yang diunggah oleh petani</div>
            </div>
          @endif
        </div>
      </div>

      <!-- RIGHT COLUMN: Farmer, Plant, and Reply info -->
      <div>
        <!-- Farmer Info Card -->
        <div class="card">
          <div class="card-title">👤 Informasi Petani</div>
          <div class="info-profile">
            <div class="profile-avatar">
              @if($keluhan->petani && $keluhan->petani->foto_profil)
                <img src="{{ asset('storage/'.$keluhan->petani->foto_profil) }}" alt="Petani">
              @else
                {{ strtoupper(substr($keluhan->petani->nama ?? 'P', 0, 2)) }}
              @endif

              <button type="submit" class="btn-submit">Kirim Solusi Medis</button>
            </form>

          @else
            <!-- Kasus Langka: belum diasosiasikan -->
            <div class="card-title">⚠️ Tindakan Tidak Tersedia</div>
            <p style="font-size: 0.9rem; color: var(--gray400); font-style: italic;">Keluhan ini belum di-assign atau tidak memiliki sesi konsultasi terkait.</p>
          @endif
        </div>
      </div>
    </div>
  </main>
</body>
</html>

<!-- MISSING LINE 657 -->
<!-- MISSING LINE 658 -->
<!-- MISSING LINE 659 -->
<!-- MISSING LINE 660 -->
<!-- MISSING LINE 661 -->
<!-- MISSING LINE 662 -->
<!-- MISSING LINE 663 -->
<!-- MISSING LINE 664 -->
<!-- MISSING LINE 665 -->
<!-- MISSING LINE 666 -->
<!-- MISSING LINE 667 -->
<!-- MISSING LINE 668 -->
<!-- MISSING LINE 669 -->
                <span class="badge b-selesai" style="font-size: 0.65rem; padding: 2px 8px; margin-top: 4px;">{{ $keluhan->tanaman->jenis_tanaman }}</span>
              @endif
            </div>
          </div>
        </div>

        <!-- Consultation Response Form / Details -->
        <div class="card">
          @php 
            $kons = $keluhan->konsultasi->last(); 
          @endphp

          @if($kons && $keluhan->status === 'selesai')
            <!-- Selesai (Read-only) -->
            <div class="card-title">✅ Solusi Konsultasi (Selesai)</div>
            
            <div class="ans-box">
              <div class="ans-title">Diagnosa Ahli</div>
              <div class="ans-content" style="font-weight: bold;">{{ $kons->diagnosa }}</div>

              <div class="ans-title">Rekomendasi Penanganan</div>
              <div class="ans-content">{{ $kons->rekomendasi }}</div>

              <div class="ans-title">Catatan Tambahan</div>
              <div class="ans-content" style="font-style: italic;">{{ $kons->catatan_konsultasi ?? 'Tidak ada catatan.' }}</div>
              
              <div style="font-size: 0.72rem; color: var(--gray400); font-weight: 500; border-top: 1px dashed var(--gray100); padding-top: 8px; margin-top: 10px;">
                Dijawab pada tanggal: {{ \Carbon\Carbon::parse($kons->tanggal_konsultasi)->translatedFormat('d F Y') }}
              </div>

<!-- MISSING LINE 700 -->
<!-- MISSING LINE 701 -->
<!-- MISSING LINE 702 -->
<!-- MISSING LINE 703 -->
<!-- MISSING LINE 704 -->
<!-- MISSING LINE 705 -->
              @csrf
              <input type="hidden" name="id_konsultasi" value="{{ $kons->id_konsultasi }}">
              
              <div class="fg">
                <label for="diagnosa">Diagnosa Penyakit / Masalah</label>
                <input type="text" id="diagnosa" name="diagnosa" 
                       placeholder="Contoh: Hawar Daun Bakteri / Defisiensi Kalium" 
                       value="{{ old('diagnosa', $kons->diagnosa) }}" required>
              </div>

              <div class="fg">
                <label for="rekomendasi">Rekomendasi Tindakan Pengobatan</label>
                <textarea id="rekomendasi" name="rekomendasi" 
                          placeholder="Tulis resep fungisida/pestisida, frekuensi penyiraman, atau langkah pemulihan taktis..." required>{{ old('rekomendasi', $kons->rekomendasi) }}</textarea>
              </div>

              <div class="fg">
                <label for="catatan_konsultasi">Catatan Tambahan (Internal/Opsional)</label>
                <textarea id="catatan_konsultasi" name="catatan_konsultasi" 
                          placeholder="Tulis instruksi tambahan jika ada...">{{ old('catatan_konsultasi', $kons->catatan_konsultasi) }}</textarea>
              </div>

              <button type="submit" class="btn-submit">Kirim Solusi Medis</button>
            </form>

          @else
            <!-- Kasus Langka: belum diasosiasikan -->
            <div class="card-title">⚠️ Tindakan Tidak Tersedia</div>
            <p style="font-size: 0.9rem; color: var(--gray400); font-style: italic;">Keluhan ini belum di-assign atau tidak memiliki sesi konsultasi terkait.</p>
          @endif
        </div>
      </div>
    </div>
  </main>
</body>
</html>
