<?php

namespace Tests\Unit;

use App\Repositories\GuestsRepository;
use App\Services\Scenarios\GuestGetOneScenario;
use Illuminate\Contracts\Container\BindingResolutionException;
use JetBrains\PhpStorm\NoReturn;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\DataProvider;
use Spatie\LaravelData\Data;
use Tests\TestCase;

class GuestScenariosTest extends TestCase
{

    /**
     * @throws BindingResolutionException
     */
    #[NoReturn] #[DataProvider('phoneCountry')]
    public function testGetOne(array $dummyGuest): void
    {
        $this->instance(GuestsRepository::class,
            Mockery::mock(GuestsRepository::class, function (MockInterface $mock) use ($dummyGuest) {
                $mock->shouldReceive('getOne')
                    ->with(1, null, null, null)
                    ->andReturn($dummyGuest)
                    ->once();
            })
        );

        /** @var GuestGetOneScenario $scenario */
        $scenario = $this->app->make(GuestGetOneScenario::class);
        $result = $scenario->handle(1);

        $this->assertInstanceOf(Data::class, $result);
        $this->assertArrayIsEqualToArrayIgnoringListOfKeys(
            $dummyGuest, $result->toArray(), []
        );
    }

    public static function phoneCountry(): array
    {
        return [
            [
                [
                    'id' => 1,
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'email' => 'testing@example.com',
                    'phone_number' => '+79781231213',
                    'country' => 'Russian Federation',
                    'created_at' => now()->format('Y-m-d H:i:s'),
                    'updated_at' => now()->format('Y-m-d H:i:s')
                ]
            ]
        ];
    }
}
