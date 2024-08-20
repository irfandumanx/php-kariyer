<?php

class EnvLoader
{
    private static $instance = null;

    private function __construct($filePath) {
        if (!file_exists($filePath)) {
            throw new Exception(".env dosyası bulunamadı: $filePath");
        }

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            if (str_starts_with(trim($line), '#')) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (preg_match('/^"(.*)"$/', $value, $matches)) {
                $value = $matches[1];
            } elseif (preg_match("/^'(.*)'$/", $value, $matches)) {
                $value = $matches[1];
            }

            $_ENV[$name] = $value;
        }
    }

    public static function load($filePath): void
    {
        if (self::$instance === null) {
            self::$instance = new EnvLoader($filePath);
        }
    }
}