<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    public function cek_login(array $where, string $table)
    {
        return $this->db->table($table)->where($where)->get()->getRow();
    }
}
