<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'kilometers_range_min',
        'kilometers_range_max',
        'tariff'
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function basketZones(): HasMany
    {
        return $this->hasMany(BasketZone::class);
    }
}
