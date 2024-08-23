<?php

namespace App\Repositories;

use App\Repositories\Contracts\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class GuestsRepository extends BaseRepository
{
    const string TABLE_NAME = 'guests';
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }
}