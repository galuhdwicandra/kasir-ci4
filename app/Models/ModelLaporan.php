<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLaporan extends Model
{
    public function DataHarian($tgl)
    {
        return $this->db->table('tbl_rinci_jual')
            ->join('tbl_produk', 'tbl_produk.kode_produk = tbl_rinci_jual.kode_produk')
            ->join('tbl_jual', 'tbl_jual.no_faktur = tbl_rinci_jual.no_faktur')
            ->where('tbl_jual.tgl_jual', $tgl)
            ->select('tbl_rinci_jual.kode_produk')
            ->select('tbl_produk.nama_produk')
            ->select('tbl_rinci_jual.modal')
            ->select('tbl_rinci_jual.harga')
            ->groupBy('tbl_rinci_jual.kode_produk')
            ->selectSum('tbl_rinci_jual.qty')
            ->selectSum('tbl_rinci_jual.total_harga')
            ->selectSum('tbl_rinci_jual.untung')
            ->get()
            ->getResultArray();
    }

    public function DataBulanan($bulan, $tahun)
    {
        return $this->db->table('tbl_rinci_jual')
            ->join('tbl_jual', 'tbl_jual.no_faktur = tbl_rinci_jual.no_faktur')
            ->where('month(tbl_jual.tgl_jual)', $bulan)
            ->where('year(tbl_jual.tgl_jual)', $tahun)
            ->select('tbl_jual.tgl_jual')
            ->groupBy('tbl_jual.tgl_jual')
            ->selectSum('tbl_rinci_jual.total_harga')
            ->selectSum('tbl_rinci_jual.untung')
            ->get()
            ->getResultArray();
    }

    public function DataTahunan($tahun)
    {
        return $this->db->table('tbl_rinci_jual')
            ->join('tbl_jual', 'tbl_jual.no_faktur = tbl_rinci_jual.no_faktur')
            ->where('year(tbl_jual.tgl_jual)', $tahun)
            ->select('month(tbl_jual.tgl_jual) as bulan')
            ->groupBy('month(tbl_jual.tgl_jual)')
            ->selectSum('tbl_rinci_jual.total_harga')
            ->selectSum('tbl_rinci_jual.untung')
            ->get()
            ->getResultArray();
    }
}
