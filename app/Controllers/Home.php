<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DokumenModel;
use App\Models\KategoriModel;
use CodeIgniter\Controller;

class Home extends Controller
{
    protected $userModel;
    protected $dokumenModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->dokumenModel = new DokumenModel();
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
       
        // $jmlDM = count($this->dokumenModel->dataJoinLike());
        // $jmlKT = count($this->kategoriModel->dataJoinLike());
        if (!session()->has('login_session')) {
            return redirect()->to('login');
        }
        $data = [
            'title' => 'Dashboard',
            'jmlDokumen' => count($this->dokumenModel->dataJoin()),
            'jmlKategori' => count($this->kategoriModel->dataJoin()),
            'jmlUser' => count($this->userModel->data()),
            'yearnow' => date('Y', strtotime('+0 year')),
            'previousyear' => date('Y', strtotime('-1 year')),
            'twoyearago' => date('Y', strtotime('-2 year')),
           
        ];
        // $uta =[
        //      'jmldm' => $jmlDM,
        //     'jmlkt' => $jmlKT
        // ];

        echo view('template/header', $data);
        echo view('home/index');
        echo view('template/footer');
    }

public function getTotalTransaksi()
{
    $jmlDM = $this->dokumenModel->dataJoinLike();
    $jmlKT = $this->kategoriModel->dataJoinLike();

    $data = [
        'jmldm' => $jmlDM,
        'jmlkt' => $jmlKT
    ];
    
    return $this->response->setJSON($data);
}



    public function getFilterTahun()
    {
        $tahun = $this->request->getPost('tahun');

        // Data per bulan
        $months = [
            'Januari' => 'January',
            'Februari' => 'February',
            'Maret' => 'March',
            'April' => 'April',
            'Mei' => 'May',
            'Juni' => 'June',
            'Juli' => 'July',
            'Agustus' => 'August',
            'September' => 'September',
            'Oktober' => 'October',
            'November' => 'November',
            'Desember' => 'December',
        ];

        $data = [];
        foreach ($months as $indonesia => $english) {
            $lastDate = date('Y-m-t', strtotime("$tahun-$english-01"));
            $firstDate = date('Y-m-01', strtotime("$tahun-$english-01"));
            
            $dm = $this->dokumenModel->jmlperbulan($firstDate, $lastDate)->getNumRows();
            $kt = $this->kategoriModel->jmlperbulan($firstDate, $lastDate)->getNumRows();
            
            $data["dm$indonesia"] = $dm;
            $data["k$indonesia"] = $kt;
        }

        return $this->response->setJSON($data);
    }
}
