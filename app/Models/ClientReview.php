<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientReview extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'client_img',
        'client_title',
        'client_description'
    ];
}
