<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Exceptions\Http;

use Pagos360\Exceptions\MasterException;

abstract class BadRequestException extends MasterException
{
    /** @var int */
    protected $httpStatus = 400;

    /** @var string */
    protected $level = \Psr\Log\LogLevel::INFO;
}
