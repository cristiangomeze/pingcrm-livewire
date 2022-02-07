<div {{ $attributes }}>
    <x-main-menu-link href="{{ route('dashboard') }}" active="{{ request()->routeIs('dashboard') }}" iconName="dashboard">Dashboard</x-main-menu-link>
    <x-main-menu-link href="{{ route('organizations') }}" active="{{ request()->routeIs('organizations') }}" iconName="office">Organizations</x-main-menu-link>
    <x-main-menu-link href="{{ route('contacts') }}" active="{{ request()->routeIs('contacts') }}" iconName="users">Contacts</x-main-menu-link>
    <x-main-menu-link href="{{ route('reports') }}" active="{{ request()->routeIs('reports') }}" iconName="printer">Reports</x-main-menu-link>
</div>