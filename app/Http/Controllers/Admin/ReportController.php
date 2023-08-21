<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DateRangeAttendanceExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReportByManagerRequest;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\User;
use Illuminate\View\View;
use Maatwebsite\Excel\Excel;

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

    public function reportByManager(ReportByManagerRequest $request): View
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

    public function exportByManager(ReportByManagerRequest $request, Excel $excel)
    {
        return $excel->download(new DateRangeAttendanceExport($request->user_id, $request->start_date, $request->end_date), 'PontosExportados.xlsx');
    }
}
