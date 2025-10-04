<?php

namespace App\Http\Controllers\Hoosh\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hoosh\Api\QuestionRequest;
use App\Http\Resources\Hoosh\QuestionResource;
use App\Models\Hoosh\MainQuestion;
use App\Models\Hoosh\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function show(MainQuestion $mainQuestion)
    {
        $questions = $mainQuestion->subQuestions;

        return sendResponse(QuestionResource::collection($questions), "سوالات با موفقیت دریافت شدند");
    }

    public function store(MainQuestion $mainQuestion, QuestionRequest $request)
    {
        if ($request->has('questions')) {

            $timestamp = now();
            $questions = collect($request->questions)->map(fn($question) => [
                'content' => $question['content'],
                'score' => $question['score'] ?? 10,
                'type' => $question['type'],
                'showType' => $question['showType'],
                'options' => isset($question['options']) ? json_encode($question['options']) : json_encode([]),
                'level' => $question['level'],
                'category' => $question['category'],
                'main_question_id' => $mainQuestion->id,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ])->toArray();

            Question::insert($questions);

            return sendResponse(data: ['question_count' => count($questions)], message: "سوالات با موفقیت ثبت شدند");
        } else {
            $question = $mainQuestion->subQuestions()->create($request->validated());
            return sendResponse(data: QuestionResource::make($question), message: "سوال با موفقیت ثبت شدند");
        }
    }
}
