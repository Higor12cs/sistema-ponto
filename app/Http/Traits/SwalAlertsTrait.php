<?php

namespace App\Http\Traits;

/**
 * Trait SwalAlertsTrait
 *
 * This trait provides a method to emit Swal alerts.
 */
trait SwalAlertsTrait
{
    /**
     * Emit a Swal alert.
     *
     * @param  string  $icon The icon for the alert.
     * @param  string  $title The title of the alert.
     * @param  string  $text The text of the alert (default: '').
     */
    public function emitAlert(string $icon, string $title, string $text = ''): void
    {
        $this->dispatchBrowserEvent('swal', [
            'toast' => true,
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 3000,
            'timerProgressBar' => true,
            'showCloseButton' => true,
            'icon' => $icon,
            'title' => $title,
            'text' => $text,
            'showClass' => [
                'backdrop' => 'swal2-noanimation',
                'popup' => '',
            ],
        ]);
    }
}
