<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kategori extends Migration
{
   public function up()
{
    $this->forge->addField([
        'id_kategori'   => ['type' => 'VARCHAR', 'constraint' => 20],
        'head_kategori' => ['type' => 'VARCHAR', 'constraint' => 80, 'null' => true],
        'sub_kategori'  => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
        'kode_kategori' => ['type' => 'VARCHAR', 'constraint' => 30],
    ]);
    $this->forge->addKey('id_kategori', true);
    $this->forge->createTable('kategori');
}

public function down()
{
    $this->forge->dropTable('kategori');
}
}
