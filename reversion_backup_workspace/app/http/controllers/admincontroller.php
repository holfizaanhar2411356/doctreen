
    public function hapusPetani($id)
    {
        $petani = Petani::findOrFail($id);
        if ($petani->user) {
            if ($petani->user->foto_profil && Storage::disk('public')->exists($petani->user->foto_profil)) {
                Storage::disk('public')->delete($petani->user->foto_profil);
            }
            $petani->user->delete();
        } else {
            $petani->delete();
        }

        return back()->with('success', 'Petani berhasil dihapus!');
    }

    public function updatePetani(Request $request, $id)
    {
        $petani = Petani::findOrFail($id);
        $user = $petani->user;

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . ($user ? $user->id : 'NULL'),
            'telepon' => 'required|string|max:20',
            'daerah' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // Sinkronisasi Batas 5 MB
        ]);

        if ($user) {
            $pathFoto = $user->foto_profil;
            if ($request->hasFile('foto_profil')) {
                if ($pathFoto && Storage::disk('public')->exists($pathFoto)) {
                    Storage::disk('public')->delete($pathFoto);
                }
                $pathFoto = $request->f
<truncated 33701 bytes>
lable|url',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi,mkv|max:51200',
        ]);
        
        $video = DB::table('video_tanaman')->where('id', $id)->first();
        if (!$video) {
            return back()->with('error', 'Video tidak ditemukan.');
        }
        
        $pathVideo = $video->file_path;
        if ($request->hasFile('video_file')) {
            if ($pathVideo && Storage::disk('public')->exists($pathVideo)) {
                Storage::disk('public')->delete($pathVideo);
            }
            $pathVideo = $request->file('video_file')->store('videos', 'public');
            $urlVideo = null;
        } else {
            $urlVideo = $request->filled('video_url') ? $request->video_url : $video->url;
        }
        
        DB::table('video_tanaman')->where('id', $id)->update([
            'judul' => $request->judul,
            'url' => $urlVideo,
            'file_path' => $pathVideo,
            'updated_at' => now(),
        ]);
        
        return back()->with('success', 'Video panduan berhasil diperbarui!');
    }
    // --- ASSIGN KONSULTAN ---
    public function assignKonsultan(Request $request, $id)
    {
        $request->validate([
            'konsultan_id' => 'required|exists:konsultan,id',
            'tanggal_konsultasi' => 'required|date',
        ]);

        $keluhan = Keluhan::findOrFail($id);
        
        // Update status keluhan saja (tidak ada kolom id_konsultan di tabel keluhan)
        $keluhan->update([
            'status' => 'proses',
        ]);

        // Cari sesi konsultasi yang sudah terbuat sebelumnya (dari input keluhan petani)
The above content does NOT show the entire file contents. If you need to view any lines of the file which were not shown to complete your task, call this tool again to view those lines.