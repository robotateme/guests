<?php

namespace App\Data\Guest;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;

class GuestStoreData extends Data
{
    public function __construct(
        #[MapName('phone_number', 'phone_number')]
        public string $phoneNumber,
        #[MapName('first_name', 'first_name')]
        public string $firstName,
        #[MapName('last_name', 'last_name')]
        public string $lastName,
        public ?string $email,
        public ?string $country = null,
        public ?int $id = null,
    ) {
    }
}
