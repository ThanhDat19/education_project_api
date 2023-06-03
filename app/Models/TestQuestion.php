<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestQuestion extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'test_questions';
    protected $fillable = ['test_id', 'question_id'];

}
