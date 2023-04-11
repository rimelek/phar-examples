<?php
/* @var $exampleDirs SplFileInfo[] */
$exampleDirs = new GlobIterator('examples/*', FilesystemIterator::SKIP_DOTS);

function getPathOfExecutable(SplFileInfo $example): string
{
    return 'output/' . $example->getFilename() . '/example.phar.php';
}

function isBuilt(SplFileInfo $example): bool
{
    return is_file(getPathOfExecutable($example));
}

$buildRequest = filter_input(INPUT_GET, 'build');
if ($buildRequest) {
    header('Location: .');
    $dirName = basename($buildRequest);
    $exDir = 'examples/' . $dirName;
    $exFile = $exDir . '/index.php';
    $pharFile =  'output/' . $dirName . '/example.phar.php';

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
        $readme = preg_replace_callback('~\[code(:([^]]+))]\(([^)]+)\)~m', function ($matches) use ($dir) {
            return sprintf('[file: %1$s](%2$s/%1$s)', $matches[3], $dir->getPathname())
                . "\n```php\n" . file_get_contents($dir->getPathname() . '/' . $matches[3]) . "\n```\n";
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
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Phar examples</title>

        <link href="static/css/bootstrap-<?= getenv('STATIC_BOOTSTRAP_CSS_VERSION') ?>.min.css" rel="stylesheet">
        <script src="static/js/jquery-<?= getenv('STATIC_JQUERY_JS_VERSION') ?>.min.js"></script>
        
        <link href="static/css/highlight-<?= getenv('STATIC_HIGHLIGHT_CSS_VERSION') ?>.min.css" rel="stylesheet">
        <script src="static/js/highlight-<?= getenv('STATIC_HIGHLIGHT_JS_VERSION') ?>.min.js"></script>

        <script src="static/js/showdown-<?= getenv('STATIC_SHOWDOWN_JS_VERSION') ?>.min.js"></script>
        
        <style>
            pre {
                background-color: #f5f5f5;
                border: 1px solid #ccc;
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <ul class="list-group" id="examples">
                <?php foreach ($examples as $example) : ?>
                <li class="list-group-item example" id="pharex-<?= $example['name'] ?>">
                    <span class="btn-group btn-group-sm">
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
            hljs.highlightAll();
            
            let converter = new showdown.Converter();
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