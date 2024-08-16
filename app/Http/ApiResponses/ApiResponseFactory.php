<?php

namespace App\Http\ApiResponses;

use App\Http\Controllers\ApiResponses\Formats\DefaultFormat;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;

class ApiResponseFactory
{

    /**
     * @param  int  $statusCode
     * @param  string  $message
     * @param  array|Arrayable|string  $data
     * @param  bool  $success
     * @return JsonResponse
     */
    public static function make(int $statusCode, string $message = '', mixed $data = [], bool $success = true): JsonResponse
    {
        $resultData = new DefaultFormat($success, $statusCode, $message, $data);
        return new JsonResponse($resultData->toArray(), $statusCode);
    }
}
