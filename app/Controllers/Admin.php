<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAdmin;
use App\Models\ModelLaporan;

class Admin extends BaseController
{
    protected $ModelAdmin;
    protected $ModelLaporan;

    public function __construct()
    {
        $this->ModelAdmin = new ModelAdmin();
        $this->ModelLaporan = new ModelLaporan();
    }

    public function index()
    {
        $search = $this->request->getGet('search'); // Ambil keyword pencarian dari GET

        if ($search) {
            // Jika ada pencarian, ambil data yang sesuai
            $pesanan_terbaru = $this->ModelAdmin->CariPesanan($search);
        } else {
            // Jika tidak, ambil semua data
            $pesanan_terbaru = $this->ModelAdmin->GetPesananTerbaru();
        }

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
            'pesanan_terbaru' => $pesanan_terbaru,
            'search' => $search,
        ];
        return view('v_template', $data);
    }

    public function Setting()
    {
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

    public function UpdateSetting()
    {
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

    public function Cek()
    {
        echo dd($this->ModelAdmin->PendapatanTahunIni());
    }

    public function UpdateStatusPembayaran()
    {
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

    public function updatePesanan()
    {
        // Validasi request
        if (!$this->request->getMethod() === 'post') {
            session()->setFlashdata('error', 'Invalid request method.');
            return redirect()->to(base_url('Admin'));
        }

        // Ambil data dari form
        $no_faktur = $this->request->getPost('no_faktur');

        $data = [
            'nama_konsumen' => $this->request->getPost('nama_konsumen'),
            'no_hp' => $this->request->getPost('no_hp'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'grand_total' => $this->request->getPost('grand_total'),
            'dibayar' => $this->request->getPost('dibayar'),
            'status_pembayaran' => $this->request->getPost('status_pembayaran')
        ];

        // Update data di database
        $updated = $this->ModelAdmin->updatePesanan($no_faktur, $data);

        // Set flashdata dan redirect
        if ($updated) {
            session()->setFlashdata('success', 'Pesanan berhasil diperbarui.');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui pesanan.');
        }

        return redirect()->to(base_url('Admin'));
    }

    public function deletePesanan($no_faktur = null)
    {
        // Validasi parameter
        if (!$no_faktur) {
            session()->setFlashdata('error', 'No Faktur tidak valid.');
            return redirect()->to(base_url('Admin'));
        }

        // Ambil data pesanan untuk mendapatkan nama file gambar
        $pesanan = $this->ModelAdmin->getPesananByNoFaktur($no_faktur);

        // Hapus file gambar_before jika ada
        if ($pesanan && !empty($pesanan['gambar_before'])) {
            $file_path = FCPATH . $pesanan['gambar_before'];
            if (is_file($file_path)) {
                @unlink($file_path);
            }
        }

        // Hapus data di database
        $deleted = $this->ModelAdmin->deletePesanan($no_faktur);

        // Set flashdata dan redirect
        if ($deleted) {
            session()->setFlashdata('success', 'Pesanan berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus pesanan.');
        }

        return redirect()->to(base_url('Admin'));
    }
}
