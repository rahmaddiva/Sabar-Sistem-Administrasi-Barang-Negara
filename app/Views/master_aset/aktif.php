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
            <div class="card mt-5">
                <div class="card-body col-lg-12">
                    <div class="d-flex justify-content-between align-items-center mb-4">
    <!-- Tombol Export -->
    <div class="btn-group">
        <a href="/export-pdf-aktif" class="btn btn-outline-danger" target="_blank">
            <i class="bx bxs-file-pdf"></i> Export PDF
        </a>
        <a href="/export-excel-aktif" class="btn btn-outline-success">
            <i class="bx bx-file-excel"></i> Export Excel
        </a>
    </div>

    <!-- Form Import -->
    <form action="<?php echo base_url('barang/import_excel') ?>" method="post" enctype="multipart/form-data" class="d-flex align-items-center gap-2">
        <div class="form-group mb-0">
            <input type="file" name="file_excel" accept=".xls,.xlsx" class="form-control form-control-sm" required>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="bx bx-upload"></i> Import Excel
        </button>
    </form>
</div>


                    <!-- table serverside -->
                    <div class="table-responsive mt-3">
                        <table id="table-aset" class="datatable-basic table border-top">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>NUP</th>
                                    <th>Nama Barang</th>
                                    <th>Merk</th>
                                    <th>Tahun Perolehan</th>
                                    <th>Nilai Perolehan</th>
                                    <th>Penanggung Jawab</th>
                                    <th>Kondisi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('#table-aset').DataTable({
                                processing: true,
                                serverSide: true,
                                ajax: '/aset-aktif',
                                language: {
                                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/id.json'
                                }
                            });
                        });
                    </script>

                </div>
            </div>

        </div>
    </div>
</div>
</div>
<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus berita <strong id="newsTitle"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="post" action="">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var newsId = button.getAttribute('data-id');
        var newsTitle = button.getAttribute('data-title');

        var modalTitle = deleteModal.querySelector('.modal-body #newsTitle');
        modalTitle.textContent = newsTitle;

        var deleteForm = document.getElementById('deleteForm');
        deleteForm.action = '/delete-barang/' + newsId;
    });
</script>

<?php echo view('templates/partials') ?>
<?php $this->endSection()?>