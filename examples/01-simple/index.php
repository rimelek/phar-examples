<?php

$pharName = __DIR__ . '/../../output/' . basename(__DIR__) . '/example.phar.php';

if (!file_exists($pharName)) {
    mkdir(dirname($pharName), 0755);
    $phar = new Phar($pharName);
    $phar->setStub(Phar::createDefaultStub());
    $phar->buildFromDirectory('src');
}

require $pharName;