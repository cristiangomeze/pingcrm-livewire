<div>
    <div class="flex items-center justify-between mb-6">
        <x-search-filter wire:model="search" class="mr-4 w-full max-w-md" wire:click="filterReset">
            <label class="block text-gray-700">Role:</label>
            <select wire:model="role" class="form-select mt-1 w-full">
                <option/>
                <option value="user">User</option>
                <option value="owner">Owner</option>
            </select>
            <label class="block mt-4 text-gray-700">Trashed:</label>
            <select wire:model="trashed" class="form-select mt-1 w-full">
                <option/>
                <option value="with">With Trashed</option>
                <option value="only">Only Trashed</option>
            </select>
        </x-search-filter>
        
        <button class="btn-indigo" wire:click="$emit('openModal', 'user-create')">
          <span>Create</span>
          <span class="hidden md:inline">&nbsp;User</span>
        </button>
    </div>
  
    <div class="bg-white rounded-md shadow overflow-x-auto">
        <table class="w-full whitespace-nowrap">
          <thead>
            <tr class="text-left font-bold">
                <th class="pb-4 pt-6 px-6">Name</th>
                <th class="pb-4 pt-6 px-6">Email</th>
                <th class="pb-4 pt-6 px-6" colspan="2">Role</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($this->users as $user)
            <tr class="hover:bg-gray-100 focus-within:bg-gray-100">
              <td class="border-t">
                <a wire:click="$emit('edit-user', {{ $user }})" class="flex items-center px-6 py-4 focus:text-indigo-500">
                  {{ $user->name }}
                  @if($user->deleted_at)
                  <x-icon name="trash" class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400" />
                  @endif
                </a>
              </td>
              <td class="border-t">
                <a wire:click="$emit('edit-user', {{ $user }})" class="flex items-center px-6 py-4" tabindex="-1">
                  {{ $user->email }}
                </a>
              </td>
              <td class="border-t">
                <a wire:click="$emit('edit-user', {{ $user }})" class="flex items-center px-6 py-4" tabindex="-1">
                    {{ $user->owner ? 'Owner' : 'User' }}
                </a>
              </td>
              <td class="w-px border-t">
                <a wire:click="$emit('edit-user', {{ $user }})" class="flex items-center px-4" tabindex="-1">
                  <x-icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                </a>
              </td>
            </tr>
            @empty
            <tr>
              <td class="px-6 py-4 border-t" colspan="4">No users found.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="mt-6">{{ $this->users->links() }}</div>
  
      <livewire:user-edit/>
  </div>
  