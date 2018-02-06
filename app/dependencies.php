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

/*******************************************************************************
 * Third party
 ******************************************************************************/
$container['spot'] = function () {
    $config = new \Spot\Config();
    /*$config->addConnection("mysql", [
        "dbname" => getenv("DB_NAME"),
        "user" => getenv("DB_USER"),
        "password" => getenv("DB_PASSWORD"),
        "host" => getenv("DB_HOST"),
        "driver" => "pdo_mysql",
        "charset" => "utf8"
    ]);*/

    $config->addConnection('mysql', getenv('DATABASE_DSN'));

    return new \Spot\Locator($config);
};

/*******************************************************************************
 * Libraries
 ******************************************************************************/
$container['pagination'] = function () {
    return new \Pagos360\Libraries\Pagination();
};

/*******************************************************************************
 * Repositories
 ******************************************************************************/
/** @noinspection PhpDocSignatureInspection */
$container['databaseRepository'] = function (Container $container) {
    return new \Pagos360\Repositories\DatabaseRepository(
        $container->get('spot')
    );
};

$container['clientsRepository'] = function (Container $container) {
    /** @var Container $container */
    return new \Pagos360\Repositories\ClientsRepository(
        $container->get('spot')
    );
};
