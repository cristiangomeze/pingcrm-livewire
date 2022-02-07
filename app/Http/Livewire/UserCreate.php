<?php

namespace App\Http\Livewire;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use LivewireUI\Modal\ModalComponent as Component;

class UserCreate extends Component
{
    public $state = [];

    public function store()
    {
        $this->resetErrorBag();

        Auth::user()->account->contacts()->create(
            Validator::make($this->state, [
                'first_name' => ['required', 'max:50'],
                'last_name' => ['required', 'max:50'],
                'email' => ['required', 'max:50', 'email', Rule::unique('users')],
                'password' => ['nullable'],
                'owner' => ['required', 'boolean'],
            ])->validate()
        );

        $this->forceClose()->closeModal();

        $this->emit('refresh-user-crud');

        $this->emit('flash-messages', 'User created.');
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function render()
    {
        return view('users.create');
    }
}
