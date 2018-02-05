<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Repositories;

use Pagos360\Entities\Client;
use Pagos360\Libraries\Pagination;
use Spot\Entity\Collection;
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
     * Returns the default order of values in the format required by Spot.
     *
     * @return array
     */
    public function getDefaultOrder(): array
    {
        return [
            'lastname' => 'ASC',
            'name' => 'ASC',
        ];
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

    /**
     * @param Pagination|null $pagination
     *
     * @return Collection
     */
    public function getAll(Pagination $pagination = null)
    {
        $offset = $pagination->getSqlOffset();
        $limit = $pagination->getSqlLimit();

        $query = $this->getMapper()
            ->all()
            ->order($this->getDefaultOrder())
            ->limit($limit, $offset);
        $collection = $query->execute();

        if (!empty($pagination)) {
            $totalItems = $this->getTotalItemsFromQuery($query);
            if (!empty($totalItems)) {
                $pagination->setTotalItems($totalItems);
            }
        }

        return $collection;
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
