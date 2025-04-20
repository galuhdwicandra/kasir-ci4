<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdmin extends Model
{
    public function DetailData()
    {
        return $this->db->table('tbl_setting')
            ->where('id', 1)
            ->get()
            ->getRowArray();
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_setting')
            ->where('id', $data['id'])
            ->update($data);
    }

    public function Grafik()
    {
        return $this->db->table('tbl_rinci_jual')
            ->join('tbl_jual', 'tbl_jual.no_faktur = tbl_rinci_jual.no_faktur')
            ->where('month(tbl_jual.tgl_jual)', date('m'))
            ->where('year(tbl_jual.tgl_jual)', date('Y'))
            ->select('tbl_jual.tgl_jual')
            ->groupBy('tbl_jual.tgl_jual')
            ->selectSum('tbl_rinci_jual.total_harga')
            ->selectSum('tbl_rinci_jual.untung')
            ->get()
            ->getResultArray();
    }

    public function PendapatanHariIni()
    {
        return $this->db->table('tbl_rinci_jual')
            ->join('tbl_jual', 'tbl_jual.no_faktur = tbl_rinci_jual.no_faktur')
            ->where('tbl_jual.tgl_jual', date('Y-m-d'))
            ->groupBy('tbl_jual.tgl_jual')
            ->selectSum('tbl_rinci_jual.total_harga')
            ->get()
            ->getRowArray();
    }

    public function PendapatanBulanIni()
    {
        return $this->db->table('tbl_rinci_jual')
            ->join('tbl_jual', 'tbl_jual.no_faktur = tbl_rinci_jual.no_faktur')
            ->where('month(tbl_jual.tgl_jual)', date('m'))
            ->where('year(tbl_jual.tgl_jual)', date('Y'))
            ->groupBy('month(tbl_jual.tgl_jual)')
            ->selectSum('tbl_rinci_jual.total_harga')
            ->get()
            ->getRowArray();
    }

    public function PendapatanTahunIni()
    {
        return $this->db->table('tbl_rinci_jual')
            ->join('tbl_jual', 'tbl_jual.no_faktur = tbl_rinci_jual.no_faktur')
            ->where('year(tbl_jual.tgl_jual)', date('Y'))
            ->groupBy('year(tbl_jual.tgl_jual)')
            ->selectSum('tbl_rinci_jual.total_harga')
            ->get()
            ->getRowArray();
    }

    public function JumlahProduk()
    {
        return $this->db->table('tbl_produk')
            ->countAll();
    }

    public function JumlahKategori()
    {
        return $this->db->table('tbl_kategori')
            ->countAll();
    }

    public function JumlahSatuan()
    {
        return $this->db->table('tbl_satuan')
            ->countAll();
    }

    public function JumlahUser()
    {
        return $this->db->table('tbl_user')
            ->countAll();
    }

    public function LatestOrder()
    {
        return $this->db->table('tbl_rinci_jual')
            ->join('tbl_jual', 'tbl_rinci_jual.no_faktur = tbl_jual.no_faktur')
            ->orderBy('tbl_jual.jam', 'DESC') // Urutkan berdasarkan tanggal & jam terbaru
            ->limit(5) // Batasi jumlah pesanan yang diambil, misalnya 5 pesanan terakhir
            ->select('tbl_jual.no_faktur, tbl_jual.jam, tbl_rinci_jual.kode_produk, 
                     tbl_rinci_jual.qty, tbl_rinci_jual.harga, tbl_rinci_jual.total_harga, 
                     tbl_rinci_jual.untung')
            ->get()->getResultArray();
    }

    public function GetPesananTerbaru()
    {
        return $this->db->table('tbl_jual')
            ->select('no_faktur, tgl_jual, grand_total, status_pembayaran, nama_konsumen, no_hp, tanggal_masuk, tanggal_selesai, deskripsi, gambar_before, dibayar, kembalian')
            ->orderBy('tgl_jual', 'DESC')
            ->get()
            ->getResultArray();
    }

    // Di ModelAdmin.php
    public function GetAllPesanan()
    {
        // Menggunakan paginate bawaan CI4
        return $this->select('no_faktur, tgl_jual, grand_total, status_pembayaran, nama_konsumen, no_hp, tanggal_masuk, tanggal_selesai, deskripsi')
            ->orderBy('tgl_jual', 'DESC')
            ->paginate(10, 'pesanan'); // 10 data per halaman, 'pesanan' adalah nama group
    }

    public function UpdateStatusPesanan($noFaktur, $status)
    {
        return $this->db->table('tbl_jual')
            ->where('no_faktur', $noFaktur)
            ->update(['status_pembayaran' => $status]);
    }

    public function UpdateStatusPembayaran($noFaktur, $statusPembayaran)
    {
        return $this->db->table('tbl_jual')
            ->where('no_faktur', $noFaktur)
            ->update(['status_pembayaran' => $statusPembayaran]);
    }

    public function CariPesanan($keyword)
    {
        if (empty($keyword)) {
            return $this->GetPesananTerbaru(); // Return semua data jika tidak ada keyword
        }

        return $this->db->table('tbl_jual')
            ->select('no_faktur, tgl_jual, grand_total, status_pembayaran, 
                      nama_konsumen, no_hp, tanggal_masuk, tanggal_selesai, deskripsi, dibayar, kembalian')
            ->groupStart()
            ->like('no_faktur', $keyword)
            ->orLike('nama_konsumen', $keyword)
            ->orLike('no_hp', $keyword)
            ->orLike('deskripsi', $keyword)
            ->groupEnd()
            ->orderBy('tgl_jual', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function updatePesanan($no_faktur, $data)
    {
        return $this->db->table('tbl_jual')
            ->where('no_faktur', $no_faktur)
            ->update($data);
    }

    public function deletePesanan($no_faktur)
    {
        // Hapus dari tabel rinci_jual terlebih dahulu (karena relasi)
        $this->db->table('tbl_rinci_jual')
            ->where('no_faktur', $no_faktur)
            ->delete();

        // Kemudian hapus dari tabel jual
        return $this->db->table('tbl_jual')
            ->where('no_faktur', $no_faktur)
            ->delete();
    }

    public function getPesananByNoFaktur($no_faktur)
    {
        return $this->db->table('tbl_jual')
            ->where('no_faktur', $no_faktur)
            ->get()
            ->getRowArray();
    }
}
