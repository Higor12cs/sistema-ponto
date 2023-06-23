@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>{{ __('Editar Ponto') }} - {{ $attendance->id }}</h4>
        <div class="d-flex">
            <form action="{{ route('admin.attendances.destroy', $attendance) }}" method="POST" class="me-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">{{ __('Excluir') }}</button>
            </form>
            <a href="{{ route('admin.attendances.index') }}" class="btn btn-secondary">{{ __('Voltar') }}</a>
        </div>
    </div>

    @if ($attendance->ended)
        <div class="card mb-4">
            <div class="card-header">
                {{ __('Ponto Finalizado') }}
            </div>
            <div class="card-body">
                <div class="col-12 mb-3">
                    <label class="form-label">{{ __('Data Finalizado') }}</label>
                    <input type="text" class="form-control" value="{{ $attendance->ended_at->format('d/m/Y - H:i') }}"
                        disabled>
                </div>
                <a href="{{ route('admin.attendances.reopen', $attendance) }}"
                    class="btn btn-primary">{{ __('Reabrir Ponto') }}</a>
            </div>
        </div>
    @else
        @livewire('admin.attendance.add-employee-to-attendance', ['attendance' => $attendance])
    @endif

    <div class="card mb-4">
        <div class="card-header">
            {{ __('Ponto Detalhado') }}
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-lg-8 pe-2 mb-2">
                    <label class="form-label">{{ __('Responsável') }}</label>
                    <input type="text" class="form-control" value="{{ $attendance->user->name }}" disabled>
                </div>
                <div class="col-lg-4 mb-2">
                    <label class="form-label">{{ __('Data') }}</label>
                    <form action="{{ route('admin.attendances.update', $attendance) }}" method="POST" class="d-flex">
                        @csrf
                        @method('PUT')

                        <input type="date" name="attendance_date"
                            class="form-control @if ($errors->has('attendance_date')) is-invalid @endif"
                            value="{{ $attendance->date->format('Y-m-d') }}" @disabled($attendance->ended)>

                        <button type="submit" class="btn btn-dark ms-3"
                            @disabled($attendance->ended)>{{ __('Atualizar') }}</button>
                    </form>
                </div>
            </div>

            @livewire('admin.attendance.attendance-detail-table', ['attendance' => $attendance], key($attendance->id))
        </div>
    </div>
@endsection
