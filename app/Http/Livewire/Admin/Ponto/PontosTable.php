<?php

namespace App\Http\Livewire\Admin\Ponto;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Ponto;
use Illuminate\Database\Eloquent\Builder;

class PontosTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Ponto::query()->with('user')->select();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('pontos.id', 'desc')
            ->setTableRowUrl(function ($row) {
                return route('admin.pontos.edit', $row);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Código", "id")
                ->sortable(),
            Column::make("Responsável", "user.name")
                ->sortable(),
            Column::make("Data", "data")
                ->sortable()
                ->format(fn ($value) => $value->format('d/m/Y')),
            Column::make("Criado Em", "created_at")
                ->sortable()
                ->format(fn ($value) => $value->format('d/m/Y H:i')),
        ];
    }
}
