<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Exceptions\Http;

use Pagos360\Exceptions\MasterException;

abstract class PayloadTooLargeException extends MasterException
{
    /** @var int */
    protected $httpStatus = 413;

    /** @var string */
    protected $level = \Psr\Log\LogLevel::WARNING;
}
