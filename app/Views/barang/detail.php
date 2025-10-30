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

            <!-- QR Scanner Button -->
            <div class="card mt-3 border-primary">
                <div class="card-body text-center py-3">
                    <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#qrScannerModal">
                        <i class="bx bx-qr-scan"></i> Scan QR Code Barang
                    </button>
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
                                    <td><strong>NUP</strong></td>
                                    <td>:</td>
                                    <td><?= esc($barang['nup']) ?></td>
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
                                        <div class="mb-3">
                                            <i class="bx <?= $isPdf ? 'bx-file-pdf' : 'bx-file' ?> display-4 text-danger"></i>
                                        </div>
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

<!-- QR Scanner Modal -->
<div class="modal fade" id="qrScannerModal" tabindex="-1" aria-labelledby="qrScannerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qrScannerModalLabel">
                    <i class="bx bx-qr-scan"></i> Scan QR Code Barang
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <p class="text-muted">Arahkan QR Code ke kamera untuk memindai</p>
                </div>
                <div id="qr-reader" style="width: 100%;"></div>
                <div id="qr-reader-results" class="mt-3"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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

<?= $this->section('scripts') ?>
<!-- Include html5-qrcode library -->
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

<script>
    let html5QrCode;
    
    // Initialize scanner when modal is shown
    document.getElementById('qrScannerModal').addEventListener('shown.bs.modal', function () {
        html5QrCode = new Html5Qrcode("qr-reader");
        
        const config = {
            fps: 10,
            qrbox: { width: 250, height: 250 },
            aspectRatio: 1.0
        };
        
        html5QrCode.start(
            { facingMode: "environment" },
            config,
            onScanSuccess,
            onScanError
        ).catch(err => {
            console.error("Error starting scanner:", err);
            document.getElementById('qr-reader-results').innerHTML = 
                '<div class="alert alert-danger">Tidak dapat mengakses kamera. Pastikan Anda memberikan izin kamera.</div>';
        });
    });
    
    // Stop scanner when modal is hidden
    document.getElementById('qrScannerModal').addEventListener('hidden.bs.modal', function () {
        if (html5QrCode) {
            html5QrCode.stop().then(() => {
                html5QrCode.clear();
            }).catch(err => {
                console.error("Error stopping scanner:", err);
            });
        }
    });
    
    function onScanSuccess(decodedText, decodedResult) {
        // Stop scanning
        html5QrCode.stop();
        
        // Show success message
        document.getElementById('qr-reader-results').innerHTML = 
            '<div class="alert alert-success">QR Code berhasil dipindai! Mengarahkan ke halaman detail...</div>';
        
        // Redirect to the scanned URL
        setTimeout(() => {
            window.location.href = decodedText;
        }, 1000);
    }
    
    function onScanError(errorMessage) {
        // Silent error handling - only log to console
        // console.warn(`QR Code scan error: ${errorMessage}`);
    }
</script>
<?= $this->endSection() ?>