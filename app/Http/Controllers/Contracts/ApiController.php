<?php

namespace App\Http\Controllers\Contracts;

use App\Http\ApiResponses\ApiResponseTrait;

abstract class ApiController extends Controller
{
    use ApiResponseTrait;
}