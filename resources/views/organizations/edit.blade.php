<div x-data="{ shown: @entangle('shown') }"
    x-on:close.stop="shown = false"
    x-on:keydown.escape.window="shown = false"
    x-init="$watch('shown', value => {
      if (value) {
        document.getElementById('editOrganization').style.display = 'block';
      } else {
        document.getElementById('editOrganization').style.display = 'none';
      }
    })"
    style="display: none;"
    id="editOrganization"
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
            class="slideout absolute px-2 sm:px-6 md-full:px-6 fixed top-0 right-0 w-1/3 h-full overflow-y-auto bg-white shadow-xl border-l" style="z-index: 100000;">
            <button type="button" class="absolute top-0 right-0 p-4 text-gray-500 hover:text-gray-700" @click="shown = false">
                <svg class="fill-current w-2 h-2" viewBox="278.046 126.846 235.908 235.908">
                <path d="M506.784 134.017c-9.56-9.56-25.06-9.56-34.62 0L396 210.18l-76.164-76.164c-9.56-9.56-25.06-9.56-34.62 0-9.56 9.56-9.56 25.06 0 34.62L361.38 244.8l-76.164 76.165c-9.56 9.56-9.56 25.06 0 34.62 9.56 9.56 25.06 9.56 34.62 0L396 279.42l76.164 76.165c9.56 9.56 25.06 9.56 34.62 0 9.56-9.56 9.56-25.06 0-34.62L430.62 244.8l76.164-76.163c9.56-9.56 9.56-25.06 0-34.62z"></path>
                </svg>
            </button>
            @if($this->organization->deleted_at)
            <x-trashed-message class="mt-12" wire:click="restore">
                This organization has been deleted.
            </x-trashed-message>
            @endif
            <h2 class="pt-12 font-bold text-2xl">Edit Organization</h2>

            <div class="mt-6">
                <form wire:submit.prevent="update">
                  <div>
                    <x-text-input wire:model.defer="state.name" error="name" class="pb-8" label="Name" />
                    <x-text-input wire:model.defer="state.email" error="email" class="pb-8" label="Email" />
                    <x-text-input wire:model.defer="state.phone" error="phone" class="pb-8" label="Phone" />
                    <x-text-input wire:model.defer="state.address" error="address" class="pb-8" label="Address" />
                    <div class="-mr-4">
                      <div class="flex flex-wrap">
                        <x-text-input wire:model.defer="state.city" error="city" class="w-1/2 pr-4 pb-8" label="City" />
                        <x-text-input wire:model.defer="state.region" error="region" class="w-1/2 pr-4 pb-8" label="Province/State" />
                        <x-select-input wire:model.defer="state.country" error="country" class="w-1/2 pr-4 pb-8" label="Country">
                          <option />
                          <option value="CA">Canada</option>
                          <option value="US">United States</option>
                        </x-select-input>
                        <x-text-input wire:model.defer="state.postal_code" error="postal_code" class="w-1/2 pr-4 pb-8" label="Postal code" />
                      </div>
                    </div>
                  </div>
                  <div class="py-4 flex items-center">
                    @unless($this->organization->deleted_at)
                    <a wire:click="delete" class="text-red-600 hover:underline">
                        Delete
                    </a>
                    @endunless
                    <x-loading-button wire:loading.attr="disabled" wire:target="update" class="ml-auto bg-indigo-600 btn-indigo" type="submit">Update Organization</x-loading-button>
                  </div>
                </form>
              </div>
        </div>
    </div>
</div>