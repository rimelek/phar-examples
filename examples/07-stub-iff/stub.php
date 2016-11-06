<?php

if (!filter_input(INPUT_GET, 'external')) {
    Phar::interceptFileFuncs();
}

echo 'STUB: ' . file_get_contents('file.txt') . '<br />';

require 'phar://' . __FILE__ . '/index.php';

__HALT_COMPILER();
?>