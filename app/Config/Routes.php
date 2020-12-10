<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// Home
$routes->get('/', 'Home::index');
// Kegiatan
$routes->get('/kegiatan', 'Kegiatan::kegiatan');
$routes->get('/kegiatan/lama', 'Kegiatan::kegiatanLama');
$routes->get('/kegiatan/aktif', 'Kegiatan::kegiatanAktif');
$routes->get('/kegiatan/pasif', 'Kegiatan::kegiatanPasif');
$routes->get('/kegiatan/(:segment)', 'Kegiatan::detail/$1');
$routes->get('/kegiatan/kegiatan/(:segment)', 'Kegiatan::detail/$1');
$routes->get('/kegiatanku', 'Kegiatan::kegiatanku');
$routes->get('/kegiatanbaru', 'Kegiatan::kegiatanbaru');
$routes->get('/editkegiatan/(:segment)', 'Kegiatan::editkegiatan/$1');
$routes->get('/hapuskegiatan/(:num)', 'Kegiatan::hapuskegiatan/$1');
// Berita
$routes->get('/berita', 'Home::berita');
$routes->get('/beritaku', 'Auth::beritaku');
// Ekstra
$routes->get('/ekstra', 'Home::ekstra');
$routes->get('/ekstraku', 'Auth::ekstraku');
// Tentang Kami
$routes->get('/tentangkami', 'Home::tentang');
// Auth
$routes->get('/login', 'Auth::index');
$routes->get('/logout', 'Auth::logout');
$routes->get('/daftar', 'Auth::daftar');
$routes->get('/forgot', 'Auth::forgot');
$routes->get('/profil', 'Auth::profil');
$routes->get('/pengumuman', 'Auth::pengumuman');
$routes->get('/hapuspengumuman/(:num)', 'Auth::hapuspengumuman/$1');
$routes->get('/kirimpesan', 'Auth::kirimpesan');
$routes->get('/pesanmasuk', 'Auth::pesanmasuk');
$routes->get('/pesankeluar', 'Auth::pesankeluar');
$routes->get('/detailpesan/(:num)', 'Auth::detailpesan/$1');
$routes->get('/ubahpassword', 'Auth::ubahpassword');
$routes->get('/myprofile', 'Auth::myprofile');
$routes->get('/verify', 'Auth::verify');



/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
