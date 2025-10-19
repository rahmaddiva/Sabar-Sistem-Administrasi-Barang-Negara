<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;

class UsersController extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UsersModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola User',
            'users' => $this->userModel->findAll(),
        ];
        return view('user/index', $data);
    }

    public function proses_user()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => [
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => 'Username wajib diisi',
                    'is_unique' => 'Username sudah digunakan'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password wajib diisi',
                    'min_length' => 'Password minimal 6 karakter'
                ]
            ],
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap wajib diisi'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // ambil data dari form
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'role' => 'admin' // default role
        ];
        $this->userModel->insert($data);
        return redirect()->to('/kelola-user')->with('success', 'Akun berhasil dibuat.');
    }

    public function update_user($id)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap wajib diisi'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        // ambil data dari form
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
        ];
        // jika password diisi, update password
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
        $this->userModel->update($id, $data);
        return redirect()->to('/kelola-user')->with('success', 'Akun berhasil diperbarui.');
    }

    public function hapus_user($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/kelola-user')->with('success', 'Akun berhasil dihapus.');
    }
}
