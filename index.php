<?php
/* @var $exampleDirs SplFileInfo[] */
$exampleDirs = new GlobIterator('examples/*', FilesystemIterator::SKIP_DOTS);

function getPathOfExecutable(SplFileInfo $example)
{
    return $example->getPathname() . '/' . $example->getFilename() . '.phar.php';
}

function isBuilt(SplFileInfo $example)
{
    return is_file(getPathOfExecutable($example));
}

$buildRequest = filter_input(INPUT_GET, 'build');
if ($buildRequest) {
    header('Location: .');
    $dirName = basename($buildRequest);
    $exDir = 'examples/' . $dirName;
    $exFile = $exDir . '/index.php';
    $pharFile = $exDir . '/' . $dirName . '.phar.php';

    if (is_file($exFile)) {
        if (is_file($pharFile)) {
            unlink($pharFile);
        }
        chdir($exDir);
        require $exFile;
    }
    exit;
}

$examples = [];
foreach ($exampleDirs as $dir) {
    $built = isBuilt($dir);
    $executablePath = getPathOfExecutable($dir);
    $readmePath = $dir->getPathname() . '/README.md';
    $readme = is_file($readmePath) ? file_get_contents($readmePath) : '';
    if ($readme) {
        $readme = preg_replace_callback('~\[code\]\(([^\)]+)\)~ms', function ($matches) use ($dir) {
            return sprintf('[file: %1$s](%2$s/%1$s)', $matches[1], $dir->getPathname())
                . "\n```\n" . file_get_contents($dir->getPathname() . '/' . $matches[1]) . "\n```\n";
        }, $readme);
    }
    $examples[] = [
        'readme' => $readme,
        'name' => $dir->getFilename(),
        'dir' => $dir->getPathname(),
        'built' => $built,
        'builtAt' => $built ? @filemtime($executablePath) : null,
        'executablePath' => $executablePath,
    ];
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Phar examples</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
        <script src="https://cdn.rawgit.com/showdownjs/showdown/1.4.4/dist/showdown.min.js"></script>
    </head>
    <body>
        <div class="container">
            <ul class="list-group" id="examples">
                <?php foreach ($examples as $example) : ?>
                <li class="list-group-item example" id="pharex-<?= $example['name'] ?>">
                    <span class="btn-group btn-group-xs">
                        <a class="pharex-build btn btn-primary" href="?build=<?= $example['name'] ?>" title="<?= $example['built'] ? 'built at ' . date('Y-m-d H:i:s', $example['builtAt']) : 'has not been built yet' ?>">(Re)Build</a>
                        <a class="pharex-runas-included btn btn-success <?= $example['built'] ? '' : 'disabled' ?>" href="<?= $example['dir'] ?>" target="_blank">Run as included script</a>
                        <a class="pharex-runas-webapp btn btn-success <?= $example['built'] ? '' : 'disabled' ?>" href="<?= $example['executablePath'] ?>" target="_blank">Run as web application</a>
                        <a class="pharex-toggle-details btn btn-info" href="javascript:">Details</a>
                    </span>
                    <?= $example['name'] ?>
                    <div class="pharex-details alert alert-info" style="display: none;"><?= htmlspecialchars($example['readme']) ?></div>

                </li>
                <?php endforeach ?>
            </ul>
        </div>
        <script>
            var converter = new showdown.Converter();
            $('.pharex-details').each(function () {
                $(this).html(converter.makeHtml($(this).text()));
            });
            $('#examples .pharex-toggle-details').on('click', function (evt) {
                evt.preventDefault();
                $(this).closest('li').find('.pharex-details').slideToggle();
            });
        </script>
    </body>
</html>