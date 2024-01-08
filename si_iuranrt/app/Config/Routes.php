<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Page::dashboard');


$routes->get('/dashboard', 'Page::dashboard');
$routes->get('/login', 'Page::login');
$routes->get('/register', 'Page::register');

//------------------------------------------
$routes->get('/warga', 'Warga::index');
$routes->add('/warga/add', 'Warga::addwarga');
$routes->post('/warga/save', 'Warga::save');
$routes->get('/warga/edit/(:num)', 'Warga::edit/$1');
$routes->add('/warga/update/(:num)', 'Warga::update/$1');
$routes->get('/warga/delete/(:num)', 'Warga::delete/$1');

//------AUTO COMPLETE DATA WARGA--------
$routes->get("search", "SearchController::index", ["as" => "search"]);
$routes->get("autocomplete", "Iuran::autocomplete", ["as" => "autocomplete"]);
//------------------------------------------
$routes->get('/iuran', 'Iuran::index');
$routes->add('/iuran/add', 'Iuran::addiuran');
$routes->post('/iuran/save', 'Iuran::save');
$routes->get('/iuran/edit/(:num)', 'Iuran::editiuran/$1');
$routes->add('/iuran/update/(:num)', 'Iuran::updateiuran/$1');
$routes->get('/iuran/delete/(:num)', 'Iuran::deleteiuran/$1');

//----------------LAPORAN--------------------------
$routes->get('/unpaid', 'Laporan::unpaid');
$routes->add('/unpaid/checks', 'Laporan::checks');

//----------------LAPORAN--------------------------
$routes->get('/kas', 'Page::kas');
$routes->get('/about-siforate', 'Page::aboutsiforate');
$routes->get('/about-dev', 'Page::aboutdev');
$routes->get('/thank-you', 'Page::thanks');


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