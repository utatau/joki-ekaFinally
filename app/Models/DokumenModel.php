<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumenModel extends Model
{
    protected $table = 'dokumen';
    protected $primaryKey = 'id_dokumen';
    protected $allowedFields = ['id_kategori', 'tgl_upload', 'file'];

    public function data()
    {
        return $this->orderBy('id_dokumen', 'DESC')->findAll();
    }

    public function dataJoin()
    {
        return $this->db->table('dokumen dm')
            ->select('*')
            ->join('kategori k', 'k.id_kategori = dm.id_kategori')
            ->orderBy('dm.id_dokumen', 'DESC')
            ->get()
            ->getResult();
    }

    public function dataIndex()
    {
        return $this->db->table('dokumen dm')
            ->select('*')
            ->orderBy('dm.id_dokumen', 'DESC')
            ->get()
            ->getResult();
    }

public function dataJoinLike()
{
    $builder = $this->db->table('dokumen dm')
        ->select('*');

    return $builder
        ->orderBy('dm.id_dokumen', 'DESC')
        ->countAllResults(); 
}




    public function detailJoin($id)
    {
        return $this->db->table('dokumen dm')
            ->select('*')
            ->join('kategori k', 'k.id_kategori = dm.id_kategori')
            ->where('dm.id_dokumen', $id)
            ->orderBy('dm.id_dokumen', 'DESC')
            ->get()
            ->getResult(); 
    }

    // public function ambilFile($where)
    // {
    //     return $this->db->table('dokumen')
    //         ->where($where)
    //         ->orderBy('id_dokumen', 'DESC')
    //         ->limit(1)
    //         ->get()
    //         ->getResult('file');
    // }
    public function ambilFile($where)
{
    $result = $this->db->table('dokumen')
        ->where($where)
        ->orderBy('id_dokumen', 'DESC')
        ->limit(1)
        ->get()
        ->getRow(); 

    return $result ? $result->file : null; 
}


    public function ambilId($table, $where)
    {
        return $this->db->table($table)->where($where)->get()->getRow();
    }

    public function hapus_data($where, $table)
    {
        $this->db->table($table)->where($where)->delete();
        return ($this->db->affectedRows() == 1);
    }

     public function detail_data($where, $table)
    {
        return $this->db->table($table)->where($where)->get();
    }

//     public function detail_data($where)
// {
//     return $this->where($where)->first(); // langsung pakai nama tabel dari model
// }
    public function tambah_data($data, $table)
    {
        return $this->db->table($table)->insert($data);
    }

    public function ubah_data(array $where, array $data, string $table)
{
    return $this->db->table($table)->where($where)->update($data);
}


    public function buat_kode()
    {
        $query = $this->db->table('dokumen')
            ->select('RIGHT(id_dokumen,4) as kode', false)
            ->orderBy('id_dokumen', 'DESC')
            ->limit(1)
            ->get();

        if ($query->getNumRows() !== 0) {
            $data = $query->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 4, '0', STR_PAD_LEFT);
        return 'DKM-' . $kodemax;
    }
}
