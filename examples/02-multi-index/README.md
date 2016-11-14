# Multiple index file

You often need the script to work other way when it is executed from command line.
Imagine, you create an administrative tool to do its job when the system administrator 
use it from his/her favorite terminal and you want it to be working from web browser with 
a friendly GUI. You need to pass two argument to 
[Phar::createDefaultStub()](http://php.net/manual/en/phar.createdefaultstub.php).
The first is the file which will run from command line and the second is the index file where 
the browser will redirect to. It still let you load the cli version from the browser, 
so you have to protect it yourself.

[code](index.php)

When you open it from the web browser (as web application), you will be redirected to
the web-index.php. In case you run it included in other script or from command line,
it show you the output of phpinfo() (cli-index.php). Note that your cli-index.php 
is not protected yet!
