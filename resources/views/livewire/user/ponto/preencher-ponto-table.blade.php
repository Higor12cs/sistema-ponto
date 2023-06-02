<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead>
            <th class="col-6">Funcionário</th>
            <th class="col-2">Entrada</th>
            <th class="col-2">Saída</th>
            <th class="col-1">Ações</th>
        </thead>
        <tbody>
            @forelse ($funcionarios as $funcionario)
                <tr class="@if ($funcionario->pivot->missed) table-danger @endif">
                    <td>{{ $funcionario->nome }}</td>
                    <td>
                        @if ($funcionario->pivot->missed)
                            <span class="badge bg-danger">Faltou</span>
                        @elseif (!empty($funcionario->pivot->entrada1))
                            {{ date('H:i', strtotime($funcionario->pivot->entrada1)) }}
                        @endif
                    </td>
                    <td>
                        @if ($funcionario->pivot->missed)
                            <span class="badge bg-danger">Faltou</span>
                        @elseif (!empty($funcionario->pivot->saida1))
                            {{ date('H:i', strtotime($funcionario->pivot->saida1)) }}
                        @endif
                    </td>
                    <td>
                        <button wire:click="$emit('apontarFuncionario', {{ $funcionario }})"
                            class="btn btn-sm btn-primary">Preencher</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Nenhum funcionário encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
