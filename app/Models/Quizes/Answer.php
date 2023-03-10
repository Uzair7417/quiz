<?php

namespace App\Models\Quizes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'answers';

    protected $fillable = [
        'answer',
        'isRight',
        'questionId'
    ];

    public function question() {
        return $this->belongsTo(Question::class, 'questionId');
    }
}
