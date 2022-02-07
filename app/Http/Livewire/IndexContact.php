<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithPagination;

class IndexContact extends Component
{
    use WithPagination;

    public $search;

    public $page = 1;
 
    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected function contacts()
    {
        return Auth::user()->account->contacts()
                ->with('organization')
                ->orderByName()
                ->filter(Request::only('search', 'trashed'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($contact) => [
                    'id' => $contact->id,
                    'name' => $contact->name,
                    'phone' => $contact->phone,
                    'city' => $contact->city,
                    'deleted_at' => $contact->deleted_at,
                    'organization' => $contact->organization ? $contact->organization->only('name') : null,
                ]);
    }

    public function render()
    {
        return view('contact.index', [
            'contacts' => $this->contacts()
        ]);
    }
}
