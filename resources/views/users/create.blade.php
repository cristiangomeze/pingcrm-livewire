<div class="bg-white rounded-md shadow overflow-hidden">
    <h1 class="p-6 text-xl font-bold text-gray-600">Create User</h1>
    <div class="border-b"></div>
    <form wire:submit.prevent="store">
      <div class="flex flex-wrap -mb-8 -mr-6 p-8">
        <x-text-input wire:model.defer="state.first_name" error="first_name" class="pb-8 pr-6 w-full lg:w-1/2" label="First Name" />
        <x-text-input wire:model.defer="state.last_name" error="last_name" class="pb-8 pr-6 w-full lg:w-1/2" label="Last Name" />
        <x-text-input wire:model.defer="state.email" error="email" type="email"  class="pb-8 pr-6 w-full lg:w-1/2" label="Email" />
        <x-text-input wire:model.defer="state.password" error="password" type="password" class="pb-8 pr-6 w-full lg:w-1/2" label="Password"/>
        <x-select-input wire:model.defer="state.owner" error="owner" class="pb-8 pr-6 w-full lg:w-1/2" label="Owner">
          <option/>
          <option value="true">Yes</option>
          <option value="false">No</option>
        </x-select-input>
      </div>
      <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
        <x-loading-button wire:loading.attr="disabled" wire:target="store" type="submit" class="bg-indigo-600 btn-indigo">Create User</x-loading-button>
      </div>
    </form>
</div>