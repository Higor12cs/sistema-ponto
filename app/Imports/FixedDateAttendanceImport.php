<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class FixedDateAttendanceImport implements ToCollection
{
    private $date;
    private $firstRow = true;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.0' => 'required',
            '*.1' => 'required',
            '*.2' => 'required',
        ], [
            '*.0.required' => 'O valor da célula :attribute é obrigatório. Todas matrículas são obrigatórias',
            '*.1.required' => 'O valor da célula :attribute é obrigatório. Todos nomes são obrigatórios',
            '*.2.required' => 'O valor da célula :attribute é obrigatório. Todas responsáveis são obrigatórios.',
        ])->validate();

        $groupedRows = $rows->groupBy(2);

        $groupedRows->each(function ($rows, $manager) {
            if ($this->firstRow) {
                $this->firstRow = false;
            } else {
                $attendance = new Attendance();
                $attendance->date = $this->date;
                $attendance->user_id = $manager;
                $attendance->save();

                foreach ($rows as $row) {
                    $employee = Employee::firstOrNew(['registration' => $row[0]]);

                    if (!$employee->exists) {
                        $employee->name = $row[1];
                        $employee->save();
                    }

                    $attendance->employees()->attach($employee->id);
                }
            }
        });
    }
}
