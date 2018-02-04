<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Entities;

interface EntityInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return array
     */
    public function jsonSerialize(): array;

    /**
     * @return array
     */
    public function toArray(): array;
}
