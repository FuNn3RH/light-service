<div>

    <livewire:hoosh.navbar />

    <div class="container mt-4">

        <livewire:hoosh.admin.main-question.header />

        @if (session()->has('message'))
            <x-alert type="{{ session('message')['type'] }}" :messages="session('message')['text']" />
        @endif

        <livewire:hoosh.admin.main-question.table />

    </div>

</div>
