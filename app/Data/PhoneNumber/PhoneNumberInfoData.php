<?php

namespace App\Data\PhoneNumber;

use Spatie\LaravelData\Data;

class PhoneNumberInfoData extends Data
{
    public function __construct(
        public string $phoneNumber,
        public string $countryCode,
        public ?string $countryName = null,
    ) {
    }
}
