<?php

namespace App\Http\Traits;

/**
 * Trait HasModalTrait
 *
 * This trait provides methods to open and close modals.
 */
trait HasModalTrait
{
    /**
     * Open a modal.
     *
     * @param  string  $name The name of the modal.
     * @param  string  $action The action to perform on the modal (default: 'open').
     */
    public function openModal(string $name, string $action = 'show'): void
    {
        $this->dispatchBrowserEvent('modal', [
            'name' => $name,
            'action' => $action,
        ]);
    }

    /**
     * Close a modal.
     *
     * @param  string  $name The name of the modal.
     * @param  string  $action The action to perform on the modal (default: 'hide').
     */
    public function closeModal(string $name, string $action = 'hide'): void
    {
        $this->dispatchBrowserEvent('modal', [
            'name' => $name,
            'action' => $action,
        ]);
    }
}
