<?php

namespace App\Models\Hoosh;

use Illuminate\Database\Eloquent\Model;

class UserMainQuestion extends Model
{
    protected $guarded = [];

    protected $table = 'hoosh_user_main_questions';

    public function mainQuestions()
    {
        return $this->hasMany(MainQuestion::class);
    }


    public function mainQuestion()
    {
        return $this->hasOne(MainQuestion::class, 'id', 'main_question_id');
    }
}
