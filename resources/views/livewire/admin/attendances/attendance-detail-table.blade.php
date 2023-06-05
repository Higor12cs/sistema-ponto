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
                <tr class="@if ($employee->pivot->missed) table-danger @endif">
                    <td>{{ $employee->id }}</td>
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
                    <td class="text-nowrap">
                        <button wire:click="removeEmploye({{ $employee }})" class="btn btn-sm btn-danger"
                            @if ($attendance->ended) disabled @endif>{{ __('Remover') }}</button>
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
