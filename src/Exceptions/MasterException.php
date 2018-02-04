<?php

namespace Pagos360\Exceptions;

abstract class MasterException extends \Exception implements
    \JsonSerializable
{
    /**
     * @var string
     */
    protected $message;

    /**
     * @var int
     */
    protected $httpStatus;

    /**
     * @var string
     */
    protected $level;

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
        if (empty($this->message)) {
            $this->message = 'Unkonwn error';
        }

        if (empty($this->httpStatus)) {
            $this->httpStatus = 500;
        }

        if (empty($this->level)) {
            $this->level = 'error';
        }

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
        ];

        if (!empty($this->data)) {
            $output['data'] = $this->data;
        }

        return $output;
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
