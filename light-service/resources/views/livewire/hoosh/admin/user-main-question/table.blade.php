<div class="table-responsive mt-3">
    <table class="table table-bordered table-striped text-center align-middle">
        <thead class="table-light">
            <tr>
                <th>سوال</th>
                <th>زمان شروع</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($userMainQuestions as $userMainQuestion)
                <livewire:hoosh.admin.user-main-question.table-row :$userMainQuestion :key="'user-main-question-' . $userMainQuestion->id" />
            @empty
                <tr>
                    <td colspan="3">
                        <h5 class="text-center my-3">سوالی وجود ندارد</h5>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
