<?php

namespace App\Console\Commands;

use App\Services\PhoneNumberService;
use Illuminate\Console\Command;

class TestingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:testing-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(PhoneNumberService $phoneService)
    {
        PhoneNumberService::validatePhoneNumber('+447534418723');
    }
}
