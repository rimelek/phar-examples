<?php

Phar::mapPhar('self.phar');

require 'phar://self.phar/index.php';

__HALT_COMPILER();
?>