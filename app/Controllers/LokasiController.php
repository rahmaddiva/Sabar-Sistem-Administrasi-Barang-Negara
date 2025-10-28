<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LokasiModel;

class LokasiController extends BaseController
{
    protected $lokasiModel;

    public function __construct()
    {
        $this->lokasiModel = new LokasiModel();
    }

    public function index()
    {
        $data = [
            'title'  => 'Kelola Lokasi',
            'lokasi' => $this->lokasiModel->findAll(),
        ];
        return view('lokasi/index', $data);
    }

    public function proses_lokasi()
    {
        // validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_lokasi' => [
                'label'  => 'Nama Lokasi',
                'rules'  => 'required|is_unique[lokasi.nama_lokasi]',
                'errors' => [
                    'required'  => '{field} wajib diisi.',
                    'is_unique' => '{field} sudah ada.',
                ],
            ],
        ]);
        if (! $validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        // simpan data lokasi
        $nama_lokasi = $this->request->getPost('nama_lokasi');
        $this->lokasiModel->insert([
            'nama_lokasi' => $nama_lokasi,
        ]);
        return redirect()->to('/kelola-lokasi')->with('success', 'Lokasi berhasil ditambahkan.');
    }

    public function update_lokasi($id)
    {
        // validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_lokasi' => [
                'label'  => 'Nama Lokasi',
                'rules'  => 'required|is_unique[lokasi.nama_lokasi,id,' . $id . ']',
                'errors' => [
                    'required'  => '{field} wajib diisi.',
                    'is_unique' => '{field} sudah ada.',
                ],
            ],

        ]);
        if (! $validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        // update data lokasi
        $nama_lokasi = $this->request->getPost('nama_lokasi');
        $this->lokasiModel->update($id, [
            'nama_lokasi' => $nama_lokasi,
        ]);
        return redirect()->to('/kelola-lokasi')->with('success', 'Lokasi berhasil diperbarui.');
    }

    public function delete_lokasi($id)
    {
        $lokasi = $this->lokasiModel->find($id);
        if (! $lokasi) {
            return redirect()->to('/kelola-lokasi')->with('error', 'Lokasi tidak ditemukan.');
        }
        $this->lokasiModel->delete($id);
        return redirect()->to('/kelola-lokasi')->with('success', 'Lokasi berhasil dihapus.');
    }

}
