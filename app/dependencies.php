<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

use Slim\Container;

$container = $app->getContainer();

/*******************************************************************************
 * Slim handlers
 ******************************************************************************/
$container['errorHandler'] = function () {
    return new \Pagos360Slim\Handlers\ErrorHandler();
};

unset($container['phpErrorHandler']); // @TODO remove, maybe

/*******************************************************************************
 * Third party
 ******************************************************************************/
$container['spot'] = function () {
    $config = new \Spot\Config();
    $config->addConnection("mysql", [
        "dbname" => getenv("DB_NAME"),
        "user" => getenv("DB_USER"),
        "password" => getenv("DB_PASSWORD"),
        "host" => getenv("DB_HOST"),
        "driver" => "pdo_mysql",
        "charset" => "utf8"
    ]);

    // @TODO change mysql config to dsn

    return new \Spot\Locator($config);
};

/*******************************************************************************
 * Repositories
 ******************************************************************************/
$container['databaseRepository'] = function (Container $container) {
    /** @var Container $container */
    return new \Pagos360\Repositories\DatabaseRepository(
        $container->get('spot')
    );
};
