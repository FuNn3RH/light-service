<div class="table-responsive">
    <table class="table table-bordered table-striped text-center align-middle mt-4">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>عنوان</th>
                <th>تعداد زیر سوال</th>
                <th>عکس</th>
                <th>زمان ایجاد</th>
                <th>زمان انتشار</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mainQuestions as $mainQuestion)
                <livewire:hoosh.admin.main-question.table-row :$mainQuestion :key="$mainQuestion->id" />

            @empty
                <tr>
                    <td colspan="7">
                        <h5 class="text-center my-3">سوالی وجود ندارد</h5>
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>
</div>
