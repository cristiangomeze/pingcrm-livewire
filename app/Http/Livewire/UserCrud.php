<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UserCrud extends Component
{
    use WithPagination;

    public $search;
    public $role;
    public $trashed;
 
    protected $queryString = ['search' => ['except' => ''], 'role' => ['except' => ''], 'trashed' => ['except' => '']];

    protected $listeners = [
        'refresh-user-crud' => '$refresh',
    ];
    
    public function updatingSearch()
    {
        $this->resetPage();
    }

    
    public function updatingRole()
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
        $this->role = '';
        $this->trashed = '';
    }

    public function getUsersProperty()
    {
        return Auth::user()->account->users()
            ->orderByName()
            ->filter([
                'search' => $this->search, 'role' => $this->role, 'trashed' => $this->trashed
            ])
            ->paginate(10);
    }

    public function render()
    {
        return view('users.crud');
    }
}
