<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360Slim\Handlers;

use Slim\Http\Response;
use Slim\Http\Request;

class ErrorHandler
{
    /**
     * @param Request    $request
     * @param Response   $response
     * @param \Exception $exception
     *
     * @return Response
     */
    public function __invoke(
        Request $request,
        Response $response,
        \Exception $exception
    ) {

        if ($exception instanceof \Pagos360\Exceptions\MasterException) {
            return $response
                ->withJson($exception, $exception->getHttpStatus());
        }

        $body = [
            'status' => 'error',
            'message' => 'Unknown error.',
        ];

        if (getenv('DEBUG')) { // @todo inject this
            $body['exceptionMessage'] = $exception->getMessage();
        }

        return $response->withJson($body, 500);
    }
}
