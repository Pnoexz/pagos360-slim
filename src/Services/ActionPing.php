<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Services;

use Slim\Http\Request as Request;
use Slim\Http\Response as Response;

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
