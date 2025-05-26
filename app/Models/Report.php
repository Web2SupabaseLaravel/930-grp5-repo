<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';


    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = true;

    protected $fillable = [
        'id',
        'reporter_id',
        'type',
        'course_id',
        'lesson_id',
        'message',
        'status',
    ];

    protected $casts = [
        'id' => 'string',
        'reporter_id' => 'string',
        'course_id' => 'string',
        'lesson_id' => 'string',
    ];


    public const TYPES = [
        'technical_issue' => 'Technical Issue',
        'become_instructor' => 'Become Instructor',
        'certificate_request' => 'Certificate Request',
    ];


    public const STATUSES = [
        'pending' => 'Pending',
        'reviewed' => 'Reviewed',
        'resolved' => 'Resolved',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }
}
