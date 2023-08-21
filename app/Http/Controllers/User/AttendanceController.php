<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function index(): View
    {
        return view('user.attendances.index');
    }

    public function fill(Attendance $attendance): View
    {
        return view('user.attendances.fill', compact('attendance'));
    }

    public function close(Attendance $attendance): RedirectResponse
    {
        $everyEmployeeHasHours = $attendance->employees->every(function ($employee) {
            return (! empty($employee->pivot->clock_in) && ! empty($employee->pivot->clock_out)) ||
                $employee->pivot->missed || $employee->pivot->dsr || $employee->pivot->sick || $employee->pivot->absence || $employee->pivot->vacation || $employee->pivot->dismissed;
        });

        if (! $everyEmployeeHasHours) {
            return redirect()->route('attendances.fill', $attendance)
                ->with('warning', 'Ainda existem funcionários sem horarios definidos neste ponto.');
        }

        $attendance->update([
            'ended' => true,
            'ended_at' => now(),
        ]);

        return redirect()->route('attendances.index')
            ->with('success', 'Ponto concluído e fechado com sucesso.');
    }
}
