<?php

namespace dhope0000\Snap\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Http\Client\Exception\HttpException;
use dhope0000\Snap\Exception\AuthenticationFailedException;
use dhope0000\Snap\Exception\NotFoundException;
use dhope0000\Snap\Exception\ConflictException;

/**
 * Handle Snap errors
 *
 */
class SnapExceptionThower implements Plugin
{
    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first)
    {
        $promise = $next($request);

        return $promise->then(function (ResponseInterface $response) use ($request) {
            return $response;
        }, function (\Exception $e) use ($request) {
            if (get_class($e) === HttpException::class) {
                $response = $e->getResponse();

                if (401 === $response->getStatusCode()) {
                    throw new AuthenticationFailedException($request, $response, $e);
                }

                if (403 === $response->getStatusCode()) {
                    throw new AuthenticationFailedException($request, $response, $e);
                }

                if (404 === $response->getStatusCode()) {
                    throw new NotFoundException($request, $response, $e);
                }

                if (409 === $response->getStatusCode()) {
                    throw new ConflictException($request, $response, $e);
                }
            }

            throw $e;
        });
    }
}
