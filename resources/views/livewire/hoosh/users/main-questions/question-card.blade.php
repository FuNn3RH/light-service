<div class="col-md-6 col-lg-4">
    <div class="card h-100 shadow-sm border-0">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title mb-2">{{ $mainQuestion->title }}</h5>

            <p class="card-text text-muted">
                <span class='fw-bold text-{{ $mainQuestion->level->color() }}'>{{ $mainQuestion->level->label() }}</span>
            </p>

            <p class="card-text text-muted">
                <span class="fw-bold text-info">{{ $mainQuestion->answers_count }}</span> جواب از
                <span class="fw-bold text-primary">{{ $mainQuestion->sub_questions_count }}</span> سوال
            </p>

            @if (!empty($mainQuestion->answers))
                <p class="card-text text-muted">
                    <span class="fw-bold text-info">{{ $mainQuestion->user_score ?? 0 }}</span> از
                    <span class="fw-bold text-primary">{{ $mainQuestion->total_score }}</span> امتیاز
                </p>
            @endif

            @if ($mainQuestion->published_at < date('Y-m-d H:i:s'))
                <a href="{{ route('hoosh.users.questions', $mainQuestion->id) }}"
                    class="btn btn-outline-primary mt-auto">دیدن
                    سوال‌ها</a>
            @else
                <a wire:navigate class="btn btn-secondary mt-auto">
                    <span>{{ JalaliDate($mainQuestion->published_at, '%d %B %Y H:i:s') }}</span>
                </a>
            @endif
        </div>
    </div>
</div>
