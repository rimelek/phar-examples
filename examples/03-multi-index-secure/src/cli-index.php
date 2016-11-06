<?php
if (php_sapi_name() !== 'cli') {
    exit('This script can run only from command line');
}

phpinfo();