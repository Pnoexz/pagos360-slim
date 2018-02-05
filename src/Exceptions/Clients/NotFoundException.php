<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Exceptions\Clients;

class NotFoundException extends \Pagos360\Exceptions\Http\NotFoundException
{
    /** @var string */
    protected $message = 'Client not found.';
}
