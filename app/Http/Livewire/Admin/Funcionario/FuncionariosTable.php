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
        $this->setPrimaryKey('id');
        $this->setTdAttributes(function (Column $column) {
            if (in_array($column->getTitle(),  ['Ativo', 'Ações'])) {
                return [
                    'default' => false,
                    'style' => 'width:50px',
                ];
            }
            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make("Código", "id")
                ->sortable()
                ->searchable(),
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
                ->format(fn ($value) => $value->format('d/m/Y H:i')),
            Column::make("Ativo")
                ->label(
                    fn ($row) => $row->ativo == true ? '<span class="badge bg-success">Ativo</span>' : '<span class="badge bg-danger">Desativado</span>'
                )->html(),
            Column::make('Ações')
                ->label(
                    function ($row) {
                        $edit = '<a href="' . route('admin.funcionarios.edit', $row) . '" class="btn btn-secondary btn-sm me-1">Editar</a>';
                        $delete = '<button class="btn btn-danger btn-sm">Excluir</button>';
                        return '<div class="text-nowrap">' . $edit . $delete . '</div>';
                    }
                )->html(),
        ];
    }
}
