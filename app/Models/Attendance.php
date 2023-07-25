<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'date',
        'ended',
        'ended_by_admin',
        'ended_at',
    ];

    protected $casts = [
        'date' => 'datetime',
        'ended' => 'boolean',
        'ended_by_admin' => 'boolean',
        'ended_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($attendance) {
            DB::table('attendance_employee')
                ->where('attendance_id', $attendance->id)
                ->update(['deleted_at' => now()]);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class)
            ->withTrashed()
            ->withPivot('id', 'clock_in', 'clock_out', 'missed', 'dsr', 'sick', 'absence', 'done', 'deleted_at')
            ->withTimestamps()
            ->whereNull('attendance_employee.deleted_at');
    }

    public function detachEmployee(int $id): void
    {
        DB::table('attendance_employee')
            ->where('id', $id)
            ->update(['deleted_at' => now()]);
    }
}
