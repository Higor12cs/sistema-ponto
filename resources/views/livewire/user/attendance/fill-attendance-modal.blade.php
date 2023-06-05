<div wire:ignore.self class="modal fade" id="attendanceModal" tabindex="-1" aria-labelledby="apontamentoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form wire:submit.prevent="save">
                <div class="modal-header">
                    <h5 class="modal-title" id="apontamentoModalLabel">{{ __('Apontar Funcionário') }}</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="clock_in" class="form-label">{{ __('Entrada') }}</label>
                            <input wire:model.defer="clock_in" type="time"
                                class="form-control @if ($errors->has('clock_in')) is-invalid @endif"
                                @if ($missed) disabled @endif>
                            @if ($errors->has('clock_in'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('clock_in') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3 col-6">
                            <label for="clock_out" class="form-label">{{ __('Saída') }}</label>
                            <input wire:model.defer="clock_out" type="time"
                                class="form-control @if ($errors->has('clock_out')) is-invalid @endif"
                                @if ($missed) disabled @endif>
                            @if ($errors->has('clock_out'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('clock_out') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <input wire:model="missed" type="checkbox" class="form-check-input">
                            <label class="form-check-label ms-1" for="missed">{{ __('Funcionário faltou?') }}</label>
                            @if ($errors->has('missed'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('missed') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-coreui-dismiss="modal">{{ __('Cancelar') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
