<?php

$pharName = __DIR__ . '/../../output/' . basename(__DIR__) . '/example.phar.php';

if (!file_exists($pharName)) {
    $outputDir = dirname($pharName);
    mkdir($outputDir, 0755);
    copy(__DIR__ . '/config.php', $outputDir . '/config.php');
    
    $phar = new Phar($pharName);
    $phar->setStub(file_get_contents(__DIR__ . '/stub.php'));
    $phar->buildFromDirectory('src');
}

require $pharName;