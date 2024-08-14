<?php

namespace App\Data\Guest;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class GuestResponseData extends Data
{
    public function __construct(
        #[MapName('phone_number', 'phone_number')]
        public string $phoneNumber,
        #[MapName('first_name', 'first_name')]
        public string $firstName,
        #[MapName('last_name', 'last_name')]
        public string $lastName,
        #[MapName('created_at')]
        #[WithCast(DateTimeInterfaceCast::class)]
        public Carbon $createdAt,
        #[MapName('updated_at')]
        #[WithCast(DateTimeInterfaceCast::class)]
        public Carbon $updatedAt,
        public ?string $email,
        public ?string $country = null,
        public ?int $id = null,
    ) {}
}
