<tr>
    <td>{{ $answer->user->username }}</td>
    <td>
        {{ str($answer->mainQuestion->title)->limit(30) }}
    </td>
    <td dir="ltr">{{ isset($answer->review) ? $answer->review->score . '/' : '' }}{{ $answer->question->score }}
    <td>
        {{ str($answer->mainQuestion->content)->limit(30) }}
    </td>
    <td>{{ JalaliDate($answer->created_at, '%A, %d %B %Y') }}</td>
    <td>
        @if (filled($answer->review))
            <span class="badge bg-success">تصحیح شده</span>
        @else
            <span class="badge bg-warning text-dark">تصحیح نشده</span>
        @endif
    </td>
    <td>
        <a href="{{ route('hoosh.admin.reviews.index', array_merge(['answer' => $answer->id], request()->query())) }}"
            class="btn btn-sm btn-warning">تصحیح</a>
        <button wire:click='delete({{ $answer->id }})' wire:confirm='آیا از حذف این پاسخ مطمئن هستید؟'
            class="btn btn-sm btn-danger">حذف پاسخ</button>
    </td>
</tr>
