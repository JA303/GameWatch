<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
    ];

    protected $casts = [
        'screen_shots' => 'array',
        'system' => 'array',
        'prices' => 'array',

        'release_date' => 'datetime',
        'crack_date' => 'datetime',
    ];

    public function state() {

        $remain_days = Carbon::now()->diffInDays($this->release_date, false);
        if($remain_days >= 0) {
            return 'unreleased';
        } else {
            if($this->crack_date == null)
                return 'uncracked';
            else
                return 'cracked';
        }
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function all_comments() {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function isBelongsTo(User $user){
        return $this->user_id == $user->id;
    }

//    public function followes() {
//        return $this->morphMany(Follow::class, 'followable');
//    }

    public function followers() {
        return $this->morphToMany(User::class, 'followable');
    }

    public function followBy(User $user) {
        return $this->followers->contains('id', $user->id);
    }
}
