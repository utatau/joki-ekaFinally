<?php

namespace App\Controllers;

use App\Models\LoginModel;
use CodeIgniter\Controller;

class Login extends Controller
{
    protected $loginModel;
    protected $session;

    public function __construct()
    {
        helper('url');

        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $this->loginModel = new LoginModel();
        $this->session = $session;
        $this->request = $request;
    }

    public function index()
    {
        if (session()->has('login_session')) {
            return redirect()->to('/home');
        }

        $data = [
            'validation' => \Config\Services::validation(),
        ];
        echo view('template/header_login', $data);
        echo view('login/index');
        echo view('template/footer_login');
    }

    public function proses_login()
    {
        $username = $this->request->getPost('user');
        $password = md5($this->request->getPost('pwd'));

        $where = ['username' => $username, 'password' => $password];
        $user = $this->loginModel->cek_login($where, 'user');

        if ($user) {
            $userdata = [
                'id_user' => $user->id_user,   
                'level' => $user->level
            ];

            session()->set('login_session', $userdata);

            return $this->response->setJSON(['respon' => 'success']);
        } else {
            return $this->response->setJSON(['respon' => 'failed']);
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
