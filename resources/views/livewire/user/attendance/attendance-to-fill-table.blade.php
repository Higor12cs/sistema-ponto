<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead>
            <th class="col-6">{{ __('Funcionário') }}</th>
            <th class="col-2">{{ __('Entrada') }}</th>
            <th class="col-2">{{ __('Saída') }}</th>
            <th class="col-1">{{ __('Ações') }}</th>
        </thead>
        <tbody>
            @forelse ($employees as $employee)
                <tr class="@if ($employee->pivot->missed) table-danger @endif">
                    <td>{{ $employee->name }}</td>
                    <td>
                        @if ($employee->pivot->missed)
                            <span class="badge bg-danger">{{ __('Faltou') }}</span>
                        @elseif (!empty($employee->pivot->clock_in))
                            {{ date('H:i', strtotime($employee->pivot->clock_in)) }}
                        @endif
                    </td>
                    <td>
                        @if ($employee->pivot->missed)
                            <span class="badge bg-danger">{{ __('Faltou') }}</span>
                        @elseif (!empty($employee->pivot->clock_out))
                            {{ date('H:i', strtotime($employee->pivot->clock_out)) }}
                        @endif
                    </td>
                    <td>
                        <button wire:click="$emit('clockEmploye', {{ $employee }})"
                            class="btn btn-sm btn-primary">{{ __('Preencher') }}</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">{{ __('Nenhum funcionário encontrado.') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
