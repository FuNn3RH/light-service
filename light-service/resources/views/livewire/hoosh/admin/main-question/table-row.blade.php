<tr>
    <td>{{ $mainQuestion['id'] }}</td>
    <td>
        {{ str($mainQuestion->title)->limit(30) }}
    </td>
    <td>{{ $mainQuestion->sub_questions_count }}</td>
    <td>{{ empty($mainQuestion->image) ? '❌' : '✅' }}</td>
    <td>{{ JalaliDate($mainQuestion->created_at, '%A, %d %B %Y') }}</td>
    <td>
        @if ($mainQuestion->published_at->timestamp < now()->timestamp)
            <span class="badge bg-success">منتشر شده</span>
        @else
            {{ JalaliDate($mainQuestion->published_at, '%d %B %Y H:i:s') }}
        @endif
    </td>
    <td>
        <div class="d-flex flex-wrap justify-content-center gap-2">
            <a wire:navigate href="{{ route('hoosh.admin.questions.sub-questions.index', $mainQuestion->id) }}"
                class="btn btn-sm btn-primary">زیر
                سوالات</a>
            <a href="{{ route('hoosh.admin.questions.create-edit', $mainQuestion->id) }}"
                class="btn btn-sm btn-warning">ویرایش</a>
            <button wire:click='delete({{ $mainQuestion->id }})' wire:confirm='آیا از حذف این سوال مطمئن هستید؟'
                class="btn btn-sm btn-danger">حذف</button>
        </div>
    </td>
</tr>
