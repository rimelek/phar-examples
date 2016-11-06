<?php

spl_autoload_register(function ($class) {
    $file = __DIR__ . DIRECTORY_SEPARATOR . str_replace(['\\', '_'], DIRECTORY_SEPARATOR, $class) . '.php';
    if (is_file($file)) {
        require $file;
    }
});