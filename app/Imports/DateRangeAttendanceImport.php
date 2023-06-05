<?php

namespace App\Imports;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class DateRangeAttendanceImport implements ToCollection
{
    private $date1;
    private $date2;
    private $firstRow = true;

    public function __construct($date1, $date2)
    {
        $this->date1 = $date1;
        $this->date2 = $date2;
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

        $period = CarbonPeriod::create(Carbon::parse($this->date1), Carbon::parse($this->date2));

        foreach ($period as $date) {
            $this->firstRow = true;

            $groupedRows->each(function ($rows, $manager) use ($date) {
                if ($this->firstRow) {
                    $this->firstRow = false;
                } else {
                    $attendance = new Attendance();
                    $attendance->date = $date;
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
}