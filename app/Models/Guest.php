<?php

namespace App\Models;

use App\Observers\GuestObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(GuestObserver::class)]
class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_number',
        'first_name',
        'last_name',
        'email',
        'country',
    ];
}
