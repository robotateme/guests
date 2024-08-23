<?php

namespace App\Data\Casts;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class NormalizePhoneCast implements Cast
{

    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): string
    {
        return preg_replace('/\s+/', '', $value);
    }
}