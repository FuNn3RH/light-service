<div class="row g-4">
    @forelse($mainQuestions as $mainQuestion)
        <livewire:hoosh.users.main-questions.question-card :mainQuestion="$mainQuestion" :key="$mainQuestion['id']" />
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                سوالی برای نمایش وجود ندارد.
            </div>
        </div>
    @endforelse
</div>
