<?php

define('BASE_URL', strstr(filter_input(INPUT_SERVER, 'REQUEST_URI'), '.phar.php', true) . '.phar.php');