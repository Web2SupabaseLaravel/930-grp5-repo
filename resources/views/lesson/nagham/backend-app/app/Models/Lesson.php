<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
protected $fillable = ['title', 'content_type', 'content_url', 'order', 'course_id'];

}
