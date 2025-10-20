<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Data Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            padding: 0;
        }

        .header p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            font-size: 10pt;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>LAPORAN DATA BARANG</h2>
        <p>Tanggal: <?= date('d-m-Y') ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Merk</th>
                <th>Nilai Perolehan</th>
                <th>Penanggung Jawab</th>
                <th>Tahun</th>
                <th>Kondisi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($barang as $row): ?>
                <tr>
                    <td style="text-align: center;"><?= $no++ ?></td>
                    <td><?= esc($row['kode_barang']) ?></td>
                    <td><?= esc($row['nama_barang']) ?></td>
                    <td><?= esc($row['nama_kategori']) ?></td>
                    <td><?= esc($row['nama_lokasi']) ?></td>
                    <td><?= esc($row['merk']) ?></td>
                    <td style="text-align: right;">Rp <?= number_format($row['nilai_perolehan'], 0, ',', '.') ?></td>
                    <td><?= esc($row['penanggung_jawab']) ?></td>
                    <td style="text-align: center;"><?= esc($row['tahun_perolehan']) ?></td>
                    <td style="text-align: center;"><?= esc($row['kondisi']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: <?= date('d-m-Y H:i:s') ?></p>
    </div>
</body>

</html>