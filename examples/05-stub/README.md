# Custom stub.php

You can have your own stub.php instead of the one provided by 
[Phar::createDefaultStub()](http://php.net/manual/en/phar.createdefaultstub.php).

Sometimes you need a simpler loader or a more specific solution. 
Phar:setStub() expects the source code of the stub.php as a string
so you can pass your custom version as argument. 

It is useful when you want to create a library and need an autoloader inside
the stub file.

There is one important rule you have to keep in mind. The stub file must ends with the following function: 

```
__HALT_COMPILER();
```

It is similar to "exit()" with an important difference. 
It instructs the compiler to ignore anything after this line. So you can have data after it which 
would cause syntax error in case of "exit()". 

Every Phar archive is a file started with the code of stub.php. It is followed by data as other files 
inside the archive and metadata.

Although this is like a normal function, you must write it uppercase or the archive will not work properly. 

[code:index.php](index.php)

[code:stub.php](stub.php)

You may noticed the prefix "phar://" used inside the autoloader. 
It was necessary because stub files are not actually a file inside the archive. 
It is a loader script as if it were the phar file itself. \_\_FILE\_\_ contains the path 
of the phar archive and when you want to load a file from a phar archive, you must use
"phar://" as prefix to use phar stream wrapper. Other files loaded by the stub are not need this.
\_\_FILE\_\_ and \_\_DIR\_\_ will already contain the prefix.

