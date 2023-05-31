<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionOption extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'question_id',
        'option_text',
        'correct'
    ];
}
