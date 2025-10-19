<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;

class AuthController extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UsersModel();
    }

    private function setUserSession($user)
    {
        $data = [
            'user_id'       => $user['id'],
            'username'      => $user['username'],
            'role'          => $user['role'],
            'nama_lengkap'  => $user['nama_lengkap'],
            'isLoggedIn'    => true,
        ];
        session()->set($data);
        return true;
    }

    public function login()
    {
        return view('auth/login');
    }

    public function proses_login()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username wajib diisi'

                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password wajib diisi'
                ]
            ],
        ]);

        // jika validasi gagal maka muncul error
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // ambil data dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // cari user berdasarkan username
        $user = $this->userModel->where('username', $username)->first();
        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Username tidak ditemukan');
        }
        // verifikasi password
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Password salah');
        }
        // set session
        $this->setUserSession($user);
        return redirect()->to('/dashboard');
    }
    public function proses_register()
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
        return redirect()->to('/')->with('success', 'Registrasi berhasil. Silakan login.');
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
