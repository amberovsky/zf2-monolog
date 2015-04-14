<?php
/**
 * @author Anton Zagorskiy amberovsky@gmail.com
 */

namespace MonologTest;

error_reporting(E_ALL | E_STRICT);

$loader = require(__DIR__ . '/../vendor/autoload.php');
$loader->add("MonologTest\\", __DIR__);
