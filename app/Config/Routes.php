<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ImportController::index');
$routes->post('upload', 'ImportController::upload');