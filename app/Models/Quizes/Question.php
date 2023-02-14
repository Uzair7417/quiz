<?php

namespace App\Models\Quizes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'questions';

    protected $fillable = [
        'question',
        'isMandatory',
        'quizId'
    ];

    public function quiz() {
        return $this->belongsTo(Quiz::class, 'quizId');
    }

    public function answers() {
        return $this->hasMany(Answer::class, 'questionId');
    }
}
