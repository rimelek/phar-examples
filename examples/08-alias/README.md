# Alias of the current phar archive

When you need to refer to the current phar file, you can use 
[Phar::running()](http://php.net/manual/en/phar.running.php). 
\_\_FILE\_\_ contains the path of the phar too, when it is used in the stub file.
The third way is setting an alias of the current phar file. 
[Phar::mapPhar()](http://php.net/manual/en/phar.mapphar.php) is your friend in this case.
After you set an alias inside the stub file, you can use it anywhere like this:

```php
<?php
Phar::mapPhar('self.phar');
// ...
require 'phar://self.phar/path/inside/phar.php';
```

It can be useful in some cases, but it is not the method we could not live without, 
since we can use magic constants as we would probably do without phar archives:

```php
<?php
// somewhere in the root directory
const BASEDIR = __DIR__;

// anywhere else
require BASEDIR . '/path/inside/the/app.php';
```

[code:stub.php](stub.php)

[code:index.php](index.php)

[code:src/index.php](src/index.php)

[code:src/included.php](src/included.php)

