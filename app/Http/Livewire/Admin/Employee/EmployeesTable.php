<?php

namespace App\Http\Livewire\Admin\Employee;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Employee;

class EmployeesTable extends DataTableComponent
{
    protected $model = Employee::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'desc')
            ->setTableRowUrl(function ($row) {
                return route('admin.employees.show', $row);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Código", "id")
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make("Matrícula", "registration")
                ->sortable()
                ->searchable(),
            Column::make("Nome", "name")
                ->sortable()
                ->searchable(),
            Column::make("", "active")
                ->sortable()
                ->hideIf(true),
            Column::make("Data Cadastro", "created_at")
                ->sortable()
                ->format(fn ($value) => $value->format('d/m/Y H:i'))
                ->collapseOnTablet(),
            Column::make("Ativo")
                ->label(
                    fn ($row) => $row->active == true ? '<span class="badge bg-primary">Ativo</span>' : '<span class="badge bg-danger">Desativado</span>'
                )->html()
                ->collapseOnTablet(),
        ];
    }
}
