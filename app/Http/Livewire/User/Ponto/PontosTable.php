<?php

namespace App\Http\Livewire\User\Ponto;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Ponto;
use Illuminate\Database\Eloquent\Builder;

class PontosTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Ponto::query()
            ->with('user')
            ->where('user_id', auth()->user()->id)
            ->where('finalizado', false)
            ->select();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('data', 'asc')
            ->setTableRowUrl(function ($row) {
                return route('pontos.preencher', $row);
            })
            ->setSearchDisabled()
            ->setTdAttributes(function (Column $column) {
                if (in_array($column->getTitle(),  ['Ações'])) {
                    return [
                        'default' => false,
                        'style' => 'width:50px',
                    ];
                }
                return [];
            })
            ->setEmptyMessage('Nenhum ponto disponível para preenchimento.');
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
        ];
    }
}
