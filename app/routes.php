<?php
/**
 * @author Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

$app->group('/api/v1', function () use ($app) {
    $app->group('/status', function () use ($app) {
        $app->get(
            '',
            new \Pagos360\Controllers\Status\Ping()
        );
    });
});
