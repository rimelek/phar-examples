# The simplest example

* This is the simplest example to show you how to create and run a minimal Phar archive.

* You can easily build your own phar archive from the contents of a directory. 
Every archive can contain a file called "stub.php" which is intended to run when you load
the phar file either from a browser, by including it from other PHP script or by running 
it from command line.

* All of these methods give you the same result in case of a simple PHP script. 
Most of the time, however, you need to handle different requests different ways.
In addition, it can redirect you to a chosen index file (default is index.php) if
you don't give it manually.

* The Phar class provides a [default STUB](http://php.net/manual/en/phar.createdefaultstub.php) 
to make it easier, but unfortunately it has some downsides. 
For example, when you need different index files.

* This example use the default stub only for default index file.

[code](index.php)