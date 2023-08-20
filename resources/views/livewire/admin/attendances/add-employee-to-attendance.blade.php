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
            <form wire:submit.prevent="add">
                <div class="mb-3">
                    <label for="employee" class="form-label">{{ __('Funcionário') }}</label>
                    <select wire:model="employee" wire:loading.attr="disabled"
                        class="form-select @if ($errors->has('employee')) is-invalid @endif" id="employee"
                        name="employee">
                        <option value="">{{ __('-- selecione --') }}</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">
                                {{ $employee->name . ' - ' . $employee->registration }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('employee'))
                        <div class="invalid-feedback">
                            {{ $errors->first('employee') }}
                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">{{ __('Incluir') }}</button>
                    <a href="{{ route('admin.attendances.close', $attendance) }}" class="btn btn-danger">{{ __('Fechar Ponto') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
