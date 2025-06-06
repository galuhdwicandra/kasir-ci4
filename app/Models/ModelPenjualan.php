<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelPenjualan extends Model
{
    public function NoFaktur(){
        $tgl = date('Ymd');
        $query = $this->db->query("SELECT MAX(RIGHT(no_faktur,4)) as no_urut FROM tbl_jual WHERE DATE(tgl_jual)='$tgl'");
        $hasil = $query->getRowArray();
        if ($hasil['no_urut'] > 0) {
            $tmp = $hasil['no_urut'] + 1;
            $kd = sprintf("%04s", $tmp);
        }else {
            $kd = "0001";
        }
        $no_faktur = date('Ymd') . $kd;
        return $no_faktur;
    }

    public function CekProduk($kode_produk){
        return $this->db->table('tbl_produk')
        ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.id_kategori')
        ->join('tbl_satuan', 'tbl_satuan.id_satuan = tbl_produk.id_satuan')
        ->where('kode_produk', $kode_produk)
        ->get()
        ->getRowArray();
    }

    public function AllProduk(){
        return $this->db->table('tbl_produk')
        ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.id_kategori')
        ->join('tbl_satuan', 'tbl_satuan.id_satuan = tbl_produk.id_satuan')
        ->get()
        ->getResultArray();
    }

    public function InsertJual($data){
        $this->db->table('tbl_jual')->insert($data);
    }

    public function InsertRinciJual($data){
        $this->db->table('tbl_rinci_jual')->insert($data);
    }

    public function updatePaymentStatus($no_faktur, $status) {
        return $this->db->table('tbl_jual')
                       ->where('no_faktur', $no_faktur)
                       ->update(['status_pembayaran' => $status]);
    }
    
    public function getTransactionStatus($no_faktur) {
        $query = $this->db->query("SELECT status_pembayaran FROM tbl_jual WHERE no_faktur = '$no_faktur'");
        $result = $query->getRowArray();
        return $result ? $result['status_pembayaran'] : 'pending';
    }
       
}
