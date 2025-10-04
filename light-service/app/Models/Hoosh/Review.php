<?php

namespace App\Models\Hoosh;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [];

    protected $table = 'hoosh_reviews';

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'answer_id');
    }
}
