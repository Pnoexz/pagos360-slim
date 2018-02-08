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
 * @SWG\Get(
 *   path="/clients/{clientId}",
 *   summary="Get a client",
 *   tags={"Clients"},
 *   @SWG\Parameter(
 *     name="clientId",
 *     in="path",
 *     required=true,
 *     type="integer",
 *   ),
 *   @SWG\Response(
 *     response=200,
 *     description="successful operation",
 *     @SWG\Items(
 *      ref="#/definitions/ClientsGetOneResponse",
 *     ),
 *   ),
 *   @SWG\Response(
 *     response=404,
 *     description="Client not found",
 *     @SWG\Items(
 *      ref="#/definitions/ClientNotFoundExceptionResponse",
 *     ),
 *   ),
 * ),
 *
 * @SWG\Definition(
 *   definition="ClientsGetOneResponse",
 *   required={"entity", "kind", "data"},
 *    @SWG\Property(
 *      property="entity",
 *      type="string",
 *      example="Client",
 *    ),
 *    @SWG\Property(
 *      property="kind",
 *      type="string",
 *      example="entity",
 *    ),
 *    @SWG\Property(
 *      property="data",
 *      ref="#/definitions/Client",
 *    ),
 *  ),
 * @SWG\Definition(
 *   definition="ClientNotFoundExceptionResponse",
 *   allOf={
 *     @SWG\Schema(ref="#/definitions/MasterException"),
 *     @SWG\Schema(
 *       required={"class"},
 *       @SWG\Property(
 *         property="class",
 *         example="Pagos360\Exceptions\Clients\NotFoundException",
 *       ),
 *     ),
 *   },
 * ),

 */
class ActionGet extends ClientsController
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
        $id = $args['id'];
        $client = $this->clientsRepository->get($id);

        $body = $this->buildResponseBodyForEntity($client);

        return $response->withJson($body, 200);
    }
}
