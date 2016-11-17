# Implement your own routing

Nothing is perfect so the default routing of webPhar() is also has some bug.
It seems it does not support query string using built-in php server and the browser tries to download the file.
It is not a huge problem since you can implement your own routing easily.

```php
<?php
Phar::webPhar('self.phar', 'index.php', '404.php', [], function ($uri) {
    return parse_url($uri, PHP_URL_PATH);
});
```

You can also have custom 404 error page and protecting a file is also possible. 
You can redirect any request to a real file, but the index file in webPhar's 
second argument must exists. As a workaround, you can create a file "welcome" inside 
the phar that will never be used and now, you can set "welcome" as default index
and redirect it to the real index.php inside the routing function in the 5th argument.

[code:stub.php](stub.php)

[code:src/secret.txt](src/secret.txt)

