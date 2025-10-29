<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Data Barang</title>
 <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 9pt;
    }

    table.tabel,
    table.tabel td,
    table.tabel th {
        border: 1px solid black;
    }

    table.tabel {
        border-collapse: collapse;
        width: 100%;
    }

    .header-table {
        width: 100%;
        border-bottom: 2px solid black;
        padding-bottom: 5px;
    }

    .header-text {
        text-align: center;
    }

    .header-main-text {
        font-weight: bold;
        font-size: 14pt;
    }

    .header-sub-text {
        font-size: 9pt;
    }

    .signature-block {
        width: 100%;
        text-align: right;
    }

    .signature {
        display: inline-block;

        width: 300px; /* Adjust width as needed */
    }
</style>
</head>

<body>
    <table class="header-table">
        <tr>
            <td style="width: 15%; text-align: left;"><img src="<?php echo FCPATH . 'assets/img/favicon/logo_kalsel.png' ?>" alt="Logo Pemerintah Kalimantan Selatan" width="80"></td>
            <td style="width: 70%;" class="header-text">
                <div class="header-main-text">LAPORAN INVENTARIS BARANG MILIK NEGARA</div>
                <div class="header-main-text">BADAN PENGAWAS PEMILIHAN UMUM</div>
                <div class="header-sub-text">Jl.R.E Martadinata No.3 Banjarmasin 7000, Telp. (0511) 3360-222 Fax. (0511) 3362766, E-mail : Sekretariat@bawaslukalselprov.info. www.bawaslukalselprov.info/go.id</div>
            </td>
            <td style="width: 15%; text-align: right;"><img src="<?php echo FCPATH . 'assets/img/favicon/Logo-Bawaslu-2.png' ?>" alt="Logo Bawaslu" width="80"></td>
        </tr>
    </table>
    <h3 style="text-align: center; font-weight: bold;">DAFTAR INVENTARIS BARANG</h3>
    <table class="tabel">
        <!-- thead ada warna abu abu -->
        <thead>
            <tr style="background-color: lightgray;">
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kondisi</th>
                <th>Ruangan</th>
                <th>Merk</th>
                <th>Tahun</th>
                <th>Penanggung Jawab</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($barang as $row): ?>
                <tr>
                    <td style="text-align: center;"><?php echo $no++; ?></td>
                    <td><?php echo esc($row['kode_barang']); ?></td>
                    <td><?php echo esc($row['nama_barang']); ?></td>
                    <td style="text-align: center;"><?php echo esc($row['kondisi']); ?></td>
                    <td><?php echo esc($row['nama_lokasi']); ?></td>
                    <td><?php echo esc($row['merk']); ?></td>
                    <td style="text-align: center;"><?php echo esc($row['tahun_perolehan']); ?></td>
                    <td><?php echo esc($row['penanggung_jawab']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br><br>
     <table style="text-align: center;">
        <tbody>
            <tr>
                <td></td>
                <td>
                    <table>
                        <tr>
                            <td>Kepala Sekretariat</td>
                        </tr>
                        <tr>
                            <td>
                                <br><br><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font>-------------------</font><br>
                                <font>Pembina Utama Muda (IV/c)</font><br>
                                <font>NIP. </font>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>