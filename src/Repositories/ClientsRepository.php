<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Repositories;

use Pagos360\Entities\Client;
use Pagos360\Exceptions\Clients\AlreadyExistsException;
use Pagos360\Exceptions\Clients\EmailAlreadyRegisteredException;
use Pagos360\Exceptions\DatabaseException;
use Pagos360\Libraries\Pagination;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
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
    protected function getDefaultOrder(): array
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
     * Creates and saves the entity object.
     *
     * @param string      $name
     * @param string      $lastname
     * @param int         $dni
     * @param string|null $email
     *
     * @return Client
     */
    public function create(
        string $name,
        string $lastname,
        int $dni,
        string $email = null
    ) {
        /** @var Client $entity */
        $entity = $this->getMapper()->build([
            'name' => $name,
            'lastname' => $lastname,
            'dni' => $dni,
            'email' => $email,
        ]);

        $this->saveEntity($entity);

        return $entity;
    }

    public function edit(
        Client $client,
        string $name,
        string $lastname,
        int $dni,
        string $email = null
    ) {
        // @todo
    }

    /**
     * Tries to save an entity. If this fails, we need to catch DBAL's
     * UniqueConstraintViolationException and determine which UNIQUE CONSTRAIN
     * check is failing to show a proper error message. The DBAL exception looks
     * like this (all in one line):
     *
     * SQLSTATE[23000]: Integrity constraint violation: 1062
     * Duplicate entry 'FOO-BA-1376194' for key 'clients_UN_all_required'
     *
     * @param Client $entity
     *
     * @return Client
     * @throws AlreadyExistsException
     * @throws DatabaseException
     * @throws EmailAlreadyRegisteredException
     */
    protected function saveEntity(Client $entity)
    {
        try {
            $this->getMapper()->save($entity);
        } catch (UniqueConstraintViolationException $e) {
            $previousMessage = $e->getMessage();
            if (strpos($previousMessage, "'clients_UN_email'")) {
                throw new EmailAlreadyRegisteredException();
            } elseif (strpos($previousMessage, "'clients_UN_all_required'")) {
                throw new AlreadyExistsException();
            }
            throw new DatabaseException([], $e);
        } catch (\Exception $e) {
            throw new DatabaseException([], $e);
        }

        return $entity;
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
