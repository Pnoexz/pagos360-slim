<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Repositories;

use Doctrine\DBAL\Connection;
use Spot\Locator;
use Spot\Query;

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

    /**
     * Takes a Query object as a parater and removes the limit part of the
     * query, replaces the select with a simple COUNT(*), and removed the
     * order to slightly improve performance.
     *
     * @param Query $query
     *
     * @return int
     */
    protected function getTotalItemsFromQuery(Query $query): int
    {
        $countQuery = clone $query;
        $countQuery
            ->select('COUNT(*)')
            ->order([])
            ->limit(null, null);

        return $countQuery->count();
    }
}
