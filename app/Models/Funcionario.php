<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Funcionario extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'matricula',
        'nome',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];

    public function pontos(): BelongsToMany
    {
        return $this->belongsToMany(Ponto::class)
            ->withPivot('id', 'entrada1', 'saida1', 'missed', 'deleted_at')
            ->withTimestamps()
            ->whereNull('funcionario_ponto.deleted_at');
    }
}
