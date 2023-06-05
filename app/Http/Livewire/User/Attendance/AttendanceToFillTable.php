<?php

namespace App\Http\Livewire\User\Attendance;

use App\Http\Traits\SwalAlertsTrait;
use App\Models\Attendance;
use Livewire\Component;

class AttendanceToFillTable extends Component
{
    use SwalAlertsTrait;

    protected $listeners = [
        'employeeApontado' => 'render',
    ];

    public $attendance;
    public $employees;

    public function mount(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    public function render()
    {
        $this->employees = $this->attendance->employees;

        return view('livewire.user.attendance.attendance-to-fill-table');
    }
}
