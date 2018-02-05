<?php
/**
 * @author  Matias Pino <pnoexz@gmail.com>
 * @license GPL v3.0
 */

namespace Pagos360\Exceptions;

/**
 * MasterException relies on the following principles:
 *
 * * Each exception must be unique.
 * * Consumers MUST NOT rely on the human readable error message to identify it.
 * * Comply with PSR-3. See: https://www.php-fig.org/psr/psr-3/
 *
 * @package Pnoexz\MasterException
 */

abstract class MasterException extends \Exception implements
    \JsonSerializable
{
    /**
     * Contains the human readable your consumer SHOULD display in case no
     * translation is available.
     *
     * @var string
     */
    protected $message;

    /**
     * The default HTTP status code to send in the headers if none is given.
     * It's RECOMMENDED that you set this value for each exception.
     * For more information, visit: https://httpstatuses.com/
     *
     * @var int
     */
    protected $httpStatus = 500;

    /**
     * A default PSR-3 compliant level for the exception if none is given.
     * It's RECOMMENDED that you set this value for each exception.
     * For more information, visit: https://www.php-fig.org/psr/psr-3/
     *
     * @var string
     */
    protected $level = \Psr\Log\LogLevel::ERROR;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * MasterException constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->data = $data;
        }
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $newData
     *
     * @return self
     */
    public function setData(array $newData)
    {
        $this->data = $newData;
        return $this;
    }

    /**
     * @param array $moreData
     *
     * @return self
     */
    public function appendData(array $moreData)
    {
        $this->data = array_merge($this->data, $moreData);
        return $this;
    }

    /**
     * @return int
     */
    public function getHttpStatus(): int
    {
        return $this->httpStatus;
    }

    /**
     * @return string
     */
    public function getLevel(): string
    {
        return $this->level;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $output = [
            'class' => get_class($this),
            'message' => $this->message,
            'httpStatusCode' => $this->httpStatus,
        ];

        if (!empty($this->data)) {
            $output['data'] = $this->data;
        }

        return $output;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->message;
    }

    /*
     * @TODO in master exception stand alone
     *
    public function populateResponseObject(
        \Psr\Http\Message\MessageInterface $response,
        \Psr\Http\Message\StreamInterface $stream
    ) {
        if (!$stream->isWritable()) {
            throw new \InvalidArgumentException(
                'The stream is not writable'
            );
        }
        $stream = $stream->write(json_encode($this));

        return $response
            ->withStatus($this->httpStatus)
            ->withHeader("Content-type", "application/json")
            ->withBody($stream);
    }
    */
}
