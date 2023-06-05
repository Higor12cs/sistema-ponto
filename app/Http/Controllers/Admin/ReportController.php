<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function byManager(): View
    {
        $users = User::where('is_admin', false)->get();

        return view('admin.reports.manager', compact('users'));
    }

    public function byEmployee(): View
    {
        $employees = Employee::all();

        return view('admin.reports.employee', compact('employees'));
    }

    public function reportByManager(Request $request)
    {
        $user_id = $request->user_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $report = true;
        $users = User::where('is_admin', false)->get();

        $attendances = Attendance::where('user_id', $user_id)
            ->where('ended', true)
            ->whereBetween('date', [$start_date, $end_date])
            ->with(['employees', 'user'])
            ->get();

        return view('admin.reports.manager', compact('report', 'users', 'attendances', 'start_date', 'end_date', 'user_id'));
    }
}
