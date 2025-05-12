<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaturanModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['username', 'password', 'level']; 

    public function data()
    {
        return $this->orderBy('id_user', 'DESC')->findAll();
    }

    public function ambilId($table, $where)
    {
        return $this->db->table($table)->where($where)->get()->getRow();
    }

    public function hapus_data( $where,  $table)
    {
        $this->db->table($table)->where($where)->delete();
        return $this->db->affectedRows() === 1;
    }

//     public function detail_data($where, $table)
// {
//     return $this->db->table($table)->where($where)->get();
// }
public function detail_data($where, $table)
    {
        return $this->db->table($table)->where($where)->get();
    }




    public function tambah_data( $data,  $table)
    {
        return $this->db->table($table)->insert($data);
    }

    public function ubah_data( $where,  $data,  $table)
    {
        return $this->db->table($table)->where($where)->update($data);
    }

    public function buat_kode()
    {
        $query = $this->db->table('user')
            ->select('RIGHT(id_user, 3) as kode', false)
            ->orderBy('id_user', 'DESC')
            ->limit(1)
            ->get();

        if ($query->getNumRows() > 0) {
            $data = $query->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        return "USR-" . $kodemax;
    }
}
