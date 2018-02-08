<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Entities;

/**
 * @SWG\Definition(
 *   definition="Client",
 *   required={"name", "langID", "type"},
 *   @SWG\Property(
 *     property="id",
 *     type="integer",
 *     description="ID"
 *   ),
 *   @SWG\Property(
 *     property="name",
 *     type="string",
 *     description="Name"
 *   ),
 *   @SWG\Property(
 *     property="lastname",
 *     type="string",
 *     description="Name"
 *   ),
 *   @SWG\Property(
 *     property="dni",
 *     type="integer",
 *     description="D.N.I."
 *   ),
 *   @SWG\Property(
 *     property="email",
 *     type="string",
 *     description="Emails"
 *   ),
 * ),
 *
 *
 * @SWG\Definition(
 *   definition="ClientInput",
 *   required={"name", "lastname", "dni"},
 *    @SWG\Property(
 *      property="name",
 *      type="string",
 *      example="Foo",
 *    ),
 *    @SWG\Property(
 *      property="lastname",
 *      type="string",
 *      example="Bar",
 *    ),
 *    @SWG\Property(
 *      property="dni",
 *      type="integer",
 *      example="12345678",
 *    ),
 *    @SWG\Property(
 *      property="email",
 *      type="string",
 *      example="example@gmail.com",
 *    ),
 *  ),
 *
 * @property string name
 * @property string lastname
 * @property int dni
 * @property string email
 */
class Client extends SpotEntity implements EntityInterface
{
    /**
     * Used by Spot. Matches the table name in the database.
     * @var string
     */
    protected static $table = 'clients';

    /**
     * Used by Spot. Matches the table schema in the database.
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
     * Used by Spot.
     *
     * @return array
     */
    public static function fields(): array
    {
        return self::$fields;
    }

    /**
     * Exports the instance to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $output = [
            'id' => $this->getId(),
            'name' => (string) $this->getField('name'),
            'lastname' => (string) $this->getField('lastname'),
            'dni' => (int) $this->getField('dni'),
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
