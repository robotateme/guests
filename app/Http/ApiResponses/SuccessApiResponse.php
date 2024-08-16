<?php

namespace App\Http\ApiResponses;

use App\Http\ApiResponses\Contracts\ApiResponse;
use Illuminate\Http\JsonResponse;

class SuccessApiResponse extends ApiResponse
{
    public function toResponse($request): JsonResponse
    {
        $this->setSuccess(true);
        parent::toResponse($request);
        return $this;
    }

    protected function getResponseCode(): int
    {
        return self::HTTP_OK;
    }
}
