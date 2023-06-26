<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NestedReply;
use App\Models\Video;
use App\Models\User;

class Reply extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function author() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function video() {
        return $this->belongsTo(Video::class);
    }

    public function nestedReplies() {
        return $this->hasMany(NestedReply::class);
    }
}
