<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Example: CSS and JS</title>
    <link rel="stylesheet" href="<?= BASE_URL . '/css/default.css'?>" type="text/css">
</head>
<body>
    <div id="time" class="hidden"><?= date('H:i:s') ?></div>

    <script src="<?= BASE_URL . '/js/example.js'?>"></script>
</body>
</html>