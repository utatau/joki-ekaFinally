<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Dokumen extends Seeder
{
   public function run()
{
    $data = [
        [
            'id_dokumen' => 'DKM-0002',
            'kode_rak' => 'KTG-001',
            'nama_tenaga_krj' => 'EKA',
            'kpj' => 2147483647,
            'id_kategori' => 'KTG-0007',
            'tgl_upload' => '2025-05-12',
            'masa_berlaku' => '2028-05-11',
            'file' => '1747048622_baec9a119956c2f1d05f.pdf'
        ]
    ];
    $this->db->table('dokumen')->insertBatch($data);
}

}
