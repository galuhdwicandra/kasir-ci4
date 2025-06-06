<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser;

class User extends BaseController
{
    protected $ModelUser;

    public function __construct() {
        $this->ModelUser = new ModelUser();
    }

    public function index()
    {
        $data = [
            'judul' => 'User',
            'subjudul' => 'User',
            'menu' => 'masterdata',
            'submenu' => 'user',
            'page' => 'v_user',
            'user' => $this->ModelUser->AllData(),
        ];
        return view('v_template', $data);
    }

    public function InsertData(){
        $data = [
            'nama_user' => $this->request->getpost('nama_user'),
            'email' => $this->request->getpost('email'),
            'password' => sha1($this->request->getpost('password')),
            'level' => $this->request->getpost('level'),
            'status' => $this->request->getpost('status', '1'),
        ];
        $this->ModelUser->InsertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to(base_url('User'));
    }

    public function UpdateData($id_user){
        $data = [
            'id_user' => $id_user,
            'nama_user' => $this->request->getpost('nama_user'),
            'email' => $this->request->getpost('email'),
            'level' => $this->request->getpost('level'),
            'status' => $this->request->getpost('status'),
        ];
        $this->ModelUser->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate');
        return redirect()->to(base_url('User'));
    }

    public function DeleteData($id_user){
        $data = [
            'id_user' => $id_user,
        ];
        $this->ModelUser->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Didelete');
        return redirect()->to(base_url('User'));
    }

    public function changeStatus($id_user, $status){
        $this->ModelUser->updateStatus($id_user, $status);
        session()->setFlashdata('pesan', 'Status user berhasil diubah');
        return redirect()->to(base_url('User'));
    }
    
}
