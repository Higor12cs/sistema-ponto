<?php

namespace App\Http\Livewire\Admin\Attendance;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

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
            Column::make('Código', 'id')
                ->sortable()
                ->collapseOnTablet(),
            Column::make('Responsável', 'user.name')
                ->sortable(),
            Column::make('Data', 'date')
                ->sortable()
                ->format(fn ($value) => $value->format('d/m/Y')),
            Column::make('ended', 'ended')
                ->hideIf(true),
            Column::make('Status')
                ->label(
                    fn ($row) => $row->ended == true ? '<span class="badge bg-primary">Finalizado '.$row->ended_at?->format('d/m/Y - H:i').'</span>' : '<span class="badge bg-danger">Aberto</span>'
                )->html()
                ->collapseOnTablet(),
            Column::make('Criado Em', 'created_at')
                ->sortable()
                ->format(fn ($value) => $value->format('d/m/Y H:i'))
                ->collapseOnTablet(),
        ];
    }

    public function filters(): array
    {
        return [
            DateFilter::make('Data Ponto')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('date', $value);
                }),
            MultiSelectFilter::make('Responsáveis')
                ->options(
                    User::query()
                        ->where('is_admin', false)
                        ->orderBy('name')
                        ->get()
                        ->keyBy('id')
                        ->map(fn ($tag) => $tag->name)
                        ->toArray()
                )
                ->filter(function (Builder $builder, array $array) {
                    $builder->whereIn('user_id', $array);
                }),
            SelectFilter::make('Status')
                ->options([
                    '' => 'Todos',
                    false => 'Aberto',
                    true => 'Finalizado',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('ended', $value);
                }),
        ];
    }
}
