<?php

namespace Tests\Feature\livewire;

use App\Http\Livewire\ContactCrud;
use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ContactsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'account_id' => Account::create(['name' => 'Acme Corporation'])->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'owner' => true,
        ]);

        $organization = $this->user->account->organizations()->create(['name' => 'Example Organization Inc.']);

        $this->user->account->contacts()->createMany([
            [
                'organization_id' => $organization->id,
                'first_name' => 'Martin',
                'last_name' => 'Abbott',
                'email' => 'martin.abbott@example.com',
                'phone' => '555-111-2222',
                'address' => '330 Glenda Shore',
                'city' => 'Murphyland',
                'region' => 'Tennessee',
                'country' => 'US',
                'postal_code' => '57851',
            ], [
                'organization_id' => $organization->id,
                'first_name' => 'Lynn',
                'last_name' => 'Kub',
                'email' => 'lynn.kub@example.com',
                'phone' => '555-333-4444',
                'address' => '199 Connelly Turnpike',
                'city' => 'Woodstock',
                'region' => 'Colorado',
                'country' => 'US',
                'postal_code' => '11623',
            ],
        ]);
    }

    
    public function test_can_view_contacts()
    {
        $this->actingAs($this->user);

        Livewire::test(ContactCrud::class)
            ->assertCount('contacts', 2)
            ->assertSeeInOrder(['martin.abbott@example.com', 'lynn.kub@example.com']);
    }

    public function test_can_search_for_contacts()
    {
        $this->actingAs($this->user);

        Livewire::withQueryParams(['search' => 'Martin'])
            ->test(ContactCrud::class)
            ->assertSet('search', 'Martin')
            ->assertCount('contacts', 1)
            ->assertSee('martin.abbott@example.com')
            ->assertDontSee('lynn.kub@example.com');
    }
}
