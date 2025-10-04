<div class="accordion my-4">
    <div class="accordion-item border">
        <h2 class="accordion-header bg-info-subtle px-4 py-3">
            <p class="mb-1">{{ $mainQuestion->title }}</p>
            <p class="fw-bold text-{{ $mainQuestion->level->color() }}">
                {{ $mainQuestion->level->label() }}
            </p>
        </h2>
        <div class="accordion-collapse collapse {{ !$showType && !$mainQuestion['seen'] ? 'show' : '' }}">
            <div class="accordion-body">
                @if (!empty($mainQuestion->image))
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $mainQuestion->image) }}" alt="question-image"
                            class="img-fluid rounded shadow-sm">
                    </div>
                @endif

                <p class="fs-5">{{ $mainQuestion->content }}</p>
            </div>
        </div>
    </div>
</div>
