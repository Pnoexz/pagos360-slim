<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Controllers\Status;

use Slim\Http\Request as Request;
use Slim\Http\Response as Response;

/**
 * @SWG\Get(
 *   path="/status",
 *   summary="General system status",
 *   tags={"Status"},
 *   @SWG\Response(
 *     response=200,
 *     description="successful operation",
 *     @SWG\Items(
 *      ref="#/definitions/StatusOkResponse"),
 *     ),
 *   ),
 *   @SWG\Response(
 *     response=500,
 *     description="Internal server error",
 *   ),
 * ),
 *
 * @SWG\Definition(
 *   definition="StatusOkResponse",
 *   required={"status"},
 *    @SWG\Property(
 *      property="status",
 *      type="string",
 *      example="OK",
 *    ),
 *  ),
 */
class ActionPing
{
    /**
     * @param Request  $request
     * @param Response $response
     * @return Response
     */
    public function __invoke(Request $request, Response $response)
    {
        return $response->withStatus(200)->withJson(['status' => 'OK']);
    }
}
