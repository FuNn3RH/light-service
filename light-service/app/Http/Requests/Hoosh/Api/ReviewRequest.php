<?php

namespace App\Http\Requests\Hoosh\Api;

use App\Rules\QuestionScoreRule;
use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->has('reviews')) {
            return [
                'reviews.*.answer_id' => 'required|exists:hoosh_answers,id',
                'reviews.*.score' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        // Get the index from the attribute, e.g., answers.0.score => 0
                        preg_match('/reviews\.(\d+)\.score/', $attribute, $matches);
                        $index = $matches[1] ?? null;

                        if ($index !== null) {
                            $answerId = $this->input("reviews.$index.answer_id");
                            (new QuestionScoreRule(answerId: $answerId))->validate($attribute, $value, $fail);
                        }
                    },
                ],
                'reviews.*.feedback' => 'nullable|string',
            ];
        }

        return [
            'answer_id' => 'required|exists:hoosh_answers,id',
            'score' => ['required', new QuestionScoreRule(answerId: $this->answer_id)],
            'feedback' => 'nullable|string'
        ];
    }

    public function attributes(): array
    {
        return [
            'answers.*.answer_id' => 'شناسه پاسخ',
            'answers.*.score' => 'امتیاز',
            'answers.*.feedback' => 'متن بازخورد',
        ];
    }
}
