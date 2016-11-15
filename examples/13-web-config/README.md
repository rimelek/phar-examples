# Mounted configuration file

If the application needs a configuration file, mounting one from outside the phar
is a good choice. You keep it next to the phar and the phar will find it.
You can easily change it and give the application to anyone without your configs.

[Phar::mount()](http://php.net/manual/en/phar.mount.php) helps you to do it.

[code:stub.php](stub.php)

[code:config.php](config.php)