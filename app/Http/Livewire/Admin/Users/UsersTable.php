<?php

namespace App\Http\Livewire\Admin\Users;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class UsersTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'desc')
            ->setTableRowUrl(function ($row) {
                return route('admin.users.show', $row);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Código", "id")
                ->sortable()
                ->collapseOnTablet(),
            Column::make("Matrícula", "registration")
                ->sortable()
                ->searchable(),
            Column::make("Nome", "name")
                ->sortable()
                ->searchable(),
            Column::make("Usuário", "username")
                ->sortable()
                ->collapseOnTablet(),
            Column::make("is_admin")
                ->hideIf(true),
            Column::make("Tipo Usuário")
                ->label(
                    fn ($row) => $row->is_admin == true ? '<h6><span class="badge bg-success">Administrador</span></h6>' : '<h6><span class="badge bg-primary">Responsável</span></h6>'
                )->html()
                ->collapseOnTablet(),
            Column::make("active")
                ->hideIf(true),
            Column::make("Ativo")
                ->label(
                    fn ($row) => $row->active == true ? '<h6><span class="badge bg-primary">Ativo</span></h6>' : '<h6><span class="badge bg-danger">Inativo</span></h6>'
                )->html()
                ->collapseOnTablet(),
            Column::make("Data Cadastro", "created_at")
                ->sortable()
                ->format(fn ($value) => $value->format('d/m/Y H:i'))
                ->collapseOnTablet(),
        ];
    }
}
