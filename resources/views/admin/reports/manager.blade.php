@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>{{ __('Relatório por Responsável') }}</h4>
        <div class="d-flex">
        </div>
    </div>

    <x-alerts />

    <div class="card mb-4">
        <div class="card-header">
            {{ __('Relatório por Responsável') }}
        </div>
        <div class="card-body">
            <form id="report" action="{{ route('admin.reports.manager') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="user_id" class="form-label">Responsável</label>
                    <select wire:model="user_id" class="form-select @if ($errors->has('user_id')) is-invalid @endif" id="user_id" name="user_id">
                        <option value="">{{ __('-- selecione --') }}</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @if (isset($user_id) && $user->id == $user_id) selected @endif>
                                {{ $user->name . ' - ' . $user->id }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('user_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('user_id') }}
                        </div>
                    @endif
                </div>
                <div class="row mb-4">
                    <div class="col-6">
                        <label for="start_date" class="form-label">{{ __('Data Inicio') }}</label>
                        <input type="date" class="form-control @if ($errors->has('start_date')) is-invalid @endif" id="start_date" name="start_date" value="{{ $start_date ?? '' }}">
                        @if ($errors->has('start_date'))
                            <div class="invalid-feedback">
                                {{ $errors->first('start_date') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-6">
                        <label for="end_date" class="form-label">{{ __('Data Fim') }}</label>
                        <input type="date" class="form-control @if ($errors->has('end_date')) is-invalid @endif" id="end_date" name="end_date" value="{{ $end_date ?? '' }}">
                        @if ($errors->has('end_date'))
                            <div class="invalid-feedback">
                                {{ $errors->first('end_date') }}
                            </div>
                        @endif
                    </div>
                </div>
            </form>
            <div class="d-flex justify-content-start">
                <button form="report" type="submit" class="btn btn-primary">{{ __('Emitir Relatório') }}</button>
            </div>
        </div>
    </div>

    @isset($report)
        <div class="card mb-4">
            <div class="card-header">{{ __('Relatório') }}</div>
            <div class="card-body">

                @forelse ($attendances as $attendance)
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-dark">
                                <th>{{ __('Ponto') }}</th>
                                <th>{{ __('Data') }}</th>
                                <th>{{ __('Responsável') }}</th>
                            </thead>
                            <tbody>
                                <tr class="fw-bold">
                                    <td class="col-2">{{ str_pad($attendance->id, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td class="col-4">{{ $attendance->date->format('d/m/Y') }}</td>
                                    <td class="col-6">{{ $attendance->user->name }}</td>
                                <tr>
                                    <td colspan="4">
                                        <table class="table table-striped table-hover">
                                            <thead class="table-dark">
                                                <th>{{ __('Funcionário') }}</th>
                                                <th>{{ __('Entrada') }}</th>
                                                <th>{{ __('Saida') }}</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($attendance->employees as $employee)
                                                    <tr>
                                                        <td class="col-8">{{ $employee->name }}</td>
                                                        <td class="col-2">
                                                            @if (!empty($employee->pivot->clock_in))
                                                                {{ date('H:i', strtotime($employee->pivot->clock_in)) }}
                                                            @elseif ($employee->pivot->missed)
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
                                                            @else
                                                                {{ __('Não Preenchido') }}
                                                            @endif
                                                        </td>
                                                        <td class="col-2">
                                                            @if (!empty($employee->pivot->clock_out))
                                                                {{ date('H:i', strtotime($employee->pivot->clock_out)) }}
                                                            @elseif ($employee->pivot->missed)
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
                                                            @else
                                                                {{ __('Não Preenchido') }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @empty
                    <span>{{ __('Nenhum ponto encontrado.') }}</span>
                @endforelse

                <form id="export" action="{{ route('admin.reports.manager.export') }}" method="POST" target="_blank">
                    @csrf
                    <input type="hidden" name="start_date" value="{{ $start_date ?? '' }}">
                    <input type="hidden" name="end_date" value="{{ $end_date ?? '' }}">
                    <input type="hidden" name="user_id" value="{{ $user_id ?? '' }}">
                    <button form="export" type="submit" class="btn btn-success">{{ __('Exportar Excel') }}</button>
                </form>
            </div>
        </div>
    @endisset
@endsection
