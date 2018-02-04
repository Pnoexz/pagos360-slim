<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Entities;

use Spot\Entity;

abstract class SpotEntity extends Entity implements EntityInterface
{
    /**
     * @param string $field
     *
     * @return mixed
     */
    public function getField(string $field)
    {
        return $this->_data[$field];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int) $this->getField('id');
    }

    public function toArray(): array
    {
    }

    public function jsonSerialize(): array
    {
    }
}
