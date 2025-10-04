<?php

namespace App\Http\Controllers\Hoosh\Api;

use App\Models\Hoosh\Answer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hoosh\Api\AnswerRequest;
use App\Http\Requests\Hoosh\Api\ReviewRequest;
use App\Http\Resources\Hoosh\AnswerResource;
use App\Http\Resources\Hoosh\ReviewResource;
use App\Models\Hoosh\Review;

class ReviewController extends Controller
{
    public function store(ReviewRequest $request)
    {

        if ($request->has("reviews")) {

            $reviews = [];
            foreach ($request->reviews as $review) {
                $reviews[] = Review::updateOrCreate(['answer_id' => $review['answer_id']], $review);
            }

            return sendResponse(data: ReviewResource::collection($reviews), message: "بازخوردها با موفقیت ثبت شدند");
        } else {
            $review = Review::updateOrCreate(['answer_id' => $request->answer_id], $request->validated());
            return sendResponse(data: ReviewResource::make($review), message: "بازخورد با موفقیت ثبت شد");
        }
    }
}
