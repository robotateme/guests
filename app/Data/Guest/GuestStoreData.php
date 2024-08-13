<?php

namespace App\Data\Guest;

use Spatie\LaravelData\Data;

class GuestStoreData extends Data
{
    public function __construct(
        public string $phoneNumber,
        public string $firstName,
        public string $lastName,
        public ?string $email,
        public ?string $country = null,
        public ?int $id = null,
    ) {
    }
}
