<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Controllers\Status;

use Pagos360\Repositories\DatabaseRepository;
use Slim\Http\Request as Request;
use Slim\Http\Response as Response;

/**
 * @SWG\Get(
 *   path="/status/database",
 *   summary="Database status",
 *   tags={"Status"},
 *   @SWG\Response(
 *     response=200,
 *     description="successful operation",
 *     @SWG\Items(
 *      ref="#/definitions/StatusOkResponse"),
 *     ),
 *   ),
 *   @SWG\Response(
 *     response="503",
 *     description="Service not available",
 *     @SWG\Items(
 *      ref="#/definitions/DatabaseNotAvailableResponse"),
 *     ),
 *   ),
 * ),
 *
 * @SWG\Definition(
 *   definition="DatabaseNotAvailableResponse",
 *
 *   required={"status"},
 *    @SWG\Property(
 *      property="status",
 *      type="string",
 *      example="OK",
 *    ),
 *  ),

 */
class ActionDatabase
{
    public $databaseRepository;

    /**
     * ActionDatabase constructor.
     *
     * @param Databaserepository $databaseRepository
     */
    public function __construct(DatabaseRepository $databaseRepository)
    {
        $this->databaseRepository = $databaseRepository;
    }

    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     * @throws \Pagos360\Exceptions\DatabaseNotAvailableException
     */
    public function __invoke(Request $request, Response $response)
    {
        try {
            $connection = $this->databaseRepository->getConnection();
            $connection->ping();

            return $response->withStatus(200)->withJson(['status' => 'OK']);
        } catch (\Exception $e) {
            throw new \Pagos360\Exceptions\DatabaseNotAvailableException();
        }
    }
}
