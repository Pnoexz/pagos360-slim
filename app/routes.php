<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

$app->group('/api/v1', function () use ($app) {
    $app->group('/clients', function () use ($app) {
        $app->get(
            '',
            new \Pagos360\Controllers\Clients\ActionGetAll(
                $app->getContainer()->get('clientsRepository'),
                $app->getContainer()->get('pagination')
            )
        );

        $app->get(
            '/{id:\d+}',
            new \Pagos360\Controllers\Clients\ActionGet(
                $app->getContainer()->get('clientsRepository')
            )
        );

        $app->post(
            '',
            new \Pagos360\Controllers\Clients\ActionCreate(
                $app->getContainer()->get('clientsRepository')
            )
        );

        $app->put(
            '/{id:\d+}',
            new \Pagos360\Controllers\Clients\ActionEdit(
                $app->getContainer()->get('clientsRepository')
            )
        );
    });

    $app->group('/status', function () use ($app) {
        $app->get(
            '',
            new \Pagos360\Controllers\Status\ActionPing()
        );
        $app->get(
            '/database',
            new \Pagos360\Controllers\Status\ActionDatabase(
                $app->getContainer()->get('databaseRepository')
            )
        );
    });
});
