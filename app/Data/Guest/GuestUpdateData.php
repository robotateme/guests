<?php

namespace App\Data\Guest;

use App\Data\Casts\NormalizePhoneCast;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class GuestUpdateData extends Data
{
    public function __construct(
        public int $id,
        #[WithCast(NormalizePhoneCast::class)]
        #[MapName('phone_number', 'phone_number')]
        public string $phoneNumber,
        #[MapName('first_name', 'first_name')]
        public string $firstName,
        #[MapName('last_name', 'last_name')]
        public string $lastName,
        public ?string $email,
        public ?string $country = null,
    ) {}
}
