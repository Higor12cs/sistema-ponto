<?php

namespace App\Http\Livewire\User\Attendance;

use App\Http\Traits\HasModalTrait;
use App\Http\Traits\SwalAlertsTrait;
use App\Models\Attendance;
use Livewire\Component;

class FillAttendanceModal extends Component
{
    use SwalAlertsTrait, HasModalTrait;

    public $attendance;
    public $clock_in, $clock_out, $missed;

    protected $listeners = [
        'clockEmploye' => 'clock',
    ];

    public function render()
    {
        return view('livewire.user.attendance.fill-attendance-modal');
    }

    public function clock($attendance)
    {
        $this->attendance = $attendance;
        $this->clock_in = $attendance['pivot']['clock_in'];
        $this->clock_out = $attendance['pivot']['clock_out'];
        $this->missed = $attendance['pivot']['missed'];

        $this->openModal('attendanceModal');
    }

    public function save()
    {
        $this->validate([
            'clock_in' => ['nullable'],
            'clock_out' => ['nullable'],
            'missed' => ['sometimes', 'boolean'],
        ]);

        $attendance = Attendance::findOrFail($this->attendance['pivot']['attendance_id']);

        $attendance->employees()
            ->updateExistingPivot($this->attendance['pivot']['employee_id'], [
                'clock_in' => $this->missed ? null : $this->clock_in,
                'clock_out' => $this->missed ? null : $this->clock_out,
                'missed' => $this->missed,
            ]);

        $this->emit('employeeApontado');
        $this->emitAlert('success', 'Informações atualizadas!');

        $this->closeModal('attendanceModal');
        $this->reset();
    }
}
