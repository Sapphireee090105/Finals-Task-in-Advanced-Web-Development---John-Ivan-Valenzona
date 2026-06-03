<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->post('submit-form', 'Home::submit');
$routes->get('profile', 'Profile::index');
$routes->post('profile/upload', 'Profile::upload');