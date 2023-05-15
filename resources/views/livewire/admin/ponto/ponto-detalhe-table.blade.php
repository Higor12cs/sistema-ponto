<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <th class="col-2">Código</th>
            <th class="col-5">Funcionário</th>
            <th class="col-2">Entrada</th>
            <th class="col-2">Saída</th>
            <th class="col-1">Ações</th>
        </thead>
        <tbody>
            @forelse ($funcionarios as $funcionario)
                <tr>
                    <td>{{ $funcionario->id }}</td>
                    <td>{{ $funcionario->nome }}</td>
                    <td>{{ $funcionario->pivot->entrada1 }}</td>
                    <td>{{ $funcionario->pivot->saida1 }}</td>
                    <td class="text-nowrap">
                        <button wire:click="removerFuncionario({{ $funcionario }})"
                            class="btn btn-sm btn-danger">Remover</button>
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
