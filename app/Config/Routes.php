<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// $routes->group('api', function ($routes) {
    $routes->get('/tasks', 'TaskController::index');
    $routes->get('/tasks/(:num)', 'TaskController::show/$1');
    $routes->post('/tasks', 'TaskController::store');
    $routes->put('/tasks/(:num)', 'TaskController::update/$1');
    $routes->delete('/tasks/(:num)', 'TaskController::delete/$1');
    $routes->post('/tasks/action', 'TaskController::action');
// });
