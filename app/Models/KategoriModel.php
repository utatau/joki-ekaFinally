<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $allowedFields = ['head_kategori', 'sub_kategori', 'kode_kategori', 'id_dokumen']; // sesuaikan fieldnya

    public function data()
    {
        // return $this->orderBy('id_kategori', 'DESC')->findAll();
         return $this->db->table('kategori')->get()->getResult();
    }

    public function dataJoin()
    {
        return $this->db->table('kategori k')
            ->select('*')
            ->orderBy('k.id_kategori', 'DESC')
            ->get()
            ->getResult();
    }

public function dataJoinLike()
{
    $builder = $this->db->table('kategori kt')
        ->select('*');

    return $builder
        ->orderBy('kt.id_kategori', 'DESC')
        ->countAllResults(); 
}




    public function detailJoin($id)
    {
        return $this->db->table('kategori k')
            ->select('*')
            ->join('dokumen dm', 'dm.id_dokumen = k.id_dokumen')
            ->where('k.id_kategori', $id)
            ->orderBy('k.id_kategori', 'DESC')
            ->get()
            ->getRow();
    }

    public function ambilId($table, $where)
    {
        return $this->db->table($table)->where($where)->get()->getRow();
    }

    // public function detail_data($where, $table)
    // {
    //     return $this->db->table($table)->where($where)->get()->getRow();
    // }
     public function detail_data($where, $table)
    {
        return $this->db->table($table)->where($where)->get();
    }
    public function detail_sub($where, $table)
    {
        return $this->db->table($table)->where($where);
    }

    public function tambah_data($data, $table)
    {
        return $this->db->table($table)->insert($data);
    }

    public function ubah_data($where, $data, $table)
    {
        return $this->db->table($table)->where($where)->update($data);
    }

    public function hapus_data($where, $table)
    {
        $this->db->table($table)->where($where)->delete();
        return $this->db->affectedRows() === 1;
    }

    public function get_kategori()
    {
        $query = $this->db->table('kategori')
            ->orderBy('id_kategori', 'DESC')
            ->orderBy('head_kategori', 'ASC')
            ->orderBy('sub_kategori', 'ASC')
            ->orderBy('kode_kategori', 'ASC')
            ->get();

        $result = [];
        foreach ($query->getResult() as $row) {
            $result[$row->head_kategori][] = $row;
        }
        return $result;
    }

    public function buat_kode()
    {
        $query = $this->db->table('kategori')
            ->select('RIGHT(id_kategori, 4) as kode', false)
            ->orderBy('id_kategori', 'DESC')
            ->limit(1)
            ->get();

        if ($query->getNumRows() > 0) {
            $data = $query->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        return "KTG-" . $kodemax;
    }
}
