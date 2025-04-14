<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAdmin;
use App\Models\ModelLaporan;

class Admin extends BaseController
{
    protected $ModelAdmin;
    protected $ModelLaporan;

    public function __construct() {
        $this->ModelAdmin = new ModelAdmin();
        $this->ModelLaporan = new ModelLaporan();
    }

    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'subjudul' => '',
            'menu' => 'dashboard',
            'submenu' => '',
            'page' => 'v_admin',
            'grafik' => $this->ModelAdmin->Grafik(),
            'p_hari_ini' => $this->ModelAdmin->PendapatanHariIni(),
            'p_bulan_ini' => $this->ModelAdmin->PendapatanBulanIni(),
            'p_tahun_ini' => $this->ModelAdmin->PendapatanTahunIni(),
            'jml_produk' => $this->ModelAdmin->JumlahProduk(),
            'jml_kategori' => $this->ModelAdmin->JumlahKategori(),
            'jml_satuan' => $this->ModelAdmin->JumlahSatuan(),
            'jml_user' => $this->ModelAdmin->JumlahUser(),
            'latest_order' => $this->ModelAdmin->LatestOrder(),
            'pesanan_terbaru' => $this->ModelAdmin->GetPesananTerbaru(),
        ];
        return view('v_template', $data);
    }

    public function Setting(){
        $data = [
            'judul' => 'Setting',
            'subjudul' => 'Setting',
            'menu' => 'setting',
            'submenu' => '',
            'page' => 'v_setting',
            'setting' => $this->ModelAdmin->DetailData(),
        ];
        return view('v_template', $data);
    }

    public function UpdateSetting(){
        $data = [
            'id' => 1,
            'nama_toko' => $this->request->getpost('nama_toko'),
            'slogan' => $this->request->getpost('slogan'),
            'alamat' => $this->request->getpost('alamat'),
            'no_hp' => $this->request->getpost('no_hp'),
            'deskripsi' => $this->request->getpost('deskripsi'),
        ];
        $this->ModelAdmin->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate');
        return redirect()->to(base_url('Admin/Setting'));
    }

    public function Cek(){
        echo dd($this->ModelAdmin->PendapatanTahunIni());
    }

    public function UpdateStatusPembayaran() {
        // Validasi request AJAX
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403, 'Forbidden');
        }
    
        // Ambil data dari request
        $noFaktur = $this->request->getPost('no_faktur');
        $statusPembayaran = $this->request->getPost('status_pembayaran');
    
        // Validasi nilai status pembayaran
        $allowedStatus = ['pending', 'success', 'failed'];
        if (!in_array($statusPembayaran, $allowedStatus)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Status tidak valid']);
        }
    
        // Update status pembayaran di database
        $updated = $this->ModelAdmin->UpdateStatusPembayaran($noFaktur, $statusPembayaran);
    
        // Kembalikan response sukses/gagal
        return $this->response->setJSON([
            'success' => (bool)$updated,
            'message' => $updated ? 'Status berhasil diperbarui' : 'Gagal memperbarui status',
        ]);
    }
}