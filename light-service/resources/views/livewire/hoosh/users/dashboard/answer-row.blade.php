<tr>
    <td>
        {{ str($answer->question->content)->limit(30) }}
    </td>
    <td dir="ltr">{{ isset($answer->review) ? $answer->review->score . '/' : '' }}{{ $answer->question->score }}
    <td>
        <span class="badge {{ $answer->is_reviewed->class() }}">{{ $answer->is_reviewed->label() }}</span>
    </td>
    <td class="text-break">
        {{ $answer->review?->feedback ? str($answer->review?->feedback)->limit(30) : '-' }}
    </td>
    <td>
        {{ $answer->review?->created_at ? JalaliDate($answer->review?->created_at, '%A, %d %B %Y - H:i') : '-' }}
    </td>
    <td>
        <a href="{{ route('hoosh.users.answer', $answer->id) }}" class="btn btn-warning btn-sm">جزئیات</a>
    </td>
</tr>
