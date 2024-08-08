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
        'basket_charged_daily_37H',
        'basket_charged_daily_35H',
    ];

    public static function calculateBasketCharged($basket): float
    {
        return $basket * 1.70; // Exemple de calcul
    }

    public static function calculateBasketChargedDaily37H($basketCharged): float
    {
        return $basketCharged / 7.4; // Exemple de calcul
    }

    public static function calculateBasketChargedDaily35H($basketCharged): float
    {
        return $basketCharged / 7; // Exemple de calcul
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class);
    }
}
