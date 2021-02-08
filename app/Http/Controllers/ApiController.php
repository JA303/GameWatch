<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Response;

class ApiController extends Controller
{
    public function get_post(Post $post, Request $request) {
        return Response::json($post);
    }

    public function get_post_top(int $count, Request $request) {
        if($count > 50)
            $count = 50;

        $posts = Post::withCount('followers')
        ->orderBy('followers_count', 'desc')
        ->take($count)
        ->get();

        return Response::json($posts);
    }

    public function get_post_comments(Post $post, Request $request) {
        return Response::json($post->all_comments);
    }

    public function get_comment(Comment $comment, Request $request) {
        return Response::json($comment);
    }

    public function get_user(User $user, Request $request) {
        return Response::json($user);
    }

    public function get_user_top(int $count, Request $request) {
        if($count > 100)
        $count = 100;

        $users = User::query()->orderByDesc('karma')->take($count)->get();
        return Response::json($users);
    }

    public function get_user_votes(User $user, Request $request) {
        return Response::json($user->votes);
    }
}
