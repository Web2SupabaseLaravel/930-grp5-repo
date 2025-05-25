<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\User; 

class Wishlist extends Model
{
    use HasUuids;

    protected $table = 'wishlist'; 
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'course_id',
    ];

    public $timestamps = true;
    const UPDATED_AT = null; 

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
