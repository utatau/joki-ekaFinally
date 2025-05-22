<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
   public function up()
{
    $this->forge->addField([
        'id_user' => ['type' => 'VARCHAR', 'constraint' => 50],
        'username' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
        'level' => ['type' => 'ENUM', 'constraint' => ['staff', 'admin'], 'null' => true],
        'password' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
    ]);
    $this->forge->addKey('id_user', true);
    $this->forge->createTable('user');
}

public function down()
{
    $this->forge->dropTable('user');
}

}
