<?php $this->extend('templates/main') ?>
<?php $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
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

            <!-- Informasi Barang Card -->
            <div class="card mt-3">
                <div class="card-header text-white">
                    <h5 class="card-title mb-0">Informasi Umum Barang</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="35%"><strong>Kode Barang</strong></td>
                                    <td width="5%">:</td>
                                    <td><?= esc($barang['kode_barang']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Barang</strong></td>
                                    <td>:</td>
                                    <td><?= esc($barang['nama_barang']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Kategori</strong></td>
                                    <td>:</td>
                                    <td><?= esc($kategori['nama_kategori']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Lokasi</strong></td>
                                    <td>:</td>
                                    <td><?= esc($lokasi['nama_lokasi']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Merk</strong></td>
                                    <td>:</td>
                                    <td><?= esc($barang['merk']) ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="35%"><strong>Tahun Perolehan</strong></td>
                                    <td width="5%">:</td>
                                    <td><?= esc($barang['tahun_perolehan']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Nilai Perolehan</strong></td>
                                    <td>:</td>
                                    <td>Rp <?= number_format($barang['nilai_perolehan'], 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Penanggung Jawab</strong></td>
                                    <td>:</td>
                                    <td><?= esc($barang['penanggung_jawab']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Kondisi</strong></td>
                                    <td>:</td>
                                    <td><span class="badge bg-info"><?= esc($barang['kondisi']) ?></span></td>
                                </tr>
                                <tr>
                                    <td><strong>Keterangan</strong></td>
                                    <td>:</td>
                                    <td><?= nl2br(esc($barang['keterangan'])) ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Media Section Card -->
            <div class="card mt-4">
                <div class="card-header text-current">
                    <h5 class="card-title mb-0">Media & Dokumen</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- QR Code -->
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">QR Code</h6>
                                </div>
                                <div class="card-body text-center">
                                    <?php if ($barang['qr_code']) : ?>
                                        <img src="<?= base_url('uploads/barang/qrcodes/' . $barang['qr_code']) ?>"
                                            alt="QR Code" class="img-fluid mb-3" style="max-height: 200px;">
                                        <div>
                                            <a href="<?= base_url('uploads/barang/qrcodes/' . $barang['qr_code']) ?>"
                                                class="btn btn-sm btn-primary" download>
                                                <i class="bx bx-download"></i> Download QR Code
                                            </a>
                                        </div>
                                    <?php else : ?>
                                        <p class="text-muted">QR Code tidak tersedia</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Gambar Barang -->
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">Gambar Barang</h6>
                                </div>
                                <div class="card-body text-center">
                                    <?php if ($barang['gambar']) : ?>
                                        <img src="<?= base_url('uploads/barang/images/' . $barang['gambar']) ?>"
                                            alt="Gambar Barang" class="img-fluid mb-3" style="max-height: 200px;">
                                        <div>
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#imageModal">
                                                <i class="bx bx-zoom-in"></i> Lihat Detail
                                            </button>
                                            <a href="<?= base_url('uploads/barang/images/' . $barang['gambar']) ?>"
                                                class="btn btn-sm btn-primary" download>
                                                <i class="bx bx-download"></i> Download
                                            </a>
                                        </div>
                                    <?php else : ?>
                                        <p class="text-muted">Gambar tidak tersedia</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Dokumen BAST -->
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">Dokumen BAST</h6>
                                </div>
                                <div class="card-body text-center">
                                    <?php if ($barang['dokumen_bast']) : ?>
                                        <?php
                                        $ext = pathinfo($barang['dokumen_bast'], PATHINFO_EXTENSION);
                                        $isPdf = strtolower($ext) === 'pdf';
                                        ?>
                                        <?php if ($isPdf) : ?>
                                            <div class="embed-responsive mb-3" style="height: 200px;">
                                                <embed src="<?= base_url('uploads/barang/documents/' . $barang['dokumen_bast']) ?>"
                                                    type="application/pdf" width="100%" height="100%">
                                            </div>
                                        <?php else : ?>
                                            <div class="mb-3">
                                                <i class="bx bx-file fs-1"></i>
                                                <p class="mb-2"><?= esc($barang['dokumen_bast']) ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <?php if ($isPdf) : ?>
                                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#pdfModal">
                                                    <i class="bx bx-zoom-in"></i> Lihat Detail
                                                </button>
                                            <?php endif; ?>
                                            <a href="<?= base_url('uploads/barang/documents/' . $barang['dokumen_bast']) ?>"
                                                class="btn btn-sm btn-primary" download>
                                                <i class="bx bx-download"></i> Download
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

<!-- Image Modal -->
<?php if ($barang['gambar']) : ?>
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Detail Gambar Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="<?= base_url('uploads/barang/images/' . $barang['gambar']) ?>"
                        alt="Gambar Barang" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- PDF Modal -->
<?php if ($barang['dokumen_bast'] && pathinfo($barang['dokumen_bast'], PATHINFO_EXTENSION) === 'pdf') : ?>
    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Detail Dokumen BAST</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <embed src="<?= base_url('uploads/barang/documents/' . $barang['dokumen_bast']) ?>"
                        type="application/pdf" width="100%" height="600px">
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>