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

// Vista Inicio.php
$routes->get('/', 'Home::index');
$routes->get('/contacto', 'Contacto::index');
$routes->get('/aboutme', 'AboutMe::index');

//Reservas
$routes->get('/reservas/disponibilidad', 'ReservasController::mostrarDisponibilidad');
$routes->get('/reservas/confirmacion', 'ReservasController::confirmacion');
$routes->post('/reservas/reservar', 'ReservasController::reservar');
$routes->post('/reservas/reservar', 'ReservasController::reservar');
$routes->get('/confirmacion', 'ReservasController::confirmacion');
$routes->post('/reservas', 'ReservasController::reservar');

// Login y Register
$routes->get('/auth/login', 'Auth::index');
$routes->get('/auth/register', 'Auth::register');
$routes->post('auth/save', 'Auth::save');
$routes->get('/register', 'Auth::register');
$routes->post('/auth/check', 'Auth::check');
$routes->get('/auth', 'Auth::check');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/auth/logout', 'Auth::Input');
$routes->get('/inicio', 'Home::index');
$routes->get('/login', 'Auth::index');  
$routes->get('/dashboard/profile', 'Dashboard::profile');

// Renderiza a la vista 
$routes->group('', ['Filters' => 'AuthCheckFilter'], function ($routes) {
    $routes->get('/dashboard', 'Dashboard::index');
    $routes->get('/dashboard/profile', 'Dashboard::profile');
    
    
    $routes->group('', ['Filters' => 'AlreadyLoggedFilter'], function ($routes) {
        $routes->get('/auth/login', 'Auth::index');
        $routes->get('/auth/register', 'Auth::index');
    });

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
