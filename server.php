<?php

require __DIR__.'/vendor/autoload.php';

// Load configuration
$config = require __DIR__.'/src/config/config.php';
require __DIR__.'/src/Helpers/helpers.php';

define('CONFIG', $config);
define('BASE_DIR', __DIR__);

use SMS\Controllers\HomeCont;

$home = new HomeCont();

$home->loadHome();

