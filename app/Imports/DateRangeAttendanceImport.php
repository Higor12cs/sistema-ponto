<?php

namespace App\Imports;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;

class DateRangeAttendanceImport implements ToCollection
{
    private $start_date;
    private $end_date;
    private $firstRow = true;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.0' => 'required',
            '*.1' => 'required',
            '*.2' => ['required', 'exists:users,registration'],
        ], [
            '*.0.required' => 'O valor da célula :attribute é obrigatório. Todas matrículas são obrigatórias',
            '*.1.required' => 'O valor da célula :attribute é obrigatório. Todos nomes são obrigatórios',
            '*.2.required' => 'O valor da célula :attribute é obrigatório. Todas responsáveis são obrigatórios.',
            '*.2.exists' => 'Existem matrículas de responsáveis inválidas e/ou incorretas.',
        ])->validate();

        $groupedRows = $rows->groupBy(2);

        $period = CarbonPeriod::create(Carbon::parse($this->start_date), Carbon::parse($this->end_date));

        foreach ($period as $date) {
            $this->firstRow = true;

            $groupedRows->each(function ($rows, $managerRegistration) use ($date) {
                if ($this->firstRow) {
                    $this->firstRow = false;
                } else {
                    $manager = User::where('registration', $managerRegistration)->first();

                    if (!$manager) {
                        throw ValidationException::withMessages(['danger' => 'Responsável de matrícula ' . $managerRegistration . ' não existe.']);
                    }

                    $attendance = new Attendance();
                    $attendance->date = $date;
                    $attendance->user_id = $manager->id;
                    $attendance->save();

                    foreach ($rows as $row) {
                        $employee = Employee::firstOrNew(['registration' => $row[0]]);

                        $clock_in = $row[3] !== null ? Carbon::createFromFormat('H:i:s', gmdate('H:i:s', $row[3] * 86400))->format('H:i:s') : null;
                        $clock_out = $row[4] !== null ? Carbon::createFromFormat('H:i:s', gmdate('H:i:s', $row[4] * 86400))->format('H:i:s') : null;

                        if (!$employee->exists) {
                            $employee->name = $row[1];
                            $employee->save();
                        }

                        $attendance->employees()->attach($employee->id, [
                            'clock_in' => $clock_in,
                            'clock_out' => $clock_out,
                        ]);
                    }
                }
            });
        }
    }
}
