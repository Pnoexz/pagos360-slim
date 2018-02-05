<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Controllers\Clients;

use Pagos360\Controllers\BaseController;

abstract class ClientsController extends BaseController
{
    /**
     * Indicates the entity we are returning.
     * @var string
     */
    protected $entity = 'Client';
}
