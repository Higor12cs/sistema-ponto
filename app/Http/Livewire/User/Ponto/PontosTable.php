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
            ->select();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setSearchDisabled()
            ->setTdAttributes(function (Column $column) {
                if (in_array($column->getTitle(),  ['Ações'])) {
                    return [
                        'default' => false,
                        'style' => 'width:50px',
                    ];
                }
                return [];
            });
            // ->setTableRowUrl(fn ($row) => route('pontos.preencher', $row));
    }

    public function columns(): array
    {
        return [
            Column::make("Código", "id")
                ->sortable()
                ->collapseOnTablet(),
            Column::make("Responsável", "user.name")
                ->sortable()
                ->collapseOnTablet(),
            Column::make("Data", "data")
                ->sortable()
                ->format(fn ($value) => $value->format('d/m/Y')),
            Column::make("Criado Em", "created_at")
                ->sortable()
                ->collapseOnTablet()
                ->format(fn ($value) => $value->format('d/m/Y')),
            Column::make('Ações')
                ->label(
                    fn ($row) => '<a href="' . route('pontos.preencher', $row) . '" class="btn btn-secondary btn-sm">Preencher</a>'
                )
                ->html(),
        ];
    }
}
