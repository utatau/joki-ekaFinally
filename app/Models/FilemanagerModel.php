<?php

namespace App\Models;

use CodeIgniter\Model;

class FilemanagerModel extends Model
{
    protected $table = 'dokumen';
    protected $primaryKey = 'id_dokumen';
    protected $allowedFields = ['id_kategori', 'tgl_upload', 'file']; // sesuaikan jika ada field lain

    public function data()
    {
        return $this->orderBy('id_dokumen', 'DESC')->findAll();
    }

    public function ambilId($table, $where)
    {
        return $this->db->table($table)->where($where)->get()->getRow();
    }

    public function detail_data($where, $table)
    {
        return $this->db->table($table)->where($where)->get()->getRow();
    }

    public function detail_join($id)
    {
        return $this->db->table('dokumen d')
            ->select('*')
            ->join('kategori k', 'k.id_kategori = d.id_kategori')
            ->where('d.id_dokumen', $id)
            ->orderBy('d.id_dokumen', 'DESC')
            ->get()
            ->getRow();
    }
}
