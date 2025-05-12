<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class User extends Controller
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        helper(['url', 'download', 'cookie', 'form']);
        $this->userModel = new UserModel();
        $this->session = session();
    }

    public function index()
    {
        $data = [
            'title' => 'User',
            'user' => $this->userModel->data()->getResult()
        ];

        echo view('template/header', $data);
        echo view('user/index');
        echo view('template/footer');
    }

    public function proses_ubah()
    {
        $kode      = $this->request->getPost('iduser');
        $user      = $this->request->getPost('user');
        $level     = $this->request->getPost('level');
        $pass      = $this->request->getPost('pwd');
        $passLama  = $this->request->getPost('pwdLama');

        $passUpdate = ($pass === '') ? $passLama : md5($pass);

        $data = [
            'username' => $user,
            'level'    => $level,
            'password' => $passUpdate
        ];

        $this->userModel->ubah_data(['id_user' => $kode], $data, 'user');

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

        return redirect()->to('/user');
    }
}
