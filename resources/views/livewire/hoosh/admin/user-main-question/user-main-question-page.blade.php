<div>
    <livewire:hoosh.navbar />

    <div class="container mt-4">

        <livewire:hoosh.admin.user-main-question.header :$user />

        @if (session()->has('message'))
            <x-alert type="{{ session('message')['type'] }}" :messages="session('message')['text']" />
        @endif

        <livewire:hoosh.admin.user-main-question.table :$user />

    </div>

</div>
