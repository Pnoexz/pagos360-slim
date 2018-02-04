<?php

use Slim\Container;

$container = $app->getContainer();

/*******************************************************************************
 * Slim handlers
 ******************************************************************************/
$container['errorHandler'] = function () {
    return new \Pagos360Slim\Handlers\ErrorHandler();
};

unset($container['phpErrorHandler']);

/*******************************************************************************
 * Third party
 ******************************************************************************/
$container['spot'] = function () {
    /** @var Container $container */
    $config = new \Spot\Config();
    $config->addConnection("mysql", [
        "dbname" => getenv("DB_NAME"),
        "user" => getenv("DB_USER"),
        "password" => getenv("DB_PASSWORD"),
        "host" => getenv("DB_HOST"),
        "driver" => "pdo_mysql",
        "charset" => "utf8"
    ]);

    $spot = new \Spot\Locator($config);

    return $spot;
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
