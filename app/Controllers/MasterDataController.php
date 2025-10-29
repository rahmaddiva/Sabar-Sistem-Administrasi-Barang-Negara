<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use TCPDF;

class MasterDataController extends BaseController
{

    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }

    public function aset_aktif()
    {
        // menampilkan data barang dengan kondisi "baik, rusak ringan" menggunakan datatable server side
        if ($this->request->isAJAX()) {
            $draw   = $this->request->getVar('draw');
            $start  = $this->request->getVar('start');
            $length = $this->request->getVar('length');
            $search = $this->request->getVar('search')['value'];

            $kondisiAktif = ['Baik', 'Rusak Ringan'];

            // total semua data yang aktif
            $totalData = $this->barangModel->whereIn('kondisi', $kondisiAktif)->countAllResults();

            // builder untuk filtering
            $builder = $this->barangModel->whereIn('kondisi', $kondisiAktif);

            if ($search) {
                $builder->groupStart()
                    ->like('nama_barang', $search)
                    ->orLike('kode_barang', $search)
                    ->orLike('merk', $search)
                    ->orLike('penanggung_jawab', $search)
                    ->orLike('tahun_perolehan', $search)
                    ->groupEnd();
            }

            // clone builder sebelum limit/offset supaya count filtered akurat
            $builderFiltered = clone $builder;
            $totalFiltered   = $builderFiltered->countAllResults(false);

            // ambil data sesuai limit & offset
            $barang = $builder->orderBy('id', 'ASC')->findAll($length, $start);

            // simpan data array untuk datatable
            $data = [];
            $no   = $start + 1;
            foreach ($barang as $row) {
                $data[] = [
                    $no++,
                    esc($row['kode_barang']),
                    esc($row['nama_barang']),
                    esc($row['merk']),
                    esc($row['tahun_perolehan']),
                    esc($row['penanggung_jawab']),
                    esc($row['kondisi']),
                ];
            }
            $output = [
                "draw"            => $draw,
                "recordsTotal"    => $totalData,
                "recordsFiltered" => $totalFiltered,
                "data"            => $data,
            ];
            return $this->response->setJSON($output);
        }

        // Jika bukan AJAX, tampilkan view
        return view('master_aset/aktif', ['title' => 'Master Aset Aktif']);
    }

    public function aset_inaktif()
    {
        // menampilkan data barang dengan kondisi "rusak berat" menggunakan datatable server side
        if ($this->request->isAJAX()) {
            $draw   = $this->request->getVar('draw');
            $start  = $this->request->getVar('start');
            $length = $this->request->getVar('length');
            $search = $this->request->getVar('search')['value'];

            $kondisiInaktif = ['Rusak Berat', 'Berhenti Guna'];

            // total semua data yang inaktif
            $totalData = $this->barangModel->whereIn('kondisi', $kondisiInaktif)->countAllResults();

            // builder untuk filtering
            $builder = $this->barangModel->whereIn('kondisi', $kondisiInaktif);

            if ($search) {
                $builder->groupStart()
                    ->like('nama_barang', $search)
                    ->orLike('kode_barang', $search)
                    ->orLike('merk', $search)
                    ->orLike('penanggung_jawab', $search)
                    ->orLike('tahun_perolehan', $search)
                    ->groupEnd();
            }

            // clone builder sebelum limit/offset supaya count filtered akurat
            $builderFiltered = clone $builder;
            $totalFiltered   = $builderFiltered->countAllResults(false);

            // ambil data sesuai limit & offset
            $barang = $builder->orderBy('id', 'ASC')->findAll($length, $start);

            // simpan data array untuk datatable
            $data = [];
            $no   = $start + 1;
            foreach ($barang as $row) {
                $data[] = [
                    $no++,
                    esc($row['kode_barang']),
                    esc($row['nama_barang']),
                    esc($row['merk']),
                    esc($row['tahun_perolehan']),
                    esc($row['penanggung_jawab']),
                    esc($row['kondisi']),
                ];
            }
            $output = [
                "draw"            => $draw,
                "recordsTotal"    => $totalData,
                "recordsFiltered" => $totalFiltered,
                "data"            => $data,
            ];
            return $this->response->setJSON($output);
        }

        // Jika bukan AJAX, tampilkan view
        return view('master_aset/inaktif', ['title' => 'Master Aset Inaktif']);
    }

    public function export_pdf_aktif()
    {
        $data['barang'] = $this->barangModel
            ->select('barang.*, kategori.nama_kategori, lokasi.nama_lokasi')
            ->join('kategori', 'kategori.id = barang.id_kategori')
            ->join('lokasi', 'lokasi.id = barang.id_lokasi')
            ->whereIn('kondisi', ['Baik', 'Rusak Ringan'])
            ->findAll();

        // Buat instance TCPDF
        // 'L' untuk Landscape, 'mm' untuk unit, 'A4' untuk ukuran kertas
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

        // Set informasi dokumen
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('SABAR System');
        $pdf->SetTitle('Laporan Data Barang Aktif');
        $pdf->SetSubject('Data Barang');

        // Hapus header dan footer default
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Set margin
        $pdf->SetMargins(10, 10, 10);

        // Tambah halaman
        $pdf->AddPage();

        // Render view ke dalam variabel HTML
        $html = view('barang/export_pdf', $data);

        // Tulis HTML ke PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Tutup dan kirim PDF ke browser
        // 'I' berarti tampilkan inline di browser
        $this->response->setContentType('application/pdf');
        $pdf->Output('data_barang_aktif' . date('Y-m-d') . '.pdf', 'I');
    }

    public function export_pdf_inaktif()
    {
        $data['barang'] = $this->barangModel
            ->select('barang.*, kategori.nama_kategori, lokasi.nama_lokasi')
            ->join('kategori', 'kategori.id = barang.id_kategori')
            ->join('lokasi', 'lokasi.id = barang.id_lokasi')
            ->whereIn('kondisi', ['Rusak Berat', 'Berhenti Guna'])
            ->findAll();

        // Buat instance TCPDF
        // 'L' untuk Landscape, 'mm' untuk unit, 'A4' untuk ukuran kertas
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

        // Set informasi dokumen
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('SABAR System');
        $pdf->SetTitle('Laporan Data Barang Inaktif');
        $pdf->SetSubject('Data Barang Inaktif');

        // Hapus header dan footer default
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Set margin
        $pdf->SetMargins(10, 10, 10);

        // Tambah halaman
        $pdf->AddPage();

        // Render view ke dalam variabel HTML
        $html = view('barang/export_pdf_inaktif', $data);

        // Tulis HTML ke PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Tutup dan kirim PDF ke browser
        // 'I' berarti tampilkan inline di browser
        $this->response->setContentType('application/pdf');
        $pdf->Output('data_barang_inaktif_' . date('Y-m-d') . '.pdf', 'I');
    }

    public function export_excel_aktif()
    {
        $barang = $this->barangModel
            ->select('barang.*, kategori.nama_kategori, lokasi.nama_lokasi')
            ->join('kategori', 'kategori.id = barang.id_kategori')
            ->join('lokasi', 'lokasi.id = barang.id_lokasi')
            ->whereIn('kondisi', ['Baik', 'Rusak Ringan'])
            ->findAll();

        // Create new Spreadsheet object
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();

        // Set document properties
        $spreadsheet->getProperties()
            ->setCreator('SABAR - Sistem Administrasi Barang')
            ->setLastModifiedBy('SABAR System')
            ->setTitle('Data Barang')
            ->setSubject('Laporan Data Barang')
            ->setDescription('Daftar Barang dari Sistem Administrasi Barang');

        // Add header row
        $sheet->setCellValue('A1', 'DAFTAR INVENTARIS BARANG');
        $sheet->mergeCells('A1:H1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Add date
        $sheet->setCellValue('A2', 'Tanggal: ' . date('d-m-Y'));
        $sheet->mergeCells('A2:H2');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Add headers
        $headers = [
            'No',
            'Kode Barang',
            'Nama Barang',
            'Kondisi',
            'Ruangan',
            'Merk',
            'Tahun',
            'Penanggung Jawab',
        ];

        // Style for headers
        $headerStyle = [
            'font'      => [
                'bold'  => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill'      => [
                'fillType'   => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4B5563'],
            ],
            'borders'   => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];

        // Apply headers
        foreach ($headers as $index => $header) {
            $column = chr(65 + $index); // Convert number to letter (A, B, C, etc.)
            $sheet->setCellValue($column . '4', $header);
        }
        $sheet->getStyle('A4:H4')->applyFromArray($headerStyle);

        // Add data
        $row = 5;
        $no  = 1;
        foreach ($barang as $item) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $item['kode_barang']);
            $sheet->setCellValue('C' . $row, $item['nama_barang']);
            $sheet->setCellValue('D' . $row, $item['kondisi']);
            $sheet->setCellValue('E' . $row, $item['nama_lokasi']);
            $sheet->setCellValue('F' . $row, $item['merk']);
            $sheet->setCellValue('G' . $row, $item['tahun_perolehan']);
            $sheet->setCellValue('H' . $row, $item['penanggung_jawab']);

            $row++;
        }

        // Style for data
        $dataStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet->getStyle('A4:H' . ($row - 1))->applyFromArray($dataStyle);

        // Auto size columns
        foreach (range('A', 'H') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Create writer
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data_barang_' . date('Y-m-d') . '.xlsx"');
        header('Cache-Control: max-age=0');

        // Save to PHP output
        $writer->save('php://output');
        exit;
    }

    public function export_excel_inaktif()
    {
        $barang = $this->barangModel
            ->select('barang.*, kategori.nama_kategori, lokasi.nama_lokasi')
            ->join('kategori', 'kategori.id = barang.id_kategori')
            ->join('lokasi', 'lokasi.id = barang.id_lokasi')
            ->whereIn('kondisi', ['Rusak Berat', 'Berhenti Guna'])
            ->findAll();

        // Create new Spreadsheet object
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();

        // Set document properties
        $spreadsheet->getProperties()
            ->setCreator('SABAR - Sistem Administrasi Barang')
            ->setLastModifiedBy('SABAR System')
            ->setTitle('Data Barang')
            ->setSubject('Laporan Data Barang')
            ->setDescription('Daftar Barang dari Sistem Administrasi Barang');

        // Add header row
        $sheet->setCellValue('A1', 'DAFTAR INVENTARIS BARANG');
        $sheet->mergeCells('A1:H1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Add date
        $sheet->setCellValue('A2', 'Tanggal: ' . date('d-m-Y'));
        $sheet->mergeCells('A2:H2');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Add headers
        $headers = [
            'No',
            'Kode Barang',
            'Nama Barang',
            'Kondisi',
            'Ruangan',
            'Merk',
            'Tahun',
            'Penanggung Jawab',
        ];

        // Style for headers
        $headerStyle = [
            'font'      => [
                'bold'  => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill'      => [
                'fillType'   => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4B5563'],
            ],
            'borders'   => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];

        // Apply headers
        foreach ($headers as $index => $header) {
            $column = chr(65 + $index); // Convert number to letter (A, B, C, etc.)
            $sheet->setCellValue($column . '4', $header);
        }
        $sheet->getStyle('A4:H4')->applyFromArray($headerStyle);

        // Add data
        $row = 5;
        $no  = 1;
        foreach ($barang as $item) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $item['kode_barang']);
            $sheet->setCellValue('C' . $row, $item['nama_barang']);
            $sheet->setCellValue('D' . $row, $item['kondisi']);
            $sheet->setCellValue('E' . $row, $item['nama_lokasi']);
            $sheet->setCellValue('F' . $row, $item['merk']);
            $sheet->setCellValue('G' . $row, $item['tahun_perolehan']);
            $sheet->setCellValue('H' . $row, $item['penanggung_jawab']);

            $row++;
        }

        // Style for data
        $dataStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet->getStyle('A4:H' . ($row - 1))->applyFromArray($dataStyle);

        // Auto size columns
        foreach (range('A', 'H') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Create writer
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data_barang_' . date('Y-m-d') . '.xlsx"');
        header('Cache-Control: max-age=0');

        // Save to PHP output
        $writer->save('php://output');
        exit;
    }

}
