# Front controllers for web applications

When you use [Phar::createDefaultStub()](http://php.net/manual/en/phar.createdefaultstub.php), it generates a default stub file
which uses [Phar::webPhar()](http://php.net/manual/en/phar.webphar.php). This method catches the HTTP request when you open 
the phar directly from the web browser. Everything else will be ignored after this method.
When you try to run tha phar from command line, webPhar() will do nothing and this is how it
can give you multiple index files as I mentioned it earlier.

webPhar() is much more important method , however. 
Without it, you should route the request 
manually to a file based on request uri. webPhar() solves it for you. 
/myapp.phar/my/path.php will give you /my/path.php from my.phar.

[code:stub.php](stub.php)

[code:index.php](index.php)

[code:src/index.php](src/index.php)