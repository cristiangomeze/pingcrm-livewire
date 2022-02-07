<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ContactEdit extends Component
{
    public $shown = false;
    public $contact;
    public $state;

    protected $listeners = [
        'edit-contact' => 'shown'
    ];

    public function mount()
    {
        $this->contact = new Contact();
    }

    public function shown(Contact $contact)
    {
        $this->shown = true;
        $this->contact = $contact;
        $this->state = [
            'first_name' => $contact->first_name,
            'last_name' => $contact->last_name,
            'organization_id' => $contact->organization_id,
            'email' => $contact->email,
            'phone' => $contact->phone,
            'address' => $contact->address,
            'city' => $contact->city,
            'region' => $contact->region,
            'country' => $contact->country,
            'postal_code' => $contact->postal_code,
            'deleted_at' => $contact->deleted_at,
        ];
    }

    public function update()
    {
        $this->contact->update(
            Validator::make($this->state, [
                'first_name' => ['required', 'max:50'],
                'last_name' => ['required', 'max:50'],
                'organization_id' => [
                    'nullable',
                    Rule::exists('organizations', 'id')->where(fn ($query) => $query->where('account_id', Auth::user()->account_id)),
                ],
                'email' => ['nullable', 'max:50', 'email'],
                'phone' => ['nullable', 'max:50'],
                'address' => ['nullable', 'max:150'],
                'city' => ['nullable', 'max:50'],
                'region' => ['nullable', 'max:50'],
                'country' => ['nullable', 'max:2'],
                'postal_code' => ['nullable', 'max:25'],
            ])->validate()
        );

        $this->emit('refresh-contact-crud');

        $this->emit('flash-messages', 'Contact updated.');
    }

    public function delete()
    {
        $this->contact->delete();

        $this->emit('refresh-contact-crud');

        $this->emit('flash-messages', 'Contact deleted.');
    }

    public function restore()
    {
        $this->contact->restore();

        $this->emit('refresh-contact-crud');

        $this->emit('flash-messages', 'Contact restored.');
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

    public function render()
    {
        return view('contacts.edit');
    }
}
