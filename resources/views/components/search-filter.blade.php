@props(['maxWidth' => '300'])

<div class="flex items-center {{ $attributes->get('class') }}">
    <div class="flex w-full bg-white rounded shadow">
        <x-dropdown :autoClose="false" contentClasses="" class="px-6 py-3 focus:z-10 hover:bg-gray-100 border-r focus:border-white rounded-l focus:ring md:px-6" align="left">
            <x-slot name="trigger">
                <div class="flex items-baseline cursor-pointer">
                    <span class="hidden text-gray-700 md:inline">Filter</span>
                    <svg class="w-2 h-2 fill-gray-700 md:ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 961.243 599.998">
                        <path d="M239.998 239.999L0 0h961.243L721.246 240c-131.999 132-240.28 240-240.624 239.999-.345-.001-108.625-108.001-240.624-240z" />
                    </svg>
                </div>
            </x-slot>
            <x-slot name="content">
                <div class="mt-2 px-4 py-6 w-screen bg-white rounded shadow-xl" style="max-width: {{ $maxWidth}}px">
                  {{ $slot }}
                </div>
            </x-slot>
        </x-dropdown>
        <input class="relative px-6 py-3 w-full rounded-r focus:shadow-outline" autocomplete="off" type="text" name="search" placeholder="Search…" {{ $attributes->wire('model') }}/>
    </div>
    <button class="ml-3 text-gray-500 hover:text-gray-700 focus:text-indigo-500 text-sm" type="button" {{ $attributes->wire('click') }}>Reset</button>
</div>