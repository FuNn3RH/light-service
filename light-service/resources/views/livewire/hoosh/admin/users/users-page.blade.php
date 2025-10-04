<div>
    <livewire:hoosh.navbar />

    <div class="container mt-4">

        <livewire:hoosh.admin.users.header />

        @if (session()->has('message'))
            <x-alert type="{{ session('message')['type'] }}" :messages="session('message')['text']" />
        @endif

        <livewire:hoosh.admin.users.users-table />

        <livewire:hoosh.admin.users.users-report />

    </div>
</div>
