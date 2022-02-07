<button {{ $attributes->merge(['class' => 'flex items-center']) }}>
    <div wire:loading {{ $attributes->wire('target') }} class="btn-spinner mr-2"></div>
    {{ $slot }}
</button>