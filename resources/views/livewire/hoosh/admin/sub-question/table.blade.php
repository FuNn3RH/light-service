<table class="table table-bordered table-striped text-center align-middle mt-4">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>محتوا</th>
            <th>دسته بندی</th>
            <th>سطح</th>
            <th>نوع سوال</th>
            <th>عکس</th>
            <th>نمایش</th>
            <th>امتیاز</th>
            <th>زمان ایجاد</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($subQuestions as $subQuestion)
            <livewire:hoosh.admin.sub-question.table-row :$subQuestion :key="$subQuestion->id" />
        @empty
            <tr>
                <td colspan="10">
                    <h5 class="text-center my-3">سوالی وجود ندارد</h5>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
