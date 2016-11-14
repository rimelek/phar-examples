# Multiple index file: protected cli-index.php

It is very similar to the previous example. You still have two different index files, 
but cli-index.php is finally protected. In order to protect a file you need to check 
the current SAPI using [php_sapi_name()](http://php.net/manual/en/function.php-sapi-name.php)

[code:cli-index.php](src/cli-index.php)