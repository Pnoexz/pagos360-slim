<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

$config = [
    'settings' => [
        'displayErrorDetails' => \filter_var(
            getenv('DEBUG'),
            FILTER_VALIDATE_BOOLEAN,
            ['default' => false]
        ),
    ],
];
