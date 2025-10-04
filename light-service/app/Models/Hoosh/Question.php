<?php

namespace App\Models\Hoosh;

use App\Enums\Hoosh\QuestionLevel;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];

    protected $casts = [
        'options' => 'array',
        'showType' => 'boolean',
        'level' => QuestionLevel::class,
        'score' => 'integer',
    ];

    protected $table = 'hoosh_questions';

    public function mainQuestion()
    {
        return $this->belongsTo(MainQuestion::class, 'main_question_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function answer()
    {
        return $this->hasOne(Answer::class);
    }

    public function userAnswer()
    {
        return $this->hasOne(Answer::class)->where('user_id', request()->route('user')->id ?? auth()->guard('hoosh')->id());
    }
}
