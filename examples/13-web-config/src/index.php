<?php
if (!is_file(__DIR__ . '/config.php')) {
    exit('Config file not found');
}
require __DIR__ . '/config.php';

?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Example: Mounted configuration file</title>
    <link rel="stylesheet" href="<?= BASE_URL . '/css/default.css'?>" type="text/css">
</head>
<body>
    <div id="time" class="hidden"><?= date('H:i:s') ?></div>

    <script src="<?= BASE_URL . '/js/example.js'?>"></script>
</body>
</html>