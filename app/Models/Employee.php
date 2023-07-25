<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'registration',
        'name',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function attendances(): BelongsToMany
    {
        return $this->belongsToMany(Attendance::class)
            ->withPivot('id', 'clock_in', 'clock_out', 'missed', 'dsr', 'sick', 'absence', 'done', 'deleted_at')
            ->withTimestamps()
            ->whereNull('attendance_employee.deleted_at');
    }
}
