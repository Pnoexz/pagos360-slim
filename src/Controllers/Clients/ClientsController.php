<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Controllers\Clients;

use Pagos360\Controllers\BaseController;
use Pagos360\Exceptions\Validation\InvalidEmailsException;
use Pagos360\Exceptions\Validation\MissingRequiredFieldsException;

abstract class ClientsController extends BaseController
{
    /**
     * Indicates the entity we are returning.
     * @var string
     */
    protected $entity = 'Client';

    /**
     * Validates the rules for creating a new client.
     *
     * @param $params
     *
     * @return array
     * @throws InvalidEmailsException
     * @throws MissingRequiredFieldsException
     */
    protected function validateParams($params): array
    {
        $rules = [
            'required' => ['name', 'lastname', 'dni'],
            'email' => ['email'],
        ];

        // Validation required
        $missing = [];
        foreach ($rules['required'] as $required) {
            if (!isset($params[$required])) {
                $missing[] = $required;
            }
        }
        if (!empty($missing)) {
            throw new MissingRequiredFieldsException($missing);
        }

        // Validation email
        $invalidEmails = [];
        foreach ($rules['email'] as $email) {
            // Since email is optional, we only check it's valid if it's present
            if (!empty($params['email']) &&
                !filter_var($params['email'], \FILTER_VALIDATE_EMAIL)
            ) {
                $invalidEmails[] = $email;
            }
        }
        if (!empty($invalidEmails)) {
            throw new InvalidEmailsException($invalidEmails);
        }

        return $params;
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function transformParams(array $params)
    {
        $params['name'] = strtoupper($params['name']);
        $params['lastname'] = strtoupper($params['lastname']);
        $params['dni'] = (int) $params['dni'];
        $params['email'] = (!empty($params['email'])) ? $params['email'] : null;

        return $params;
    }
}
