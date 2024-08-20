<?php

use Responses\JsonResponse;
require_once "init.php";
session_start();
require_once "utils.php";
$route = new Route();
require_once "routes.php";

try {
    $route->findAndExecute(new RouteDTO($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']));
} catch (Exception $e) {
    return new JsonResponse(['success' => false, 'error' => $e->getMessage()], $e->getCode());
}

