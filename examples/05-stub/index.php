<?php

$pharName = basename(__DIR__) . '.phar.php';

if (!file_exists($pharName)) {
    $phar = new Phar($pharName);
    $phar->setStub(file_get_contents(__DIR__ . '/stub.php'));
    $phar->buildFromDirectory('src');
}

require $pharName;

$phpinfo = new \Rimelek\PharExample\Example05\PHPInfo(INFO_VARIABLES);

$phpinfo->run();