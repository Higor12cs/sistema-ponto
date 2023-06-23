<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function index(): View
    {
        return view('admin.attendances.index');
    }

    public function create(): View
    {
        $managers = User::where('is_admin', false)
            ->orderBy('name')
            ->get();

        return view('admin.attendances.create', compact('managers'));
    }

    public function store(AttendanceRequest $request): RedirectResponse
    {
        $attendance = Attendance::create($request->validated());

        return to_route('admin.attendances.edit', $attendance)
            ->with('success', 'Ponto criado com sucesso.');
    }

    public function edit(Attendance $attendance): View
    {
        return view('admin.attendances.edit', compact('attendance'));
    }

    public function update(Request $request, Attendance $attendance): RedirectResponse
    {
        $request->validate([
            'attendance_date' => 'required|date',
        ]);

        $attendance->update([
            'date' => $request->attendance_date,
        ]);

        return to_route('admin.attendances.edit', $attendance)
            ->with('success', 'Ponto atualizado com sucesso.');
    }

    public function destroy(Attendance $attendance): RedirectResponse
    {
        $attendance->delete();

        return to_route('admin.attendances.index')->with('success', 'Ponto excluído com sucesso.');
    }

    public function reopenAttendance(Attendance $attendance): RedirectResponse
    {
        $attendance->update(['ended' => false]);

        return to_route('admin.attendances.edit', $attendance)->with('success', 'Ponto reaberto com sucesso.');
    }

    public function closeAttendance(Attendance $attendance): RedirectResponse
    {
        $attendance->update([
            'ended' => true,
            'ended_by_admin' => true,
            'ended_at' => now(),
        ]);

        return to_route('admin.attendances.edit', $attendance)->with('success', 'Ponto fechado com sucesso.');
    }
}
