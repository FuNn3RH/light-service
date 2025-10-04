<?php

namespace App\Http\Requests\Hoosh\Api;

use App\Enums\Hoosh\QuestionLevel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestionRequest extends FormRequest
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
        if ($this->has('questions')) {
            return [
                'questions' => 'required|array|min:1',
                'questions.*.content' => 'required|string|max:1000',
                'questions.*.score' => 'nullable|integer|min:1|max:100',
                'questions.*.type' => 'required|in:choose,text,image',
                'questions.*.showType' => 'required|integer|in:0,1',
                'questions.*.options' => 'nullable|array',
                'questions.*.level' => ['required', Rule::enum(QuestionLevel::class)],
                'questions.*.category' => 'required|string|max:255',
            ];
        }

        return [
            'content' => 'required|string|max:1000',
            'score' => 'nullable|integer|min:1|max:100',
            'type' => 'required|in:choose,text,image',
            'showType' => 'required|integer|in:0,1',
            'options' => 'nullable|array',
            'level' => ['required', Rule::enum(QuestionLevel::class)],
            'category' => 'required|string|max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            'questions.*.content' => 'محتوا',
            'questions.*.score' => 'امتیاز',
            'questions.*.type' => 'نوع سوال',
            'questions.*.showType' => 'نحوه نمایش',
            'questions.*.options' => 'موارد تستی',
            'questions.*.level' => 'سختی',
            'questions.*.category' => 'دسته بندی',
        ];
    }
}
