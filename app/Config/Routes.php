<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');


$routes->group('produk', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1', ['filter' => 'auth']);
    $routes->get('delete/(:any)', 'ProdukController::delete/$1', ['filter' => 'auth']);
    $routes->get('download', 'ProdukController::download');
});

$routes->group('keranjang', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'TransaksiController::index');
    $routes->post('', 'TransaksiController::cart_add');
    $routes->post('edit', 'TransaksiController::cart_edit');
    $routes->get('delete/(:any)', 'TransaksiController::cart_delete/$1');
    $routes->get('clear', 'TransaksiController::cart_clear');
});

$routes->get('transaksi/cetak/(:num)', 'TransaksiController::cetak/$1', ['filter' => 'auth']);

$routes->get('checkout', 'TransaksiController::checkout');
$routes->get('getcity', 'TransaksiController::getcity');
$routes->get('getcost', 'TransaksiController::getcost');
$routes->post('buy', 'TransaksiController::buy');

$routes->get('profile', 'Home::profile', ['filter' => 'auth']);
$routes->get('api', 'ApiController::index');

$routes->group('api', function ($routes) {
    $routes->post('monthly', 'ApiController::monthly');
});