<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Entities;

class Client extends SpotEntity
{
    /**
     * Used by Spot. Matches the table name in the database.
     * @var string
     */
    protected static $table = 'subpattern';

    /**
     * @var array
     */
    protected static $fields = [
        'id' => [
            'type' => 'integer',
            'unique' => true,
            'primary' => true,
            'autoincrement' => true,
        ],
        'name' => [
            'type' => 'string',
            'required' => true,
        ],
        'lastname' => [
            'type' => 'string',
            'required' => true,
        ],
        'dni' => [
            'type' => 'integer',
            'required' => true,
        ],
        'email' => [
            'type' => 'string',
        ],
    ];

    /**
     * Used by Spot. Matches the table schema in the database.
     *
     * @return array
     */
    public static function fields(): array
    {
        return self::$fields;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $output = [
            'name' => $this->getField('name'),
            'lastname' => $this->getField('lastname'),
            'dni' => $this->getField('dni'),
        ];

        if (!empty($this->email)) {
            $output['email'] = $this->getField('email');
        }

        return $output;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
