<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['title' => 'Katalog Koleksi Buku — Portal Mahasiswa SIPUS-Del']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Katalog Koleksi Buku — Portal Mahasiswa SIPUS-Del']); ?>

    
    <div class="hero-del-modern">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-3" style="font-size: 0.78rem; background: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.25);">
                    <span class="badge bg-warning text-dark rounded-pill fw-bold">IT DEL</span>
                    <span class="text-white fw-medium">Sistem Informasi Perpustakaan Kampus Laguboti</span>
                </div>
                <h1 class="fw-bold display-6 mb-2 text-white" style="letter-spacing: -0.02em;">
                    Katalog & Koleksi Pustaka Digital
                </h1>
                <p class="text-white text-opacity-80 mb-4 fs-6" style="max-width: 620px;">
                    Eksplorasi ribuan judul referensi perkuliahan, jurnal internasional, dan buku teks akademik untuk mendukung riset dan studi Anda.
                </p>

                
                <form method="GET" action="<?php echo e(route('katalog.index')); ?>" class="search-box-modern mb-3" role="search">
                    <i class="bi bi-search text-muted fs-5 me-2" aria-hidden="true"></i>
                    <input type="text"
                           name="search"
                           id="mainSearchInput"
                           value="<?php echo e(request('search')); ?>"
                           placeholder="Cari judul buku, nama pengarang, atau ISBN (contoh: Clean Code, Basis Data)..."
                           aria-label="Cari buku">
                    <?php if(request('kategori_id')): ?>
                        <input type="hidden" name="kategori_id" value="<?php echo e(request('kategori_id')); ?>">
                    <?php endif; ?>
                    <button type="submit" class="btn btn-del rounded-pill px-4 ms-2 py-2">
                        Cari Buku
                    </button>
                </form>

                
                <?php if(!empty($lastSearch)): ?>
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: rgba(255,255,255,0.18); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.25);">
                        <i class="bi bi-clock-history text-warning" style="font-size: 0.8rem;"></i>
                        <span class="text-white-50" style="font-size: 0.78rem;">Pencarian terakhir:</span>
                        <a href="<?php echo e(route('katalog.index', ['search' => $lastSearch])); ?>" class="badge bg-warning text-dark text-decoration-none fw-bold rounded-pill px-2 py-1" style="font-size: 0.75rem;">
                            "<?php echo e($lastSearch); ?>" <i class="bi bi-arrow-repeat ms-1"></i>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-lg-4 d-none d-lg-block text-end">
                <div class="d-inline-flex flex-column gap-2 text-start p-3 rounded-4" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); min-width: 260px;">
                    <div class="d-flex align-items-center justify-content-between p-2 rounded-3" style="background: rgba(255,255,255,0.12);">
                        <span class="small text-white-75"><i class="bi bi-bookshelf text-warning me-1"></i> Total Judul</span>
                        <strong class="text-white fs-5"><?php echo e($statistik['total_judul'] ?? 0); ?></strong>
                    </div>
                    <div class="d-flex align-items-center justify-content-between p-2 rounded-3" style="background: rgba(255,255,255,0.12);">
                        <span class="small text-white-75"><i class="bi bi-check2-circle text-success me-1"></i> Stok Tersedia</span>
                        <strong class="text-white fs-5"><?php echo e($statistik['total_stok_tersedia'] ?? 0); ?></strong>
                    </div>
                    <div class="d-flex align-items-center justify-content-between p-2 rounded-3" style="background: rgba(255,255,255,0.12);">
                        <span class="small text-white-75"><i class="bi bi-tags text-info me-1"></i> Kategori</span>
                        <strong class="text-white fs-5"><?php echo e($kategoris->count()); ?></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 p-2 bg-purple-subtle text-del">
                        <i class="bi bi-journal-album fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted text-uppercase fw-semibold" style="font-size: 0.7rem; letter-spacing: 0.5px;">Total Judul Buku</div>
                        <div class="fw-bold fs-4 text-dark lh-1"><?php echo e(number_format($statistik['total_judul'] ?? 0)); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 p-2 bg-success-subtle text-success">
                        <i class="bi bi-check2-circle fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted text-uppercase fw-semibold" style="font-size: 0.7rem; letter-spacing: 0.5px;">Total Stok Tersedia</div>
                        <div class="fw-bold fs-4 text-success lh-1"><?php echo e(number_format($statistik['total_stok_tersedia'] ?? 0)); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 p-2 bg-warning-subtle text-warning-emphasis">
                        <i class="bi bi-arrow-repeat fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted text-uppercase fw-semibold" style="font-size: 0.7rem; letter-spacing: 0.5px;">Sedang Dipinjam</div>
                        <div class="fw-bold fs-4 text-warning-emphasis lh-1"><?php echo e(number_format($statistik['total_sedang_dipinjam'] ?? 0)); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 p-2 bg-info-subtle text-info-emphasis">
                        <i class="bi bi-box-arrow-in-down-left fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted text-uppercase fw-semibold" style="font-size: 0.7rem; letter-spacing: 0.5px;">Total Dikembalikan</div>
                        <div class="fw-bold fs-4 text-info-emphasis lh-1"><?php echo e(number_format($statistik['total_dikembalikan'] ?? 0)); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <?php if(isset($pengumumanTerbaru) && $pengumumanTerbaru->count() > 0): ?>
        <div class="announcement-ticker mb-4 shadow-sm">
            <div class="pulse-badge">
                <span class="pulse-ring bg-warning"></span>
                <span class="badge bg-warning text-dark rounded-pill px-2 py-1 fw-bold" style="font-size: 0.72rem;">
                    <i class="bi bi-megaphone-fill me-1"></i> PENGUMUMAN
                </span>
            </div>
            <div class="flex-grow-1 text-truncate">
                <?php $topAnnouncement = $pengumumanTerbaru->first(); ?>
                <span class="fw-semibold text-dark"><?php echo e($topAnnouncement->judul); ?>:</span>
                <span class="text-muted small ms-1"><?php echo e(Str::limit(strip_tags($topAnnouncement->konten), 90)); ?></span>
            </div>
            <div class="d-flex gap-2 flex-shrink-0">
                <button type="button" class="btn btn-sm btn-outline-del rounded-pill px-3 py-1" data-bs-toggle="modal" data-bs-target="#announcementModal<?php echo e($topAnnouncement->id); ?>">
                    Baca Rincian <i class="bi bi-arrow-right ms-1"></i>
                </button>
                <a href="<?php echo e(route('pengumuman.index')); ?>" class="btn btn-sm btn-light rounded-pill px-3 py-1 text-muted border">
                    Semua Pengumuman
                </a>
            </div>
        </div>

        
        <div class="modal fade" id="announcementModal<?php echo e($topAnnouncement->id); ?>" tabindex="-1" aria-labelledby="announcementModalLabel<?php echo e($topAnnouncement->id); ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow-lg">
                    <div class="modal-header bg-del-gradient text-white rounded-top-4 border-0 py-3">
                        <h5 class="modal-title fw-bold" id="announcementModalLabel<?php echo e($topAnnouncement->id); ?>">
                            <i class="bi bi-megaphone-fill me-2 text-warning"></i><?php echo e($topAnnouncement->judul); ?>

                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge <?php echo e($topAnnouncement->kategori_badge); ?> rounded-pill px-3 py-1">
                                <?php echo e($topAnnouncement->kategori_label); ?>

                            </span>
                            <span class="text-muted small">
                                <i class="bi bi-calendar3 me-1"></i><?php echo e($topAnnouncement->created_at->format('d M Y')); ?>

                            </span>
                            <span class="text-muted small ms-auto">
                                Oleh: <strong><?php echo e($topAnnouncement->author->name ?? 'Pustakawan'); ?></strong>
                            </span>
                        </div>
                        <div class="text-secondary lh-lg" style="white-space: pre-line;">
                            <?php echo e($topAnnouncement->konten); ?>

                        </div>
                    </div>
                    <div class="modal-footer border-0 bg-light rounded-bottom-4 justify-content-between p-3">
                        <a href="<?php echo e(route('pengumuman.index')); ?>" class="btn btn-sm btn-outline-del rounded-pill px-3">
                            Lihat Arsip Pengumuman
                        </a>
                        <button type="button" class="btn btn-del btn-sm rounded-pill px-4" data-bs-dismiss="modal">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    
    <div class="mb-4">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <span class="fw-bold text-dark small text-uppercase tracking-wider">
                <i class="bi bi-tags-fill text-del me-1"></i> Klasifikasi & Kategori Koleksi
            </span>
            <?php if(request('search') || request('kategori_id')): ?>
                <a href="<?php echo e(route('katalog.index')); ?>" class="text-del small text-decoration-none fw-semibold">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Semua Filter
                </a>
            <?php endif; ?>
        </div>
        <div class="d-flex gap-2 overflow-auto pb-2" style="scrollbar-width: thin;">
            <a href="<?php echo e(route('katalog.index', request()->except('kategori_id'))); ?>"
               class="chip-filter <?php echo e(!request('kategori_id') ? 'active' : ''); ?>">
                Semua Kategori (<?php echo e($statistik['total_judul'] ?? $bukus->total()); ?>)
            </a>
            <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('katalog.index', array_merge(request()->except('kategori_id'), ['kategori_id' => $kat->id]))); ?>"
                   class="chip-filter <?php echo e(request('kategori_id') == $kat->id ? 'active' : ''); ?>">
                    <?php echo e($kat->nama_kategori); ?> (<?php echo e($kat->bukus_count ?? 0); ?>)
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    
    <?php if(request('search') || request('kategori_id')): ?>
        <div class="alert bg-del-pale border-del text-del rounded-4 d-flex align-items-center justify-content-between p-3 mb-4">
            <div class="small">
                <i class="bi bi-info-circle-fill me-2 fs-6"></i>
                Menampilkan <strong><?php echo e($bukus->total()); ?></strong> buku
                <?php if(request('search')): ?> untuk kata kunci "<strong><?php echo e(request('search')); ?></strong>" <?php endif; ?>
                <?php if(request('kategori_id')): ?> dalam kategori terpilih <?php endif; ?>.
            </div>
            <a href="<?php echo e(route('katalog.index')); ?>" class="btn btn-sm btn-del rounded-pill px-3 py-1">
                Tampilkan Semua
            </a>
        </div>
    <?php endif; ?>

    
    <div class="row g-4 mb-5">
        <?php $__empty_1 = true; $__currentLoopData = $bukus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <article class="book-card-modern shadow-sm">

                    
                    <div class="book-card-cover-area">
                        <div class="book-3d-wrap">
                            <a href="<?php echo e(route('katalog.show', $buku)); ?>" class="text-decoration-none" title="Lihat detail <?php echo e($buku->judul); ?>">
                                <div class="book-3d-cover">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <span class="badge bg-warning text-dark fw-bold rounded-pill" style="font-size: 0.6rem;">
                                            <?php echo e($buku->kategori->kode_kategori ?? 'DEL'); ?>

                                        </span>
                                        <i class="bi bi-bookmark-fill text-warning" style="font-size: 0.85rem;"></i>
                                    </div>
                                    <div class="text-center my-auto px-1">
                                        <h3 class="fw-bold text-white mb-1" style="font-size: 0.82rem; line-height: 1.3;">
                                            <?php echo e(Str::limit($buku->judul, 36)); ?>

                                        </h3>
                                        <div class="text-white-50" style="font-size: 0.68rem;"><?php echo e(Str::limit($buku->penulis, 20)); ?></div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-end pt-1 border-top border-white border-opacity-25" style="font-size: 0.58rem;">
                                        <span class="text-white-50 font-monospace"><?php echo e(Str::limit($buku->isbn, 13)); ?></span>
                                        <span class="badge rounded-pill text-white" style="background: rgba(255,255,255,0.25);"><?php echo e($buku->tahun_terbit); ?></span>
                                    </div>
                                </div>
                            </a>
                        </div>

                        
                        <div class="position-absolute top-0 end-0 m-3">
                            <?php if($buku->status_stok === 'tersedia'): ?>
                                <span class="badge bg-success shadow-sm rounded-pill" style="font-size: 0.68rem;">
                                    <i class="bi bi-check2 me-1"></i><?php echo e($buku->stok); ?> Tersedia
                                </span>
                            <?php elseif($buku->status_stok === 'menipis'): ?>
                                <span class="badge bg-warning text-dark shadow-sm rounded-pill" style="font-size: 0.68rem;">
                                    <i class="bi bi-exclamation me-1"></i>Sisa <?php echo e($buku->stok); ?>

                                </span>
                            <?php else: ?>
                                <span class="badge bg-danger shadow-sm rounded-pill" style="font-size: 0.68rem;">
                                    <i class="bi bi-x me-1"></i>Habis
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="card-body p-4 d-flex flex-column flex-grow-1">
                        <div class="mb-1">
                            <span class="badge badge-del px-2 py-1 rounded-pill" style="font-size: 0.68rem;">
                                <?php echo e($buku->kategori->nama_kategori ?? 'Umum'); ?>

                            </span>
                        </div>

                        <h2 class="fs-6 fw-bold text-dark mb-1">
                            <a href="<?php echo e(route('katalog.show', $buku)); ?>" class="text-decoration-none text-dark hover-del" style="line-height: 1.4;">
                                <?php echo e($buku->judul); ?>

                            </a>
                        </h2>

                        <div class="text-muted small mb-2 d-flex align-items-center gap-2" style="font-size: 0.8rem;">
                            <span><i class="bi bi-person me-1"></i><?php echo e($buku->penulis); ?></span>
                            <span>&bull;</span>
                            <span><i class="bi bi-building me-1"></i><?php echo e($buku->penerbit); ?></span>
                        </div>

                        <p class="text-secondary small flex-grow-1 mb-3" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.5; font-size: 0.82rem;">
                            <?php echo e($buku->sinopsis ?? 'Referensi literatur akademik Institut Teknologi Del.'); ?>

                        </p>

                        
                        <div class="d-flex gap-2 mt-auto pt-3 border-top">
                            <a href="<?php echo e(route('katalog.show', $buku)); ?>" class="btn btn-outline-secondary btn-sm rounded-pill px-3 flex-grow-1" aria-label="Lihat detail <?php echo e($buku->judul); ?>">
                                <i class="bi bi-info-circle me-1" aria-hidden="true"></i> Detail Buku
                            </a>

                            <?php if($buku->stok > 0): ?>
                                <form action="<?php echo e(route('katalog.pinjam', $buku)); ?>" method="POST" class="d-inline flex-grow-1" id="pinjamForm<?php echo e($buku->id); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="button"
                                            class="btn btn-del btn-sm rounded-pill px-3 w-100 shadow-sm"
                                            data-confirm-trigger
                                            data-confirm-form="pinjamForm<?php echo e($buku->id); ?>"
                                            data-confirm-title="Konfirmasi Peminjaman"
                                            data-confirm-message="Pinjam buku &quot;<?php echo e(addslashes($buku->judul)); ?>&quot;?"
                                            data-confirm-subtext="Masa pinjam adalah <strong>7 hari kalender</strong>. Denda Rp1.000/hari jika telat."
                                            data-confirm-ok="Pinjam Sekarang"
                                            aria-label="Pinjam buku <?php echo e($buku->judul); ?>">
                                        <i class="bi bi-bookmark-plus me-1" aria-hidden="true"></i> Pinjam
                                    </button>
                                </form>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-sm rounded-pill px-3 flex-grow-1" disabled>
                                    <i class="bi bi-dash-circle me-1"></i> Habis
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </article>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <div class="card card-del border-0 shadow-sm text-center py-5 px-3">
                    <div class="mb-3">
                        <div class="brand-badge mx-auto" style="width: 70px; height: 70px; font-size: 2rem;">
                            <i class="bi bi-search text-warning"></i>
                        </div>
                    </div>
                    <h2 class="h5 fw-bold text-dark mb-2">Buku Tidak Ditemukan</h2>
                    <p class="text-muted mb-4 small" style="max-width: 480px; margin: 0 auto;">
                        Tidak ada koleksi yang cocok dengan filter atau kata kunci yang dimasukkan. Silakan coba judul lain atau reset pencarian.
                    </p>
                    <div>
                        <a href="<?php echo e(route('katalog.index')); ?>" class="btn btn-del rounded-pill px-4">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Tampilkan Semua Koleksi
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    
    <?php if($bukus->hasPages()): ?>
        <div class="d-flex justify-content-center mb-5">
            <?php echo e($bukus->links()); ?>

        </div>
    <?php endif; ?>

    
    <section class="mt-4 mb-5 pt-4 border-top" id="tentang">
        <div class="text-center mb-4">
            <span class="badge badge-del px-3 py-1 rounded-pill mb-2">LAYANAN KAMPUS</span>
            <h2 class="h4 fw-bold text-dark mb-1">
                Tentang Perpustakaan Institut Teknologi Del
            </h2>
            <p class="text-muted small" style="max-width: 580px; margin: 0 auto;">
                Menyediakan akses sumber daya ilmu pengetahuan, fasilitas ruang baca kondusif, dan otomasi sirkulasi digital bagi civitas academica IT Del.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="feature-card-del">
                    <div class="feature-icon-bubble bg-del-pale text-del">
                        <i class="bi bi-laptop"></i>
                    </div>
                    <h3 class="h6 fw-bold text-dark mb-2">Akses Katalog 24/7</h3>
                    <p class="small text-muted mb-0">
                        Pencarian buku, pengecekan ketersediaan stok fisik, dan perpanjangan masa pinjam mandiri secara real-time via Portal Mahasiswa.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="feature-card-del">
                    <div class="feature-icon-bubble bg-del-pale text-del">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <h3 class="h6 fw-bold text-dark mb-2">Jam Layanan Kampus</h3>
                    <p class="small text-muted mb-0">
                        Ruang baca buka Senin - Jumat pukul 08.00 - 22.00 WIB. Layanan sirkulasi buku dan pengembalian dilayani hingga pukul 17.00 WIB.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="feature-card-del">
                    <div class="feature-icon-bubble bg-del-pale text-del">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h3 class="h6 fw-bold text-dark mb-2">Aturan Sirkulasi Terbuka</h3>
                    <p class="small text-muted mb-0">
                        Batas kuota maksimal 3 buku dengan durasi pinjam 7 hari kalender. Bebas denda jika dikembalikan tepat waktu.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="feature-card-del">
                    <div class="feature-icon-bubble bg-del-pale text-del">
                        <i class="bi bi-journal-bookmark"></i>
                    </div>
                    <h3 class="h6 fw-bold text-dark mb-2">E-Journal & Repository</h3>
                    <p class="small text-muted mb-0">
                        Terhubung ke repositori karya ilmiah IT Del, IEEE Xplore, ScienceDirect, dan jurnal nasional terakreditasi SINTA.
                    </p>
                </div>
            </div>
        </div>
    </section>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $attributes = $__attributesOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__attributesOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $component = $__componentOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__componentOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\DEL-LEATS\resources\views/katalog/index.blade.php ENDPATH**/ ?>