<tr>
    <td>
        {{ $question->username }}
    </td>
    <td>
        {{ str($question->title)->limit(30) }}
    </td>
    <td>
        {{ str($question->content)->limit(30) }}
    </td>
    <td>{{ JalaliDate($question->created_at, '%A, %d %B %Y') }}</td>
    <td>
        <span class="badge bg-danger">بدون پاسخ</span>
    </td>
    <td>
        <a class="btn btn-sm btn-warning"
            href="{{ route('hoosh.admin.questions.sub-questions.create-edit', [
                'subQuestion' => $question->id,
                'mainQuestion' => $question->main_question_id,
            ]) }}">
            ویرایش سوال
        </a>
    </td>
</tr>
