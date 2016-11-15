# Custom stub.php: when "phar://" is not needed

Here the autoloader is in a separate file. stub.php use "phar://" to load the autoloader, 
but the autoloader does not need it to load classes.

[code:stub.php](stub.php)

[code:src/autoload.php](src/autoload.php)