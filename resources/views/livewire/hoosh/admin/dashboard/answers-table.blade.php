<div wire:key="answers-branch">
    @if (in_array((int) $filter, [2, 3], true))
        <table class="table table-bordered table-striped text-center align-middle"
            wire:key="answers-table-answered-{{ (int) $filter }}">
            <thead class="table-light">
                <tr>
                    <th>کاربر</th>
                    <th>سوال اصلی</th>
                    <th>زیر سوال</th>
                    <th>زمان جواب</th>
                    <th>امتیاز</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($answers as $answer)
                    <livewire:hoosh.admin.dashboard.answer-row :answer="$answer" :key="'answer-row-' . $answer->id" />
                @empty
                    <tr>
                        <td colspan="7">
                            <h5 class="text-center my-3">پاسخی وجود ندارد</h5>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @else
        <table class="table table-bordered table-striped text-center align-middle"
            wire:key="answers-table-unanswered-{{ (int) $filter }}">
            <thead class="table-light">
                <tr>
                    <th>سوال اصلی</th>
                    <th>زیر سوال</th>
                    <th>زمان ایجاد سوال</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($answers as $question)
                    <livewire:hoosh.admin.dashboard.un-answered-row :question="$question" :key="'unanswered-row-' . $question->id" />
                @empty
                    <tr>
                        <td colspan="5">
                            <h5 class="text-center my-3">سوالی بدون پاسخ وجود ندارد</h5>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endif
</div>
