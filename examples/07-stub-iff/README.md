# Reading a file inside and outside the phar

When you use relative path inside tha phar to read a file, the path will point to a file outside the phar.
In that case the path is relative to tha phar itself. If you want to change this behavior,
you need to call [Phar::interceptFileFuncs()](http://php.net/manual/en/phar.interceptfilefuncs.php)
in stub.php.

It can be useful when you want to package a program created by someone else who did not
use for example \_\_DIR\_\_ to make an absolute reference to the file.

However, when you create your own software, make sure, you refer every file using absolute path.

This example shows you what happens when you

* read a file in stub.php using relative path. (reads the external file)
* read a file in the index.php inside the phar using relative path (reads the file depends on interceptFileFuncs)
* read a file in the index.php inside the phar using absolute path (reads the file exactly what you wants to read)

[code:stub.php](stub.php)

[code:src/index.php](src/index.php)

[code:file.txt](file.txt)

[code:src/file.txt](src/file.txt)