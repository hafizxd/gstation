<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reply;
use App\Models\User;

class Video extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function favoritedBy() {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function replies() {
        return $this->hasMany(Reply::class);
    }
}
