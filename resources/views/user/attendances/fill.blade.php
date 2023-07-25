@extends('layouts.app')

@push('css')
    <style>
        .table-action-button {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20px;
            width: 16px;
        }
    </style>
@endpush

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>Preencher Ponto</h4>
        <a href="{{ route('attendances.index') }}" class="btn btn-secondary">Voltar</a>
    </div>

    <x-alerts />

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <div class="table-responsive attendance-table">
        <table class="table table-hover table-bordered bg-white">
            <thead class="bg-black text-white">
                <th>{{ __('Funcionário') }}</th>
                <th style="width: 70px; min-width: 70px;" class="text-center">{{ __('Início') }}</th>
                <th style="width: 70px; min-width: 70px;" class="text-center">{{ __('Fim') }}</th>
                <th style="width: 50px; min-width: 50px;" class="text-center">{{ __('Ações') }}</th>
                <th style="width: 90px; min-width: 90px;" class="text-center">{{ __('DSR') }}</th>
                <th style="width: 90px; min-width: 90px;" class="text-center">{{ __('Atestado') }}</th>
                <th style="width: 90px; min-width: 90px;" class="text-center">{{ __('Abonado') }}</th>
            </thead>
            <tbody>
                @forelse ($attendance->employees as $attendanceEmployee)
                    @livewire('user.attendance.attendance-to-fill', [
                        'attendance' => $attendance,
                        'attendanceEmployee' => $attendanceEmployee,
                    ])
                @empty
                    <tr>
                        <td colspan="5">{{ __('Nenhum funcionário encontrado.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <form action="{{ route('attendances.close', $attendance) }}" method="POST">
        @csrf
        <button type="submit"
            onclick="return confirm('Tem certeza que deseja concluir este ponto? Após clicar em ok, este ponto não estará mais disponível para edição.')"
            class="btn btn-primary">Concluir Ponto</button>
    </form>
@endsection
