<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('SetAccess');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'SetAccess::index', ['filter' => 'authGuard']);

$routes->get('setusermanagement', 'SetUserManagement::index', ['filter' => 'authGuard']);
$routes->get('setusermanagement/new', 'SetUserManagement::insert', ['filter' => 'authGuard']);
$routes->post('setusermanagement/new', 'SetUserManagement::insert_save', ['filter' => 'authGuard']);
$routes->get('setusermanagement/(:hash)', 'SetUserManagement::update/$1', ['filter' => 'authGuard']);
$routes->post('setusermanagement/(:hash)', 'SetUserManagement::update_save/$1', ['filter' => 'authGuard']);
$routes->get('setusermanagement/(:hash)/delete', 'SetUserManagement::delete/$1', ['filter' => 'authGuard']);
$routes->get('setusermanagement/reset/(:hash)', 'SetUserManagement::pass_reset/$1');
$routes->post('setusermanagement/reset/(:hash)', 'SetUserManagement::pass_reset_process/$1');
$routes->get('setusermanagement/resetself/(:hash)', 'SetUserManagement::pass_reset_self/$1');
$routes->post('setusermanagement/resetself/(:hash)', 'SetUserManagement::pass_reset_process_self/$1');
$routes->get('setusermanagement/apv/(:hash)', 'SetUserManagement::approval/$1');
$routes->post('setusermanagement/apv/(:hash)', 'SetUserManagement::approval_process/$1');

$routes->get('setgroup', 'SetGroup::index', ['filter' => 'authGuard']);
$routes->get('setgroup/new', 'SetGroup::insert', ['filter' => 'authGuard']);
$routes->post('setgroup/new', 'SetGroup::insert_save', ['filter' => 'authGuard']);
$routes->get('setgroup/(:hash)', 'SetGroup::update/$1', ['filter' => 'authGuard']);
$routes->post('setgroup/(:hash)', 'SetGroup::update_save/$1', ['filter' => 'authGuard']);
$routes->get('setgroup/access/(:hash)', 'SetGroup::access/$1', ['filter' => 'authGuard']);
$routes->post('setgroup/access/(:hash)', 'SetGroup::access_process/$1', ['filter' => 'authGuard']);
$routes->get('setgroup/(:hash)/delete', 'SetGroup::delete/$1', ['filter' => 'authGuard']);

$routes->get('setaccess', 'SetAccess::index', ['filter' => 'authGuard']);
$routes->get('setaccess/new', 'SetAccess::insert', ['filter' => 'authGuard']);
$routes->post('setaccess/new', 'SetAccess::insert_save', ['filter' => 'authGuard']);
$routes->get('setaccess/(:hash)', 'SetAccess::update/$1', ['filter' => 'authGuard']);
$routes->post('setaccess/(:hash)', 'SetAccess::update_save/$1', ['filter' => 'authGuard']);
$routes->get('setaccess/(:hash)/delete', 'SetAccess::delete/$1', ['filter' => 'authGuard']);

$routes->get('setsystemprofile', 'SetSystemProfile::index', ['filter' => 'authGuard']);
$routes->get('setsystemprofile/new', 'SetSystemProfile::insert', ['filter' => 'authGuard']);
$routes->post('setsystemprofile/new', 'SetSystemProfile::insert_save', ['filter' => 'authGuard']);
$routes->get('setsystemprofile/(:hash)', 'SetSystemProfile::update/$1', ['filter' => 'authGuard']);
$routes->post('setsystemprofile/(:hash)', 'SetSystemProfile::update_save/$1', ['filter' => 'authGuard']);
$routes->get('setsystemprofile/(:hash)/delete', 'SetSystemProfile::delete/$1', ['filter' => 'authGuard']);
$routes->get('setsystemprofile/upload/(:hash)', 'SetSystemProfile::upload/$1', ['filter' => 'authGuard']);
$routes->post('setsystemprofile/upload/(:hash)', 'SetSystemProfile::upload_save/$1', ['filter' => 'authGuard']);
$routes->get('setsystemprofile/upload/(:hash)/delete', 'SetSystemProfile::image_delete/$1', ['filter' => 'authGuard']);

// Auth
$routes->get('signin', 'Auth::login');
$routes->post('signin', 'Auth::login_process');
$routes->get('login', 'Auth::login_process');
$routes->get('logout', 'Auth::logout');

$routes->get('signin2', 'Auth::login2');
$routes->post('signin2', 'Auth::login_process2');
$routes->get('logout2', 'Auth::logout2');

$routes->get('forgot', 'Auth::pass_forgot');
$routes->post('forgot', 'Auth::pass_forgot_process');

$routes->get('reset/(:any)', 'Auth::pass_reset/$1');
$routes->post('reset', 'Auth::pass_reset_process');

// Activate User
$routes->get('activate_user/(:hash)', 'Auth::activate_user/$1');

$routes->get('unauthorized', function () {
    return view('errors/html/401');
});



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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
