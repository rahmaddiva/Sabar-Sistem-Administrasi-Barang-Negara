<?php echo $this->extend('templates/main')?>
<?php echo $this->section('content')?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- rowcrumb -->
            <div class="page-breadcrumb d-flex align-items-center mt-3">
                <h4 class="page-title me-3"><?php echo esc($title ?? 'Kelola Kategori')?></h4>
                <div class="ms-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo esc($title ?? 'Kelola Kategori')?></li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-body">
                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                        data-bs-target="#basicModal">
                        Tambah Data Kategori
                    </button>
                    <br>
                    <div class="table-responsive mt-3">
                        <table id="datatables-basic" class="datatables-basic table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($kategori as $item): ?>
                                    <tr>
                                        <td><?php echo $no++;?></td>
                                        <td><?php echo esc($item['nama_kategori']);?></td>
                                        <td>
                                            <!-- btn group -->
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <!-- edit modal -->
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editModal<?php echo esc($item['id']);?>">
                                                    Edit
                                                </button>
                                                <a href="<?php echo base_url('delete-kategori/' . $item['id']);?>"
                                                    class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">Hapus</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal tambah -->
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo base_url('proses-kategori')?>" method="POST">
                <?php echo csrf_field()?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal edit -->
<?php foreach ($kategori as $item): ?>
    <div class="modal fade" id="editModal<?php echo esc($item['id']);?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo base_url('update-kategori/' . $item['id'])?>" method="POST">
                    <?php echo csrf_field()?>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_kategori_edit" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama_kategori_edit" name="nama_kategori"
                                value="<?php echo esc($item['nama_kategori']);?>" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php echo view('templates/partials')?>
<?php echo $this->endSection()?>