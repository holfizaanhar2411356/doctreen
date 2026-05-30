<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Model Tanaman — Doctreen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a7a4a;
            --primary-dark: #145c38;
            --accent: #34d399;
            --bg: #f0fdf4;
            --card-bg: #fff;
            --text: #1a2e1a;
            --muted: #6b7280;
        }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); }
        .navbar-brand { font-weight: 700; color: var(--primary) !important; font-size: 1.4rem; }
        .page-header { background: linear-gradient(135deg, var(--primary) 0%, #2d9d6b 100%); color: white; padding: 2.5rem 0 2rem; }
        .page-header h1 { font-weight: 700; font-size: 2rem; }
        .card-tanaman { border: none; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,.07); transition: transform .2s, box-shadow .2s; overflow: hidden; }
        .card-tanaman:hover { transform: translateY(-4px); box-shadow: 0 8px 30px rgba(26,122,74,.15); }
        .card-tanaman .img-wrap { height: 180px; background: linear-gradient(135deg, #d1fae5, #a7f3d0); overflow: hidden; position: relative; }
        .card-tanaman .img-wrap img { width: 100%; height: 100%; object-fit: cover; }
        .card-tanaman .img-wrap .icon-placeholder { display: flex; align-items: center; justify-content: center; height: 100%; font-size: 3rem; color: var(--primary); opacity: .4; }
        .badge-jenis { background: #d1fae5; color: var(--primary); font-weight: 600; font-size: .72rem; border-radius: 20px; padding: 3px 10px; }
        .btn-green { background: var(--primary); color: white; border-radius: 10px; border: none; }
        .btn-green:hover { background: var(--primary-dark); color: white; }
        .btn-outline-green { color: var(--primary); border: 1.5px solid var(--primary); border-radius: 10px; }
        .btn-outline-green:hover { background: var(--primary); color: white; }
        .video-card { border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,.08); overflow: hidden; transition: transform .15s; }
        .video-card:hover { transform: translateY(-3px); }
        .video-thumb { position: relative; cursor: pointer; }
        .video-thumb img { width: 100%; height: 140px; object-fit: cover; }
        .video-thumb .play-btn { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(0,0,0,.6); color: white; border-radius: 50%; width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; }
        .video-thumb.local-video { background: #1a2e1a; display: flex; align-items: center; justify-content: center; height: 140px; }
        .video-thumb.local-video i { font-size: 2.5rem; color: var(--accent); }
        .search-box { border-radius: 12px; border: 1.5px solid #d1fae5; padding: .6rem 1.2rem; font-size: .95rem; }
        .search-box:focus { border-color: var(--primary); outline: none; box-shadow: 0 0 0 3px rgba(26,122,74,.1); }
        .show-more-btn { border: none; background: none; color: var(--primary); font-size: .85rem; font-weight: 600; padding: 0; }
        .collapsed-text { max-height: 60px; overflow: hidden; transition: max-height .4s ease; }
        .collapsed-text.expanded { max-height: 500px; }
        .modal-header { background: var(--primary); color: white; }
        .modal-header .btn-close { filter: invert(1); }
        .alert-success-custom { background: #d1fae5; border: 1px solid var(--accent); color: var(--primary-dark); border-radius: 12px; }
        .alert-danger-custom { background: #fee2e2; border: 1px solid #f87171; color: #991b1b; border-radius: 12px; }
        .section-title { font-weight: 700; font-size: 1.1rem; color: var(--primary); border-left: 4px solid var(--accent); padding-left: .75rem; margin-bottom: 1rem; }
    </style>
</head>
<body>
{{-- Navbar --}}
<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">🌿 Doctreen</a>
        <div class="d-flex align-items-center gap-2">
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-green"><i class="fas fa-arrow-left me-1"></i>Dashboard Admin</a>
            @else
                <a href="{{ route('konsultan.dashboard') }}" class="btn btn-sm btn-outline-green"><i class="fas fa-arrow-left me-1"></i>Dashboard</a>
            @endif
        </div>
    </div>
</nav>

{{-- Page Header --}}
<div class="page-header">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h1><i class="fas fa-seedling me-2"></i>Model Tanaman</h1>
                <p class="mb-0 opacity-75">Ensiklopedia tanaman pertanian — {{ $tanamanList->count() }} tanaman terdaftar</p>
            </div>
            @if(auth()->user()->role === 'admin')
            <button class="btn btn-light fw-600" data-bs-toggle="modal" data-bs-target="#modalTambahTanaman">
                <i class="fas fa-plus me-1"></i>Tambah Tanaman
            </button>
            @endif
        </div>
    </div>
</div>

<div class="container py-4">
    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success-custom d-flex align-items-center gap-2 mb-4">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger-custom d-flex align-items-center gap-2 mb-4">
            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
        </div>
    @endif

    {{-- Search --}}
    <div class="mb-4">
        <input type="text" id="searchTanaman" class="search-box w-100" placeholder="🔍 Cari tanaman berdasarkan nama atau jenis...">
    </div>

    {{-- Grid Tanaman --}}
    @if($tanamanList->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="fas fa-leaf fa-3x mb-3 d-block" style="color:#d1fae5"></i>
            Belum ada data tanaman. @if(auth()->user()->role === 'admin') Klik "Tambah Tanaman" untuk memulai. @endif
        </div>
    @else
    <div class="row g-4" id="tanamanGrid">
        @foreach($tanamanList as $tanaman)
        <div class="col-md-4 col-lg-3 tanaman-item" data-name="{{ strtolower($tanaman->nama_tanaman) }}" data-jenis="{{ strtolower($tanaman->jenis_tanaman ?? '') }}">
            <div class="card-tanaman bg-white h-100 d-flex flex-column">
                {{-- Foto --}}
                <div class="img-wrap">
                    @if($tanaman->foto_tanaman)
                        <img src="{{ $tanaman->foto_url }}" alt="{{ $tanaman->nama_tanaman }}" loading="lazy">
                    @else
                        <div class="icon-placeholder"><i class="fas fa-leaf"></i></div>
                    @endif
                </div>

                <div class="p-3 d-flex flex-column flex-grow-1">
                    {{-- Badge jenis --}}
                    @if($tanaman->jenis_tanaman)
                        <span class="badge-jenis mb-2 d-inline-block">{{ $tanaman->jenis_tanaman }}</span>
                    @endif

                    <h6 class="fw-700 mb-0">{{ $tanaman->nama_tanaman }}</h6>
                    @if($tanaman->nama_latin)
                        <small class="text-muted fst-italic mb-2">{{ $tanaman->nama_latin }}</small>
                    @endif

                    {{-- Deskripsi collapsible --}}
                    @if($tanaman->deskripsi)
                        <div class="collapsed-text mb-2" id="desc-{{ $tanaman->id }}">
                            <p class="text-muted small mb-0">{{ $tanaman->deskripsi }}</p>
                        </div>
                        <button class="show-more-btn text-start mb-2" onclick="toggleExpand('desc-{{ $tanaman->id }}', this)">
                            Lihat selengkapnya <i class="fas fa-chevron-down ms-1 fa-xs"></i>
                        </button>
                    @endif

                    <div class="mt-auto d-flex gap-2 flex-wrap">
                        {{-- Tombol detail / video --}}
                        <button class="btn btn-sm btn-outline-green flex-grow-1"
                            data-bs-toggle="modal" data-bs-target="#modalDetailTanaman"
                            onclick="loadDetail({{ $tanaman->id }}, @json($tanaman))">
                            <i class="fas fa-info-circle me-1"></i>Detail & Video
                        </button>

                        @if(auth()->user()->role === 'admin')
                        <button class="btn btn-sm btn-outline-warning"
                            data-bs-toggle="modal" data-bs-target="#modalEditTanaman"
                            onclick="loadEdit({{ $tanaman->id }}, @json($tanaman))">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form action="{{ route('admin.tanaman.hapus', $tanaman->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus tanaman ini beserta semua videonya?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

{{-- ===================== MODAL TAMBAH TANAMAN ===================== --}}
@if(auth()->user()->role === 'admin')
<div class="modal fade" id="modalTambahTanaman" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold"><i class="fas fa-plus me-2"></i>Tambah Tanaman Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.tanaman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-600">Nama Tanaman <span class="text-danger">*</span></label>
                            <input type="text" name="nama_tanaman" class="form-control" required placeholder="cth: Padi, Jagung">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-600">Nama Latin</label>
                            <input type="text" name="nama_latin" class="form-control" placeholder="cth: Oryza sativa">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-600">Jenis Tanaman</label>
                            <input type="text" name="jenis_tanaman" class="form-control" placeholder="cth: Pangan, Hortikultura">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-600">Foto Tanaman</label>
                            <input type="file" name="foto_tanaman" class="form-control" accept="image/*" onchange="previewImg(this, 'previewFotoTambah')">
                            <img id="previewFotoTambah" src="" alt="" class="mt-2 rounded" style="max-height:80px;display:none">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-600">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi singkat tanaman..."></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-600">Metode Perawatan</label>
                            <textarea name="metode_perawatan" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-600">Protokol Pengobatan</label>
                            <textarea name="protokol_pengobatan" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-600">Ancaman Hama</label>
                            <textarea name="ancaman_hama" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-green"><i class="fas fa-save me-1"></i>Simpan Tanaman</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===================== MODAL EDIT TANAMAN ===================== --}}
<div class="modal fade" id="modalEditTanaman" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold"><i class="fas fa-edit me-2"></i>Edit Tanaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEditTanaman" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-600">Nama Tanaman <span class="text-danger">*</span></label>
                            <input type="text" name="nama_tanaman" id="edit_nama_tanaman" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-600">Nama Latin</label>
                            <input type="text" name="nama_latin" id="edit_nama_latin" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-600">Jenis Tanaman</label>
                            <input type="text" name="jenis_tanaman" id="edit_jenis" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-600">Ganti Foto</label>
                            <input type="file" name="foto_tanaman" class="form-control" accept="image/*" onchange="previewImg(this, 'previewFotoEdit')">
                            <img id="previewFotoEdit" src="" alt="" class="mt-2 rounded" style="max-height:80px;display:none">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-600">Deskripsi</label>
                            <textarea name="deskripsi" id="edit_deskripsi" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-600">Metode Perawatan</label>
                            <textarea name="metode_perawatan" id="edit_metode" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-600">Protokol Pengobatan</label>
                            <textarea name="protokol_pengobatan" id="edit_protokol" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-600">Ancaman Hama</label>
                            <textarea name="ancaman_hama" id="edit_hama" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-green"><i class="fas fa-save me-1"></i>Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

{{-- ===================== MODAL DETAIL & VIDEO ===================== --}}
<div class="modal fade" id="modalDetailTanaman" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="detailModalTitle"><i class="fas fa-seedling me-2"></i>Detail Tanaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="detailModalBody">
                <div class="text-center py-4"><div class="spinner-border text-success"></div></div>
            </div>
        </div>
    </div>
</div>

{{-- ===================== MODAL VIDEO PLAYER ===================== --}}
<div class="modal fade" id="modalVideoPlayer" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="videoPlayerTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="stopVideo()"></button>
            </div>
            <div class="modal-body p-0" id="videoPlayerBody"></div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // ── Search ──
    document.getElementById('searchTanaman').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.tanaman-item').forEach(el => {
            const match = el.dataset.name.includes(q) || el.dataset.jenis.includes(q);
            el.style.display = match ? '' : 'none';
        });
    });

    // ── Collapse / Expand teks ──
    function toggleExpand(id, btn) {
        const el = document.getElementById(id);
        const expanded = el.classList.toggle('expanded');
        btn.innerHTML = expanded
            ? 'Tampilkan lebih sedikit <i class="fas fa-chevron-up ms-1 fa-xs"></i>'
            : 'Lihat selengkapnya <i class="fas fa-chevron-down ms-1 fa-xs"></i>';
    }

    // ── Preview foto sebelum upload ──
    function previewImg(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            preview.src = URL.createObjectURL(input.files[0]);
            preview.style.display = 'block';
        }
    }

    // ── Load Edit Modal ──
    function loadEdit(id, data) {
        const form = document.getElementById('formEditTanaman');
        form.action = `/admin/tanaman/${id}`;
        document.getElementById('edit_nama_tanaman').value = data.nama_tanaman || '';
        document.getElementById('edit_nama_latin').value   = data.nama_latin  || '';
        document.getElementById('edit_jenis').value        = data.jenis_tanaman || '';
        document.getElementById('edit_deskripsi').value    = data.deskripsi   || '';
        document.getElementById('edit_metode').value       = data.metode_perawatan || '';
        document.getElementById('edit_protokol').value     = data.protokol_pengobatan || '';
        document.getElementById('edit_hama').value         = data.ancaman_hama || '';
        document.getElementById('previewFotoEdit').style.display = 'none';
    }

    // ── Load Detail Modal (tanaman & video) ──
    const allTanaman = @json($tanamanList->map(function($t) {
        return [
            'id'                  => $t->id,
            'nama_tanaman'        => $t->nama_tanaman,
            'nama_latin'          => $t->nama_latin,
            'jenis_tanaman'       => $t->jenis_tanaman,
            'deskripsi'           => $t->deskripsi,
            'metode_perawatan'    => $t->metode_perawatan,
            'protokol_pengobatan' => $t->protokol_pengobatan,
            'ancaman_hama'        => $t->ancaman_hama,
            'foto_url'            => $t->foto_url,
            'videos'              => $t->videos->map(fn($v) => [
                'id'        => $v->id,
                'judul'     => $v->judul,
                'url'       => $v->url,
                'embed_url' => $v->embed_url,
                'thumbnail' => $v->thumbnail,
                'file_path' => $v->file_path,
                'uploader'  => $v->uploader,
            ]),
        ];
    }));

    const isAdmin = {{ auth()->user()->role === 'admin' ? 'true' : 'false' }};
    const csrfToken = '{{ csrf_token() }}';

    function loadDetail(id, data) {
        const tanaman = allTanaman.find(t => t.id === id) || data;
        document.getElementById('detailModalTitle').innerHTML = `<i class="fas fa-seedling me-2"></i>${tanaman.nama_tanaman}`;

        const videos = tanaman.videos || [];
        const maxShow = 4;
        const showMore = videos.length > maxShow;

        let infoHtml = `
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    ${tanaman.foto_url ? `<img src="${tanaman.foto_url}" class="img-fluid rounded-3 w-100" style="height:200px;object-fit:cover" alt="">` : `<div class="bg-light rounded-3 d-flex align-items-center justify-content-center" style="height:200px"><i class="fas fa-leaf fa-3x text-success opacity-25"></i></div>`}
                </div>
                <div class="col-md-8">
                    ${tanaman.jenis_tanaman ? `<span class="badge-jenis mb-2 d-inline-block">${tanaman.jenis_tanaman}</span>` : ''}
                    ${tanaman.nama_latin ? `<p class="text-muted fst-italic mb-2">${tanaman.nama_latin}</p>` : ''}
                    ${tanaman.deskripsi ? `<p class="mb-3">${tanaman.deskripsi}</p>` : ''}
                    <div class="row g-2">
                        ${tanaman.metode_perawatan ? `<div class="col-md-4"><div class="p-2 rounded-2" style="background:#d1fae5"><small class="fw-600 d-block text-success">Metode Perawatan</small><small>${tanaman.metode_perawatan}</small></div></div>` : ''}
                        ${tanaman.protokol_pengobatan ? `<div class="col-md-4"><div class="p-2 rounded-2" style="background:#fef3c7"><small class="fw-600 d-block" style="color:#92400e">Protokol Pengobatan</small><small>${tanaman.protokol_pengobatan}</small></div></div>` : ''}
                        ${tanaman.ancaman_hama ? `<div class="col-md-4"><div class="p-2 rounded-2" style="background:#fee2e2"><small class="fw-600 d-block text-danger">Ancaman Hama</small><small>${tanaman.ancaman_hama}</small></div></div>` : ''}
                    </div>
                </div>
            </div>`;

        let videoHtml = `<div class="section-title"><i class="fas fa-play-circle me-2"></i>Video (${videos.length})</div>`;

        if (isAdmin) {
            videoHtml += `
            <button class="btn btn-sm btn-green mb-3" data-bs-toggle="collapse" data-bs-target="#formVideoCollapse">
                <i class="fas fa-plus me-1"></i>Tambah Video
            </button>
            <div class="collapse mb-3" id="formVideoCollapse">
                <div class="border rounded-3 p-3">
                    <form action="/admin/tanaman/${tanaman.id}/video" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <label class="form-label fw-600 small">Judul Video</label>
                                <input type="text" name="judul" class="form-control form-control-sm" required placeholder="Judul video...">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-600 small">Tipe Video</label>
                                <select name="tipe_video" class="form-select form-select-sm" id="tipeVideoSelect" onchange="toggleVideoInput(this.value)">
                                    <option value="youtube">YouTube URL</option>
                                    <option value="lokal">Upload Lokal (MP4)</option>
                                </select>
                            </div>
                            <div class="col-md-4" id="inputYoutube">
                                <label class="form-label fw-600 small">URL YouTube</label>
                                <input type="url" name="url" class="form-control form-control-sm" placeholder="https://youtu.be/...">
                            </div>
                            <div class="col-md-4 d-none" id="inputLokal">
                                <label class="form-label fw-600 small">File Video (MP4)</label>
                                <input type="file" name="file_video" class="form-control form-control-sm" accept="video/mp4,video/webm">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-green mt-2"><i class="fas fa-upload me-1"></i>Upload Video</button>
                    </form>
                </div>
            </div>`;
        }

        if (videos.length === 0) {
            videoHtml += `<p class="text-muted small">Belum ada video untuk tanaman ini.</p>`;
        } else {
            videoHtml += `<div class="row g-3" id="videoGrid">`;
            videos.forEach((v, i) => {
                const hidden = i >= maxShow ? 'video-extra d-none' : '';
                if (v.url && v.embed_url) {
                    videoHtml += `
                    <div class="col-md-3 col-6 ${hidden}">
                        <div class="video-card">
                            <div class="video-thumb" onclick="playVideo('${v.embed_url}', '${v.judul}')">
                                ${v.thumbnail ? `<img src="${v.thumbnail}" alt="${v.judul}">` : `<div style="background:#1a2e1a;height:140px;display:flex;align-items:center;justify-content:center"><i class="fab fa-youtube fa-2x text-danger"></i></div>`}
                                <div class="play-btn"><i class="fas fa-play"></i></div>
                            </div>
                            <div class="p-2">
                                <p class="mb-0 small fw-600 text-truncate">${v.judul}</p>
                                <small class="text-muted"><i class="fab fa-youtube me-1 text-danger"></i>YouTube</small>
                                ${isAdmin ? `<form action="/admin/video/${v.id}" method="POST" class="mt-1 d-inline" onsubmit="return confirm('Hapus video ini?')"><input type="hidden" name="_token" value="${csrfToken}"><input type="hidden" name="_method" value="DELETE"><button class="btn btn-xs btn-outline-danger btn-sm py-0 px-1"><i class="fas fa-trash fa-xs"></i></button></form>` : ''}
                            </div>
                        </div>
                    </div>`;
                } else if (v.file_path) {
                    videoHtml += `
                    <div class="col-md-3 col-6 ${hidden}">
                        <div class="video-card">
                            <div class="video-thumb local-video" onclick="playLocalVideo('/storage/${v.file_path}', '${v.judul}')">
                                <i class="fas fa-film"></i>
                                <div class="play-btn" style="position:absolute"><i class="fas fa-play"></i></div>
                            </div>
                            <div class="p-2">
                                <p class="mb-0 small fw-600 text-truncate">${v.judul}</p>
                                <small class="text-muted"><i class="fas fa-file-video me-1"></i>Lokal</small>
                                ${isAdmin ? `<form action="/admin/video/${v.id}" method="POST" class="mt-1 d-inline" onsubmit="return confirm('Hapus video ini?')"><input type="hidden" name="_token" value="${csrfToken}"><input type="hidden" name="_method" value="DELETE"><button class="btn btn-xs btn-outline-danger btn-sm py-0 px-1"><i class="fas fa-trash fa-xs"></i></button></form>` : ''}
                            </div>
                        </div>
                    </div>`;
                }
            });
            videoHtml += `</div>`;

            if (showMore) {
                videoHtml += `
                <div class="text-center mt-3">
                    <button class="btn btn-sm btn-outline-green" id="showMoreVideos" onclick="toggleVideos(this)">
                        Lihat semua ${videos.length} video <i class="fas fa-chevron-down ms-1"></i>
                    </button>
                </div>`;
            }
        }

        document.getElementById('detailModalBody').innerHTML = infoHtml + videoHtml;
    }

    // ── Toggle Show More Videos ──
    function toggleVideos(btn) {
        const extras = document.querySelectorAll('.video-extra');
        const visible = btn.dataset.expanded === 'true';
        extras.forEach(el => el.classList.toggle('d-none', visible));
        btn.dataset.expanded = visible ? '' : 'true';
        btn.innerHTML = visible
            ? `Lihat semua video <i class="fas fa-chevron-down ms-1"></i>`
            : `Tampilkan lebih sedikit <i class="fas fa-chevron-up ms-1"></i>`;
    }

    // ── Toggle input YouTube vs Lokal ──
    function toggleVideoInput(val) {
        document.getElementById('inputYoutube').classList.toggle('d-none', val !== 'youtube');
        document.getElementById('inputLokal').classList.toggle('d-none', val !== 'lokal');
    }

    // ── Play YouTube ──
    function playVideo(embedUrl, title) {
        document.getElementById('videoPlayerTitle').textContent = title;
        document.getElementById('videoPlayerBody').innerHTML = `
            <div class="ratio ratio-16x9">
                <iframe src="${embedUrl}?autoplay=1" frameborder="0" allowfullscreen allow="autoplay; encrypted-media"></iframe>
            </div>`;
        new bootstrap.Modal(document.getElementById('modalVideoPlayer')).show();
    }

    // ── Play Local Video ──
    function playLocalVideo(path, title) {
        document.getElementById('videoPlayerTitle').textContent = title;
        document.getElementById('videoPlayerBody').innerHTML = `
            <video class="w-100" controls autoplay style="max-height:500px">
                <source src="${path}" type="video/mp4">
            </video>`;
        new bootstrap.Modal(document.getElementById('modalVideoPlayer')).show();
    }

    // ── Stop video on modal close ──
    function stopVideo() {
        document.getElementById('videoPlayerBody').innerHTML = '';
    }

    document.getElementById('modalVideoPlayer').addEventListener('hidden.bs.modal', stopVideo);
</script>
</body>
</html>
