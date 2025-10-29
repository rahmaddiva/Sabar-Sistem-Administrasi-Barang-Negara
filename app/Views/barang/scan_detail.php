<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo esc($title)?></title>
    <!-- Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
        }

        .card-header {
            background-color: #0d6efd;
            color: white;
        }

        .item-image {
            max-width: 100%;
            height: auto;
            max-height: 400px;
            border-radius: 0.375rem;
        }

        .info-table td {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .footer {
            margin-top: 2rem;
            padding: 1rem;
            background-color: #e9ecef;
            text-align: center;
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="my-2 text-center">Detail Informasi Barang</h4>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <!-- Kolom Gambar -->
                    <div class="col-md-5 text-center mb-4 mb-md-0">
                        <?php if ($barang['gambar']): ?>
                            <img src="<?php echo base_url('uploads/barang/images/' . $barang['gambar'])?>" alt="Gambar Barang" class="item-image">
                        <?php else: ?>
                            <div class="text-muted p-5 border rounded">
                                <p>Gambar tidak tersedia</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Kolom Informasi -->
                    <div class="col-md-7">
                        <h3 class="mb-3"><?php echo esc($barang['nama_barang'])?></h3>
                        <table class="table table-borderless info-table">
                            <tr>
                                <td width="40%"><strong>Kode Barang</strong></td>
                                <td>: <?php echo esc($barang['kode_barang'])?></td>
                            </tr>
                            <tr>
                                <td><strong>Merk</strong></td>
                                <td>: <?php echo esc($barang['merk'])?></td>
                            </tr>
                            <tr>
                                <td><strong>Tahun Perolehan</strong></td>
                                <td>: <?php echo esc($barang['tahun_perolehan'])?></td>
                            </tr>
                            <tr>
                                <td><strong>Kondisi</strong></td>
                                <td>: <span class="badge bg-primary"><?php echo esc($barang['kondisi'])?></span></td>
                            </tr>
                            <tr>
                                <td><strong>Lokasi / Ruangan</strong></td>
                                <td>: <?php echo esc($lokasi['nama_lokasi'] ?? 'N/A')?></td>
                            </tr>
                            <tr>
                                <td><strong>Penanggung Jawab</strong></td>
                                <td>: <?php echo esc($barang['penanggung_jawab'])?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        Sistem Administrasi Barang (SABAR) &copy; <?php echo date('Y')?>
    </footer>
</body>

</html>