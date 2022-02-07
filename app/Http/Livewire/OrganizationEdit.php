<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class OrganizationEdit extends Component
{
    public $shown = false;
    public $organization;
    public $state;

    protected $listeners = [
        'edit-organization' => 'shown'
    ];

    public function mount()
    {
        $this->organization = new Organization();
    }

    public function shown(Organization $organization)
    {
        $this->shown = true;
        $this->organization = $organization;
        $this->state = [
            'name' => $this->organization->name,
            'email' => $this->organization->email,
            'phone' => $this->organization->phone,
            'address' => $this->organization->address,
            'city' => $this->organization->city,
            'region' => $this->organization->region,
            'country' => $this->organization->country,
            'postal_code' => $this->organization->postal_code,
        ];
    }

    public function update()
    {
        $this->organization->update(
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

        $this->emit('refresh-organization-crud');

        $this->emit('flash-messages', 'Organization updated.');
    }

    public function delete()
    {
        $this->organization->delete();

        $this->emit('refresh-organization-crud');

        $this->emit('flash-messages', 'Organization deleted.');
    }

    public function restore()
    {
        $this->organization->restore();

        $this->emit('refresh-organization-crud');

        $this->emit('flash-messages', 'Organization restored.');
    }

    public function getOrganizationProperty()
    {
        return $this->organization;
    }

    public function render()
    {
        return view('organizations.edit');
    }
}
