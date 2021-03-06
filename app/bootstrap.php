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

/** Load configuration from environment variables use vlucas/phpdotenv */
$dotenv = new \Dotenv\Dotenv(ROOT_PATH);
if (file_exists(ROOT_PATH . '.env')) {
    $dotenv->load();
}
$dotenv->required([
    'DB_NAME',
    'DB_USER',
    'DB_PASSWORD',
    'DB_HOST',
]);


$config = [];
require_once APP_PATH . '/config.php';
$app = new \Slim\App($config);

require_once APP_PATH . 'dependencies.php';

require APP_PATH . 'routes.php';
