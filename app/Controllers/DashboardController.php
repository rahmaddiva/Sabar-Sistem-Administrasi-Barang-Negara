<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\LokasiModel;

class DashboardController extends BaseController
{
    protected $barangModel;
    protected $kategoriModel;
    protected $lokasiModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->kategoriModel = new KategoriModel();
        $this->lokasiModel = new LokasiModel();
    }

    public function index()
    {
        // Get total counts
        $data['total_barang'] = $this->barangModel->countAll();
        $data['total_kategori'] = $this->kategoriModel->countAll();
        $data['total_lokasi'] = $this->lokasiModel->countAll();

        // Get latest items
        $data['barang_terbaru'] = $this->barangModel
            ->select('barang.*, kategori.nama_kategori, lokasi.nama_lokasi')
            ->join('kategori', 'kategori.id = barang.id_kategori')
            ->join('lokasi', 'lokasi.id = barang.id_lokasi')
            ->orderBy('barang.id', 'DESC')
            ->limit(5)
            ->find();

        // Get items per location statistics
        $data['barang_per_lokasi'] = $this->barangModel
            ->select('lokasi.nama_lokasi, COUNT(*) as total')
            ->join('lokasi', 'lokasi.id = barang.id_lokasi')
            ->groupBy('lokasi.id, lokasi.nama_lokasi')
            ->findAll();

        return view('dashboard/index', $data);
    }
}
