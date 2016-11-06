<?php

$pharName = basename(__DIR__) . '.phar.php';

if (!file_exists($pharName)) {
    $phar = new Phar($pharName);
    $phar->setStub(Phar::createDefaultStub());
    $phar->buildFromDirectory('src');
}

require $pharName;