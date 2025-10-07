<div>

    <livewire:hoosh.navbar />

    <div class="container mt-5">
        <h3>ثبت پاسخ</h3>

        <div wire:key="lw-flash-slot">
            @if (session()->has('message'))
                <div class="mt-3">
                    <x-alert type="{{ session('message')['type'] }}" :messages="session('message')['text']" />
                </div>
            @else
                <div class="mt-3" style="display:none;"></div>
            @endif
        </div>

        @if ($question->showType === 1)
            <livewire:hoosh.users.questions.main-question :$mainQuestion :$showType />
        @endif

        <div class="card p-4 mt-3">
            <div class="border-bottom mb-2 py-2" dir="ltr">
                <div x-data="{ time: new Date().toLocaleTimeString('fa-IR', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false }) }" x-init="setInterval(() => time = new Date().toLocaleTimeString('fa-IR', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false }), 1000)">
                    <span x-text="time" class="fs-5"></span>
                </div>

            </div>
            <h5>سوال:</h5>
            @if ($question->image)
                <div class="my-3">
                    <img src="{{ asset('storage/' . $question->image) }}" alt="question-image"
                        class="img-fluid rounded shadow-sm">
                </div>
            @endif

            @if ($question->voice)
                <div class="mb-3">
                    <audio src="{{ asset('storage/' . $question->voice) }}" controls></audio>
                </div>
            @endif
            <p>
                {{ $question->content }}
            </p>

            <form wire:submit.prevent='submit'>
                <div class="mb-3">
                    <label class="form-label fs-5">پاسخ:</label>

                    @switch($question->type)
                        @case('choose')
                            @if ($question->options)
                                @foreach ($question->options as $option)
                                    <div class="form-check d-flex align-items-center justify-content-between"
                                        style="width: fit-content;">
                                        <input class="form-check-input ms-2" type="radio" name="answer_text"
                                            id="options-{{ $loop->index }} ?>" value="{{ $option }}">
                                        <label class="form-check-label" for="options-{{ $loop->index }} ?>">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                <textarea class="form-control" name="answer_text" rows="3" wire:model='answer_text'
                                    placeholder="پاسخ خود را وارد کنید"></textarea>
                                @error('answer_text')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            @endif
                        @break

                        @case('image')
                            <div class="my-3 d-flex align-items-center">
                                @if (!empty($images))
                                    @foreach ($images as $image)
                                        <div class="mb-3">
                                            <img src="{{ $image->temporaryUrl() }}" alt="question-image"
                                                class="img-fluid rounded shadow-sm w-50 h-50">
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="mb-3">
                                <input class="form-control" type="file" wire:model="images" multiple accept="image/*">
                                @error('images')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                                <div wire:loading wire:target="images" class="text-info mt-2">
                                    در حال آپلود تصویر، لطفاً صبر کنید...
                                </div>
                            </div>
                        @break

                        @default
                            <textarea class="form-control" name="answer_text" rows="3" wire:model='answer_text'
                                placeholder="پاسخ خود را وارد کنید"></textarea>
                            @error('answer_text')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        @break

                    @endswitch

                </div>

                <button wire:loading.attr="disabled" wire:target="images" wire:confirm='آیا مطمئن به ثبت پاسخ هستید؟'
                    class="btn btn-success">ثبت پاسخ</button>

                <a href="{{ route('hoosh.users.questions', $mainQuestion->id) }}"
                    onclick="return confirm('آیا مطمئن به بازگشت هستید؟')" class="btn btn-danger">بازگشت</a>
            </form>
        </div>
    </div>

</div>
