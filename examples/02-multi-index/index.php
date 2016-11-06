<?php

$pharName = basename(__DIR__) . '.phar.php';

if (!file_exists($pharName)) {
    $phar = new Phar($pharName);
    $phar->setStub(Phar::createDefaultStub('cli-index.php', 'web-index.php'));
    $phar->buildFromDirectory('src');

}

require $pharName;