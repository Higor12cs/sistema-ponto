<?php

namespace App\Http\Traits;

trait SwalAlertsTrait
{
    public function emitAlert(string $icon, string $title, string $text = '')
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
