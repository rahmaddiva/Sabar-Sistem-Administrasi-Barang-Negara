<?= $this->extend('templates/main'); ?>
<?= $this->section('content'); ?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Welcome Message -->
            <div class="col-12 mb-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="text-white mb-1">Selamat Datang, <?= session()->get('nama_lengkap') ?>! 👋</h4>
                                <p class="mb-0">Sistem Administrasi Barang (SABAR)</p>
                            </div>
                            <a href="<?= base_url('kelola-barang') ?>" class="btn btn-sm btn-light">Kelola Barang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row">
            <!-- Total Barang -->
            <div class="col-lg-4 col-md-4 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar flex-shrink-0 me-2">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="bx bx-cube"></i>
                                </span>
                            </div>
                            <span class="fw-semibold">Total Barang</span>
                        </div>
                        <h3 class="card-title mb-2"><?= $total_barang ?? 0 ?></h3>
                        <a href="<?= base_url('kelola-barang') ?>" class="text-primary small">Lihat Detail</a>
                    </div>
                </div>
            </div>

            <!-- Total Kategori -->
            <div class="col-lg-4 col-md-4 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar flex-shrink-0 me-2">
                                <span class="avatar-initial rounded bg-label-warning">
                                    <i class="bx bx-category"></i>
                                </span>
                            </div>
                            <span class="fw-semibold">Total Kategori</span>
                        </div>
                        <h3 class="card-title mb-2"><?= $total_kategori ?? 0 ?></h3>
                        <a href="<?= base_url('kelola-kategori') ?>" class="text-warning small">Lihat Detail</a>
                    </div>
                </div>
            </div>

            <!-- Total Lokasi -->
            <div class="col-lg-4 col-md-4 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar flex-shrink-0 me-2">
                                <span class="avatar-initial rounded bg-label-success">
                                    <i class="bx bx-map-pin"></i>
                                </span>
                            </div>
                            <span class="fw-semibold">Total Lokasi</span>
                        </div>
                        <h3 class="card-title mb-2"><?= $total_lokasi ?? 0 ?></h3>
                        <a href="<?= base_url('kelola-lokasi') ?>" class="text-success small">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Row -->
        <div class="row">
            <!-- Barang Terbaru -->
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0">Barang Terbaru</h5>
                        <a href="<?= base_url('kelola-barang') ?>" class="btn btn-sm btn-primary">Lihat Semua</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Lokasi</th>
                                    <th>Kondisi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($barang_terbaru) && !empty($barang_terbaru)): ?>
                                    <?php foreach ($barang_terbaru as $barang): ?>
                                        <tr>
                                            <td><i class="bx bx-box text-primary me-1"></i><?= $barang['kode_barang'] ?></td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="fw-semibold"><?= $barang['nama_barang'] ?></span>
                                                    <small class="text-muted"><?= $barang['merk'] ?></small>
                                                </div>
                                            </td>
                                            <td><?= $barang['nama_kategori'] ?></td>
                                            <td><?= $barang['nama_lokasi'] ?></td>
                                            <td>
                                                <span class="badge bg-label-<?= $barang['kondisi'] == 'Baik' ? 'success' : 'warning' ?>">
                                                    <?= $barang['kondisi'] ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data barang</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Statistik per Lokasi -->
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title m-0">Statistik per Lokasi</h5>
                    </div>
                    <div class="card-body">
                        <?php if (isset($barang_per_lokasi) && !empty($barang_per_lokasi)): ?>
                            <?php foreach ($barang_per_lokasi as $lokasi): ?>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-info">
                                            <i class="bx bx-map"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-0"><?= $lokasi['nama_lokasi'] ?></h6>
                                                <small class="text-muted"><?= $lokasi['total'] ?> barang</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-center text-muted mt-3">Belum ada data lokasi</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>