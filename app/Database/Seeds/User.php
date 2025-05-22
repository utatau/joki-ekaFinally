<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
{
    $data = [
        ['id_user' => 'USR-001', 'username' => 'admin', 'level' => 'admin', 'password' => '5c04d53c23e881867ed63658d5388028'],
        ['id_user' => 'USR-002', 'username' => 'staff', 'level' => 'staff', 'password' => '21232f297a57a5a743894a0e4a801fc3'],
    ];
    $this->db->table('user')->insertBatch($data);
}

}
