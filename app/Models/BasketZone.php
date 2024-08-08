<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BasketZone extends Model
{
    use HasFactory;

    protected $fillable = [
        'zone_id',
        'basket_zone',
        'basket_zone_charged',
        'basket_zone_charged_daily_37H',
        'basket_zone_charged_daily_35H',
    ];

    protected static float $basketChargedMultiplier = 1.70;
    protected static float $basketChargedDaily37HDivisor = 7.4;
    protected static int $basketChargedDaily35HDivisor = 7;

    public static function calculateBasketCharged($basket): float
    {
        return $basket * self::$basketChargedMultiplier;
    }

    public static function calculateBasketChargedDaily37H($basketCharged): float
    {
        return $basketCharged / self::$basketChargedDaily37HDivisor;
    }

    public static function calculateBasketChargedDaily35H($basketCharged): float
    {
        return $basketCharged / self::$basketChargedDaily35HDivisor;
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class);
    }
}
