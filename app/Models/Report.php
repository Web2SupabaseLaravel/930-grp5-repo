<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';  

    public $timestamps = true;  

    protected $fillable = [
        'reporter_id',
        'type',
        'course_id',
        'lesson_id',
        'message',
        'status',
        'created_at',
    ];

    protected $casts = [
        'reporter_id' => 'string',
        'course_id' => 'string',
        'lesson_id' => 'string',
    ];
}
