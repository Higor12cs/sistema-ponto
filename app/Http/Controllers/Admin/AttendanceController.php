<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.attendances.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $managers = User::where('is_admin', false)
            ->orderBy('name')
            ->get();

        return view('admin.attendances.create', compact('managers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendanceRequest $request): RedirectResponse
    {
        $attendance = Attendance::create($request->validated());

        return redirect()->route('admin.attendances.edit', $attendance)
            ->with('success', 'Ponto criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance): View
    {
        return view('admin.attendances.edit', compact('attendance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttendanceRequest $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance): RedirectResponse
    {
        $attendance->delete();

        return redirect()->route('admin.attendances.index')->with('success', 'Ponto excluído com sucesso.');
    }
}
