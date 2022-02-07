<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UserEdit extends Component
{
    public $shown = false;
    public $contact;
    public $state;

    protected $listeners = [
        'edit-user' => 'shown'
    ];

    public function mount()
    {
        $this->contact = new User();
    }

    public function shown(User $user)
    {
        $this->shown = true;
        $this->user = $user;
        $this->state = [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'owner' => $user->owner,
        ];
    }

    public function update()
    {
        if (App::environment('demo') && $this->user->isDemoUser()) {
            return;
        }
        
        $this->user->update(
            Validator::make($this->state, [
                'first_name' => ['required', 'max:50'],
                'last_name' => ['required', 'max:50'],
                'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($this->user->id)],
                'password' => ['nullable'],
                'owner' => ['required', 'boolean'],
            ])->validate()
        );

        $this->emit('refresh-user-crud');

        $this->emit('flash-messages', 'User updated.');
    }

    public function delete()
    {
        if ((App::environment('demo') && $this->user->isDemoUser() )|| Auth::user()->is($this->user)) {
            return;
        }
        
        $this->user->delete();

        $this->emit('refresh-user-crud');

        $this->emit('flash-messages', 'User deleted.');
    }

    public function restore()
    {
        $this->user->restore();

        $this->emit('refresh-user-crud');

        $this->emit('flash-messages', 'User restored.');
    }

    public function getUserProperty()
    {
        return Auth::user();
    }

    public function render()
    {
        return view('users.edit');
    }
}
