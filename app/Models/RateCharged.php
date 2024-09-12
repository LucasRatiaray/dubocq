<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateCharged extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'rate_charged',
    ];
}
