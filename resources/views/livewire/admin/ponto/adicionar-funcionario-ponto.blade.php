<div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            {{ __('Adicionar Funcionários') }}
        </div>
        <div class="card-body">
            <form wire:submit.prevent="adicionar">
                <div class="mb-3">
                    <label for="funcionario" class="form-label">Funcionário</label>
                    <select wire:model="funcionario"
                        class="form-select @if ($errors->has('funcionario')) is-invalid @endif"
                        aria-label="Seleção de Funcionário" id="funcionario" name="funcionario">
                        <option value="">-- selecione --</option>
                        @foreach ($funcionarios as $funcionario)
                            <option value="{{ $funcionario->id }}">
                                {{ $funcionario->nome . ' - ' . $funcionario->matricula }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('funcionario'))
                        <div class="invalid-feedback">
                            {{ $errors->first('funcionario') }}
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Incluir</button>
            </form>
        </div>
    </div>
</div>
