<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Exceptions;

class DatabaseNotAvailableException extends MasterException
{
    /** @var string */
    protected $message = 'Database not available';

    /** @var int */
    protected $httpStatus = 503;

    /** @var string */
    protected $level = 'critical';
}
