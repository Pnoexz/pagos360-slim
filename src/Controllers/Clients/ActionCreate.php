<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Controllers\Clients;

use Pagos360\Exceptions\Validation\InvalidEmailsException;
use Pagos360\Exceptions\Validation\MissingRequiredFieldsException;
use Pagos360\Repositories\ClientsRepository;
use Slim\Http\Request as Request;
use Slim\Http\Response as Response;

class ActionCreate extends ClientsController
{
    /** @var ClientsRepository */
    protected $clientsRepository;

    /**
     * ActionGet constructor.
     *
     * @param ClientsRepository $clientRepository
     */
    public function __construct(ClientsRepository $clientRepository)
    {
        $this->clientsRepository = $clientRepository;
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     * @return Response
     */
    public function __invoke(Request $request, Response $response, $args)
    {
        $validatedParams = $this->validateParams($request->getParams());
        $params = $this->transformParams($validatedParams);

        $client = $this->clientsRepository->create(
            $params['name'],
            $params['lastname'],
            $params['dni'],
            $params['email']
        );

        $body = $this->buildResponseBodyForEntity($client);

        return $response->withJson($body, 201);






        var_dump($params);
    }

    // @TODO

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
