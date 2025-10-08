<?php

namespace App\Rules;

use Closure;
use App\Models\Hoosh\Answer;
use Illuminate\Contracts\Validation\ValidationRule;

class QuestionScoreRule implements ValidationRule
{
    private int $questionScore;
    private int $answerId;

    public function __construct(?int $questionScore = 0, ?int $answerId = 0)
    {
        $this->questionScore = $questionScore ?? 0;
        $this->answerId = $answerId ?? 0;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->answerId > 0) {
            $answer = Answer::with('question')->find($this->answerId);

            if (!$answer) {
                $fail("پاسخی با این شناسه وجود ندارد");
                return;
            }

            $score = $answer->question->score;

            if ($value < 0 || $value > $score) {
                $fail("امتیاز :attribute باید بین 0 و {$score} باشد.");
            }
            return;
        }

        if ($this->questionScore > 0 && ($value < 0 || $value > $this->questionScore)) {
            $fail("امتیاز :attribute باید بین 0 و {$this->questionScore} باشد.");
        }
    }
}
