<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ContactCrud extends Component
{
    use WithPagination;

    public $search;
    public $trashed;
 
    protected $queryString = ['search' => ['except' => ''], 'trashed' => ['except' => '']];

    protected $listeners = [
        'refresh-contact-crud' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingTrashed()
    {
        $this->resetPage();
    }
    
    public function getContactsProperty()
    {
        return Auth::user()->account->contacts()
            ->with('organization')
            ->orderByName()
            ->filter([
                'search' => $this->search, 
                'trashed' => $this->trashed,
            ])
            ->paginate(10);
    }

    public function filterReset()
    {
        $this->search = '';
        $this->trashed = '';
    }

    public function render()
    {
        return view('contacts.crud');
    }
}
