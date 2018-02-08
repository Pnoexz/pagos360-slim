<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Controllers\Clients;

use Pagos360\Libraries\Pagination;
use Pagos360\Repositories\ClientsRepository;
use Slim\Http\Request as Request;
use Slim\Http\Response as Response;

/**
 * @SWG\Get(
 *   path="/clients",
 *   summary="Get paginated list of clients",
 *   tags={"Clients"},
 *   @SWG\Parameter(
 *     name="currentPage",
 *     in="query",
 *     required=false,
 *     type="integer",
 *   ),
 *   @SWG\Parameter(
 *     name="itemsPerPage",
 *     in="query",
 *     required=false,
 *     type="integer",
 *   ),
 *   @SWG\Response(
 *     response=200,
 *     description="successful operation",
 *     @SWG\Items(
 *      ref="#/definitions/ClientsGetAllResponse",
 *     ),
 *   ),
 * ),
 *
 *  @SWG\Definition(
 *    definition="ClientsGetAllResponse",
 *    @SWG\Property(
 *      property="entity",
 *      type="string",
 *      example="Client",
 *    ),
 *    @SWG\Property(
 *      property="pagination",
 *      ref="#/definitions/Pagination",
 *    ),
 *    @SWG\Property(
 *      property="data",
 *      type="array",
 *      @SWG\Items(
 *        ref="#/definitions/Client"
 *      ),
 *    ),
 *  ),
 */
class ActionGetAll extends ClientsController
{
    /** @var ClientsRepository */
    protected $clientsRepository;

    /** @var Pagination */
    protected $pagination;

    /**
     * ActionGetAll constructor.
     *
     * @param ClientsRepository $clientRepository
     * @param Pagination        $pagination
     */
    public function __construct(
        ClientsRepository $clientRepository,
        Pagination $pagination
    ) {
        $this->clientsRepository = $clientRepository;
        $this->pagination = $pagination;
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     * @return Response
     */
    public function __invoke(Request $request, Response $response, $args)
    {
        $pagination = $this->pagination;
        $currentPage = $request->getParam('currentPage');
        $itemsPerPage = $request->getParam('itemsPerPage');

        $pagination->setCurrentPage($currentPage);
        $pagination->setItemsPerPage($itemsPerPage);

        $clients = $this->clientsRepository->getAll($pagination);

        $body = $this->buildResponseBodyForListing($clients, $pagination);

        return $response->withJson($body, 200);
    }
}
