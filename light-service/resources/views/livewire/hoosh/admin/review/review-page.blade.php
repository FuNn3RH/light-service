<div>
    <livewire:hoosh.navbar />
    <div class="container mt-5">
        <h3>تصحیح پاسخ</h3>

        <div class="accordion my-3">
            <div class="accordion-item ">
                <h2 class="accordion-header px-4 py-2  bg-info">
                    <p class="mb-0">{{ $answer->mainQuestion->title }}</p>
                </h2>
                <div class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <p class="fs-5">{!! nl2br(e($answer->mainQuestion->content)) !!}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card p-4 mt-3">

            @if (filled($answer->question->question_image))
                <div class="mb-3">
                    <img class="w-100 h-100 object-fit"
                        src="{{ asset('storage/' . $answer->question->question_image) }}" alt="">
                </div>
            @endif

            <h5>سوال:</h5>
            <p>{{ $answer->question->content }}</p>

            <h5>پاسخ کاربر :</h5>

            @if (!empty($answer->images))
                <div class="my-3 d-flex align-items-center flex-wrap gap-3">
                    @foreach ($answer->images as $image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $image) }}" alt="question-image"
                                class="img-fluid rounded shadow-sm">
                        </div>
                    @endforeach
                </div>
            @endif

            <p>{{ $answer->answer_text }}</p>

            <form wire:submit.prevent="submit" class="mt-4">
                <div class="mb-3">
                    <label class="form-label">امتیاز (1–{{ $answer->question->score }})</label>
                    <input type="number" wire:model="score" class="form-control" value="{{ $score }}" />
                    @error('score')
                        <span class="text-sm text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">بازخورد</label>
                    <textarea class="form-control" wire:model="feedback" rows="3">
                    {{ $feedback }}
                </textarea>
                    @error('feedback')
                        <span class="text-sm text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button class="btn btn-success">ثبت بازخورد</button>

                <a href="{{ url()->previous() }}" wire:navigate class="btn btn-secondary">بازگشت</a>
            </form>
        </div>
    </div>

</div>
