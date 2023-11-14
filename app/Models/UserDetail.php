<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = ['usage_log_id', 'user_agent', 'ip_address', 'page_visited'];

    protected $table = 'user_details';
}
