<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login');
$routes->get('dashboard', 'DashboardController::index');
$routes->post('proses-login', 'AuthController::proses_login');
$routes->post('proses-register', 'AuthController::proses_register');

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
