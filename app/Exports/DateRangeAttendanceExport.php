<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DateRangeAttendanceExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
    private $start_date;

    private $end_date;

    private $user_id;

    public function __construct($user_id, $start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->user_id = $user_id;
    }

    public function query()
    {
        return Attendance::query()
            ->where('user_id', $this->user_id)
            ->where('ended', true)
            ->whereBetween('date', [$this->start_date, $this->end_date])
            ->with(['employees', 'user']);
    }

    public function map($attendance): array
    {
        $employeeData = [];

        foreach ($attendance->employees as $employee) {
            $employeeData[] = [
                $attendance->id,
                $attendance->date->format('d/m/Y'),
                $attendance->ended_at->format('d/m/Y H:i'),
                $attendance->user->name,
                $employee->name,
                $employee->registration,
                $employee->pivot->clock_in,
                $employee->pivot->clock_out,
                $employee->pivot->missed ? 'Sim' : 'Não',
                $employee->pivot->dsr ? 'Sim' : 'Não',
                $employee->pivot->sick ? 'Sim' : 'Não',
                $employee->pivot->absence ? 'Sim' : 'Não',
                $employee->pivot->vacation ? 'Sim' : 'Não',
                $employee->pivot->dismissed ? 'Sim' : 'Não',
            ];
        }

        return $employeeData;
    }

    public function headings(): array
    {
        return [
            'Ponto',
            'Data Referente',
            'Data Preenchido',
            'Responsável',
            'Funcionário',
            'Matrícula',
            'Entrada',
            'Saída',
            'Faltou',
            'DSR',
            'Atestado',
            'Abonado',
            'Férias',
            'Dispensado',
        ];
    }

    public function styles(): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
