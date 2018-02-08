<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Entities;

use Spot\Entity;

abstract class SpotEntity extends Entity
{
    /**
     * @param string $field
     *
     * @return mixed
     */
    public function getField(string $field)
    {
        if (isset($this->_dataModified[$field])) {
            return $this->_dataModified[$field];
        }
        return $this->_data[$field];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int) $this->getField('id');
    }
}
