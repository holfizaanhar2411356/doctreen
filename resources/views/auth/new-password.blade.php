<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Kata Sandi Default — Doctreen</title>
  
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
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
            }
          }
        }
      }
    }
  </script>
</head>
<body class="font-sans antialiased text-brand-900 bg-gradient-to-tr from-[#F5F9F0] via-white to-[#FAFCF9] min-h-screen flex items-center justify-center p-4">

  <!-- Background decorative elements -->
  <div class="fixed -left-32 -bottom-32 w-96 h-96 rounded-full bg-brand-100 opacity-20 blur-3xl pointer-events-none"></div>
  <div class="fixed -right-32 -top-32 w-96 h-96 rounded-full bg-brand-200 opacity-25 blur-3xl pointer-events-none"></div>

  <!-- Form Box -->
  <div class="relative z-10 w-full max-w-md bg-white border border-brand-100/60 rounded-3xl p-8 md:p-10 shadow-xl shadow-brand-900/5">
    
    <!-- Branding Header -->
    <div class="text-center mb-8">
      <div class="inline-flex items-center justify-center w-14 h-14 bg-brand-50 border border-brand-100 text-brand-600 text-2xl rounded-2xl mb-4 font-bold shadow-sm">
        🍃
      </div>
      <h1 class="text-2xl font-extrabold font-outfit text-brand-900 tracking-tight">Sandi Default Terdeteksi</h1>
      <p class="text-sm text-brand-600 mt-2 font-medium">
        Demi keamanan akun, Anda diwajibkan mengganti kata sandi default Anda sebelum melanjutkan.
      </p>
    </div>

    <!-- Error/Session messages -->
    @if(session('error'))
      <div class="bg-rose-50 border border-rose-100 text-rose-800 p-4 rounded-2xl text-xs font-semibold mb-6 flex items-center gap-2">
        <span>⚠️</span> {{ session('error') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="bg-rose-50 border border-rose-100 text-rose-800 p-4 rounded-2xl text-xs font-semibold mb-6">
        <ul class="list-disc list-inside space-y-1">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('password.new.update') }}" class="space-y-5" onsubmit="disableSubmitBtn(this)">
      @csrf
      
      <div>
        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-brand-600 mb-2">Kata Sandi Baru</label>
        <input type="password" id="password" name="password" required minlength="8"
               placeholder="Minimal 8 karakter..."
               class="w-full px-4 py-3 border border-brand-100 rounded-2xl text-sm outline-none focus:border-brand-400 focus:ring-2 focus:ring-brand-100 transition font-medium">
      </div>

      <div>
        <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-brand-600 mb-2">Konfirmasi Kata Sandi Baru</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8"
               placeholder="Ketik ulang kata sandi baru..."
               class="w-full px-4 py-3 border border-brand-100 rounded-2xl text-sm outline-none focus:border-brand-400 focus:ring-2 focus:ring-brand-100 transition font-medium">
      </div>

      <button type="submit" id="reset-btn" class="w-full py-3.5 bg-brand-600 hover:bg-brand-800 text-white rounded-2xl text-sm font-bold shadow-md shadow-brand-900/10 hover:shadow-lg transition duration-200 inline-flex items-center justify-center gap-2">
        Perbarui Kata Sandi & Masuk
      </button>
    </form>
    
    <!-- Logout Fallback -->
    <div class="text-center mt-6 pt-6 border-t border-brand-50">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="text-xs text-rose-500 hover:text-rose-700 font-bold transition">
          Batal & Keluar Akun
        </button>
      </form>
    </div>

  </div>

  <script>
    function disableSubmitBtn(form) {
      const btn = document.getElementById('reset-btn');
      if (btn) {
        btn.disabled = true;
        btn.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memperbarui...';
        btn.classList.add('opacity-75', 'cursor-not-allowed');
      }
    }
  </script>
</body>
</html>
