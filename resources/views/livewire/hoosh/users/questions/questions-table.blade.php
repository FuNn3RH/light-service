<table class="table table-bordered mt-4 text-center align-middle">
    <thead class="table-dark">
        <tr>
            <th>عنوان</th>
            <th>وضعیت</th>
        </tr>
    </thead>
    <tbody>
        @forelse($questions->subQuestions as $question)
            <livewire:hoosh.users.questions.questions-row :$question :$loop :key="'question-' . ($question->id ?? $loop->iteration)" />
        @empty
            <tr>
                <td colspan="2">
                    <div class="py-4">
                        <h5>سوالی برای این بخش وجود ندارد.</h5>
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
