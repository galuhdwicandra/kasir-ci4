<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKonsumenFieldsToTblJual extends Migration
{
    public function up()
    {
        $fields = [
            'nama_konsumen' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'tanggal_masuk' => [
                'type' => 'DATE',
            ],
            'tanggal_selesai' => [
                'type' => 'DATE',
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ]
        ];

        $this->forge->addColumn('tbl_jual', $fields); // Ganti 'tbl_jual' dengan nama tabel Anda
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_jual', ['nama_konsumen', 'tanggal_masuk', 'tanggal_selesai', 'deskripsi']);
    }
}

