<?php

namespace App\Models\Hoosh;

use App\Enums\Hoosh\QuestionLevel;
use Illuminate\Database\Eloquent\Model;

class MainQuestion extends Model
{
    protected $guarded = [];

    protected $table = 'hoosh_main_questions';

    protected $appends = ['total_score', 'user_score', 'subQuestionsCount'];

    public function getTotalScoreAttribute()
    {
        return $this->subQuestions()->sum('score');
    }

    public function getUserScoreAttribute()
    {
        return $this->answers()
            ->where('user_id', auth()->guard('hoosh')->id())
            ->with('review')
            ->get()
            ->sum(fn($answer) => $answer->review?->score ?? 0);
    }

    public function getSubQuestionsCountAttribute()
    {
        return $this->subQuestions()->count();
    }

    protected function casts(): array
    {
        return [
            'level' => QuestionLevel::class,
            'published_at' => 'datetime'
        ];
    }

    public function subQuestions()
    {
        return $this->hasMany(Question::class, 'main_question_id');
    }

    public function answers()
    {
        return $this->hasManyThrough(Answer::class, Question::class);
    }

    public function userMainQuestion()
    {
        return $this->hasOne(UserMainQuestion::class);
    }
}
