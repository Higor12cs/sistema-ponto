<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Ponto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'data',
        'finalizado',
        'finalizado_em',
    ];

    protected $casts = [
        'data' => 'datetime',
        'finalizado' => 'boolean',
        'finalizado_em' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($ponto) {
            DB::table('funcionario_ponto')
                ->where('ponto_id', $ponto->id)
                ->update(['deleted_at' => now()]);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function funcionarios(): BelongsToMany
    {
        return $this->belongsToMany(Funcionario::class)
            ->withTrashed()
            ->withPivot('id', 'entrada1', 'saida1', 'missed', 'deleted_at')
            ->withTimestamps()
            ->whereNull('funcionario_ponto.deleted_at');
    }

    public function detachEmployee(int $id): void
    {
        DB::table('funcionario_ponto')
            ->where('id', $id)
            ->update(['deleted_at' => now()]);
    }
}
