<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Exceptions\Clients;

use Pagos360\Exceptions\Http\BadRequestException;

class AlreadyExistsException extends BadRequestException
{
    /** @var string */
    protected $message = 'A client with this name and dni is already registered.';
}
