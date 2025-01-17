<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->get('/documento', 'Inicio::index');
$routes->get('qr-code/(:any)', 'QrCodeController::generate/$1');





