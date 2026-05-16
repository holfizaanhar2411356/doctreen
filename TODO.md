# TODO - Fix Illuminate\Database\QueryException (keluhans not found)

- [x] Identifikasi sumber error: query di `PetaniController@dashboard` menggunakan model `Keluhan` terhadap tabel `keluhans`.
- [x] Cek model & migration terkait tabel `keluhans`.
- [x] Perbaiki mismatch kolom FK pada migration `2026_05_09_060403_add_petani_id_to_keluhan_table.php`:
  - `petani_id` (salah) -> `id_petani` (konsisten dengan code/model)
  - `constrained('petanis')` -> `constrained('petani')`
- [ ] Jalankan migrasi di lingkungan Windows (PowerShell) tanpa operator `&&`.
  - Perintah yang benar (di terminal Anda):
    - `cd /d "c:/Users/Hype G12/Desktop/larapel/doctreen"`
    - `php artisan migrate --force`
- [ ] Refresh halaman: `GET /petani/dashboard` untuk memastikan error `keluhans` tidak muncul lagi.
- [ ] Jika masih error, periksa error berikutnya (kemungkinan mismatch tabel/kolom relasi lain) dan perbaiki bertahap.
