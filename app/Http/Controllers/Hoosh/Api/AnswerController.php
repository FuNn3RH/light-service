<?php

namespace App\Http\Controllers\Hoosh\Api;

use App\Models\Hoosh\Answer;
use Illuminate\Http\Request;
use App\Models\Hoosh\Question;
use App\Http\Controllers\Controller;
use App\Http\Resources\Hoosh\AnswerResource;
use App\Http\Requests\Hoosh\Api\AnswerRequest;

class AnswerController extends Controller
{
    public function index(Answer $answer)
    {
        $answers = $answer->whereDoesntHave('review')
            ->with('mainQuestion', 'question')->get();

        return sendResponse(AnswerResource::collection($answers), "پاسخ ها با موفقیت دریافت شدند");
    }
}
