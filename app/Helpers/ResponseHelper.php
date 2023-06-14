<?php

namespace App\Helpers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    public function __construct(
        readonly private ResponseFactory $response
    ){}

    const OK                   = 200;
    const CREATED              = 201;
    const NO_CONTENT           = 204;
    const UNAUTHORIZED         = 401;
    const FORBIDDEN            = 403;
    const NOT_FOUND            = 404;
    const METHOD_NOT_SUPPORTED = 405;
    const UNPROCESSABLE_ENTITY = 422;
    const SERVER_ERROR         = 501;

    public function oK($resource) : JsonResponse
    {
        return $this
        ->response
        ->json($resource, self::OK);
    }

    public function noContent() : JsonResponse
    {
        return $this
        ->response
        ->json('', self::NO_CONTENT);
    }

    public function notFound(
        string $message='Resource not found.'
    ) : JsonResponse {
        return $this
        ->response
        ->json(['message' => $message], self::NOT_FOUND);
    }

    public function unauthorized(
        string $message='This action is unauthorized'
    ) : JsonResponse {
        return $this
        ->response
        ->json(['message' => $message], self::UNAUTHORIZED);
    }

    public function denied(string $message='Access Denied') : JsonResponse
    {
        return $this
        ->response
        ->json(['message' => $message], self::FORBIDDEN);
    }

    public function methodNotSupported(
        string $message='Method not supported'
    ) : JsonResponse {
        return $this
        ->response
        ->json(['message' => $message], self::METHOD_NOT_SUPPORTED);
    }

    public function unauthenticated(
        string $message='Unauthenticated.'
    ) : JsonResponse {
        return $this
        ->response
        ->json(['message' => $message], self::UNAUTHORIZED);
    }

    public function forbidden(
        string $message='The action is forbidden.'
    ) : JsonResponse {
        return $this
        ->response
        ->json(['message' => $message], self::FORBIDDEN);
    }

    public function error(
        string $message='Some wrong data inputs found.'
    ) : JsonResponse {
        return $this
        ->response
        ->json(['message' => $message], self::UNPROCESSABLE_ENTITY);
    }

    public function server(
        string $message='A server error occurred.'
    ) : JsonResponse {
        return $this
        ->response
        ->json(['message' => $message], self::SERVER_ERROR);
    }
}