<?php

namespace dhope0000\Snap\Exception;

use Http\Client\Exception\HttpException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ConflictException extends HttpException
{
    protected $message = 'Resource already exists.';
    
    public function __construct(RequestInterface $request, ResponseInterface $response, \Exception $previous = null)
    {
        parent::__construct($this->message, $request, $response, $previous);
    }
}
