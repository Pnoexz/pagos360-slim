<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Controllers\Clients;

use Pagos360\Repositories\ClientsRepository;
use Slim\Http\Request as Request;
use Slim\Http\Response as Response;

/**
 * @SWG\Post(
 *   path="/clients",
 *   summary="Create a new client",
 *   tags={"Clients"},
 *   @SWG\Parameter(
 *     name="client",
 *     in="body",
 *     required=true,
 *     @SWG\Schema(ref="#/definitions/ClientInput")
 *   ),
 *   @SWG\Response(
 *     response=201,
 *     description="successful operation",
 *     @SWG\Items(
 *      ref="#/definitions/ClientsGetOneResponse",
 *     ),
 *   ),
 * ),
 */
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
    }
}
