<?php

namespace App\Http\ApiResponses\Formats;

use App\Http\ApiResponses\Contracts\FormatInterface;
use Spatie\LaravelData\Data;

class DefaultFormat extends Data implements FormatInterface
{
    public function __construct(
        public bool $success = true,
        public int $status = 200,
        public string $message = '',
        public mixed $data = [],
        public mixed $meta = [],
    ) {
    }
}
