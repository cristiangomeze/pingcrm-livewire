<!doctype html>
<html class="h-full bg-gray-100">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <script src="{{ mix('js/app.js') }}" defer></script>
  <style scoped>
    .slideout {
      transition: all 0.2s ease, max-width 0.1s ease;
    }
    .slideout-enter-from,
    .slideout-leave-to {
      opacity: 0;
      margin-right: -100px;
    }
    .slideout-leave-from {
      opacity: 1;
      margin-right: 0;
    }
  </style>
  <livewire:styles />
</head>
<body>
  <div>
    <div class="md:flex md:flex-col">
      <div class="md:flex md:flex-col md:h-screen">
        <div class="md:flex md:flex-shrink-0">
          <div class="flex items-center justify-between px-6 py-4 bg-indigo-900 md:flex-shrink-0 md:justify-center md:w-56">
            <a class="mt-1" href="/">
              <x-logo class="fill-white" width="120" height="28" />
            </a>
            <x-dropdown class="md:hidden" align="right" contentClasses="">
              <x-slot name="trigger">
                <svg class="w-6 h-6 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" /></svg>
              </x-slot>
              <x-slot name="content">
                <div class="mt-2 px-8 py-4 bg-indigo-800 rounded shadow-lg">
                  <x-main-menu />
                </div>
              </x-slot>
            </x-dropdown>
          </div>
          <div class="md:text-md flex items-center justify-between p-4 w-full text-sm bg-white border-b md:px-12 md:py-0">
            <div class="mr-4 mt-1">{{ Auth::user()->account->name }}</div>
            <x-dropdown class="mt-1" align="right">
              <x-slot name="trigger">
                <div class="group flex items-center cursor-pointer select-none">
                  <div class="mr-1 text-gray-700 group-hover:text-indigo-600 focus:text-indigo-600 whitespace-nowrap">
                    <span>{{ Auth::user()->first_name }}</span>
                    <span class="hidden md:inline">&nbsp;{{ Auth::user()->last_name }}</span>
                  </div>
                  <x-icon class="w-5 h-5 fill-gray-700 group-hover:fill-indigo-600 focus:fill-indigo-600" name="cheveron-down" />
                </div>
              </x-slot>
              <x-slot name="content">
                <a class="block px-6 py-2 hover:text-white hover:bg-indigo-500" href="{{ route('users') }}">Manage Users</a>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  @method('delete')

                  <a class="block px-6 py-2 w-full text-left hover:text-white hover:bg-indigo-500" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                      this.closest('form').submit();">
                      {{ __('Log Out') }}
                </a>
              </form>
              </x-slot>
            </x-dropdown>
          </div>
        </div>
        <div class="md:flex md:flex-grow md:overflow-hidden">
          <x-main-menu class="hidden flex-shrink-0 p-12 w-56 bg-indigo-800 overflow-y-auto md:block"></x-main-menu>
          <div class="px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto">
            <livewire:flash-messages/>
            {{ $slot }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <livewire:scripts />
  <livewire:livewire-ui-modal />
</body>
</html>