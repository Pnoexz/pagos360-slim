<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Exceptions\Validation;

use Pagos360\Exceptions\Http\BadRequestException;

class InvalidEmailsException extends BadRequestException
{
    /** @var int */
    protected $message = "The form contains invalid emails.";
}
