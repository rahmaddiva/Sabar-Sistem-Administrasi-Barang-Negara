<?php $this->extend('templates/main') ?>
<?php $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- rowcrumb -->
            <div class="page-breadcrumb d-flex align-items-center mt-3">
                <h4 class="page-title me-3"><?= esc($title) ?></h4>
                <div class="ms-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= esc($title) ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-body col-lg-12">
                    <?php if (session()->getFlashdata('errors')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('proses-barang') ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="kategori">Kategori</label>
                                    <select class="form-select" name="id_kategori" id="kategori">
                                        <option value="">Pilih Kategori</option>
                                        <?php foreach ($kategoris as $kategori) : ?>
                                            <option value="<?= $kategori['id'] ?>" <?= old('id_kategori') == $kategori['id'] ? 'selected' : '' ?>><?= $kategori['nama_kategori'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="lokasi">Lokasi</label>
                                    <select class="form-select" name="id_lokasi" id="lokasi">
                                        <option value="">Pilih Lokasi</option>
                                        <?php foreach ($lokasis as $lokasi) : ?>
                                            <option value="<?= $lokasi['id'] ?>" <?= old('id_lokasi') == $lokasi['id'] ? 'selected' : '' ?>><?= $lokasi['nama_lokasi'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= old('nama_barang') ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kode_barang">Kode Barang</label>
                                    <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= old('kode_barang') ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="merk">Merk</label>
                                    <input type="text" class="form-control" id="merk" name="merk" value="<?= old('merk') ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tahun_perolehan">Tahun Perolehan</label>
                                    <input type="number" class="form-control" id="tahun_perolehan" name="tahun_perolehan" value="<?= old('tahun_perolehan') ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kondisi">Kondisi</label>
                                    <select class="form-select" name="kondisi" id="kondisi">
                                        <option value="">Pilih Kondisi</option>
                                        <option value="Baik" <?= old('kondisi') == 'Baik' ? 'selected' : '' ?>>Baik</option>
                                        <option value="Rusak Ringan" <?= old('kondisi') == 'Rusak Ringan' ? 'selected' : '' ?>>Rusak Ringan</option>
                                        <option value="Rusak Berat" <?= old('kondisi') == 'Rusak Berat' ? 'selected' : '' ?>>Rusak Berat</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="gambar">Gambar Barang</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="dokumen_bast">Dokumen BAST</label>
                                    <input type="file" class="form-control" id="dokumen_bast" name="dokumen_bast" accept=".pdf,.doc,.docx">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?= old('keterangan') ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="<?= base_url('kelola-barang') ?>" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('templates/partials') ?>
<?php $this->endSection() ?>