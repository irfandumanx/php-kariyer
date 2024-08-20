<?php

global $route;

use Controllers\AdminController;
use Controllers\AdvertController;
use Controllers\IndexController;
use Controllers\LoginRegisterController;

$route->get("/", IndexController::class, "index");

$route->match(['GET', 'POST'], '/login', LoginRegisterController::class, 'login');
$route->match(['GET', 'POST'], '/register', LoginRegisterController::class, 'register');
$route->get("/logout", LoginRegisterController::class, 'logout');

$route->match(['GET', 'POST'], '/advert/create', AdvertController::class, 'create');
$route->get('/advert/appeal', AdvertController::class, 'appeal');
$route->get('/advert/submissions', AdvertController::class, 'submissions');


$route->get('/admin', AdminController::class, 'index');