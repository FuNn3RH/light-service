<div>

    <livewire:hoosh.navbar />

    <div class="container mt-5">

        <livewire:hoosh.users.questions.header />

        <div wire:key="lw-flash-slot">
            @if (session()->has('message'))
                <div class="mt-3">
                    <x-alert type="{{ session('message')['type'] }}" :messages="session('message')['text']" />
                </div>
            @else
                <div class="mt-3" style="display:none;"></div>
            @endif
        </div>

        <livewire:hoosh.users.questions.main-question :$mainQuestion />

        <livewire:hoosh.users.questions.start :$mainQuestion />

        <livewire:hoosh.users.questions.questions-table :$mainQuestion />
    </div>


</div>
