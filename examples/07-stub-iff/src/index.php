<?php

echo 'INDEX: ' . file_get_contents('file.txt') . '<br />';
echo 'INDEX (__DIR__): ' . file_get_contents(__DIR__ . '/file.txt') . '<br />';
$external = filter_input(INPUT_GET, 'external');
$link = [
    'href' => '?external=' . (int)!$external,
    'text' => $external ? 'Inernal' : 'External',
];
?>
<a href="<?= $link['href'] ?>"><?= $link['text'] ?></a>