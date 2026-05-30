<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Keluhan #{{ $keluhan->id }} — Doctreen</title>
  
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Plus Jakarta Sans', 'sans-serif'],
            outfit: ['Outfit', 'sans-serif'],
          },
          colors: {
            brand: {
              50: '#F4F8EC',
              100: '#E6EFCF',
              200: '#CBE09D',
              400: '#91BC40',
              600: '#5C811D',
              800: '#3D5614',
              900: '#213009',
            },
          }
        }
      }
    }
  </script>
  
  <style>
    body {
      background: radial-gradient(circle at 0% 0%, #F5F9F0 0%, #FAFCF9 100%);
    }
    .custom-scrollbar::-webkit-scrollbar {
      width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
      background: rgba(0, 0, 0, 0.02);
      border-radius: 8px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
      background: rgba(145, 188, 64, 0.3);
      border-radius: 8px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
      background: rgba(145, 188, 64, 0.5);
    }
  </style>
</head>
<body class="font-sans antialiased text-brand-900 min-h-screen pb-16">

  <!-- Container -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
    
    <!-- Top Action Bar -->
    <div class="flex items-center justify-between mb-8">
      <a href="{{ route('konsultan.dashboard') }}" class="group inline-flex items-center text-sm font-semibold text-brand-600 hover:text-brand-800 transition duration-200">
        <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali ke Dashboard
      </a>
      
      <!-- Session Flash Messages -->
      @if(session('success'))
        <div id="toast-success" class="flex items-center bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-2 rounded-xl text-sm font-medium shadow-sm transition duration-300">
          <span class="mr-2">🎉</span> {{ session('success') }}
        </div>
      @endif
      @if(session('error'))
        <div id="toast-error" class="flex items-center bg-rose-50 border border-rose-200 text-rose-800 px-4 py-2 rounded-xl text-sm font-medium shadow-sm transition duration-300">
          <span class="mr-2">⚠️</span> {{ session('error') }}
        </div>
      @endif
    </div>

    <!-- Main Header Grid -->
    <div class="bg-white border border-brand-100 rounded-3xl p-6 lg:p-8 shadow-sm mb-8 relative overflow-hidden">
      <!-- Glow Effect -->
      <div class="absolute -right-24 -top-24 w-64 h-64 rounded-full bg-brand-100 opacity-30 blur-3xl pointer-events-none"></div>
      
      <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div>
          <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase bg-brand-50 text-brand-600 border border-brand-100 mb-3">
            Keluhan #{{ $keluhan->id }}
          </span>
          <h1 class="text-2xl md:text-3xl font-extrabold font-outfit text-brand-900 tracking-tight">
            {{ $keluhan->judul_keluhan }}
          </h1>
          <p class="text-sm text-brand-600 mt-1">
            Diajukan pada tanggal {{ \Carbon\Carbon::parse($keluhan->tanggal_keluhan ?? $keluhan->created_at)->translatedFormat('d F Y') }}
          </p>
        </div>
        
        <!-- Status Badge -->
        <div>
          @php
            $statusColors = match($keluhan->status) {
              'baru' => 'bg-amber-50 text-amber-700 border-amber-200',
              'proses', 'sedang_berjalan' => 'bg-blue-50 text-blue-700 border-blue-200',
              'selesai' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
              default => 'bg-slate-50 text-slate-700 border-slate-200',
            };
          @endphp
          <span class="inline-flex items-center px-5 py-2.5 rounded-2xl text-sm font-bold border {{ $statusColors }} shadow-sm">
            <span class="w-2.5 h-2.5 rounded-full mr-2.5 bg-current"></span>
            {{ ucfirst($keluhan->status === 'sedang_berjalan' ? 'proses' : $keluhan->status) }}
          </span>
        </div>
      </div>
    </div>

    <!-- Main Content Two-Column Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      
      <!-- Left Column (Complaint details) -->
      <div class="lg:col-span-2 space-y-8">
        
        <!-- Complaint Card -->
        <div class="bg-white border border-brand-100 rounded-3xl p-6 lg:p-8 shadow-sm">
          <h2 class="text-lg font-bold font-outfit text-brand-900 mb-6 flex items-center">
            <span class="text-brand-400 mr-2.5 text-xl">📄</span> Deskripsi Kendala Tanaman
          </h2>
          
          <div class="bg-brand-50/50 border-l-4 border-brand-400 rounded-r-2xl p-6 text-brand-900 leading-relaxed custom-scrollbar max-h-96 overflow-y-auto mb-8 font-medium">
            {!! nl2br(e($keluhan->isi_keluhan)) !!}
          </div>

          <!-- Disease Image -->
          @if($keluhan->foto_kendala)
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-brand-600 mb-3">Foto Bukti Kendala</label>
              <div class="bg-slate-50 border border-brand-100/50 rounded-2xl p-2 flex items-center justify-center">
                <img src="{{ Storage::url($keluhan->foto_kendala) }}" alt="Foto Kendala Tanaman" class="max-w-full max-h-[480px] object-contain rounded-xl shadow-sm">
              </div>
              <p class="text-xs text-brand-400 text-center mt-2.5">📷 Gambar visualisasi penyakit/kendala yang diunggah petani</p>
            </div>
          @else
            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 text-center text-brand-400 text-sm font-medium">
              🚫 Petani tidak melampirkan foto kendala.
            </div>
          @endif
        </div>
      </div>

      <!-- Right Column (Farmer, Plant, and Answer details) -->
      <div class="space-y-8">
        
        <!-- Farmer Info Card -->
        <div class="bg-white border border-brand-100 rounded-3xl p-6 shadow-sm">
          <h2 class="text-lg font-bold font-outfit text-brand-900 mb-5 flex items-center">
            <span class="text-brand-400 mr-2.5 text-xl">👤</span> Profil Petani
          </h2>
          
          <div class="flex items-center gap-4 mb-5 pb-5 border-b border-brand-50">
            <div class="w-12 h-12 rounded-full bg-brand-400 text-white flex items-center justify-center font-bold text-lg shadow-sm">
              {{ strtoupper(substr($keluhan->petani->nama ?? 'P', 0, 2)) }}
            </div>
            <div>
              <div class="font-bold text-brand-900">{{ $keluhan->petani->nama ?? '-' }}</div>
              <div class="text-xs text-brand-600 font-semibold">{{ $keluhan->petani->daerah ?? 'Mitra Doctreen' }}</div>
            </div>
          </div>

          <div class="space-y-3.5 text-sm">
            <div class="flex justify-between">
              <span class="text-brand-600 font-medium">Email Kontak</span>
              <span class="font-bold text-brand-900">{{ $keluhan->petani->user->email ?? '-' }}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-brand-600 font-medium">No. Telepon</span>
              <span class="font-bold text-brand-900">{{ $keluhan->petani->telepon ?? $keluhan->petani->user->telepon ?? '-' }}</span>
            </div>
          </div>
        </div>

        <!-- Crop Info Card -->
        <div class="bg-white border border-brand-100 rounded-3xl p-6 shadow-sm">
          <h2 class="text-lg font-bold font-outfit text-brand-900 mb-5 flex items-center">
            <span class="text-brand-400 mr-2.5 text-xl">🌾</span> Informasi Tanaman
          </h2>
          
          <div class="space-y-4">
            <div class="flex justify-between pb-3 border-b border-brand-50">
              <span class="text-brand-600 text-sm font-medium">Nama Tanaman</span>
              <span class="font-bold text-brand-900 text-sm">{{ $keluhan->tanaman->nama_tanaman ?? '-' }}</span>
            </div>
            @if(isset($keluhan->tanaman->nama_latin))
              <div class="flex justify-between pb-3 border-b border-brand-50">
                <span class="text-brand-600 text-sm font-medium">Nama Latin</span>
                <span class="font-bold text-brand-900 text-sm italic">{{ $keluhan->tanaman->nama_latin }}</span>
              </div>
            @endif
            @if(isset($keluhan->tanaman->umur_panen))
              <div class="flex justify-between">
                <span class="text-brand-600 text-sm font-medium">Umur Panen</span>
                <span class="font-bold text-brand-900 text-sm">{{ $keluhan->tanaman->umur_panen }}</span>
              </div>
            @endif
          </div>
        </div>

        <!-- Consultation Solutions Card -->
        <div class="bg-white border border-brand-100 rounded-3xl p-6 shadow-sm">
          @php
            $kons = $keluhan->konsultasi;
          @endphp

          @if($keluhan->status === 'selesai' && $kons)
            <h2 class="text-lg font-bold font-outfit text-brand-900 mb-5 flex items-center">
              <span class="text-emerald-500 mr-2.5 text-xl">✅</span> Solusi Penanganan (Selesai)
            </h2>
            
            <div class="space-y-4 text-sm leading-relaxed">
              <div>
                <span class="block text-xs font-bold text-brand-600 uppercase tracking-wider mb-1">Diagnosa</span>
                <div class="p-3 bg-brand-50/50 rounded-xl font-bold border border-brand-100 text-brand-900">
                  {{ $kons->diagnosa }}
                </div>
              </div>
              <div>
                <span class="block text-xs font-bold text-brand-600 uppercase tracking-wider mb-1">Rekomendasi Penanganan</span>
                <div class="p-4 bg-brand-50/50 rounded-xl border border-brand-100 font-medium text-brand-800">
                  {{ $kons->rekomendasi }}
                </div>
              </div>
              @if($kons->catatan_konsultasi)
                <div>
                  <span class="block text-xs font-bold text-brand-600 uppercase tracking-wider mb-1">Catatan Tambahan</span>
                  <div class="p-4 bg-brand-50/50 rounded-xl border border-brand-100 text-brand-800 font-medium italic">
                    {{ $kons->catatan_konsultasi }}
                  </div>
                </div>
              @endif
              
              <div class="pt-3.5 border-t border-brand-50 text-xs font-medium text-brand-600">
                Selesai dijawab pada tanggal: {{ \Carbon\Carbon::parse($kons->updated_at)->translatedFormat('d F Y') }}
              </div>
            </div>

          @elseif($kons && ($keluhan->status === 'baru' || $keluhan->status === 'proses' || $keluhan->status === 'sedang_berjalan'))
            <h2 class="text-lg font-bold font-outfit text-brand-900 mb-5 flex items-center">
              <span class="text-brand-400 mr-2.5 text-xl">🧪</span> Beri Solusi Medis
            </h2>
            
            <form action="{{ route('konsultan.jawab', $keluhan->id) }}" method="POST" class="space-y-4" onsubmit="disableSubmitButton(this)">
              @csrf
              
              <div>
                <label for="diagnosa" class="block text-xs font-bold text-brand-600 uppercase tracking-wider mb-1.5">Diagnosa Penyakit / Masalah</label>
                <input type="text" id="diagnosa" name="diagnosa" required
                       placeholder="Contoh: Hawar Daun Bakteri / Defisiensi Kalium"
                       class="w-full px-4 py-3 border border-brand-100 rounded-xl text-sm outline-none focus:border-brand-400 transition font-medium">
              </div>

              <div>
                <label for="rekomendasi" class="block text-xs font-bold text-brand-600 uppercase tracking-wider mb-1.5">Rekomendasi Tindakan Pengobatan</label>
                <textarea id="rekomendasi" name="rekomendasi" required
                          placeholder="Tulis resep fungisida/pestisida, frekuensi penyiraman, atau langkah pemulihan taktis..."
                          class="w-full px-4 py-3 border border-brand-100 rounded-xl text-sm outline-none focus:border-brand-400 transition h-32 resize-none font-medium"></textarea>
              </div>

              <div>
                <label for="catatan_konsultasi" class="block text-xs font-bold text-brand-600 uppercase tracking-wider mb-1.5">Catatan Tambahan (Opsional)</label>
                <textarea id="catatan_konsultasi" name="catatan_konsultasi"
                          placeholder="Tulis instruksi tambahan jika ada..."
                          class="w-full px-4 py-3 border border-brand-100 rounded-xl text-sm outline-none focus:border-brand-400 transition h-20 resize-none font-medium"></textarea>
              </div>

              <button type="submit" id="submit-btn" class="w-full py-3 bg-brand-600 hover:bg-brand-800 text-white rounded-xl text-sm font-bold shadow-sm transition duration-200 inline-flex items-center justify-center gap-2">
                Kirim Solusi Medis
              </button>
            </form>
          @else
            <h2 class="text-lg font-bold font-outfit text-brand-900 mb-3 flex items-center">
              <span class="text-rose-500 mr-2.5">⚠️</span> Tindakan Tidak Tersedia
            </h2>
            <p class="text-sm text-brand-600 font-medium leading-relaxed">
              Keluhan ini belum di-assign atau belum memiliki sesi konsultasi aktif terkait di database.
            </p>
          @endif
        </div>
      </div>
    </div>
  </div>

  <script>
    function disableSubmitButton(form) {
      const btn = document.getElementById('submit-btn');
      if (btn) {
        btn.disabled = true;
        btn.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...';
        btn.classList.add('opacity-75', 'cursor-not-allowed');
      }
    }
  </script>
</body>
</html>
