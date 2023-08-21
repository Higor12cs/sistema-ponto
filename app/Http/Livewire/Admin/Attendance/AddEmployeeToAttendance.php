<?php

namespace App\Http\Livewire\Admin\Attendance;

use App\Http\Traits\SwalAlertsTrait;
use App\Models\Attendance;
use App\Models\Employee;
use Livewire\Component;

class AddEmployeeToAttendance extends Component
{
    use SwalAlertsTrait;

    protected $listeners = [
        'employeeCreated' => 'render',
        'employeeDeleted' => 'render',
    ];

    public Attendance $attendance;

    public $employees;

    public $employee;

    public function mount(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    public function render()
    {
        $this->employees = Employee::where('active', true)
            ->whereDoesntHave('attendances', function ($query) {
                $query->where('attendance_id', $this->attendance->id);
            })
            ->orderBy('name')
            ->get();

        return view('livewire.admin.attendances.add-employee-to-attendance');
    }

    public function add()
    {
        $this->validate();

        $this->attendance->employees()->attach($this->employee);

        $this->employee = '';
        $this->emit('employeeCreated');

        $this->emitAlert('success', 'Funcionário adicionado!');
    }

    protected $rules = [
        'employee' => ['required', 'exists:employees,id'],
    ];

    protected $messages = [
        'required' => 'O campo :attribute é obrigatório.',
        'exists' => 'O valor selecionado é inválido ou não existe.',
    ];
}
