<?php
declare(strict_types=1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function autoLoading($className): void
{
    $className = str_replace("\\", "/", $className);
    $file = "$className.php";
    if (!file_exists($file))
        $file = "Libraries/$className.php";
    if (file_exists($file))
        require_once $file;
}
spl_autoload_register('autoLoading');

EnvLoader::load(__DIR__ . "/.env");