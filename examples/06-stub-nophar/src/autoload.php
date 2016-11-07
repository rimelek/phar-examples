<?php

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . str_replace(['\\', '_'], '/', $class) . '.php';
    if (is_file($file)) {
        require $file;
    }
});