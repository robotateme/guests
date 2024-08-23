<?php

namespace App\Services\Exceptions;

use App\Services\Exceptions\Contracts\ScenarioException;

class ScenarioNotFoundException extends ScenarioException
{
    protected $message = 'Entity not found';
}