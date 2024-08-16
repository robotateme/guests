<?php

namespace App\Http\ApiResponses\Enums;

use Exception;
use Illuminate\Http\Response;

enum StatusMessagesEnum: int
{
    case SuccessCode = 200;
    case NotFoundCode = 404;
    case FoundCode = 302;
    case NoContentCode = 204;
    case BadRequestCode = 400;
    case CreatedCode = 201;
    case TeapotCode = 418;
    case UnauthorizedCode = 401;
    case InternalErrorCode = 500;

    /**
     * @return string
     */
    public function message(): string
    {
        return match ($this) {
            self::SuccessCode => 'Ok',
            self::FoundCode => 'Found',
            self::NotFoundCode => 'Not Found',
            self::NoContentCode => 'No content',
            self::CreatedCode => 'Created',
            self::BadRequestCode => 'Bad request',
            self::InternalErrorCode => 'Internal server error',
            self::UnauthorizedCode => 'Unauthorized',
            self::TeapotCode => 'I\'m a teapot'
        };
    }

    /**
     * @param  int  $code
     * @return StatusMessagesEnum
     */
    public static function getCase(int $code): StatusMessagesEnum
    {
        return self::tryFrom($code) ?? self::TeapotCode;
    }
}
