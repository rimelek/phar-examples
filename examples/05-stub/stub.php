<?php

spl_autoload_register(function ($class) {
    $file = 'phar://' . __FILE__ . '/' . str_replace(['\\', '_'], '/', $class) . '.php';
    if (is_file($file)) {
        require $file;
    }
});

__HALT_COMPILER();
?>