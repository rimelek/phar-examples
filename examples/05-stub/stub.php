<?php

spl_autoload_register(function ($class) {
    $file = 'phar://' . __FILE__ . DIRECTORY_SEPARATOR . str_replace(['\\', '_'], DIRECTORY_SEPARATOR, $class) . '.php';
    if (is_file($file)) {
        require $file;
    }
});

__HALT_COMPILER();
?>