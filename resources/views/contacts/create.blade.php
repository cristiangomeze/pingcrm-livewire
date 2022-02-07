<div class="bg-white rounded-md shadow overflow-hidden">
    <h1 class="p-6 text-xl font-bold text-gray-600">Create Contact</h1>
    <div class="border-b"></div>
    <form wire:submit.prevent="store">
      <div class="flex flex-wrap -mb-8 -mr-6 p-8">
        <x-text-input wire:model.defer="state.first_name" error="first_name" class="pb-8 pr-6 w-full lg:w-1/2" label="First Name" />
        <x-text-input wire:model.defer="state.last_name" error="last_name" class="pb-8 pr-6 w-full lg:w-1/2" label="Last Name" />
        <x-select-input wire:model.defer="state.organization_id" error="organization_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Organization">
            <option />
            @foreach ($this->organizations as $organization)
            <option value="{{ $organization['id'] }}">{{ $organization['name'] }}</option>
            @endforeach
        </x-select-input>
        <x-text-input wire:model.defer="state.email" error="email" class="pb-8 pr-6 w-full lg:w-1/2" label="Email" />
        <x-text-input wire:model.defer="state.phone" error="phone" class="pb-8 pr-6 w-full lg:w-1/2" label="Phone" />
        <x-text-input wire:model.defer="state.address" error="address" class="pb-8 pr-6 w-full lg:w-1/2" label="Address" />
        <x-text-input wire:model.defer="state.city" error="city" class="pb-8 pr-6 w-full lg:w-1/2" label="City" />
        <x-text-input wire:model.defer="state.region" error="region" class="pb-8 pr-6 w-full lg:w-1/2" label="Region"/>
        <x-select-input wire:model.defer="state.country" error="country" class="pb-8 pr-6 w-full lg:w-1/2" label="Country">
          <option value="null" />
          <option value="CA">Canada</option>
          <option value="US">United States</option>
        </x-select-input>
        <text-input wire:model.defer="state.postal_code" error="postal_code" class="pb-8 pr-6 w-full lg:w-1/2" label="Postal code" />
      </div>
      <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
        <x-loading-button wire:loading.attr="disabled" wire:target="store" type="submit" class="bg-indigo-600 btn-indigo">Create Contact</x-loading-button>
      </div>
    </form>
</div>