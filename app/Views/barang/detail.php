<?php $this->extend('templates/main') ?>
<?php $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- breadcrumb -->
            <div class="page-breadcrumb d-flex align-items-center mt-3">
                <h4 class="page-title me-3"><?= esc($title) ?></h4>
                <div class="ms-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/kelola-barang">Data Barang</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= esc($title) ?></li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">
                        <!-- Kolom Kiri: Informasi Barang -->
                        <div class="col-md-6">
                            <h5 class="card-title mb-4">Informasi Barang</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td width="30%">Kode Barang</td>
                                    <td width="5%">:</td>
                                    <td><?= esc($barang['kode_barang']) ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Barang</td>
                                    <td>:</td>
                                    <td><?= esc($barang['nama_barang']) ?></td>
                                </tr>
                                <tr>
                                    <td>Kategori</td>
                                    <td>:</td>
                                    <td><?= esc($kategori['nama_kategori']) ?></td>
                                </tr>
                                <tr>
                                    <td>Lokasi</td>
                                    <td>:</td>
                                    <td><?= esc($lokasi['nama_lokasi']) ?></td>
                                </tr>
                                <tr>
                                    <td>Merk</td>
                                    <td>:</td>
                                    <td><?= esc($barang['merk']) ?></td>
                                </tr>
                                <tr>
                                    <td>Tahun Perolehan</td>
                                    <td>:</td>
                                    <td><?= esc($barang['tahun_perolehan']) ?></td>
                                </tr>
                                <tr>
                                    <td>Kondisi</td>
                                    <td>:</td>
                                    <td><?= esc($barang['kondisi']) ?></td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>:</td>
                                    <td><?= nl2br(esc($barang['keterangan'])) ?></td>
                                </tr>
                            </table>
                        </div>

                        <!-- Kolom Kanan: QR Code dan Gambar -->
                        <div class="col-md-6">
                            <div class="row">
                                <!-- QR Code -->
                                <div class="col-md-6 text-center mb-4">
                                    <h6 class="mb-3">QR Code</h6>
                                    <?php if ($barang['qr_code']) : ?>
                                        <img src="<?= base_url('uploads/barang/qrcodes/' . $barang['qr_code']) ?>"
                                            alt="QR Code" class="img-fluid" style="max-width: 200px;">
                                        <div class="mt-2">
                                            <a href="<?= base_url('uploads/barang/qrcodes/' . $barang['qr_code']) ?>"
                                                class="btn btn-sm btn-primary" download>
                                                <i class="bx bx-download"></i> Download QR
                                            </a>
                                        </div>
                                    <?php else : ?>
                                        <p class="text-muted">QR Code tidak tersedia</p>
                                    <?php endif; ?>
                                </div>

                                <!-- Gambar Barang -->
                                <div class="col-md-6 text-center mb-4">
                                    <h6 class="mb-3">Gambar Barang</h6>
                                    <?php if ($barang['gambar']) : ?>
                                        <img src="<?= base_url('uploads/barang/images/' . $barang['gambar']) ?>"
                                            alt="Gambar Barang" class="img-fluid" style="max-width: 200px;">
                                        <div class="mt-2">
                                            <a href="<?= base_url('uploads/barang/images/' . $barang['gambar']) ?>"
                                                class="btn btn-sm btn-primary" download>
                                                <i class="bx bx-download"></i> Download Gambar
                                            </a>
                                        </div>
                                    <?php else : ?>
                                        <p class="text-muted">Gambar tidak tersedia</p>
                                    <?php endif; ?>
                                </div>

                                <!-- Dokumen BAST -->
                                <div class="col-12 text-center">
                                    <h6 class="mb-3">Dokumen BAST</h6>
                                    <?php if ($barang['dokumen_bast']) : ?>
                                        <div class="p-3 border rounded">
                                            <i class="bx bx-file fs-2"></i>
                                            <p class="mb-2"><?= esc($barang['dokumen_bast']) ?></p>
                                            <a href="<?= base_url('uploads/barang/documents/' . $barang['dokumen_bast']) ?>"
                                                class="btn btn-sm btn-primary" download>
                                                <i class="bx bx-download"></i> Download Dokumen
                                            </a>
                                        </div>
                                    <?php else : ?>
                                        <p class="text-muted">Dokumen BAST tidak tersedia</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Kembali -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <a href="<?= base_url('kelola-barang') ?>" class="btn btn-secondary">
                                <i class="bx bx-arrow-back"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>