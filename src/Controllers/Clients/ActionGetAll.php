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
