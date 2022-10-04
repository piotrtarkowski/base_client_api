<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use BaseClientApi\Service\Application;

$urlpath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

define('APP_ROOT', dirname(__DIR__));
define('APP_DATA', dirname(__DIR__) . '/data');

$app = new Application();
$app->run($urlpath);
