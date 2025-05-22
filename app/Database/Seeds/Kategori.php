<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Kategori extends Seeder
{
   public function run()
{
    $data = [
        ['id_kategori' => 'KTG-0005', 'head_kategori' => 'jaminan', 'sub_kategori' => 'Jaminan Kematian (JKM)', 'kode_kategori' => ''],
        ['id_kategori' => 'KTG-0007', 'head_kategori' => 'jaminan', 'sub_kategori' => ' Jaminan Kecelakaan Kerja (JKK)', 'kode_kategori' => ''],
        ['id_kategori' => 'KTG-0009', 'head_kategori' => 'jaminan', 'sub_kategori' => 'Jaminan Kematian (JKM)', 'kode_kategori' => ''],
        ['id_kategori' => 'KTG-0010', 'head_kategori' => 'jaminan', 'sub_kategori' => 'Jaminan Hari Tua (JHT)', 'kode_kategori' => ''],
    ];
    $this->db->table('kategori')->insertBatch($data);
}
}
