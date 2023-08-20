<?php

namespace App\Http\Livewire\User\Attendance;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Attendance;
use App\Models\Configuration;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class AttendancesTable extends DataTableComponent
{
    public function builder(): Builder
    {
        $userAttendanceDisplayLimit = Configuration::where('key', 'USER_ATTENDANCE_DISPLAY_LIMIT')->first();

        return Attendance::query()
            ->with('user')
            ->where('user_id', auth()->user()->id)
            ->where('ended', false)
            ->whereBetween('date', [Carbon::today()->subDays($userAttendanceDisplayLimit->value), Carbon::today()])
            ->select();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('date', 'asc')
            ->setTableRowUrl(function ($row) {
                return route('attendances.fill', $row);
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
            Column::make("Data", "date")
                ->sortable()
                ->format(fn ($value) => $value->format('d/m/Y')),
        ];
    }
}
