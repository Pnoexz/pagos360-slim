<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Repositories;

use Pagos360\Entities\Client;
use Pagos360\Libraries\Pagination;
use Spot\Mapper;

class ClientsRepository extends DatabaseRepository
{
    /** @var string */
    protected $entity = '\Pagos360\Entities\Client';

    /**
     * @return Mapper
     */
    public function getMapper(): Mapper
    {
        return $this->spot->mapper($this->entity);
    }

    /**
     * @param $id
     *
     * @return Client
     */
    public function get($id)
    {
        $entity = $this->getMapper()->get($id);
        $this->validateEntity($entity);
        return $entity;
    }

    public function getAll(Pagination $pagination = null)
    {
        $offset = $pagination->getSqlOffset();
        $limit = $pagination->getSqlLimit();

        $entity = $this->getMapper()->all()->limit($limit, $offset);

        if (!empty($pagination)) {
            $pagination->setTotalItems($this->countAll());
        }

        return $entity;
    }

    /**
     * Returns an int indicating the total number of records in the database.
     * For performance reasons, we run this query directly from the PDO object
     * provided by \Doctrine\DBAL\Connection. Since this doesn't use user input
     * (for now) it isn't required to prepare the statement.
     *
     * @return int
     */
    public function countAll()
    {
        $conn = $this->getConnection();
        $query = "SELECT COUNT(id) FROM clients"; // @TODO add a method to get the table

        $pdoStatment = $conn->query($query);

        return (int) $pdoStatment->fetchColumn(0);
    }

    /**
     * Validates the result we got is a valid entity.
     *
     * @param $entity
     *
     * @throws \Pagos360\Exceptions\Clients\NotFoundException
     */
    public function validateEntity($entity)
    {
        if (empty($entity) || !($entity instanceof \Pagos360\Entities\Client)) {
            throw new \Pagos360\Exceptions\Clients\NotFoundException();
        }
    }
}
