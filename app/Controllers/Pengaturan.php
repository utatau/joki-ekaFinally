<?php

namespace App\Controllers;

use App\Models\PengaturanModel;
use CodeIgniter\Controller;

class Pengaturan extends Controller
{
    protected $pengaturanModel;
    protected $session;

    public function __construct()
    {
        helper(['url', 'form', 'cookie']);
        $this->pengaturanModel = new PengaturanModel();
        $this->session = session();
    }

    public function index()
    {
        $data = [
            'title' => 'Pengaturan',
            'user' => $this->pengaturanModel->data()->getResult()
        ];

        echo view('template/header', $data);
        echo view('pengaturan/index');
        echo view('template/footer');
    }

public function ubah($id)
{
    $data = [
        'title' => 'Pengaturan',
        'user' => $this->pengaturanModel->detail_data(['id_user' => $id], 'user')->getResult()
    ];

    echo view('template/header', $data);
    echo view('pengaturan/index', $data);
    echo view('template/footer');
}








    public function proses_ubah()
    {
        $user = $this->request->getPost('user');
        $kode = $this->request->getPost('iduser');
        $pass = $this->request->getPost('pwd');
        $passLama = $this->request->getPost('pwdLama');

        $passUpdate = $pass === '' ? $passLama : md5($pass);

        $data = [
            'username' => $user,
            'password' => $passUpdate
        ];

        $this->pengaturanModel->ubah_data(['id_user' => $kode], $data, 'user');

        $this->session->setFlashdata('Pesan', '
            <script>
            $(document).ready(function() {
                swal.fire({
                    title: "Berhasil diubah!",
                    icon: "success",
                    confirmButtonColor: "#4e73df",
                });
            });
            </script>
        ');

        return redirect()->to('/home');
    }
}
