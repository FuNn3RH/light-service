<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle text-center">
        <thead class="table-light">
            <tr>
                <th>سوال</th>
                <th>امتیاز</th>
                <th>وضعیت</th>
                <th>بازخورد</th>
                <th>زمان بازخورد</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($answers as $answer)
                <livewire:hoosh.users.dashboard.answer-row :answer="$answer" :key="$answer['id']" />
            @empty
                <tr>
                    <td colspan="6">
                        <h5 class="my-3">پاسخی وجود ندارد</h5>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
