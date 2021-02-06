<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    //

    public function index() {
        $most_followed_games = Post::withCount('followers')
            ->orderBy('followers_count', 'desc')
            ->take(8)
            ->get();

        $hot_games = Post::findMany([1, 2, 3, 4]);

        $coming_soon_games = Post::whereDate('release_date', '>=', Carbon::now())
            ->orderBy('release_date')
            ->take('8')
            ->get();

        $best_comments = Comment::withCount('votes')
            ->orderBy('votes_count', 'desc')
            ->take(15)
            ->get();

        $day_start = now()->subWeek();

        $best_weekly_comments = Comment::whereDate('created_at', '>' , $day_start)
            ->withCount('votes')
            ->orderBy('votes_count', 'desc')
            ->take(15)
            ->get();


        return view('index', compact(['most_followed_games', 'hot_games', 'coming_soon_games', 'best_comments', 'best_weekly_comments']));
    }
}
