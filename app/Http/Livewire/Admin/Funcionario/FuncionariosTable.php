<?php

namespace App\Http\Livewire\Admin\Funcionario;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Funcionario;

class FuncionariosTable extends DataTableComponent
{
    protected $model = Funcionario::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('admin.funcionarios.show', $row);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Código", "id")
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make("Matrícula", "matricula")
                ->sortable()
                ->searchable(),
            Column::make("Nome", "nome")
                ->sortable()
                ->searchable(),
            Column::make("", "ativo")
                ->sortable()
                ->hideIf(true),
            Column::make("Data Cadastro", "created_at")
                ->sortable()
                ->format(fn ($value) => $value->format('d/m/Y H:i'))
                ->collapseOnTablet(),
            Column::make("Ativo")
                ->label(
                    fn ($row) => $row->ativo == true ? '<span class="badge bg-success">Ativo</span>' : '<span class="badge bg-danger">Desativado</span>'
                )->html()
                ->collapseOnTablet(),
        ];
    }
}
