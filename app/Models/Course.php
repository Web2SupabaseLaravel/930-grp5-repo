<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'courses';

    protected $fillable = [
        'id',
        'title',
        'info',
        'category',
        'price',
        'instructor_id',
    ];

    protected $casts = [
        'id' => 'string',
        'price' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'instructor_id' => 'string',
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}
