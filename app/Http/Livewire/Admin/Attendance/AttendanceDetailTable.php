<?php

namespace App\Http\Livewire\Admin\Attendance;

use App\Http\Traits\SwalAlertsTrait;
use App\Models\Attendance;
use Livewire\Component;

class AttendanceDetailTable extends Component
{
    use SwalAlertsTrait;

    protected $listeners = [
        'employeeCreated' => 'render',
        'employeeDeleted' => 'render',
    ];

    public Attendance $attendance;
    public $employees;

    public function mount(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    public function render()
    {
        $this->employees = $this->attendance->employees;

        return view('livewire.admin.attendances.attendance-detail-table');
    }

    public function removeEmploye(array $employee)
    {
        $this->attendance->detachEmployee($employee['pivot']['id']);
        $this->emit('employeeDeleted');

        $this->emitAlert('success', 'Funcionário removido!');
    }
}
