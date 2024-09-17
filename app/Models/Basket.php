<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Basket extends Model
{
    use HasFactory;

    protected $fillable = [
        'basket',
        'basket_charged',
    ];

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class);
    }
}
