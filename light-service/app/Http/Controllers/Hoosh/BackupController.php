<?php

namespace App\Http\Controllers\Hoosh;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class BackupController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $jsonFile = File::get(storage_path('app/backup/data.json'));
        $data = json_decode($jsonFile);

        $data = collect($data);

        $users = $this->getData($data, 'users');

        foreach ($users as $user) {
            DB::table('hoosh_users')->updateOrInsert(
                ['id' => $user->id],
                [
                    'username'   => $user->username,
                    'password'   => $user->password,
                    'role'       => $user->role,
                    'created_at' => $user->created_at ? Carbon::parse($user->created_at) : now(),
                    'updated_at' => $user->updated_at ? Carbon::parse($user->updated_at) : $user->created_at,
                ]
            );
        }

        $mainQuestions = $this->getData($data, 'main_questions');

        foreach ($mainQuestions as $mainQuestion) {
            DB::table('hoosh_main_questions')->updateOrInsert(
                ['id' => $mainQuestion->id],
                [
                    'title'   => $mainQuestion->title,
                    'content'   => $mainQuestion->content,
                    'level'       => $this->replaceLevel($mainQuestion->level),
                    'image' => $mainQuestion->image ?? null,
                    'published_at' => $mainQuestion->published_at ? Carbon::parse($mainQuestion->published_at)->timestamp : Carbon::parse($mainQuestion->created_at)->timestamp,
                    'user_id' => $mainQuestion->created_by,
                    'created_at' => $mainQuestion->created_at ? Carbon::parse($mainQuestion->created_at) : now(),
                    'updated_at' => $mainQuestion->updated_at ? Carbon::parse($mainQuestion->updated_at) : $mainQuestion->created_at
                ]
            );
        }

        $questions = $this->getData($data, 'questions');
        foreach ($questions as $question) {
            DB::table('hoosh_questions')->updateOrInsert(
                ['id' => $question->id],
                [
                    'main_question_id' => $question->main_question_id,
                    'content' => $question->content,
                    'image' => $question->image,
                    'score' => $question->score,
                    'type' => $question->type,
                    'showType' => $question->showType,
                    'options' => $question->options,
                    'level' => $this->replaceLevel($question->level),
                    'category' => $question->category,
                    'created_at' => $question->created_at,
                    'updated_at' => $question->updated_at ? Carbon::parse($question->updated_at) : $question->created_at,
                ]
            );
        }

        $answers = $this->getData($data, 'answers');
        foreach ($answers as $answer) {
            DB::table('hoosh_answers')->updateOrInsert(
                ['id' => $answer->id],
                [
                    'user_id' => $answer->user_id,
                    'question_id' => $answer->question_id,
                    'answer_text' => $answer->answer_text,
                    'images' => json_encode([]),
                    'created_at' => $answer->created_at,
                    'updated_at' => $answer->updated_at ? Carbon::parse($answer->updated_at) : $answer->created_at,
                ]
            );
        }

        $reviews = $this->getData($data, 'reviews');
        foreach ($reviews as $review) {
            DB::table('hoosh_reviews')->updateOrInsert(
                ['id' => $review->id],
                [
                    'answer_id' => $review->answer_id,
                    'score' => $review->score,
                    'feedback' => $review->feedback,
                    'created_at' => $review->created_at,
                    'updated_at' => $review->updated_at ? Carbon::parse($review->updated_at) : $review->created_at,
                ]
            );
        }

        $userMainQuestions = $this->getData($data, 'user_main_questions');
        foreach ($userMainQuestions as $userMainQuestion) {

            if (in_array($userMainQuestion->user_id, [15, 12])) {
                continue;
            }

            if (in_array($userMainQuestion->main_question_id, [24, 20])) {
                continue;
            }

            DB::table('hoosh_user_main_questions')->updateOrInsert(
                ['id' => $userMainQuestion->id],
                [
                    'user_id' => $userMainQuestion->user_id,
                    'main_question_id' => $userMainQuestion->main_question_id,
                    'created_at' => $userMainQuestion->created_at,
                    'updated_at' => $userMainQuestion->created_at,
                ]
            );
        }
    }

    private function getData($data, $table)
    {
        return optional($data->first(fn($item) => $item->name == $table))->data ?? [];
    }

    private function replaceLevel($level)
    {
        $levels = [
            'آسان' => 'easy',
            'متوسط' => 'medium',
            'سخت' => 'hard'
        ];

        return $levels[$level];
    }
}
