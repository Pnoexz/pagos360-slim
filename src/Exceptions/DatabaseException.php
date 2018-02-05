<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Exceptions;

class DatabaseException extends MasterException
{
    /** @var string */
    protected $message = 'Database error.';

    /** @var int */
    protected $httpStatus = 500;

    /** @var string */
    protected $level = \Psr\Log\LogLevel::CRITICAL;
}
