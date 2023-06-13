<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'question',
        'question_type_id',
        'question_image',
        'score',
        'multi_answer'
    ];

    public function options()
    {
        return $this->hasMany(QuestionOption::class, 'question_id', 'id');
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'test_questions');
    }

    public function type()
    {
        return $this->belongsTo(QuestionType::class, 'question_type_id', 'id');
    }

}
