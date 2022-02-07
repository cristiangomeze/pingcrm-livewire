<?php

namespace App\Http\Livewire;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use LivewireUI\Modal\ModalComponent as Component;

class ContactCreate extends Component
{
    public $state = [];

    public function store()
    {
        $this->resetErrorBag();

        Auth::user()->account->contacts()->create(
            Validator::make($this->state, [
                'first_name' => ['required', 'max:50'],
                'last_name' => ['required', 'max:50'],
                'organization_id' => ['nullable', Rule::exists('organizations', 'id')->where(function ($query) {
                    $query->where('account_id', Auth::user()->account_id);
                })],
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

        $this->emit('refresh-contact-crud');

        $this->emit('flash-messages', 'Contact created.');
    }

    public function getOrganizationsProperty()
    {
        return Auth::user()->account
            ->organizations()
            ->orderBy('name')
            ->get()
            ->map
            ->only('id', 'name');
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function render()
    {
        return view('contacts.create');
    }
}
