<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Views Rendering
$routes->get('/users', 'UserController::index');
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('/users', 'UserController::index');
});


// Api Routes
$routes->group('api', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('users', 'UserController::fetchAll');
    $routes->post('user/create', 'UserController::create');
    $routes->delete('user/(:segment)', 'UserController::delete/$1');
    $routes->get('user/edit/(:segment)', 'UserController::show/$1');
    $routes->post('user/update/(:segment)', 'UserController::update/$1');

});

