<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Exceptions;

abstract class NotFoundException extends MasterException
{
    /** @var int */
    protected $httpStatus = 404;

    /** @var string */
    protected $level = \Psr\Log\LogLevel::WARNING;
}
