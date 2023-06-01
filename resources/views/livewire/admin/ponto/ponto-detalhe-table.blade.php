<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <th class="col-2">Código</th>
            <th class="col-5">Funcionário</th>
            <th class="col-2">Entrada</th>
            <th class="col-2">Saída</th>
            <th class="col-1">Ações</th>
        </thead>
        <tbody>
            @forelse ($funcionarios as $funcionario)
                <tr class="@if ($funcionario->pivot->missed) table-danger @endif">
                    <td>{{ $funcionario->id }}</td>
                    <td>{{ $funcionario->nome }}</td>
                    <td>
                        @if (!empty($funcionario->pivot->entrada1))
                            {{ date('H:i', strtotime($funcionario->pivot->entrada1)) }}
                        @endif
                    </td>
                    <td>
                        @if (!empty($funcionario->pivot->saida1))
                            {{ date('H:i', strtotime($funcionario->pivot->saida1)) }}
                        @endif
                    </td>
                    <td class="text-nowrap">
                        <button wire:click="removerFuncionario({{ $funcionario }})" class="btn btn-sm btn-danger"
                            @if ($ponto->finalizado) disabled @endif>Remover</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Nenhum funcionário adicionado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
