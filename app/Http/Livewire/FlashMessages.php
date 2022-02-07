<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FlashMessages extends Component
{
    public $shown = false;
    public $message;

    protected $listeners = [
        'flash-messages' => 'dispatchFlashMessages',
    ];

    public function getMessageProperty()
    {
        return $this->message;
    }
    
    public function dispatchFlashMessages($message = 'This is a success message.')
    {
        $this->shown = true;

        $this->message = $message;
    }

    public function render()
    {
        return view('components.flash-messages');
    }
}
