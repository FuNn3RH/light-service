<div>
    <livewire:hoosh.navbar />

    <div class="container mt-4">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
            <h3 class="mb-3 mb-md-0">پاسخ های {{ $user->username }}</h3>
            <div class="d-flex gap-2">
                <a wire:navigate href="{{ route('hoosh.admin.dashboard') }}" class="btn btn-primary">داشبورد</a>
            </div>
        </div>

        @if (session()->has('message'))
            <x-alert type="{{ session('message')['type'] }}" :messages="session('message')['text']" />
        @endif

        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-3">سوالات اصلی</h5>
                <div class="d-flex flex-wrap gap-3 mb-4">
                    @forelse ($mainQuestions as $mainQuestion)
                        <div class="mb-2">
                            <label for="chk-{{ $mainQuestion->id }}">{{ $mainQuestion->title }}</label>
                            <input type="checkbox" id="chk-{{ $mainQuestion->id }}" @checked(in_array($mainQuestion->id, $selectedMainQuestions))
                                wire:click="toggleMainQuestion({{ $mainQuestion->id }})">
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
            <div>
                <button wire:click="$set('type' , 1)"
                    class="btn btn-sm btn-secondary {{ $type === 1 ? 'btn-success' : '' }}">تصحیح نشده ها</button>
                <button wire:click="$set('type' , 2)"
                    class="btn btn-sm btn-secondary {{ $type === 2 ? 'btn-success' : '' }}">تصحیح شده ها</button>
                <button wire:click="$set('type' , 3)"
                    class="btn btn-sm btn-secondary {{ $type === 3 ? 'btn-success' : '' }}">بدون پاسخ ها</button>
                <button wire:click="$set('type' , 4)"
                    class="btn btn-sm btn-secondary {{ $type === 4 ? 'btn-success' : '' }}">همه</button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @if ($questions->isEmpty())
                    <h5 class="text-center my-3">پاسخی وجود ندارد</h5>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>سوال اصلی</th>
                                    <th>زیر سوال</th>
                                    <th>زمان پاسخ</th>
                                    <th>امتیاز</th>
                                    <th>وضعیت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                    <tr>
                                        <td>
                                            {{ str($question->mainQuestion->title)->limit(30) }}
                                        </td>
                                        <td>
                                            {{ str($question->content)->limit(30) }}
                                        </td>
                                        <td>{{ JalaliDate($question->created_at, '%A, %d %B %Y') }}</td>
                                        <td>{{ isset($question->answers) && isset($question->answer->review) ? $question->answer->review->score . '/' : '' }}{{ $question->score ?? '-' }}
                                        </td>
                                        <td>
                                            @if (filled($question->answer?->review))
                                                <span class="badge bg-success">تصحیح شده</span>
                                            @else
                                                <span class="badge bg-warning text-dark">تصحیح نشده</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($question->answer)
                                                <a wire:navigate
                                                    href="{{ route('hoosh.admin.reviews.index', $question->answer->id) }}"
                                                    class="btn btn-sm btn-warning">تصحیح</a>

                                                <button class="btn btn-sm btn-danger">حذف پاسخ</button>
                                            @else
                                                <span class="badge bg-secondary">بدون پاسخ</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
