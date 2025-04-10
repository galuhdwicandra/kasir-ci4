<?php

namespace App\Controllers;

use App\Models\ModelUser;

class Home extends BaseController
{
    protected $ModelUser;

    public function __construct()
    {
        $this->ModelUser = new ModelUser();
    }

    public function index(): string
    {
        $data = [
            'judul' => 'Login',
        ];
        return view('v_login', $data);
    }

    public function CekLogin()
    {
        if ($this->validate([
            'email' => [
                'label' => 'E-Mail',
                'rules' => 'required',
                'errors' => [
                    'is_unique' => '{field} Masih Kosong'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Masih Kosong'
                ]
            ]
        ])) {
            $email = $this->request->getPost('email');
            $password = sha1($this->request->getPost('password'));
            $cek_login = $this->ModelUser->loginUser($email, $password);
            if ($cek_login) {
                // jika login berhasil
                session()->set('id_user', $cek_login['id_user']);
                session()->set('nama_user', $cek_login['nama_user']);
                session()->set('level', $cek_login['level']);
                if ($cek_login['level']) {
                    return redirect()->to(base_url('Admin'));
                }else {
                    return redirect()->to(base_url('Penjualan'));
                }
            }else {
                // jika gagal login
                session()->setFlashdata('gagal','E-Mail atau Password Salah');
                return redirect()->to(base_url('Home'));
            }
        } else {
            session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to(base_url('Home'))->withInput();
        }
    }

    public function LogOut()
    {
        session()->remove('id_user');
        session()->remove('nama_user');
        session()->remove('level');
        session()->setFlashdata('pesan', 'Anda Berhasil Logout');
        return redirect()->to(base_url('Home'));


    }
}
