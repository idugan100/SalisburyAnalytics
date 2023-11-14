<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsageLog extends Model
{
    use HasFactory;

    protected $fillable = ['about_views', 'course_views', 'professor_views', 'review_views'];

    protected $table = 'usage_log';

    public function details()
    {
        return $this->hasMany(UserDetail::class, 'usage_log_id', 'id');
    }
}
