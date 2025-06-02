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
        if (!session()->has('login_session')) {
            return redirect()->to('login');
        }
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
        $passl = $this->request->getPost('kpwd');
        $passLama = $this->request->getPost('pwdLama');

        $passUpdate = $pass === '' ? $passLama : md5($pass);
        
        $data = [
            'username' => $user,
            'password' => $passUpdate
        ];
        
        $this->pengaturanModel->ubah_data(['id_user' => $kode], $data, 'user');
        if($pass == $passl){
        $this->session->setFlashdata('Pesan', $this->successAlert('Password berhasil diubah!'));
        } else if($pass != $passl) {
            $this->session->setFlashdata('Pesan', $this->failAlert('Konfirmasi password tidak sesuai!'));
        } else if ($pass == '' || $pass1 == ''){
            $this->session->setFlashdata('Pesan', $this->failAlert('Password tidak boleh kosong'));
        }
       
        return redirect()->to('/pengaturan/ubah/'.$kode);
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
    private function failAlert($message)
    {
        return "<script>
            $(document).ready(function() {
                swal.fire({
                    title: \"$message\",
                    icon: \"error\",
                    confirmButtonColor: \"#e74a3b\",
                });
            });
        </script>";
    }
}

