<tr>
    <td>
        @if (!empty($question->answer))
            {{ str($question->content)->limit(50) }}
        @else
            سوال {{ $index }}
        @endif
    </td>
    <td>
        @if (!empty($question->answer?->review))
            <a href="{{ route('hoosh.users.answer', $question->answer->id) }}" class="btn btn-sm btn-info">
                بازخورد
            </a>
        @elseif(!empty($question->answer))
            <span class="text-success">پاسخ داده شده</span>
        @else
            <span class="text-danger">بدون پاسخ</span>
        @endif
    </td>
</tr>
