<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

$rootPath = dirname(__DIR__);

define('ROOT_PATH', "$rootPath/");
define('VENDOR_PATH', "$rootPath/vendor/");
define('APP_PATH', "$rootPath/app/");
define('PUBLIC_PATH', "$rootPath/public/");

require VENDOR_PATH . 'autoload.php';

$dotenv = new \Dotenv\Dotenv(ROOT_PATH);
if (file_exists(ROOT_PATH . '.env')) {
    $dotenv->load();
}

$config = [];
require_once APP_PATH . '/config.php';
$app = new \Slim\App($config);

require_once APP_PATH . 'dependencies.php';

require APP_PATH . 'routes.php';
