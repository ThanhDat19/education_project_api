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
        'test_id',
        'question',
        'question_image',
        'score'
    ];

    public function options(){
        return $this->hasMany(QuestionOption::class, 'question_id', 'id');
    }
}
