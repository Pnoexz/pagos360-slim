<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Repositories;

use Doctrine\DBAL\Connection;
use Spot\Locator;

class DatabaseRepository
{
    /**
     * @var Locator
     */
    protected $spot;

    /**
     * @param Locator $spot
     */
    public function __construct(Locator $spot)
    {
        $this->spot = $spot;
    }

    /**
     * Return the DBAL Connection object
     *
     * @return Connection
     */
    public function getConnection()
    {
        return $this->spot->config()->connection();
    }
}
