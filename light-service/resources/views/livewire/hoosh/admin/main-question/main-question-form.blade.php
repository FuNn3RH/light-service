<div>
    <link rel="stylesheet" href="{{ asset('assets/hoosh/lib/jalalidatepicker/persian-datepicker.min.css') }}">
    <livewire:hoosh.navbar />

    <div class="mt-5 container">
        <div class="mt-5 container">

            <div class="card p-4 mt-4">
                <form wire:submit.prevent="{{ $isEdit ? "update($question->id)" : 'save' }}">
                    <div class="mb-3">
                        <label class="form-label">عنوان سوال</label>
                        <input type="text" name="title" class="form-control" wire:model="title">
                        @error('title')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">متن سوال</label>
                        <textarea name="content" rows="5" class="form-control" wire:model="content"></textarea>
                        @error('content')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-md-3">
                        <label for="published_at">تاریخ انتشار</label>
                        <input type="text" class="form-control d-none" id="published_at" name="published_at"
                            wire:model="published_at" required>
                        <input type="text" class="form-control" id="published_at_view" wire:ignore required
                            autocomplete="off">
                        @error('published_at')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    @isset($image)
                        <div class="mb-3">
                            <img src="{{ $image->temporaryUrl() }}" alt="preview"
                                class="img-fluid rounded shadow-sm object-contain preview-image">
                        </div>
                    @endisset

                    @isset($savedImagePath)
                        @unless ($image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $savedImagePath) }}" alt="current-image"
                                    class="img-fluid rounded shadow-sm object-contain preview-image">
                            </div>
                        @endunless
                    @endisset

                    <div class="mb-3">
                        <label for="formFile" class="form-label">عکس سوال</label>
                        <input class="form-control" type="file" name="image" accept="image/*" id="formFile"
                            wire:model="image">
                        @error('image')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                        <div wire:loading wire:target="image" class="text-info mt-2">
                            در حال آپلود تصویر، لطفاً صبر کنید...
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">سختی</label>
                        <select name="level" class="form-select" wire:model="level">
                            @foreach ($levels as $levelOption)
                                <option value="{{ $levelOption->value }}" @selected($level === $levelOption->value)>
                                    {{ $levelOption->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('level')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button wire:loading.attr="disabled" wire:target="image" type="submit"
                        class="btn btn-primary">{{ $isEdit ? 'ویرایش' : 'ایجاد' }} سوال</button>
                    <a wire:navigate href="{{ route('hoosh.admin.questions.index') }}"
                        class="btn btn-secondary ms-2">انصراف</a>
                </form>
            </div>

            <script src="{{ asset('assets/hoosh/lib/jquery.slim.min.js') }}"></script>
            <script src="{{ asset('assets/hoosh/lib/jalalidatepicker/persian-date.min.js') }}"></script>
            <script src="{{ asset('assets/hoosh/lib/jalalidatepicker/persian-datepicker.min.js') }}"></script>

            <script>
                var $view = $('#published_at_view');

                $view.persianDatepicker({
                    format: 'YYYY-MM-DD HH:mm:ss',
                    calendar: {
                        persian: {
                            leapYearMode: 'astronomical'
                        }
                    },
                    toolbox: {
                        calendarSwitch: {
                            enabled: true
                        }
                    },
                    timePicker: {
                        enabled: true
                    },
                    observer: true,
                    initialValue: false,
                    altField: '#published_at',
                    altFormat: 'X',
                    autoClose: true,
                    onSelect: function() {
                        @this.set('published_at', $('#published_at').val());
                    }
                });

                function applyInitial() {
                    var raw = $('#published_at').val();
                    var ts = Number(raw);
                    if (!Number.isNaN(ts) && ts > 0) {
                        if (String(ts).length === 10) ts = ts * 1000;
                        var inst = $view.data('datepicker');
                        if (inst && inst.setDate) inst.setDate(ts);
                    }
                }

                setTimeout(() => {
                    applyInitial();
                }, 1000);
            </script>
        </div>
    </div>
</div>
