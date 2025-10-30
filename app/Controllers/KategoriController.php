<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class KategoriController extends BaseController
{
    protected $kategoriModel;
    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        $data['kategori'] = $this->kategoriModel->findAll();
        return view('kategori/index', $data);
    }

    public function proses_kategori()
    {
        // validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_kategori' => [
                'label'  => 'Nama Kategori',
                'rules'  => 'required',
                'errors' => [
                    'required'  => '{field} wajib diisi.',

                ],
            ],

        ]);
        if (! $validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $nama_kategori = $this->request->getPost('nama_kategori');
        $this->kategoriModel->insert([
            'nama_kategori' => $nama_kategori,
        ]);
        return redirect()->to('/kelola-kategori')->with('success', 'Kategori berhasil ditambahkan.');

    }

    public function update_kategori($id)
    {
        // validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_kategori' => [
                'label'  => 'Nama Kategori',
                'rules'  => 'required|is_unique[kategori.nama_kategori,id,' . $id . ']',
                'errors' => [
                    'required'  => '{field} wajib diisi.',
                    'is_unique' => '{field} sudah ada.',
                ],
            ],
        ]);
        if (! $validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $nama_kategori = $this->request->getPost('nama_kategori');
        $this->kategoriModel->update($id, [
            'nama_kategori' => $nama_kategori,
        ]);
        return redirect()->to('/kelola-kategori')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function delete_kategori($id)
    {
        $kategori = $this->kategoriModel->find($id);
        if (! $kategori) {
            return redirect()->to('/kelola-kategori')->with('error', 'Kategori tidak ditemukan.');
        }
        $this->kategoriModel->delete($id);
        return redirect()->to('/kelola-kategori')->with('success', 'Kategori berhasil dihapus.');
    }
}
