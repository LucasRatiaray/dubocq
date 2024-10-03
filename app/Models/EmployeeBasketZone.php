<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeBasketZone extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'zone_id',
        'employee_basket_zone_charged',
        'employee_basket_zone_day',
        'employee_basket_zone_night',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }
}
