<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class OrganizationCrud extends Component
{
    use WithPagination;

    public $search;
    public $trashed;
 
    protected $queryString = ['search' => ['except' => ''], 'trashed' => ['except' => '']];

    protected $listeners = [
        'refresh-organization-crud' => '$refresh',
    ];
    
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingTrashed()
    {
        $this->resetPage();
    }

    public function filterReset()
    {
        $this->search = '';
        $this->trashed = '';
    }

    public function getOrganizationsProperty()
    {
        return Auth::user()->account->organizations()
            ->orderBy('name')
            ->filter([
                'search' => $this->search, 
                'trashed' => $this->trashed
            ])
            ->paginate(10);
    }

    public function render()
    {
        return view('organizations.crud');
    }
}
