<?php

Phar::webPhar('self.phar', 'welcome', '404.php', [], function ($uri) {
    $path = parse_url($uri, PHP_URL_PATH);

    $routing = [
        '/welcome' => 'index.php',
        '/secret.txt' => false,
    ];

    return $routing[$path] ?? $path;
});

echo 'Can you see me?';

__HALT_COMPILER();
?>