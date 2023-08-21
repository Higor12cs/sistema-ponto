<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <th class="col-2">{{ __('Código') }}</th>
            <th class="col-5">{{ __('Funcionário') }}</th>
            <th class="col-2">{{ __('Entrada') }}</th>
            <th class="col-2">{{ __('Saída') }}</th>
            <th class="col-1">{{ __('Ações') }}</th>
        </thead>
        <tbody>
            @forelse ($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>
                        @if ($employee->pivot->missed)
                            <span class="badge bg-danger">{{ __('Faltou') }}</span>
                        @elseif ($employee->pivot->dsr)
                            <span class="badge bg-info">{{ __('DSR') }}</span>
                        @elseif ($employee->pivot->sick)
                            <span class="badge bg-warning">{{ __('Atestado') }}</span>
                        @elseif ($employee->pivot->absence)
                            <span class="badge bg-secondary">{{ __('Abonado') }}</span>
                        @elseif ($employee->pivot->vacation)
                            <span class="badge bg-success">{{ __('Férias') }}</span>
                        @elseif ($employee->pivot->dismissed)
                            <span class="badge bg-dark">{{ __('Dispensado') }}</span>
                        @elseif (!empty($employee->pivot->clock_in))
                            {{ date('H:i', strtotime($employee->pivot->clock_in)) }}
                        @endif
                    </td>
                    <td>
                        @if ($employee->pivot->missed)
                            <span class="badge bg-danger">{{ __('Faltou') }}</span>
                        @elseif ($employee->pivot->dsr)
                            <span class="badge bg-info">{{ __('DSR') }}</span>
                        @elseif ($employee->pivot->sick)
                            <span class="badge bg-warning">{{ __('Atestado') }}</span>
                        @elseif ($employee->pivot->absence)
                            <span class="badge bg-secondary">{{ __('Abonado') }}</span>
                        @elseif ($employee->pivot->vacation)
                            <span class="badge bg-success">{{ __('Férias') }}</span>
                        @elseif ($employee->pivot->dismissed)
                            <span class="badge bg-dark">{{ __('Dispensado') }}</span>
                        @elseif (!empty($employee->pivot->clock_out))
                            {{ date('H:i', strtotime($employee->pivot->clock_out)) }}
                        @endif
                    </td>
                    <td class="text-nowrap">
                        <button wire:click="removeEmploye({{ $employee }})" class="btn btn-sm btn-danger" @if ($attendance->ended) disabled @endif>{{ __('Remover') }}</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">{{ __('Nenhum funcionário adicionado.') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
