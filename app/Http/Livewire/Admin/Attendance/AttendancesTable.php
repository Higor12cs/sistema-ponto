<?php

namespace App\Http\Livewire\Admin\Attendance;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Attendance;
use Illuminate\Database\Eloquent\Builder;

class AttendancesTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Attendance::query()->with('user')->select();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('attendances.id', 'desc')
            ->setTableRowUrl(function ($row) {
                return route('admin.attendances.edit', $row);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Código", "id")
                ->sortable(),
            Column::make("Responsável", "user.name")
                ->sortable(),
            Column::make("Data", "date")
                ->sortable()
                ->format(fn ($value) => $value->format('d/m/Y')),
            Column::make("Criado Em", "created_at")
                ->sortable()
                ->format(fn ($value) => $value->format('d/m/Y H:i')),
        ];
    }
}
