<?php

namespace App\Models\Quizes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'quizes';

    protected $fillable = [
        'title',
        'description',
        'isPublish'
    ];

    public function questions() {
        return $this->hasMany(Question::class, 'quizId');
    }
}
