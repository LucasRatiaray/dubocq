<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimeTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'employee_id',
        'hours',
        'night_hours',
        'absenceType',
        'date',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public static function getMonthlyHoursForProject($projectId)
    {
        return self::where('project_id', $projectId)
            ->selectRaw('SUM(hours) as total_hours, TO_CHAR(date, \'YYYY-MM\') as month')
            ->groupBy('month')
            ->get();
    }
}
