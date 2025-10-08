<div>
    <livewire:hoosh.navbar>
        <div class="container mt-5">
            <h3>جزئیات پاسخ</h3>

            <div class="accordion my-3">
                <div class="accordion-item ">
                    <h2 class="accordion-header px-4 py-2  bg-info">
                        <p class="mb-0">{{ $answer->mainQuestion->title }}</p>
                    </h2>
                    <div class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            @if (!empty($answer->mainQuestion->image))
                                <div class="mb-3">
                                    <img class="img-fluid rounded shadow-sm object-contain preview-image"
                                        src="{{ asset('storage/' . $answer->mainQuestion->image) }}"
                                        alt="{{ $answer->mainQuestion->title }}">
                                </div>
                            @endif
                            <p class="fs-5">{!! nl2br(e($answer->mainQuestion->main_content)) !!}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card p-4 mt-3">

                <div>
                    <h5>سوال:</h5>
                    <p>{!! nl2br(e($answer->question->content)) !!}</p>
                </div>

                <div>
                    <h5>پاسخ شما :</h5>
                    <p>{{ $answer->answer_text }}</p>
                </div>

                @if ($answer->review)
                    <div>
                        <h5>باز خورد :</h5>
                        <p>امتیاز:{{ $answer->review->score }}</p>
                        <p>{!! nl2br(e($answer->review->feedback)) !!}</p>
                    </div>
                @endif
                <div class="mt-3">
                    <a href="{{ route('hoosh.users.dashboard') }}" class="btn btn-primary">بازگشت</a>
                </div>
            </div>
        </div>
</div>
