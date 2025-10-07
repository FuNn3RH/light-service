<div>
    <livewire:hoosh.navbar />

    <div class="mt-5 container">

        <h3 class="mb-4">{{ $isEdit ? 'ویرایش' : 'ایجاد' }} زیر سوال</h3>

        <div class="card p-4 shadow-sm">

            <form wire:submit.prevent="{{ $isEdit ? "update($subQuestion->id)" : 'save' }}">

                @isset($image)
                    <div class="mb-3 text-center">
                        <img src="{{ $image->temporaryUrl() }}" alt="preview"
                            class="img-fluid rounded shadow-sm preview-image">
                    </div>
                @endisset

                @isset($savedImagePath)
                    @unless ($image)
                        <div class="mb-3 text-center">
                            <img src="{{ asset('storage/' . $savedImagePath) }}" alt="current-image"
                                class="img-fluid rounded shadow-sm preview-image">
                        </div>
                    @endunless
                @endisset

                <div class="mb-3">
                    <label for="formFile" class="form-label">عکس سوال</label>
                    <input class="form-control" type="file" wire:model="image" accept="image/*" id="formFile">
                    @error('image')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                    <div wire:loading wire:target="image" class="text-info mt-2">
                        در حال آپلود تصویر، لطفاً صبر کنید...
                    </div>
                </div>

                @isset($voice)
                    <div class="mb-3">
                        <audio src="{{ $voice->temporaryUrl() }}" controls></audio>
                    </div>
                @endisset

                @isset($savedVoicePath)
                    @unless ($voice)
                        <div class="mb-3">
                            <audio src="{{ asset('storage/' . $savedVoicePath) }}" controls></audio>
                        </div>
                    @endunless
                @endisset

                <div class="mb-3">
                    <label for="voice-input" class="form-label">ویس</label>
                    <input class="form-control" type="file" wire:model="voice" accept="audio/*" id="voice-input">
                    @error('voice')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                    <div wire:loading wire:target="voice" class="text-info mt-2">
                        در حال آپلود ویس لطفاً صبر کنید...
                    </div>
                </div>

                <!-- نمایش همراه با سوال اصلی -->
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" id="showType-input" wire:model="showType" type="checkbox"
                            @checked($showType) />
                        <label class="form-check-label" for="showType-input">نمایش همراه با سوال اصلی</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">سختی</label>
                    <select wire:model="level" class="form-select">
                        @foreach ($levels as $levelOption)
                            <option value="{{ $levelOption->value }}" @selected($level === $levelOption)>
                                {{ $levelOption->label() }}</option>
                        @endforeach
                    </select>
                    @error('level')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3" x-data="{ score: @entangle('score') }">
                    <label class="form-label">امتیاز: <span id="score-value" x-text="score"></span></label>
                    <input type="range" min="10" max="100" step="5" x-model="score" />
                    @error('score')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">دسته بندی</label>
                    <input type="text" wire:model="category" class="form-control" />
                    @error('category')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <!-- متن سوال -->
                <div class="mb-3">
                    <label class="form-label">متن سوال</label>
                    <textarea wire:model="content" rows="5" class="form-control"></textarea>
                    @error('content')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <!-- نوع سوال -->
                <div class="mb-3">
                    <label class="form-label">نوع سوال</label>
                    <select wire:model="type" class="form-select" onchange="questionTypeHandler(this)">
                        <option value="text" @selected($type === 'text')>تشریحی</option>
                        <option value="choose" @selected($type === 'choose')>تستی</option>
                        <option value="image" @selected($type === 'image')>تصویر</option>
                    </select>
                    @error('type')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div @class(['my-3', 'd-none' => $type !== 'choose']) id="choose-type-warpper">
                    <button type="button" class="btn btn-warning mb-3" id="choose-btn"
                        onclick="createFormInputs()">ایجاد
                        گزینه</button>

                    @if ($type === 'choose')
                        @forelse ($options as $index => $option)
                            <div class="mb-3">
                                <label class="form-label">عنوان گزینه</label>
                                <input type="text" wire:model="options.{{ $index }}" class="form-control">
                            </div>
                        @empty
                        @endforelse
                    @endif
                </div>

                @error('options.*')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror

                <!-- دکمه‌ها -->
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button wire:loading.attr="disabled" wire:target="image,voice" type="submit"
                        class="btn btn-primary">{{ $isEdit ? 'ویرایش' : 'ایجاد' }} سوال</button>
                    <a href="{{ route('hoosh.admin.questions.sub-questions.index', $mainQuestion->id) }}"
                        class="btn btn-secondary">انصراف</a>
                </div>
            </form>
        </div>
    </div>
</div>
