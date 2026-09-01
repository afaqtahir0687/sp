<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = ['question_en', 'question_ar', 'answer_en', 'answer_ar', 'status'];

    protected $appends = ['question', 'answer'];

    public function getQuestionAttribute()
    {
        return app()->getLocale() === 'ar' && $this->question_ar ? $this->question_ar : $this->question_en;
    }

    public function getAnswerAttribute()
    {
        return app()->getLocale() === 'ar' && $this->answer_ar ? $this->answer_ar : $this->answer_en;
    }
}
