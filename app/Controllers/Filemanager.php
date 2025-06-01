<?php

namespace App\Controllers;

use App\Models\DokumenModel;
use App\Models\FilemanagerModel;
use CodeIgniter\Controller;

class Filemanager extends Controller
{
    protected $dokumenModel;
    protected $filemanagerModel;

    public function __construct()
    {
        $this->session = session();
        $this->request =  \Config\Services::Request();
        $this->dokumenModel = new DokumenModel();
        $this->filemanagerModel = new FilemanagerModel();
    }

    public function index()
    {
        if (!session()->has('login_session')) {
            return redirect()->to('login');
        }
        $dokumen = $this->dokumenModel->dataJoin();
        $data = [
            'title' => 'File',
            'dokumen' => $dokumen
        ];

        echo view('template/header', $data);
        echo view('filemanager/index');
        echo view('template/footer');
    }

    public function detail($id)
{
    $dokumen = $this->filemanagerModel->dataJoinById($id);

    if (!$dokumen) {
        echo "Dokumen tidak ditemukan untuk ID: $id";
        die;
    }

    $data = [
        'title' => 'File',
        'dokumen' => $dokumen
    ];

    echo view('template/header', $data);
    echo view('filemanager/detail');
    echo view('template/footer');
}



    public function getData()
    {
        $id = $this->request->getPost('id');
        $data = $this->dokumenModel
            ->detail_data(['id_dokumen' => $id], 'dokumen')
            ->getResult();

        return $this->response->setJSON($data);
    }

    public function getFilemanager()
    {
        try {
            $data = $this->filemanagerModel->dataJoin()->getResult();
            return $this->response->setJSON($data);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(500)
                                  ->setJSON(['error' => $e->getMessage()]);
        }
    }

    public function filterFilemanager($tglawal, $tglakhir)
    {
        try {
            $data = $this->filemanagerModel->lapdata($tglawal, $tglakhir)->getResult();
            return $this->response->setJSON($data);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(500)
                                  ->setJSON(['error' => $e->getMessage()]);
        }
    }

}
