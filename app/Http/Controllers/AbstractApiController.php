<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

abstract class AbstractApiController
{
    protected ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    final protected function buildPaginatedResponse(
        LengthAwarePaginator $data = null,
        int $statusCode = Response::HTTP_OK
    ): JsonResponse {
        return $this->responseFactory->json($data, $statusCode);
    }

    final protected function buildCollectionResponse(
        Collection $data = null,
        int $statusCode = Response::HTTP_OK
    ): JsonResponse {
        return $this->responseFactory->json($data, $statusCode);
    }
}
