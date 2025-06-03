<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/App/Core/Router.php';

use App\Core\Router;

$router = new Router();

$router->add('GET', '/vehicules', 'App\Controllers\CourseController', 'index');
$router->add('GET', '/vehicules/show/{id}', 'App\Controllers\CourseController', 'get');
$router->add('POST', '/vehicules/store', 'App\Controllers\VehiculeController', 'store');

$router->dispatch();
