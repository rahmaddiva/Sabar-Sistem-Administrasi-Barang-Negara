<?= $this->extend('templates/main'); ?>
<?= $this->section('content'); ?>
<!-- Layout container -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Welcome Card -->
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Selamat Datang <?= session()->get('nama_lengkap') ?>! 🎉</h5>
                                <p class="mb-4">
                                    Selamat datang di SABAR (Sistem Administrasi Barang).
                                    Anda dapat mengelola semua aset dan barang dengan mudah di sini.
                                </p>
                                <a href="<?= base_url('kelola-barang') ?>" class="btn btn-sm btn-outline-primary">Kelola Barang</a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img
                                    src="<?= base_url('assets/img/illustrations/man-with-laptop-light.png') ?>"
                                    height="140"
                                    alt="View Badge User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <span class="avatar-initial rounded bg-label-primary">
                                            <i class="bx bx-cube"></i>
                                        </span>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Total Barang</span>
                                <h3 class="card-title mb-2"><?= $total_barang ?? 0 ?></h3>
                                <a href="<?= base_url('kelola-barang') ?>" class="text-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Barang Terbaru & Statistik -->
        <div class="row">
            <!-- Tabel Barang Terbaru -->
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0">Barang Terbaru</h5>
                        <a href="<?= base_url('kelola-barang') ?>" class="btn btn-sm btn-primary">Lihat Semua</a>
                    </div>
                    <div class="table-responsive text-nowrap">
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
                            <tbody class="table-border-bottom-0">
                                <?php if (isset($barang_terbaru) && !empty($barang_terbaru)): ?>
                                    <?php foreach ($barang_terbaru as $barang): ?>
                                        <tr>
                                            <td><i class="bx bx-box me-2"></i><?= $barang['kode_barang'] ?></td>
                                            <td>
                                                <strong><?= $barang['nama_barang'] ?></strong>
                                                <br>
                                                <small class="text-muted"><?= $barang['merk'] ?></small>
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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0">Statistik per Lokasi</h5>
                    </div>
                    <div class="card-body">
                        <?php if (isset($barang_per_lokasi) && !empty($barang_per_lokasi)): ?>
                            <?php foreach ($barang_per_lokasi as $lokasi): ?>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-0"><?= $lokasi['nama_lokasi'] ?></h6>
                                        <small class="text-muted"><?= $lokasi['total'] ?> barang</small>
                                    </div>
                                    <div class="avatar flex-shrink-0 bg-label-info">
                                        <span class="avatar-initial rounded">
                                            <i class="bx bx-map"></i>
                                        </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-center mt-3">Belum ada data lokasi</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-warning">
                                <i class="bx bx-category"></i>
                            </span>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Kategori</span>
                    <h3 class="card-title mb-2"><?= $total_kategori ?? 0 ?></h3>
                    <a href="<?= base_url('kelola-kategori') ?>" class="text-warning">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>



<!-- Content wrapper -->
<!-- / Layout page -->
<?= view('templates/partials') ?>
<?= $this->endSection(); ?>