<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $openAttendancesCount = Attendance::where('ended', false)->count();
        $closedAttendancesCount = Attendance::where('ended', true)->count();
        $usersCount = User::where('is_admin', false)->count();
        $employessCount = Employee::where('active', true)->count();

        return view(
            'admin.dashboard.index',
            compact('openAttendancesCount', 'closedAttendancesCount', 'usersCount', 'employessCount')
        );
    }
}
