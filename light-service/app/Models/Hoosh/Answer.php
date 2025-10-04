<?php

namespace App\Models\Hoosh;

use App\Enums\Hoosh\AnswerStatus;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $guarded = [];

    protected $table = 'hoosh_answers';

    protected $appends = ['is_reviewed'];

    protected $casts = [
        'images' => 'array'
    ];

    public function getIsReviewedAttribute()
    {
        return $this->review ? AnswerStatus::REVIEWED : AnswerStatus::UN_REVIEWED;
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'answer_id');
    }

    public function mainQuestion()
    {
        return $this->hasOneThrough(
            MainQuestion::class,
            Question::class,
            'id',                 // Foreign key on questions
            'id',                 // Foreign key on main_questions
            'question_id',        // Local key on answers
            'main_question_id'    // Local key on questions
        );
    }
}
