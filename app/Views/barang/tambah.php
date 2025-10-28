<?php $this->extend('templates/main')?>
<?php $this->section('content')?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- rowcrumb -->
            <div class="page-breadcrumb d-flex align-items-center mt-3">
                <h4 class="page-title me-3"><?php echo esc($title) ?></h4>
                <div class="ms-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo esc($title) ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body col-lg-12">
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?php echo $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo base_url('proses-barang') ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="kategori">Kategori</label>
                                    <select class="form-select" name="id_kategori" id="kategori">
                                        <option value="">Pilih Kategori</option>
                                        <?php foreach ($kategoris as $kategori): ?>
                                            <option value="<?php echo $kategori['id'] ?>"<?php echo old('id_kategori') == $kategori['id'] ? 'selected' : '' ?>><?php echo $kategori['nama_kategori'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="lokasi">Lokasi</label>
                                    <select class="form-select" name="id_lokasi" id="lokasi">
                                        <option value="">Pilih Lokasi</option>
                                        <?php foreach ($lokasis as $lokasi): ?>
                                            <option value="<?php echo $lokasi['id'] ?>"<?php echo old('id_lokasi') == $lokasi['id'] ? 'selected' : '' ?>><?php echo $lokasi['nama_lokasi'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo old('nama_barang') ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kode_barang">Kode Barang</label>
                                    <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?php echo old('kode_barang') ?>">
                                </div>
                                    <div class="form-group mb-3">
                                        <label for="nilai_perolehan">Nilai Perolehan</label>
                                        <input type="number" class="form-control" id="nilai_perolehan" name="nilai_perolehan" value="<?php echo old('nilai_perolehan') ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="penanggung_jawab">Penanggung Jawab</label>
                                        <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab" value="<?php echo old('penanggung_jawab') ?>">
                                    </div>

                                <div class="form-group mb-3">
                                    <label for="merk">Merk</label>
                                    <input type="text" class="form-control" id="merk" name="merk" value="<?php echo old('merk') ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tahun_perolehan">Tahun Perolehan</label>
                                    <input type="number" class="form-control" id="tahun_perolehan" name="tahun_perolehan" value="<?php echo old('tahun_perolehan') ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kondisi">Kondisi</label>
                                    <select class="form-select" name="kondisi" id="kondisi">
                                        <option value="">Pilih Kondisi</option>
                                        <option value="Baik"                                                                                                                                                                                                                                                                                                                                                                         <?php echo old('kondisi') == 'Baik' ? 'selected' : '' ?>>Baik</option>
                                        <option value="Rusak Ringan"                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo old('kondisi') == 'Rusak Ringan' ? 'selected' : '' ?>>Rusak Ringan</option>
                                        <option value="Rusak Berat"                                                                                                                                                                                                                                                                                                                                                                                                                   <?php echo old('kondisi') == 'Rusak Berat' ? 'selected' : '' ?>>Rusak Berat</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="gambar">Gambar Barang</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                                </div>
                                <div id="imgPreview" class="mb-3" style="display:none;">
                                    <label class="form-label">File Gambar Terpilih:</label>
                                    <div class="d-flex align-items-center p-2 border rounded">
                                        <span id="imageFileName" class="text-muted me-auto"></span>
                                        <a id="viewImageBtn" href="#" class="btn btn-sm btn-outline-info" target="_blank"><i
                                                class="bx bx-show"></i> Lihat</a>
                                        <a id="downloadImageBtn" href="#" class="btn btn-sm btn-outline-primary ms-2" download><i
                                                class="bx bx-download"></i> Download</a>
                                        <button type="button" id="deleteImageBtn" class="btn btn-sm btn-outline-danger ms-2"><i
                                                class="bx bx-trash"></i> Hapus</button>
                                    </div>
                                </div>


                                <div class="form-group mb-3">
                                    <label for="dokumen_bast">Dokumen</label>
                                    <input type="file" class="form-control" id="dokumen_bast" name="dokumen_bast" accept=".pdf,.doc,.docx">
                                </div>
                                <div id="docPreview" class="mb-3 mt-3" style="display:none;">
                        <label class="form-label">File Dokumen Terpilih:</label>
                             <div class="d-flex align-items-center p-2 border rounded">
                                 <span id="docFileName" class="text-muted me-auto"></span>
                                 <a id="viewDocBtn" href="#" class="btn btn-sm btn-outline-info" target="_blank"><i
                                         class="bx bx-show"></i> Lihat</a>
                                 <a id="downloadDocBtn" href="#" class="btn btn-sm btn-outline-primary ms-2" download><i
                                         class="bx bx-download"></i> Download</a>
                                 <button type="button" id="deleteDocBtn" class="btn btn-sm btn-outline-danger ms-2"><i
                                         class="bx bx-trash"></i> Hapus</button>
                             </div>
                         </div>


                                <div class="form-group mb-3">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?php echo old('keterangan') ?></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="<?php echo base_url('kelola-barang') ?>" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>


                    <script>
                        (function() {
                            const gambarInput = document.getElementById('gambar');
                            const dokInput = document.getElementById('dokumen_bast');
                            const imgPreviewWrap = document.getElementById('imgPreview');
                            const imageFileName = document.getElementById('imageFileName');
                            const docPreviewWrap = document.getElementById('docPreview');
                            const docFileName = document.getElementById('docFileName');
                            const viewDocBtn = document.getElementById('viewDocBtn');
                            const downloadDocBtn = document.getElementById('downloadDocBtn');
                            const deleteDocBtn = document.getElementById('deleteDocBtn');
                            const viewImageBtn = document.getElementById('viewImageBtn');
                            const downloadImageBtn = document.getElementById('downloadImageBtn');
                            const deleteImageBtn = document.getElementById('deleteImageBtn');

                            let imgObjectUrl = null;
                            let docObjectUrl = null;

                            function revokeUrls() {
                                if (imgObjectUrl) {
                                    URL.revokeObjectURL(imgObjectUrl);
                                    imgObjectUrl = null;
                                }
                                if (docObjectUrl) {
                                    URL.revokeObjectURL(docObjectUrl);
                                    docObjectUrl = null;
                                }
                            }

                            gambarInput.addEventListener('change', function(e) {
                                const file = this.files && this.files[0];
                                if (!file) {
                                    imgPreviewWrap.style.display = 'none';
                                    revokeUrls();
                                    return;
                                }

                                if (imgObjectUrl) {
                                    URL.revokeObjectURL(imgObjectUrl);
                                }
                                imgObjectUrl = URL.createObjectURL(file);
                                imgPreviewWrap.style.display = 'block';
                                imageFileName.textContent = file.name;

                                viewImageBtn.href = imgObjectUrl;
                                downloadImageBtn.href = imgObjectUrl;
                                downloadImageBtn.download = file.name;
                            });

                            deleteImageBtn.addEventListener('click', function() {
                                gambarInput.value = '';
                                imgPreviewWrap.style.display = 'none';
                                imageFileName.textContent = '';
                                URL.revokeObjectURL(imgObjectUrl);
                                imgObjectUrl = null;
                            });

                            dokInput.addEventListener('change', function(e) {
                                const file = this.files && this.files[0];
                                if (!file) {
                                    docPreviewWrap.style.display = 'none';
                                    revokeUrls();
                                    return;
                                }

                                // revoke previous
                                if (docObjectUrl) {
                                    URL.revokeObjectURL(docObjectUrl);
                                }

                                docObjectUrl = URL.createObjectURL(file);
                                docPreviewWrap.style.display = 'block';
                                docFileName.textContent = file.name;
                                viewDocBtn.href = docObjectUrl;
                                downloadDocBtn.href = docObjectUrl;
                                downloadDocBtn.download = file.name;
                            });

                            deleteDocBtn.addEventListener('click', function() {
                                dokInput.value = '';
                                docPreviewWrap.style.display = 'none';
                                docFileName.textContent = '';
                                URL.revokeObjectURL(docObjectUrl);
                                docObjectUrl = null;
                            });

                            // revoke object URLs when the page unloads or the form is submitted
                            window.addEventListener('beforeunload', revokeUrls);
                            const form = document.querySelector('form');
                            if (form) {
                                form.addEventListener('submit', function() {
                                    revokeUrls();
                                });
                            }
                        })();
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo view('templates/partials') ?>
<?php $this->endSection()?>