<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Exceptions\Validation;

use Pagos360\Exceptions\Http\BadRequestException;

class MissingRequiredFieldsException extends BadRequestException
{
    /** @var int */
    protected $message = "Missing required fields.";
}
