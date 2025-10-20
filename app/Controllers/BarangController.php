<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BarangModel;

class BarangController extends BaseController
{

    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }

    public function index()
    {
        // menampilkan data barang menggunakan datatable server side
        if ($this->request->isAJAX()) {
            $draw = $this->request->getVar('draw');
            $start = $this->request->getVar('start');
            $length = $this->request->getVar('length');
            $search = $this->request->getVar('search')['value'];


            // total semua data 
            $totalData = $this->barangModel->countAll();

            // builder untuk filtering
            $builder = $this->barangModel;

            if ($search) {
                $builder->groupStart()
                    ->like('nama_barang', $search)
                    ->orLike('kode_barang', $search)
                    ->orLike('merk', $search)
                    ->orLike('penanggung_jawab', $search)
                    ->orLike('tahun_perolehan', $search)
                    ->orLike('kondisi', $search)
                    ->groupEnd();
            }

            // clone builder sebelum limit/offset supaya count filtere akurat
            $builderFiltered = clone $builder;

            $totalFiltered = $builderFiltered->countAllResults(false);

            // ambil data sesuai limit & offset
            $barang = $builder->orderBy('id', 'ASC')->findAll($length, $start);

            // simpan data array untuk datatable

            $data = [];
            $no = $start + 1;
            foreach ($barang as $row) {
                // button edit news
                $editbtn = '<a href="' . base_url('edit-barang/' . $row['id']) . '" class="btn btn-outline-primary "><i class="bx bx-edit"></i></a>';
                // button hapus/delete
                $deleteBtn = '<button class="btn btn-outline-danger"
                data-bs-toggle="modal" 
                data-bs-target="#deleteModal" 
                data-id="' . $row['id'] . '" 
                data-title="' . esc($row['merk']) . '"><i class="bx bx-trash"></i></button>';
                // button detail news
                $detailBtn = '<a href="' . base_url('detail-barang/' . $row['id']) . '" class="btn btn-outline-secondary"><i class="bx bx-show"></i></a>';

                $data[] = [
                    $no++,
                    esc($row['kode_barang']),
                    esc($row['nama_barang']),
                    esc($row['merk']),
                    esc($row['tahun_perolehan']),
                    esc($row['penanggung_jawab']),
                    '<span class="badge bg-info">' . esc($row['kondisi']) . '</span>',
                    $editbtn . ' ' . $deleteBtn . ' ' . $detailBtn
                ];
            }
            $output = [
                "draw" => $draw,
                "recordsTotal" => $totalData,
                "recordsFiltered" => $totalFiltered,
                "data" => $data,
            ];
            return $this->response->setJSON($output);
        }

        $data = [
            'title' => 'Kelola Data Barang'
        ];
        return view('barang/index', $data);
    }

    public function tambah()
    {
        $kategoriModel = new \App\Models\KategoriModel();
        $lokasiModel = new \App\Models\LokasiModel();

        $data = [
            'title' => 'Tambah Barang',
            'kategoris' => $kategoriModel->findAll(),
            'lokasis' => $lokasiModel->findAll()
        ];

        return view('barang/tambah', $data);
    }

    public function proses_barang()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori wajib dipilih'
                ]
            ],
            'id_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Lokasi wajib dipilih'
                ]
            ],
            'nama_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Barang wajib diisi'
                ]
            ],
            'kode_barang' => [
                'rules' => 'required|is_unique[barang.kode_barang]',
                'errors' => [
                    'required' => 'Kode Barang wajib diisi',
                    'is_unique' => 'Kode Barang sudah digunakan'
                ]
            ],
            'merk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Merk wajib diisi'
                ]
            ],
            'tahun_perolehan' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Tahun Perolehan wajib diisi',
                    'numeric' => 'Tahun Perolehan harus berupa angka'
                ]
            ],
            'kondisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kondisi wajib diisi'
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,5120]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar (max 5MB)',
                    'is_image' => 'File yang dipilih bukan gambar',
                    'mime_in' => 'Format gambar tidak didukung'
                ]
            ],
            'dokumen_bast' => [
                'rules' => 'max_size[dokumen_bast,10240]|mime_in[dokumen_bast,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]',
                'errors' => [
                    'max_size' => 'Ukuran dokumen terlalu besar (max 10MB)',
                    'mime_in' => 'Format dokumen tidak didukung (PDF/DOC/DOCX)'
                ]
            ]
        ]);

        // jika validasi gagal maka muncul pesan error
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // proses upload gambar jika ada
        $gambar = $this->request->getFile('gambar');
        $namaGambar = '';
        if ($gambar->isValid() && !$gambar->hasMoved()) {
            $namaGambar = $gambar->getRandomName();
            $gambar->move('uploads/barang/images', $namaGambar);
        }

        // proses upload dokumen bast jika ada
        $dokumen = $this->request->getFile('dokumen_bast');
        $namaDokumen = '';
        if ($dokumen->isValid() && !$dokumen->hasMoved()) {
            $namaDokumen = $dokumen->getRandomName();
            $dokumen->move('uploads/barang/documents', $namaDokumen);
        }

        // siapkan data untuk disimpan
        $data = [
            'id_kategori' => $this->request->getPost('id_kategori'),
            'id_lokasi' => $this->request->getPost('id_lokasi'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'kode_barang' => $this->request->getPost('kode_barang'),
            'merk' => $this->request->getPost('merk'),
            'nilai_perolehan' => $this->request->getPost('nilai_perolehan'),
            'penanggung_jawab' => $this->request->getPost('penanggung_jawab'),
            'tahun_perolehan' => $this->request->getPost('tahun_perolehan'),
            'kondisi' => $this->request->getPost('kondisi'),
            'gambar' => $namaGambar,
            'dokumen_bast' => $namaDokumen,
            'keterangan' => $this->request->getPost('keterangan')
        ];

        // generate QR code with image URL
        $imageUrl = '';
        if ($namaGambar) {
            $imageUrl = base_url('uploads/barang/images/' . $namaGambar);
        }

        $qrData = json_encode([
            'kode_barang' => $data['kode_barang'],
            'nama_barang' => $data['nama_barang'],
            'merk' => $data['merk'],
            'tahun_perolehan' => $data['tahun_perolehan'],
            'kondisi' => $data['kondisi'],
            'penanggung_jawab' => $data['penanggung_jawab'],
            'gambar_url' => $imageUrl,
            'detail_url' => base_url('detail-barang/' . $data['kode_barang'])
        ]);

        // QR code options
        $options = new \chillerlan\QRCode\QROptions([
            'outputType' => \chillerlan\QRCode\QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel' => \chillerlan\QRCode\QRCode::ECC_L,
            'scale' => 5,
            'imageBase64' => false,
        ]);

        // Create QR code instance with options
        $qrCode = new \chillerlan\QRCode\QRCode($options);
        $qrFileName = 'qr_' . $data['kode_barang'] . '.png';

        // Save QR code directly as PNG file
        $qrCode->render($qrData, 'uploads/barang/qrcodes/' . $qrFileName);

        // tambahkan nama file QR code ke data
        $data['qr_code'] = $qrFileName;

        // simpan ke database
        try {
            $this->barangModel->insert($data);
            return redirect()->to('kelola-barang')->with('success', 'Data barang berhasil ditambahkan');
        } catch (\Exception $e) {
            // hapus file yang sudah diupload jika gagal
            if ($namaGambar && file_exists('uploads/barang/images/' . $namaGambar)) {
                unlink('uploads/barang/images/' . $namaGambar);
            }
            if ($namaDokumen && file_exists('uploads/barang/documents/' . $namaDokumen)) {
                unlink('uploads/barang/documents/' . $namaDokumen);
            }
            if (file_exists('uploads/barang/qrcodes/' . $qrFileName)) {
                unlink('uploads/barang/qrcodes/' . $qrFileName);
            }
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function detail($id)
    {
        $kategoriModel = new \App\Models\KategoriModel();
        $lokasiModel = new \App\Models\LokasiModel();

        $barang = $this->barangModel->find($id);
        if (!$barang) {
            return redirect()->to('kelola-barang')->with('error', 'Data barang tidak ditemukan');
        }

        // get kategori dan lokasi
        $kategori = $kategoriModel->find($barang['id_kategori']);
        $lokasi = $lokasiModel->find($barang['id_lokasi']);

        $data = [
            'title' => 'Detail Barang',
            'barang' => $barang,
            'kategori' => $kategori,
            'lokasi' => $lokasi
        ];

        return view('barang/detail', $data);
    }

    public function edit($id)
    {
        $kategoriModel = new \App\Models\KategoriModel();
        $lokasiModel = new \App\Models\LokasiModel();

        $barang = $this->barangModel->find($id);
        if (!$barang) {
            return redirect()->to('kelola-barang')->with('error', 'Data barang tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Barang',
            'barang' => $barang,
            'kategoris' => $kategoriModel->findAll(),
            'lokasis' => $lokasiModel->findAll()
        ];

        return view('barang/edit', $data);
    }

    public function update($id)
    {
        $barang = $this->barangModel->find($id);
        if (!$barang) {
            return redirect()->to('kelola-barang')->with('error', 'Data barang tidak ditemukan');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori wajib dipilih'
                ]
            ],
            'id_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Lokasi wajib dipilih'
                ]
            ],
            'nama_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Barang wajib diisi'
                ]
            ],
            'kode_barang' => [
                'rules' => 'required|is_unique[barang.kode_barang,id,' . $id . ']',
                'errors' => [
                    'required' => 'Kode Barang wajib diisi',
                    'is_unique' => 'Kode Barang sudah digunakan'
                ]
            ],
            'merk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Merk wajib diisi'
                ]
            ],
            'tahun_perolehan' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Tahun Perolehan wajib diisi',
                    'numeric' => 'Tahun Perolehan harus berupa angka'
                ]
            ],
            'kondisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kondisi wajib diisi'
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,5120]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar (max 5MB)',
                    'is_image' => 'File yang dipilih bukan gambar',
                    'mime_in' => 'Format gambar tidak didukung'
                ]
            ],
            'dokumen_bast' => [
                'rules' => 'max_size[dokumen_bast,10240]|mime_in[dokumen_bast,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]',
                'errors' => [
                    'max_size' => 'Ukuran dokumen terlalu besar (max 10MB)',
                    'mime_in' => 'Format dokumen tidak didukung (PDF/DOC/DOCX)'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // proses upload gambar jika ada
        $gambar = $this->request->getFile('gambar');
        $namaGambar = $barang['gambar']; // keep existing image if no new upload
        if ($gambar->isValid() && !$gambar->hasMoved()) {
            // delete old image if exists
            if ($barang['gambar'] && file_exists('uploads/barang/images/' . $barang['gambar'])) {
                unlink('uploads/barang/images/' . $barang['gambar']);
            }
            $namaGambar = $gambar->getRandomName();
            $gambar->move('uploads/barang/images', $namaGambar);
        }

        // proses upload dokumen bast jika ada
        $dokumen = $this->request->getFile('dokumen_bast');
        $namaDokumen = $barang['dokumen_bast']; // keep existing document if no new upload
        if ($dokumen->isValid() && !$dokumen->hasMoved()) {
            // delete old document if exists
            if ($barang['dokumen_bast'] && file_exists('uploads/barang/documents/' . $barang['dokumen_bast'])) {
                unlink('uploads/barang/documents/' . $barang['dokumen_bast']);
            }
            $namaDokumen = $dokumen->getRandomName();
            $dokumen->move('uploads/barang/documents', $namaDokumen);
        }

        // siapkan data untuk disimpan
        $data = [
            'id_kategori' => $this->request->getPost('id_kategori'),
            'id_lokasi' => $this->request->getPost('id_lokasi'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'kode_barang' => $this->request->getPost('kode_barang'),
            'merk' => $this->request->getPost('merk'),
            'nilai_perolehan' => $this->request->getPost('nilai_perolehan'),
            'penanggung_jawab' => $this->request->getPost('penanggung_jawab'),
            'tahun_perolehan' => $this->request->getPost('tahun_perolehan'),
            'kondisi' => $this->request->getPost('kondisi'),
            'gambar' => $namaGambar,
            'dokumen_bast' => $namaDokumen,
            'keterangan' => $this->request->getPost('keterangan')
        ];

        // generate QR code only if essential data changed
        if (
            $barang['kode_barang'] !== $data['kode_barang'] ||
            $barang['nama_barang'] !== $data['nama_barang'] ||
            $barang['merk'] !== $data['merk'] ||
            $barang['tahun_perolehan'] !== $data['tahun_perolehan'] ||
            $barang['kondisi'] !== $data['kondisi'] ||
            $barang['penanggung_jawab'] !== $data['penanggung_jawab'] ||
            $barang['gambar'] !== $data['gambar'] // regenerate if image changes
        ) {

            // delete old QR code if exists
            if ($barang['qr_code'] && file_exists('uploads/barang/qrcodes/' . $barang['qr_code'])) {
                unlink('uploads/barang/qrcodes/' . $barang['qr_code']);
            }

            // generate QR code with image URL
            $imageUrl = '';
            if ($data['gambar']) {
                $imageUrl = base_url('uploads/barang/images/' . $data['gambar']);
            }

            $qrData = json_encode([
                'kode_barang' => $data['kode_barang'],
                'nama_barang' => $data['nama_barang'],
                'merk' => $data['merk'],
                'tahun_perolehan' => $data['tahun_perolehan'],
                'kondisi' => $data['kondisi'],
                'penanggung_jawab' => $data['penanggung_jawab'],
                'gambar_url' => $imageUrl,
                'detail_url' => base_url('detail-barang/' . $data['kode_barang'])
            ]);

            // QR code options
            $options = new \chillerlan\QRCode\QROptions([
                'outputType' => \chillerlan\QRCode\QRCode::OUTPUT_IMAGE_PNG,
                'eccLevel' => \chillerlan\QRCode\QRCode::ECC_L,
                'scale' => 5,
                'imageBase64' => false,
            ]);

            // Create QR code instance with options
            $qrCode = new \chillerlan\QRCode\QRCode($options);
            $qrFileName = 'qr_' . $data['kode_barang'] . '.png';

            // Save QR code directly as PNG file
            $qrCode->render($qrData, 'uploads/barang/qrcodes/' . $qrFileName);
            $data['qr_code'] = $qrFileName;
        }

        // simpan ke database
        try {
            $this->barangModel->update($id, $data);
            return redirect()->to('kelola-barang')->with('success', 'Data barang berhasil diperbarui');
        } catch (\Exception $e) {
            // if update fails and we uploaded new files, delete them
            if ($gambar->isValid() && file_exists('uploads/barang/images/' . $namaGambar)) {
                unlink('uploads/barang/images/' . $namaGambar);
            }
            if ($dokumen->isValid() && file_exists('uploads/barang/documents/' . $namaDokumen)) {
                unlink('uploads/barang/documents/' . $namaDokumen);
            }
            if (isset($qrFileName) && file_exists('uploads/barang/qrcodes/' . $qrFileName)) {
                unlink('uploads/barang/qrcodes/' . $qrFileName);
            }
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui data');
        }
    }

    public function export_pdf()
    {
        $data['barang'] = $this->barangModel
            ->select('barang.*, kategori.nama_kategori, lokasi.nama_lokasi')
            ->join('kategori', 'kategori.id = barang.id_kategori')
            ->join('lokasi', 'lokasi.id = barang.id_lokasi')
            ->findAll();

        // Load DOMPDF
        $dompdf = new \Dompdf\Dompdf(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        // Load view into PDF
        $html = view('barang/export_pdf', $data);
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF
        $dompdf->render();

        // Stream PDF to browser
        $dompdf->stream('data_barang_' . date('Y-m-d') . '.pdf', ['Attachment' => false]);
    }

    public function export_excel()
    {
        $barang = $this->barangModel
            ->select('barang.*, kategori.nama_kategori, lokasi.nama_lokasi')
            ->join('kategori', 'kategori.id = barang.id_kategori')
            ->join('lokasi', 'lokasi.id = barang.id_lokasi')
            ->findAll();

        // Create new Spreadsheet object
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set document properties
        $spreadsheet->getProperties()
            ->setCreator('SABAR - Sistem Administrasi Barang')
            ->setLastModifiedBy('SABAR System')
            ->setTitle('Data Barang')
            ->setSubject('Laporan Data Barang')
            ->setDescription('Daftar Barang dari Sistem Administrasi Barang');

        // Add header row
        $sheet->setCellValue('A1', 'LAPORAN DATA BARANG');
        $sheet->mergeCells('A1:J1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Add date
        $sheet->setCellValue('A2', 'Tanggal: ' . date('d-m-Y'));
        $sheet->mergeCells('A2:J2');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Add headers
        $headers = [
            'No',
            'Kode Barang',
            'Nama Barang',
            'Kategori',
            'Lokasi',
            'Merk',
            'Nilai Perolehan',
            'Penanggung Jawab',
            'Tahun',
            'Kondisi'
        ];

        // Style for headers
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4B5563'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];

        // Apply headers
        foreach ($headers as $index => $header) {
            $column = chr(65 + $index); // Convert number to letter (A, B, C, etc.)
            $sheet->setCellValue($column . '4', $header);
        }
        $sheet->getStyle('A4:J4')->applyFromArray($headerStyle);

        // Add data
        $row = 5;
        $no = 1;
        foreach ($barang as $item) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $item['kode_barang']);
            $sheet->setCellValue('C' . $row, $item['nama_barang']);
            $sheet->setCellValue('D' . $row, $item['nama_kategori']);
            $sheet->setCellValue('E' . $row, $item['nama_lokasi']);
            $sheet->setCellValue('F' . $row, $item['merk']);
            $sheet->setCellValue('G' . $row, $item['nilai_perolehan']);
            $sheet->setCellValue('H' . $row, $item['penanggung_jawab']);
            $sheet->setCellValue('I' . $row, $item['tahun_perolehan']);
            $sheet->setCellValue('J' . $row, $item['kondisi']);

            // Format number for nilai_perolehan
            $sheet->getStyle('G' . $row)->getNumberFormat()
                ->setFormatCode('#,##0');

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
        $sheet->getStyle('A4:J' . ($row - 1))->applyFromArray($dataStyle);

        // Auto size columns
        foreach (range('A', 'J') as $column) {
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

    public function delete($id)
    {
        // hapus data barang
        $barang = $this->barangModel->find($id);
        if (!$barang) {
            return redirect()->to('kelola-barang')->with('error', 'Data barang tidak ditemukan');
        }

        // hapus file terkait
        if ($barang['gambar'] && file_exists('uploads/barang/images/' . $barang['gambar'])) {
            unlink('uploads/barang/images/' . $barang['gambar']);
        }
        if ($barang['dokumen_bast'] && file_exists('uploads/barang/documents/' . $barang['dokumen_bast'])) {
            unlink('uploads/barang/documents/' . $barang['dokumen_bast']);
        }
        if ($barang['qr_code'] && file_exists('uploads/barang/qrcodes/' . $barang['qr_code'])) {
            unlink('uploads/barang/qrcodes/' . $barang['qr_code']);
        }

        $this->barangModel->delete($id);
        return redirect()->to('kelola-barang')->with('success', 'Data barang berhasil dihapus');
    }
}
