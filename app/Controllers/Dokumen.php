<?php

namespace App\Controllers;

use App\Models\DokumenModel;
use App\Models\KategoriModel;
use CodeIgniter\Controller;

class Dokumen extends Controller
{
    protected $dokumenModel;
    protected $kategoriModel;
    protected $session;

    public function __construct()
    {
        $this->dokumenModel = new DokumenModel();
        $this->kategoriModel = new KategoriModel();
        $this->session = session();
        $this->request =  \Config\Services::Request();
    }

    public function index()
    {
        if (!session()->has('login_session')) {
            return redirect()->to('login');
        }
        $dokumen = $this->dokumenModel->dataJoin();
        $kategori = $this->kategoriModel->data();
        $data = [
            'title' => 'Dokumen',
            'dokumen' => $dokumen,
            'kategori' => $kategori,
            'jmlKategori' => count($kategori),
        ];

        echo view('template/header', $data);
        echo view('dokumen/index');
        echo view('template/footer');
    }

    public function tambah()
    {
        $data = [
            'title' => 'Dokumen',
            'kategori' => $this->kategoriModel->data()->getResult(),
            'jmlKategori' => $this->kategoriModel->data()->getResult()
        ];

        echo view('template/header', $data);
        echo view('dokumen/index');
        echo view('template/footer');
    }

public function proses_tambah()
{
    $file = $this->request->getFile('dokumen');
    $kode = $this->dokumenModel->buat_kode();
    $namaFile = $file->getName();
    $ext = pathinfo($namaFile, PATHINFO_EXTENSION);
    $allowedExtensions = ['pdf', 'docx'];
    // if ($file->isValid() && !$file->hasMoved()) {
    //     $newName = $namaFile;
    //     $file->move(FCPATH . 'assets/upload/dokumen', $newName); 
    // } else {
    //     $newName = 'pdf.pdf';
    // }
    if ($file->isValid() && !$file->hasMoved() && in_array($ext, $allowedExtensions)) {
    $newName = $namaFile;
    $file->move(FCPATH . 'assets/upload/dokumen', $newName); 
    } else {
        $this->session->setFlashdata('Pesan', $this->errorAlert('File tidak valid'));
        return redirect()->back();
    }

    $data = [
        'id_dokumen' => $kode,
        'kode_rak' => $this->request->getPost('kode_rak'),
        'nama_tenaga_krj' => $this->request->getPost('nama_tenaga_krj'),
        'kpj' => $this->request->getPost('kpj'),
        'id_kategori' => $this->request->getPost('kategori'),
        'tgl_upload' => $this->request->getPost('tgl_upload'),
        'masa_berlaku' => $this->request->getPost('masa_berlaku'),
        'file' => $newName
    ];

    $this->dokumenModel->tambah_data($data, 'dokumen'); 
    $this->session->setFlashdata('Pesan', $this->successAlert('Berhasil ditambahkan!'));
    return redirect()->to('/dokumen');
}
// public function proses_tambah()
// {
//     $file = $this->request->getFile('dokumen');
//     $kode = $this->dokumenModel->buat_kode();

//     if ($file && $file->isValid() && !$file->hasMoved()) {
//         $ext = strtolower($file->getClientExtension());
//         if (in_array($ext, ['pdf', 'xlsx'])) {
//             $newName = $kode . '.' . $ext;
//             $file->move(FCPATH . 'assets/upload/dokumen', $newName);
//         } else {
//             $this->session->setFlashdata('Pesan', $this->errorAlert('Hanya PDF dan XLSX yang diperbolehkan!'));
//             return redirect()->back();
//         }
//     } else {
//         $this->session->setFlashdata('Pesan', $this->errorAlert('File tidak valid atau terjadi kesalahan upload.'));
//         return redirect()->back();
//     }

//     $data = [
//         'id_dokumen' => $kode,
//         'kode_rak' => $this->request->getPost('kode_rak'),
//         'nama_tenaga_krj' => $this->request->getPost('nama_tenaga_krj'),
//         'kpj' => $this->request->getPost('kpj'),
//         'id_kategori' => $this->request->getPost('kategori'),
//         'tgl_upload' => $this->request->getPost('tgl_upload'),
//         'masa_berlaku' => $this->request->getPost('masa_berlaku'),
//         'file' => $newName
//     ];

//     $this->dokumenModel->tambah_data($data, 'dokumen'); 
//     $this->session->setFlashdata('Pesan', $this->successAlert('Berhasil ditambahkan!'));
//     return redirect()->to('/dokumen');
// }



    public function proses_hapus($id)
    {
        $file = $this->dokumenModel->ambilFile(['id_dokumen' => $id]);

        if ($file && $file != 'pdf.pdf') {
            unlink(FCPATH . 'assets/upload/dokumen/' . $file);
        }

       $this->dokumenModel->hapus_data(['id_dokumen' => $id], 'dokumen');
        $this->session->setFlashdata('Pesan', $this->successAlert('Berhasil dihapus!'));

        return redirect()->to('/dokumen');
    }

    public function proses_ubah()
    {
        $kode = $this->request->getPost('id_dokumen');
        $fileBaru = $this->request->getFile('fileBaru');
        $fileLama = $this->request->getPost('fileLamaNama');
            if ($fileBaru && $fileBaru->isValid() && !$fileBaru->hasMoved()) {
                $newName = $fileBaru->getName(); 
                $fileBaru->move(FCPATH . 'assets/upload/dokumen', $newName);

                $pathLama = FCPATH . 'assets/upload/dokumen/' . $fileLama;
                if ($fileLama !== 'pdf.pdf' && file_exists($pathLama)) {
                    unlink($pathLama);
                }
            } else {
                $newName = $fileLama;
            }


            $masa_berlaku = $this->request->getPost('tambah_masa_berlaku') ?: $this->request->getPost('masa_berlaku_lama');

            $where = ['id_dokumen' => $this->request->getPost('id_dokumen')];
            $data = [
                'kode_rak' => $this->request->getPost('kode_rak'),
                'nama_tenaga_krj' => $this->request->getPost('nama_tenaga_krj'),
                'kpj' => $this->request->getPost('kpj'),
                'id_kategori' => $this->request->getPost('kategori'),
                'tgl_upload' => $this->request->getPost('tgl_upload'),
                'masa_berlaku' => $this->request->getPost('tambah_masa_berlaku') ?: $this->request->getPost('masa_berlaku_lama'),
                'file' => $newName
            ];

        $this->dokumenModel->ubah_data($where, $data, 'dokumen');

        $this->session->setFlashdata('Pesan', $this->successAlert('Berhasil diubah!'));

        return redirect()->to('/dokumen');
    }
    public function getData()
    {
        $id = $this->request->getPost('id');
        $where = ['id_dokumen' => $id];

        $query = $this->dokumenModel->detail_data($where, 'dokumen');
        $data = $query->getResult(); 

        return $this->response->setJSON($data);
    }

    private function successAlert($message)
    {
        return "<script>
            $(document).ready(function() {
                swal.fire({
                    title: \"$message\",
                    icon: \"success\",
                    confirmButtonColor: \"#4e73df\",
                });
            });
        </script>";
    }
    private function errorAlert($message)
    {
        return "<script>
            $(document).ready(function() {
                swal.fire({
                    title: \"$message\",
                    icon: \"error\",
                    confirmButtonColor: \"#4e73df\",
                });
            });
        </script>";
    }
}
