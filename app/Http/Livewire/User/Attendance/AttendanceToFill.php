<?php

namespace App\Http\Livewire\User\Attendance;

use App\Http\Traits\SwalAlertsTrait;
use Carbon\Carbon;
use Livewire\Component;

class AttendanceToFill extends Component
{
    use SwalAlertsTrait;

    public $attendance;
    public $attendanceEmployee;
    public $clock_in;
    public $clock_out;
    public $missed;
    public $dsr;
    public $sick;
    public $absence;
    public $done;

    public function mount()
    {
        $clock_in = $this->attendanceEmployee['pivot']['clock_in'] ?? null;
        $this->clock_in = $clock_in ? Carbon::createFromFormat('H:i:s', $clock_in)->format('H:i') : null;

        $clock_out = $this->attendanceEmployee['pivot']['clock_out'] ?? null;
        $this->clock_out = $clock_out ? Carbon::createFromFormat('H:i:s', $this->attendanceEmployee['pivot']['clock_out'])->format('H:i') : null;

        $this->missed = $this->attendanceEmployee['pivot']['missed'] ?? false;
        $this->dsr = $this->attendanceEmployee['pivot']['dsr'] ?? false;
        $this->sick = $this->attendanceEmployee['pivot']['sick'] ?? false;
        $this->absence = $this->attendanceEmployee['pivot']['absence'] ?? false;
        $this->done = $this->attendanceEmployee['pivot']['done'] ?? false;
    }

    public function render()
    {
        return view('livewire.user.attendance.attendance-to-fill');
    }

    public function editAttendance()
    {
        $this->done = false;
    }

    public function saveAttendance()
    {
        if ($this->missed || $this->dsr || $this->sick || $this->absence) {
            $this->clock_in = null;
            $this->clock_out = null;
        }

        $this->validate([
            'clock_in' => ['nullable'],
            'clock_out' => ['nullable'],
            'missed' => ['boolean'],
            'dsr' => ['boolean'],
            'sick' => ['boolean'],
            'absence' => ['boolean'],
        ]);

        $this->done = true;

        $this->attendance->employees()
            ->updateExistingPivot($this->attendanceEmployee->id, [
                'clock_in' => $this->missed ? null : $this->clock_in,
                'clock_out' => $this->missed ? null : $this->clock_out,
                'missed' => $this->missed,
                'dsr' => $this->dsr,
                'sick' => $this->sick,
                'absence' => $this->absence,
                'done' => $this->done,
            ]);

        $this->emitAlert('success', 'Funcionário apontado!');
    }

    public function setDSR()
    {
        if ($this->dsr) {
            $this->dsr = true;
            $this->sick = false;
            $this->absence = false;
        }
    }

    public function setSick()
    {
        if ($this->sick) {
            $this->sick = true;
            $this->dsr = false;
            $this->absence = false;
        }
    }

    public function setAbsence()
    {
        if ($this->absence) {
            $this->absence = true;
            $this->dsr = false;
            $this->sick = false;
        }
    }
}
