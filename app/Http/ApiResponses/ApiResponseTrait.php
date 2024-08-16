<?php

namespace App\Http\ApiResponses;

use App\Http\Controllers\ApiResponses\Enums\StatusMessagesEnum;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    /**
     * @param  array|string|Arrayable|null  $data
     * @param  int  $statusCode
     * @param  string  $message
     * @return JsonResponse
     */
    public function responseSuccess(array|string|Arrayable $data = null, int $statusCode = 200, string $message = 'Ok'): JsonResponse
    {
        return ApiResponseFactory::make($statusCode, $message, $data);
    }

    /**
     * @param  int  $statusCode
     * @param  string|null  $message
     * @param  array|string|Arrayable|null  $data
     * @return JsonResponse
     */
    public function responseFail(int $statusCode, string $message = null, array|string|Arrayable $data = null): JsonResponse
    {
        return ApiResponseFactory::make($statusCode, $message, $data, false);
    }

    public function responseUnauthorized(): JsonResponse
    {
        return ApiResponseFactory::make(
            StatusMessagesEnum::UnauthorizedCode->value,
            StatusMessagesEnum::UnauthorizedCode->message(),
            success: false);
    }


    /**
     * @param  string|null  $message
     * @param  array  $data
     * @return JsonResponse
     */
    public function responseBadRequest(?string $message = null, array $data = []): JsonResponse
    {
        return ApiResponseFactory::make(
            StatusMessagesEnum::BadRequestCode->value,
            $message ?? StatusMessagesEnum::NotFoundCode->message(),
            data: $data,
            success: false);
    }

    /**
     * @return JsonResponse
     */
    public function responseNotFound(): JsonResponse
    {
        return ApiResponseFactory::make(
            StatusMessagesEnum::NotFoundCode->value,
            StatusMessagesEnum::NotFoundCode->message(),
            success: false);
    }

    /**
     * @param  array|Arrayable|null  $data
     * @return JsonResponse
     */
    public function responseCreated(array|Arrayable|null $data = null, bool $success = true): JsonResponse
    {
        return ApiResponseFactory::make(
            StatusMessagesEnum::CreatedCode->value,
            StatusMessagesEnum::CreatedCode->message(),
            data: $data ?? [],
            success: $success,
        );
    }

    /**
     * @param  array|Arrayable|null  $data
     * @return JsonResponse
     */
    public function responseFound(array|Arrayable|null $data = null): JsonResponse
    {
        return ApiResponseFactory::make(
            StatusMessagesEnum::FoundCode->value,
            StatusMessagesEnum::FoundCode->message(),
            $data
        );
    }

    /**
     * @return JsonResponse
     */
    public function responseNoContent(): JsonResponse
    {
        return ApiResponseFactory::make(
            StatusMessagesEnum::NoContentCode->value,
            StatusMessagesEnum::NoContentCode->message(),
            success: false);
    }

    public function responseError(): JsonResponse
    {
        return ApiResponseFactory::make(
            StatusMessagesEnum::InternalErrorCode->value,
            StatusMessagesEnum::InternalErrorCode->message(),
            success: false
        );
    }
}
