<?php

namespace App\Data\PhoneNumber;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;

class PhoneNumberInfoData extends Data
{
    public function __construct(
        #[MapName('phone_number', 'phone_number')]
        public string $phoneNumber,
        #[MapName('country_code', 'country_code')]
        public string $countryCode,
        #[MapName('country_name', 'country_name')]
        public ?string $countryName = null,
    ) {
    }
}
