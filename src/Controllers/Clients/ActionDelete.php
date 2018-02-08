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
 * @SWG\Delete(
 *   path="/clients/{clientId}",
 *   summary="Deletes a client",
 *   tags={"Clients"},
 *   @SWG\Parameter(
 *     name="clientId",
 *     in="path",
 *     required=true,
 *     type="integer",
 *   ),
 *   @SWG\Response(
 *     response=204,
 *     description="successful operation",
 *   ),
 * ),
 */
class ActionDelete extends ClientsController
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
        $this->clientsRepository->delete($id);

        return $response->withStatus(204);
    }
}
