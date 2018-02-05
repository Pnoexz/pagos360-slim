<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Controllers;

abstract class BaseController
{
    /**
     * Indicates the entity we are returning.
     * @var string
     */
    protected $entity;

    /**
     * Controls the base json structure of the response for entities.
     *
     * @param $data
     *
     * @return array
     */
    protected function buildResponseBodyForEntity($data)
    {
        return [
            'entity' => $this->entity,
            'kind' => 'entity',
            'data' => $data,
        ];
    }

    /**
     * Controls the base json structure of the response for listings. If no
     * pagination is given, we assume all results are being sent in the response.
     *
     * @param $data
     * @param $pagination
     *
     * @return array
     */
    protected function buildResponseBodyForListing($data, $pagination = null)
    {
        $output = [
            'entity' => $this->entity,
            'kind' => 'listing',
            'pagination' => $pagination,
            'data' => $data,
        ];

        if (!empty($pagination)) {
            $output['pagination'] = $pagination;
        }

        $output['data'] = $data;

        return $output;
    }
}
