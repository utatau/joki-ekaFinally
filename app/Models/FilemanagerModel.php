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

    public function dataJoin()
{
    return $this->db->table('dokumen dm')
        ->select('*')
        ->join('kategori k', 'k.id_kategori = dm.id_kategori')
        ->orderBy('dm.id_dokumen', 'DESC')
        ->get()
        ->getResult();
}

  function lapdata($tglAwal, $tglAkhir)
{
    $tglAkhir = '9999-05-01';
    return $this->db->table('dokumen d')
        ->select('d.id_dokumen, d.kode_rak, d.nama_tenaga_krj, d.kpj, k.sub_kategori, d.tgl_upload, d.masa_berlaku, d.file')
        ->join('kategori k', 'k.id_kategori = d.id_kategori')
        ->where('d.tgl_upload >=', $tglAwal)
        ->orderBy('d.id_dokumen', 'DESC')
        ->get();
}
}
