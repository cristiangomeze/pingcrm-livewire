<div x-data="{ shown: @entangle('shown') }"
    x-on:close.stop="shown = false"
    x-on:keydown.escape.window="shown = false"
    x-init="$watch('shown', value => {
        if (value) {
          document.getElementById('editContact').style.display = 'block';
        } else {
          document.getElementById('editContact').style.display = 'none';
        }
      })"
      style="display: none;"
      id="editContact"
    >
    <div
        x-show="shown" 
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 transition-all transform"
        >
        <div x-on:click="shown = false" class="absolute inset-0 bg-gray-500 opacity-75"></div>
        <div 
            class="slideout px-2 sm:px-6 md-full:px-6 fixed top-0 right-0 w-full sm:w-1/3 h-full overflow-y-auto bg-white shadow-xl border-l" style="z-index: 100000;">
            <button type="button" class="absolute top-0 right-0 p-4 text-gray-500 hover:text-gray-700" @click="shown = false">
                <svg class="fill-current w-2 h-2" viewBox="278.046 126.846 235.908 235.908">
                <path d="M506.784 134.017c-9.56-9.56-25.06-9.56-34.62 0L396 210.18l-76.164-76.164c-9.56-9.56-25.06-9.56-34.62 0-9.56 9.56-9.56 25.06 0 34.62L361.38 244.8l-76.164 76.165c-9.56 9.56-9.56 25.06 0 34.62 9.56 9.56 25.06 9.56 34.62 0L396 279.42l76.164 76.165c9.56 9.56 25.06 9.56 34.62 0 9.56-9.56 9.56-25.06 0-34.62L430.62 244.8l76.164-76.163c9.56-9.56 9.56-25.06 0-34.62z"></path>
                </svg>
            </button>
            @if($this->contact->deleted_at)
            <x-trashed-message class="mt-12" wire:click="restore">
                This contact has been deleted.
            </x-trashed-message>
            @endif
            <h2 class="pt-12 font-bold text-2xl">Edit Contact</h2>

            <div class="mt-6">
                <form wire:submit.prevent="update">
                  <div>
                        <x-text-input wire:model.defer="state.first_name" error="first_name" class="pb-8" label="First Name" />
                        <x-text-input wire:model.defer="state.last_name" error="last_name" class="pb-8" label="Last Name" />
                        <x-select-input wire:model.defer="state.organization_id" error="organization_id" class="pb-8" label="Organization">
                            <option />
                            @foreach ($this->organizations as $organization)
                            <option value="{{ $organization['id'] }}">{{ $organization['name'] }}</option>
                            @endforeach
                        </x-select-input>
                        <div class="-mr-4">
                            <div class="flex flex-wrap">
                                <x-text-input wire:model.defer="state.email" error="email" class="pb-8 pr-4 w-1/2" label="Email" />
                                <x-text-input wire:model.defer="state.phone" error="phone" class="pb-8 pr-4 w-1/2" label="Phone" />
                                <x-text-input wire:model.defer="state.address" error="address" class="pb-8 pr-4 w-1/2" label="Address" />
                                <x-text-input wire:model.defer="state.city" error="city" class="pb-8 pr-4 w-1/2" label="City" />
                                <x-text-input wire:model.defer="state.region" error="region" class="pb-8 pr-4 w-1/2" label="Region"/>
                                <x-select-input wire:model.defer="state.country" error="country" class="pb-8 pr-4 w-1/2" label="Country">
                                    <option value="null" />
                                    <option value="CA">Canada</option>
                                    <option value="US">United States</option>
                                </x-select-input>
                                <text-input wire:model.defer="state.postal_code" error="postal_code" class="pb-8 pr-4 w-1/2" label="Postal code" />
                            </div>
                        </div>
                    </div>
                    <div class="py-4 flex items-center">
                        @unless($this->contact->deleted_at)
                        <a wire:click="delete" class="cursor-pointer text-red-600 hover:underline">
                            Delete
                        </a>
                        @endunless
                        <x-loading-button wire:loading.attr="disabled" wire:target="update" class="ml-auto bg-indigo-600 btn-indigo" type="submit">Update Contact</x-loading-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>