<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ponto extends Model
{
    use HasFactory;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function funcionarios(): BelongsToMany
    {
        return $this->belongsToMany(Funcionario::class)
            ->withPivot('id', 'entrada1', 'saida1');
    }
}
