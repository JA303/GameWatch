<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function votes() {
        return $this->hasMany(Vote::class, 'comment_id');
    }

    public function up_votes() {
        return $this->hasMany(Vote::class, 'comment_id')->where('up_vote', true);
    }

    public function down_votes() {
        return $this->hasMany(Vote::class, 'comment_id')->where('up_vote', false);
    }

    public function sumOfVotes() {
        $votes = $this->votes;
        $upVoteCount = $votes->where('up_vote', true)->count();
        return $upVoteCount - ($votes->count() - $upVoteCount);
    }

    public function voteBy(User $user) {
        return $this->votes->contains('user_id', $user->id);
    }

    public function vote(User $user) {
        $vote = $this->votes()->where('user_id', $user->id)->first();
        if($vote != null)
            return $vote->up_vote;
        else
            return null;
    }
}
