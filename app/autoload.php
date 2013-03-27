<?php

// simplex/app/autoload.php
 
require_once __DIR__.'/../vendor/composer/ClassLoader.php';

use Composer\Autoload\ClassLoader;
 
$loader = new ClassLoader();
$loader->register();