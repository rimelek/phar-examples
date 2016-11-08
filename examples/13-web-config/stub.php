<?php

$configPath = __DIR__ . '/config.php';

if (is_file($configPath)) {
    Phar::mount('config.php', $configPath);
}
Phar::webPhar('self.phar', 'welcome', '404.php', [], function ($uri) use($configPath) {


    $path = parse_url($uri, PHP_URL_PATH);

    $routing = [
        '/welcome' => 'index.php',
        '/config\.php' => false,
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