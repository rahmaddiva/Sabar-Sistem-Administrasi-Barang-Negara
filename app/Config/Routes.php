<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Auth routes (no filter)
$routes->get('/', 'AuthController::login');
$routes->get('login', 'AuthController::login');
$routes->get('register', 'AuthController::register');
$routes->post('proses-login', 'AuthController::proses_login');
$routes->post('proses-register', 'AuthController::proses_register');
$routes->get('logout', 'AuthController::logout');

// Protected routes (with auth filter)
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'DashboardController::index');

    // routes user management
    $routes->get('kelola-user', 'UsersController::index');
    $routes->post('proses-user', 'UsersController::proses_user');
    $routes->post('update-user/(:num)', 'UsersController::update_user/$1');
    $routes->get('hapus-user/(:num)', 'UsersController::delete_user/$1');

    // routes barang management
    $routes->get('kelola-barang', 'BarangController::index');
    $routes->get('tambah-barang', 'BarangController::tambah');
    $routes->post('proses-barang', 'BarangController::proses_barang');
    $routes->get('detail-barang/(:num)', 'BarangController::detail/$1');
    $routes->get('edit-barang/(:num)', 'BarangController::edit/$1');
    $routes->post('update-barang/(:num)', 'BarangController::update/$1');
    $routes->post('delete-barang/(:num)', 'BarangController::delete/$1');
    $routes->get('export-pdf', 'BarangController::export_pdf');
    $routes->get('export-excel', 'BarangController::export_excel');

    // routes kategori management
    $routes->get('kelola-kategori', 'KategoriController::index');
    $routes->post('proses-kategori', 'KategoriController::proses_kategori');
    $routes->post('update-kategori/(:num)', 'KategoriController::update_kategori/$1');
    $routes->get('delete-kategori/(:num)', 'KategoriController::delete_kategori/$1');

    // routes lokasi management
    $routes->get('kelola-lokasi', 'LokasiController::index');
    $routes->post('proses-lokasi', 'LokasiController::proses_lokasi');
    $routes->post('update-lokasi/(:num)', 'LokasiController::update_lokasi/$1');
    $routes->get('delete-lokasi/(:num)', 'LokasiController::delete_lokasi/$1');

    // routes master data
    $routes->get('aset-aktif', 'MasterDataController::aset_aktif');
    $routes->get('aset-inaktif', 'MasterDataController::aset_inaktif');
    $routes->get('export-pdf-aktif', 'MasterDataController::export_pdf_aktif');
    $routes->get('export-excel-aktif', 'MasterDataController::export_excel_aktif');
    $routes->get('export-pdf-inaktif', 'MasterDataController::export_pdf_inaktif');
    $routes->get('export-excel-inaktif', 'MasterDataController::export_excel_inaktif');

});
