<tr>
    <td>{{ $subQuestion->id }}</td>
    <td>{{ str($subQuestion->content)->limit(30) }}
    </td>
    <td>{{ __($subQuestion->category) }}</td>
    <td><span class="badge bg-{{ $subQuestion->level->color() }}">{{ $subQuestion->level->label() }}</span></td>
    <td>{{ __($subQuestion->type) }}</td>
    <td>{{ $subQuestion->image ? '✅' : '❌' }}</td>
    <td>{{ $subQuestion->showType ? '✅' : '❌' }}</td>
    <td>{{ $subQuestion->score }}</td>
    <td>{{ JalaliDate($subQuestion->created_at, '%A, %d %B %Y') }}</td>
    <td>
        <div class="d-flex flex-wrap justify-content-center gap-2">
            <a href="{{ route('hoosh.admin.questions.sub-questions.create-edit', [
                'subQuestion' => $subQuestion->id,
                'mainQuestion' => $subQuestion->main_question_id,
            ]) }}"
                class="btn btn-sm btn-warning">ویرایش</a>
            <button wire:click="deleteSubQuestion({{ $subQuestion->id }})"
                wire:confirm='آیا از حذف این سوال اطمینان دارید؟' class="btn btn-sm btn-danger">حذف</button>
        </div>
    </td>
</tr>
