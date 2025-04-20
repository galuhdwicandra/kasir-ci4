<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPenjualan;

class Penjualan extends BaseController
{
    protected $ModelPenjualan;
    protected $db;

    public function __construct()
    {
        $this->ModelPenjualan = new ModelPenjualan();
        $this->db = \Config\Database::connect();
        $this->ModelPenjualan = new ModelPenjualan();
    }

    public function index()
    {
        $cart = \Config\Services::cart();
        $data = [
            'judul' => 'Penjualan',
            'no_faktur' => $this->ModelPenjualan->NoFaktur(),
            'nama_kasir' => 'level',
            'cart' => $cart->contents(),
            'grand_total' => $cart->total(),
            'produk' => $this->ModelPenjualan->AllProduk(),
            'nama_konsumen' => $jual['nama_konsumen'] ?? '',
            'no_hp' => $jual['no_hp'] ?? '',
            'deskripsi' => $jual['deskripsi'] ?? '',
        ];
        return view('v_penjualan', $data);
    }

    public function CekProduk()
    {
        $kode_produk = $this->request->getPost('kode_produk');
        $produk = $this->ModelPenjualan->CekProduk($kode_produk);
        if ($produk == null) {
            $data = [
                'nama_produk' => '',
                'nama_kategori' => '',
                'nama_satuan' => '',
                'harga_akhir' => '',
                'harga_treat' => '',
            ];
        } else {
            $data = [
                'nama_produk' => $produk['nama_produk'],
                'nama_kategori' => $produk['nama_kategori'],
                'nama_satuan' => $produk['nama_satuan'],
                'harga_akhir' => $produk['harga_akhir'],
                'harga_treat' => $produk['harga_treat'],

            ];
        }
        echo json_encode($data);
    }

    public function InsertCart()
    {
        $cart = \Config\Services::cart();
        $cart->insert(array(
            'id'      => $this->request->getPost('kode_produk'),
            'qty'     => $this->request->getPost('qty'),
            'price'   => $this->request->getPost('harga_akhir'),
            'name'    => $this->request->getPost('nama_produk'),
            'options' => array(
                'nama_kategori' => $this->request->getPost('nama_kategori'),
                'nama_satuan' => $this->request->getPost('nama_satuan'),
                'modal' => $this->request->getPost('harga_treat'),
            )
        ));
        return redirect()->to(base_url('penjualan'));
    }

    public function ViewCart()
    {
        $cart = \Config\Services::cart();
        $data = $cart->contents();
        echo dd($data);
    }

    public function ResetCart()
    {
        $cart = \Config\Services::cart();
        $cart->destroy();
        return redirect()->to(base_url('penjualan'));
    }

    public function RemoveItemCart($rowid)
    {
        $cart = \Config\Services::cart();
        $cart->remove($rowid);
        return redirect()->to(base_url('penjualan'));
    }

    public function SimpanTransaksi()
    {
        // Inisialisasi variabel untuk path gambar
        $gambar_before_path = null;

        $cart = \Config\Services::cart();
        $produk = $cart->contents();
        $no_faktur = $this->request->getPost('no_faktur');
        $dibayar = str_replace(",", "", $this->request->getPost('dibayar'));
        $kembalian = str_replace(",", "", $this->request->getPost('kembalian'));
        $nama_konsumen = $this->request->getPost('nama_konsumen');
        $no_hp = $this->request->getPost('no_hp');
        $tanggal_masuk   = $this->request->getPost('tanggal_masuk');
        $tanggal_selesai = $this->request->getPost('tanggal_selesai');
        $deskripsi       = $this->request->getPost('deskripsi');
        // Upload gambar before jika ada
        $gambar_before = $this->request->getFile('gambar_before');
        if ($gambar_before && $gambar_before->isValid() && !$gambar_before->hasMoved()) {
            $newBeforeName = $gambar_before->getRandomName();
            $gambar_before->move(ROOTPATH . 'public/uploads/before', $newBeforeName);
            $gambar_before_path = 'uploads/before/' . $newBeforeName;
        }

        $statusPembayaran = $this->request->getPost('status_pembayaran');
        $allowedStatus = ['pending', 'success', 'failed'];
        if (!in_array($statusPembayaran, $allowedStatus)) {
            return redirect()->back()->with('error', 'Status pembayaran tidak valid.');
        }

        // simpan ke tabel rinci_jual
        foreach ($produk as $key => $value) {
            $data = [
                'no_faktur' => $no_faktur,
                'nama_konsumen' => $nama_konsumen,
                'no_hp' => $no_hp,
                'tanggal_masuk' => $tanggal_masuk,
                'tanggal_selesai' => $tanggal_selesai,
                'deskripsi' => $deskripsi,
                'kode_produk' => $value['id'],
                'harga' => $value['price'],
                'modal' => $value['options']['modal'],
                'qty' => $value['qty'],
                'total_harga' => $value['subtotal'],
                'untung' => ($value['price'] - $value['options']['modal']) * $value['qty'],
            ];
            $this->ModelPenjualan->InsertRinciJual($data);
        }

        // simpan ke tabel jual
        $data = [
            'no_faktur' => $no_faktur,
            'nama_konsumen' => $nama_konsumen,
            'no_hp'    => $no_hp,
            'tanggal_masuk' => $tanggal_masuk,
            'tanggal_selesai' => $tanggal_selesai,
            'deskripsi' => $deskripsi,
            'gambar_before' => $gambar_before_path,
            'tgl_jual' => date('Y-m-d'),
            'jam' => date('H:i:s'),
            'grand_total' => $cart->total(),
            'dibayar' => $dibayar,
            'kembalian' => $kembalian,
            'id_user' => session()->get('id_user'),
            'status_pembayaran' => $statusPembayaran,
        ];
        $this->ModelPenjualan->InsertJual($data);
        $cart->destroy();
        session()->setFlashdata('pesan', 'Transaksi Berhasil Disimpan');
        return redirect()->to(base_url('Penjualan'));
    }

    public function UpdateStatusPembayaran($id)
    {
        $status = $this->request->getPost('status_pembayaran');
        $this->db->table('tbl_jual')->where('id', $id)->update(['status_pembayaran' => $status]);
        return redirect()->to('/penjualan');
    }

    public function InsertJual()
    {
        $statusPembayaran = $this->request->getPost('status_pembayaran');
        $data = [
            'no_faktur' => $this->ModelPenjualan->NoFaktur(),
            'id_pelanggan' => $this->request->getPost('id_pelanggan'),
            'tgl_jual' => date('Y-m-d'),
            'total_harga' => $this->request->getPost('total_harga'),
            'status_pembayaran' => $statusPembayaran, // Nilai default untuk status pembayaran
        ];

        // Simpan data ke tabel tbl_jual
        $this->ModelPenjualan->InsertJual($data);

        // Redirect atau beri pesan sukses
        return redirect()->to('/penjualan')->with('success', 'Transaksi berhasil disimpan dengan status pembayaran pending.');
    }
}
