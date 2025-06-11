<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'students_count',
        'instructor_id'
    ];

    protected $casts = [
        'id' => 'string',
        'students_count' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            $course->id = (string) Str::uuid();
        });
    }
}
