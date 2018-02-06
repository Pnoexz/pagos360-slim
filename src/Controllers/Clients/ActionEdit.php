<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Controllers\Clients;

use Pagos360\Repositories\ClientsRepository;
use Slim\Http\Request as Request;
use Slim\Http\Response as Response;

class ActionEdit extends ClientsController
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
        $id = (int) $args['id'];
        $oldClient = $this->clientsRepository->get($id);

        $validatedParams = $this->validateParams($request->getParams());
        $params = $this->transformParams($validatedParams);

        $newClient = $this->clientsRepository->edit(
            $oldClient,
            $params['name'],
            $params['lastname'],
            $params['dni'],
            $params['email']
        );

        $body = $this->buildResponseBodyForEntity($newClient);

        return $response->withJson($body, 200);
    }
}
