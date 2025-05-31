<?php 

use CodeIgniter\Router\RouteCollection; 
/**
 * @var RouteCollection $routes
 */ 
 
// home
$routes->get('/','Home::index');
$routes->get('/home','Home::index');

$routes->post('/home/getTotalTransaksi', 'Home::getTotalTransaksi');
// login
$routes->get('/login','Login::index');
$routes->post('/login/logout', 'Login::logout'); 
$routes->get('/login/logout', 'Login::logout'); 
$routes->post('/login/proses_login', 'Login::proses_login'); 


// dokumen
$routes->get('/dokumen','Dokumen::index');
$routes->post('/dokumen/proses_tambah','Dokumen::proses_tambah/$1');
$routes->post('/dokumen/proses_hapus/(:any)','Dokumen::proses_hapus/$1');
$routes->get('/dokumen/proses_hapus/(:any)','Dokumen::proses_hapus/$1');
$routes->post('/dokumen/proses_ubah','Dokumen::proses_ubah');


// kategori
$routes->get('/kategori','Kategori::index');
// kategori post
$routes->post('/kategori/proses_tambah','Kategori::proses_tambah');
$routes->post('/kategori/proses_ubah','Kategori::proses_ubah');

$routes->post('/kategori/proses_tambah_sub', 'Kategori::proses_tambah_sub');

$routes->post('/kategori/proses_hapus/(:any)','Kategori::proses_hapus/$1');
$routes->post('/kategori/proses_hapus_sub/(:any)','Kategori::proses_hapus_sub/$1');
$routes->post('/kategori/proses_ubah_sub','Kategori::proses_ubah_sub');
$routes->get('/kategori/proses_ubah_sub','Kategori::proses_ubah_sub');
// kategori get
$routes->get('/kategori/proses_hapus/(:any)','Kategori::proses_hapus/$1');
$routes->get('/kategori/proses_hapus_sub/(:any)','Kategori::proses_hapus_sub/$1');


$routes->post('/kategori/getData', 'Kategori::getData');
$routes->post('/dokumen/getData', 'Dokumen::getData');


// pengaturan
$routes->get('/pengaturan/ubah/(:any)','Pengaturan::ubah/$1');
$routes->post('/pengaturan/ubah/(:any)','Pengaturan::ubah/$1');
// ubah password
// http://localhost:8080/pengaturan/proses_ubah

$routes->get('/pengaturan/proses_ubah','Pengaturan::proses_ubah/$1');
$routes->post('/pengaturan/proses_ubah','Pengaturan::proses_ubah/$1');


// staff //
$routes->get('/filemanager','Filemanager::index');
$routes->get('/filemanager/(:any)','Filemanager::detail/$1');


// filemanager
$routes->get('/Filemanager/getFilemanager', 'Filemanager::getFilemanager');
$routes->post('/Filemanager/filterFilemanager', 'Filemanager::filterFilemanager');
$routes->get('/Filemanager/filterFilemanager/(:any)/(:any)', 'Filemanager::filterFilemanager/$1/$2');


// logout
$routes->post('/login/logout','Login::logout');
