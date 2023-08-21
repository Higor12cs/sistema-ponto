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
    public $options = ['missed', 'dsr', 'sick', 'absence', 'vacation', 'dismissed'];
    public $done;

    public function mount()
    {
        foreach ($this->options as $option) {
            $this->$option = $this->attendanceEmployee['pivot'][$option] ?? false;
        }

        $this->clock_in = $this->formatTime($this->attendanceEmployee['pivot']['clock_in']);
        $this->clock_out = $this->formatTime($this->attendanceEmployee['pivot']['clock_out']);

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
        $this->validate([
            'clock_in' => ['nullable'],
            'clock_out' => ['nullable'],
            'done' => ['boolean'],
            ...array_fill_keys($this->options, ['boolean']),
        ]);

        $this->done = true;

        if ($this->hasTrueOption()) {
            $this->clock_in = null;
            $this->clock_out = null;
        }

        $data = array_merge([
            'clock_in' => $this->clock_in,
            'clock_out' => $this->clock_out,
            'done' => $this->done,
        ], $this->getOptionsData());

        $this->attendance->employees()
            ->updateExistingPivot($this->attendanceEmployee->id, $data);

        $this->emitAlert('success', 'Funcionário apontado!');
    }

    public function setOption($selected)
    {
        foreach ($this->options as $option) {
            if ($option !== $selected) {
                $this->$option = $option === $selected;
            }
        }
    }

    private function hasTrueOption()
    {
        foreach ($this->options as $option) {
            if ($this->$option) {
                return true;
            }
        }
        return false;
    }

    private function formatTime($time)
    {
        return $time ? Carbon::createFromFormat('H:i:s', $time)->format('H:i') : null;
    }

    private function getOptionsData()
    {
        $optionsData = [];

        foreach ($this->options as $option) {
            $optionsData[$option] = $this->$option;
        }

        return $optionsData;
    }
}
