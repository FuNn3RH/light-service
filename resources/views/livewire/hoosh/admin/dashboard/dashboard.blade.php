<div>
    <livewire:hoosh.navbar wire:key="lw-admin-navbar" />

    <div class="container mt-4">
        <livewire:hoosh.admin.dashboard.header wire:key="lw-admin-header" />

        {{-- keep this node stable so siblings don’t shift --}}
        <div wire:key="lw-flash-slot">
            @if (session()->has('message'))
                <div class="mt-3">
                    <x-alert type="{{ session('message')['type'] }}" :messages="session('message')['text']" />
                </div>
            @else
                <div class="mt-3" style="display:none;"></div>
            @endif
        </div>

        <livewire:hoosh.admin.dashboard.filter-buttons wire:key="lw-filter-buttons" />
        <livewire:hoosh.admin.dashboard.answers-table wire:key="lw-answers-table" />
    </div>
</div>
