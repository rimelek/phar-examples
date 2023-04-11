<?php

use Rimelek\PharExample\Example06\PHPInfo;

$pharName = __DIR__ . '/../../output/' . basename(__DIR__) . '/example.phar.php';

if (!file_exists($pharName)) {
    mkdir(dirname($pharName), 0755);
    $phar = new Phar($pharName);
    $phar->setStub(file_get_contents(__DIR__ . '/stub.php'));
    $phar->buildFromDirectory('src');
}

require $pharName;

$phpinfo = new PHPInfo(INFO_VARIABLES);

$phpinfo->run();