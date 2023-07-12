<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'discount_types',
        'reduction_rate',
        'course_id',
        'start_date',
        'end_date',
    ];

    public function course(){
        return $this->hasOne(Courses::class, 'id', 'course_id');
    }
}
