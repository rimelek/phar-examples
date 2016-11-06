<?php

Phar::webPhar('self.phar', 'welcome', '404.php', [], function ($uri) {
    $path = parse_url($uri, PHP_URL_PATH);
    $realUri = filter_input(INPUT_SERVER, 'REQUEST_URI');
    $realPath = parse_url($realUri, PHP_URL_PATH);

    $diffPath = substr($realPath, 0, -strlen($path));

    define('BASE_URL', $diffPath);


    $routing = [
        '/welcome' => 'index.php',
    ];

    foreach ($routing as $pattern => $destination) {
        if (preg_match('#^' . $pattern . '$#', $path)) {
            return $destination;
        }
    }

    return $path;
});

echo 'Can you see me?';

__HALT_COMPILER();
?>