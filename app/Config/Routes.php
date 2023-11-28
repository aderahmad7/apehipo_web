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
$routes->get('/', 'Home::index');

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
