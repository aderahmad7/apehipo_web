<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'admin::index', ['filter' => 'login']);

$routes->get('/home', 'admin::index', ['filter' => 'login']);


// API

// dashboard
$routes->resource('dashboard');
$routes->post('dashboard/cari/(:any)', 'Dashboard::cari/$1');

// auth
$routes->resource('auth');
$routes->post('auth/register', 'Auth::register');

// auth
$routes->resource('account');
$routes->post('account/ubah/(:any)', 'Account::update/$1');
// $routes->post('auth/register', 'Auth::register');

// product
$routes->resource('product');
$routes->post('product/status/(:any)', 'Product::ubah/$1');
$routes->post('product/ubah/(:any)', 'Product::update/$1');

$routes->get('/pay', 'Payment::index');

// Order
$routes->resource('order');
$routes->post('order/status/(:any)', 'Order::ubah/$1');
$routes->post('order/bukti/(:any)', 'Order::kirimGambar/$1');
// $routes->post('/', 'Product')

// transaksi
$routes->resource('transaksi');
$routes->post('transaksi/status/(:any)', 'Transaksi::ubah/$1');

// notifikasi
$routes->resource('notifikasi');
$routes->post('notifikasi/status/(:any)', 'Notifikasi::ubah/$1');

// kelola kebun
$routes->resource('kelola_kebun');

// kebun
$routes->resource('kebun');
$routes->get('kebun/(:segment)', 'Kebun::show/$1');
$routes->post('kebun/addKebun/(:any)', 'Kebun::addKebun/$1');
$routes->post('kebun/edit/(:any)', 'Kebun::edit/$1');
$routes->post('kebun/delete/(:any)', 'Kebun::delete/$1');

// modul
$routes->resource('modul');
$routes->get('modul/(:segment)', 'modul::show/$1');
$routes->post('modul/addModul/(:any)', 'modul::addModul/$1');
$routes->post('modul/edit/(:any)', 'modul::edit/$1');
$routes->post('modul/delete/(:any)', 'modul::delete/$1');

// semai
$routes->resource('semai');
$routes->post('semai/createSemai/(:any)', 'Semai::createSemai/$1');
$routes->post('semai/edit/(:any)', 'Semai::edit/$1');
$routes->post('semai/delete/(:any)', 'Semai::delete/$1');
$routes->post('semai/toTanam/(:any)', 'Semai::toTanam/$1');
$routes->post('semai/search', 'Semai::search');

// tanam
$routes->resource('tanam');
$routes->post('tanam/toPanen/(:any)', 'Tanam::toPanen/$1');
$routes->post('tanam/manage/(:any)', 'Tanam::manage/$1');
$routes->post('tanam/search', 'Tanam::search');
$routes->post('tanam/searchTgl', 'Tanam::searchTgl');

// panen
$routes->resource('panen');
$routes->post('panen/search', 'Panen::search');

// report
$routes->resource('report');

// rumah
$routes->resource('rumah');
$routes->get('rumah/(:segment)', 'Rumah::show/$1');
$routes->post('rumah/createRumah/(:any)', 'Rumah::createRumah/$1');
$routes->post('rumah/edit/(:any)', 'Rumah::edit/$1');
$routes->post('rumah/delete/(:any)', 'Rumah::delete/$1');

// monitoring
$routes->resource('monitoring');
$routes->get('monitoring/(:segment)/(:segment)', 'Monitoring::show/$1/$2');
$routes->post('monitoring/createMonitoring/(:any)', 'Monitoring::createMonitoring/$1');
$routes->post('monitoring/edit/(:any)', 'Monitoring::edit/$1');

// BACKEND - FRONTEND
// admin - dashboard
$routes->resource('admin', ['filter' => 'login']);
// $routes->resource('admin');
$routes->post('admin/status/(:any)', 'Admin::ubahStatus/$1');


// kelola produk
$routes->resource('kelola_produk', ['filter' => 'login']);
$routes->post('kelola_produk/delete/(:any)', 'Kelola_produk::delete/$1');
$routes->post('kelola_produk/ubah/(:any)', 'Kelola_produk::update/$1');


// kelola user
$routes->resource('kelola_user', ['filter' => 'login']);
$routes->post('kelola_user/ubah/(:any)', 'Kelola_user::update/$1');
$routes->post('kelola_user/delete/(:any)', 'Kelola_user::delete/$1');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
