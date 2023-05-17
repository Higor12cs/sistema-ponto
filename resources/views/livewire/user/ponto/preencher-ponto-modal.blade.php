<div wire:ignore.self class="modal fade" id="apontamentoModal" tabindex="-1" aria-labelledby="apontamentoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form wire:submit.prevent="salvar">
                <div class="modal-header">
                    <h5 class="modal-title" id="apontamentoModalLabel">Apontar Funcionário</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="entrada1" class="form-label">Entrada</label>
                            <input wire:model.defer="entrada1" type="time"
                                class="form-control @if ($errors->has('entrada1')) is-invalid @endif" id="entrada1"
                                name="entrada1">
                            @if ($errors->has('entrada1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('entrada1') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3 col-6">
                            <label for="saida1" class="form-label">Saída</label>
                            <input wire:model.defer="saida1" type="time"
                                class="form-control @if ($errors->has('saida1')) is-invalid @endif" id="saida1"
                                name="saida1">
                            @if ($errors->has('saida1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('saida1') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
