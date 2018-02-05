<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Exceptions\Clients;

use Pagos360\Exceptions\Http\BadRequestException;

class EmailAlreadyRegisteredException extends BadRequestException
{
    /** @var string */
    protected $message = 'A client with this email is already registered.';
}
