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
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <a href="/tambah-barang" class="btn btn-outline-secondary">Tambah Barang</a>
                        </div>
                        <div class="btn-group">
                            <a href="/export-pdf" class="btn btn-outline-danger" target="_blank">
                                <i class="bx bxs-file-pdf"></i> Export PDF
                            </a>
                            <a href="/export-excel" class="btn btn-outline-success">
                                <i class="bx bx-file-excel"></i> Export Excel
                            </a>
                        </div>
                    </div>
                    <!-- table serverside -->
                    <div class="table-responsive mt-3">
                        <table id="table-barang" class="datatable-basic table border-top">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Merk</th>
                                    <th>Tahun Perolehan</th>
                                    <th>Penanggung Jawab</th>
                                    <th>Kondisi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('#table-barang').DataTable({
                                processing: true,
                                serverSide: true,
                                ajax: '/kelola-barang',
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

<?= view('templates/partials') ?>
<?php $this->endSection() ?>