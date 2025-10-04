<div>
    <livewire:hoosh.navbar />

    <div class="container mt-5">
        <livewire:hoosh.admin.sub-question.header :$mainQuestion />

        @if (session()->has('message'))
            <x-alert type="{{ session('message')['type'] }}" :messages="session('message')['text']" />
        @endif


        <livewire:hoosh.admin.sub-question.main-question-info :$mainQuestion />

        <div class="table-responsive">
            <livewire:hoosh.admin.sub-question.table :$mainQuestion />
        </div>
    </div>

</div>
