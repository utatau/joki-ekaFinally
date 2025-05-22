<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dokumen extends Migration
{
   public function up()
{
    $this->forge->addField([
        'id_dokumen' => ['type' => 'VARCHAR', 'constraint' => 20],
        'kode_rak' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
        'nama_tenaga_krj' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
        'kpj' => ['type' => 'BIGINT', 'null' => true],
        'id_kategori' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
        'tgl_upload' => ['type' => 'DATE', 'null' => true],
        'masa_berlaku' => ['type' => 'DATE', 'null' => true],
        'file' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
    ]);
    $this->forge->addKey('id_dokumen', true);
    $this->forge->addKey('id_kategori');
    $this->forge->createTable('dokumen');
}

public function down()
{
    $this->forge->dropTable('dokumen');
}

}
