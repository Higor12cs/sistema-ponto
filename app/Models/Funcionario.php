<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Funcionario extends Model
{
    use HasFactory;

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
        return $this->belongsToMany(Ponto::class);
    }
}
