<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Repositories;

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

    public function validateEntity($entity)
    {
        if (empty($entity) || !($entity instanceof \Pagos360\Entities\Client)) {
            throw new \Pagos360\Exceptions\Clients\NotFoundException();
        }
    }
}
