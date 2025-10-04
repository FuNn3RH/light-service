<div>

    <livewire:hoosh.navbar wire:key="lw-user-navbar" />

    <div class="container mt-4">

        <livewire:hoosh.users.dashboard.welcome />

        <div wire:key="lw-flash-slot">
            @if (session()->has('message'))
                <div class="mt-3">
                    <x-alert type="{{ session('message')['type'] }}" :messages="session('message')['text']" />
                </div>
            @else
                <div class="mt-3" style="display:none;"></div>
            @endif
        </div>

        <h5 class="mb-3">جواب‌های شما</h5>
        <livewire:hoosh.users.dashboard.answers-table />
    </div>

</div>
