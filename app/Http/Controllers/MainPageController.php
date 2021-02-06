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
            ->take(4)
            ->get();

        $hot_games = Post::query()->take(4)->get();

        $most_commented_game = Post::withCount(['comments' => function ($query) {
            $query->whereDate('created_at', '>=' , now()->subWeek());
        }])->take(8)->get();

        $coming_soon_games = Post::whereDate('release_date', '>=', Carbon::now())
            ->orderBy('release_date')
            ->take(8)
            ->get();

        $best_comments = Comment::withCount('votes')
            ->orderBy('votes_count', 'desc')
            ->take(15)
            ->get();

//        $day_start = now()->subWeek();

        $best_weekly_comments = Comment::whereDate('created_at', '>' , now()->subWeek())
            ->withCount('votes')
            ->orderBy('votes_count', 'desc')
            ->take(15)
            ->get();


        return view('index', compact(['most_followed_games', 'hot_games', 'coming_soon_games', 'most_commented_game', 'best_comments', 'best_weekly_comments']));
    }
}
