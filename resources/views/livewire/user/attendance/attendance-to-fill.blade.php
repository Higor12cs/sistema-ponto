<tr>
    <td>
        {{ $attendanceEmployee->name }}
    </td>
    <td>
        <div class="input-group input-group-sm">
            <input wire:model.defer="clock_in" onClick="this.select();" id="clock_in_{{ $attendanceEmployee->id }}" type="tel" @disabled($done) class="form-control text-center" x-data="{}" x-init="() => {
                $nextTick(() => $('#clock_in_' + {{ $attendanceEmployee->id }}).mask('00:00', {
                    onComplete: function(val, e, field, options) {
                        const [hour, minute] = val.split(':');
                        if (hour > 23 || minute > 59) {
                            field.val('');
                            field.focus();
                        }
                    },
                    placeholder: '__:__'
                }));
            }">
        </div>
    </td>
    <td>
        <div class="input-group input-group-sm">
            <input wire:model.defer="clock_out" onClick="this.select();" id="clock_out_{{ $attendanceEmployee->id }}" type="tel" @disabled($done) class="form-control text-center" x-data="{}" x-init="() => {
                $nextTick(() => $('#clock_out_' + {{ $attendanceEmployee->id }}).mask('00:00', {
                    onComplete: function(val, e, field, options) {
                        const [hour, minute] = val.split(':');
                        if (hour > 23 || minute > 59) {
                            field.val('');
                            field.focus();
                        }
                    },
                    placeholder: '__:__'
                }));
            }">
        </div>
    </td>
    <td>
        <div class="d-flex justify-content-between gap-1">
            <button wire:click="editAttendance" class="btn btn-sm @if ($done) btn-primary @else btn-secondary @endif" @disabled(!$done)>
                <svg class="nav-icon table-action-button">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-pencil') }}"></use>
                </svg>
            </button>

            <button wire:click="saveAttendance" class="btn btn-sm @if (!$done) btn-primary @else btn-secondary @endif"'' @disabled($done)>
                <svg class="nav-icon table-action-button">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-save') }}"></use>
                </svg>
            </button>
        </div>
    </td>

    @foreach ($options as $option)
        <td class="text-center">
            <input wire:model="{{ $option }}" wire:click="setOption('{{ $option }}')" type="checkbox" class="form-check-input" @disabled($done)>
        </td>
    @endforeach
</tr>
