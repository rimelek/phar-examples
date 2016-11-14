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

[code](index.php)
[code](stub.php)