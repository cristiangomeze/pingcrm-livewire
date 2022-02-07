<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use LivewireUI\Modal\ModalComponent as Component;

class OrganizationCreate extends Component
{
    public $state = [];

    public function store()
    {
        $this->resetErrorBag();

        Auth::user()->account->organizations()->create(
            Validator::make($this->state, [
                'name' => ['required', 'max:100'],
                'email' => ['nullable', 'max:50', 'email'],
                'phone' => ['nullable', 'max:50'],
                'address' => ['nullable', 'max:150'],
                'city' => ['nullable', 'max:50'],
                'region' => ['nullable', 'max:50'],
                'country' => ['nullable', 'max:2'],
                'postal_code' => ['nullable', 'max:25'],
            ])->validate()
        );

        $this->forceClose()->closeModal();

        $this->emit('refresh-organization-crud');

        $this->emit('flash-messages', 'Organization created.');
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function render()
    {
        return view('organizations.create');
    }
}
