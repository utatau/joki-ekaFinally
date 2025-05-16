<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use CodeIgniter\Controller;

class Kategori extends Controller
{
    protected $kategoriModel;
    protected $session;

    public function __construct()
    {
        $this->session = session();
        $this->request =  \Config\Services::Request();
        helper(['url', 'form']);
        $this->kategoriModel = new KategoriModel();
        $this->session = session();
        
    }

    public function index()
    {
         if (!session()->has('login_session')) {
            return redirect()->to('login');
        }
        $data = [
            'title' => 'Kategori',
            'kategori' => $this->kategoriModel->get_kategori()
        ];

        echo view('template/header', $data);
        echo view('kategori/index');
        echo view('template/footer');
    }

    public function proses_tambah()
    {
        $kode = $this->kategoriModel->buat_kode();
        $head_kategori = $this->request->getPost('head_kategori');
        $sub = $this->request->getPost('sub_kategori');
        $kepala = $this->kategoriModel->buat_kode();

        $data = [
            'id_kategori' => $kode,
            'head_kategori' => $head_kategori,
            'sub_kategori' => $sub,
            'kode_kategori' => $kepala
        ];

        $this->kategoriModel->tambah_data($data, 'kategori');
        $this->setFlashSuccess('Berhasil ditambahkan!');
        return redirect()->to('/kategori');
    }

    public function proses_tambah_sub()
    {
        $kode = $this->kategoriModel->buat_kode();
        $head_kategori = $this->request->getPost('head_kategori');
        $sub_kategori = $this->request->getPost('sub_kategori');

        $data = [
            'id_kategori' => $kode,
            'head_kategori' => $head_kategori,
            'sub_kategori' => $sub_kategori,
        ];

        $this->kategoriModel->tambah_data($data, 'kategori');
        $this->setFlashSuccess('Sub Kategori Berhasil ditambahkan!');
        return redirect()->to('/kategori');
    }

    public function proses_ubah_sub()
    {
        $kode = $this->request->getPost('id_kategori');
        $head_kategori = $this->request->getPost('head_kategori');
        $sub_kategori = $this->request->getPost('sub_kategori');

        $data = [
            'head_kategori' => $head_kategori,
            'sub_kategori' => $sub_kategori
        ];
        $where = ['id_kategori' => $kode];

        $this->kategoriModel->ubah_data($where, $data, 'kategori');
        $this->setFlashSuccess('Berhasil diubah!');
        return redirect()->to('/kategori');
    }

    public function ubah_kategori()
    {
        $sebelumnya = $this->request->getPost('sebelumnya');
        $new_head_kategori = $this->request->getPost('head_kategori');

        $result = $this->kategoriModel->upgrade_kategori($sebelumnya, $new_head_kategori, 'kategori');

        if ($result) {
            $this->setFlashSuccess('Berhasil diubah!');
        } else {
            $this->setFlashError('Gagal diubah!');
        }

        return redirect()->to('/kategori');
    }

    public function proses_ubah()
    {
        $sebelumnya = $this->request->getPost('head_kategori');
        $kategori = $this->request->getPost('kategori');

        $data = ['head_kategori' => $kategori];
        $where = ['head_kategori' => $sebelumnya];

        $this->kategoriModel->ubah_data($where, $data, 'kategori');
        $this->setFlashSuccess('Berhasil diubah!');
        return redirect()->to('/kategori');
    }

    public function proses_hapus_sub($id)
    {
        $where = ['id_kategori' => $id];
        $this->kategoriModel->hapus_data($where, 'kategori');
        $this->setFlashSuccess('Berhasil dihapus!');
        return redirect()->to('/kategori');
    }

    public function proses_hapus($id)
    {
        $decoded = urldecode($id);
        $where = ['head_kategori' => $decoded];
        $this->kategoriModel->hapus_data($where, 'kategori');
        $this->setFlashSuccess('Berhasil dihapus!');
        return redirect()->to('/kategori');
    }

 public function getData()
    {
        $id = $this->request->getPost('id');
        $where = ['id_kategori' => $id];
        $query = $this->kategoriModel->detail_data($where, 'kategori');
        $data = $query->getResult(); 
        return $this->response->setJSON($data);
    }

    private function setFlashSuccess($message)
    {
        $this->session->setFlashdata('Pesan', '
            <script>
            $(document).ready(function() {
                Swal.fire({
                    title: "' . $message . '",
                    icon: "success",
                    confirmButtonColor: "#4e73df",
                });
            });
            </script>
        ');
    }

    private function setFlashError($message)
    {
        $this->session->setFlashdata('Pesan', '
            <script>
            $(document).ready(function() {
                Swal.fire({
                    title: "' . $message . '",
                    icon: "error",
                    confirmButtonColor: "#8888",
                });
            });
            </script>
        ');
    }
}
