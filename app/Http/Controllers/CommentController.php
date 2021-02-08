<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Vote;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\True_;
use DB;

class CommentController extends Controller
{

    public function __construct() {
        $this->middleware('role:user')->except(['index_bests', 'index_week_bests', 'delete']);
        // $this->middleware('role:admin')->except(['index_bests', 'index_week_bests']);
    }

    public function index_bests() {
        $title = 'Best Comments';
        $comments = Comment::withCount(['up_votes', 'down_votes'])
            ->orderBy(DB::raw("`up_votes_count` - `down_votes_count`"), 'desc')
            ->paginate(30);

        return view('comments', compact(['title', 'comments']));
    }

    public function index_week_bests() {
        $title = 'Best Comments Of Week';
        $comments = Comment::whereDate('created_at', '>' , now()->subWeek())
            ->withCount(['up_votes', 'down_votes'])
            ->orderBy(DB::raw("`up_votes_count` - `down_votes_count`"), 'desc')
            ->paginate(30);

        return view('comments', compact(['title', 'comments']));
    }

    public function store(Post $post, Request $request)
    {
        $comment_text = $request->comment;
        if(!$comment_text){
            return back()
                ->withErrors(['comment is null']);
        }

        $comment = new Comment;

        if($request->comment_image != null) {
            $request->validate([
                'comment_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $fileName = $request->user()->id.'_'.time().'.'.$request->comment_image->extension();
            $request->comment_image->move(public_path('uploads/comment_imgs/'), $fileName);

            $comment->image = $fileName;
        }

        $comment->comment = $comment_text;

        $comment->user()->associate($request->user());

//        $post = Post::find($request->post_id);

        $post->comments()->save($comment);

        return back();
    }

    public function replyStore(Comment $comment, Request $request)
    {
        $comment_text = $request->comment;
        if(!$comment_text){
            return back()
                ->withErrors(['comment is null']);
        }

        $reply = new Comment();

        if($request->comment_image != null) {
            $request->validate([
                'comment_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $fileName = $request->user()->id.'_'.time().'.'.$request->comment_image->extension();
            $request->comment_image->move(public_path('uploads/comment_imgs/'), $fileName);

            $reply->image = $fileName;
        }

        $reply->comment = $comment_text;

        $reply->user()->associate(auth()->user());

        $reply->parent_id = $comment->id;

        $post = Post::find($request->get('post_id'));

        $post->comments()->save($reply);

        return back();
    }

    public function delete(Comment $comment, Request $request) {
        if(auth()->user()->hasRole('admin'))
        {
            $comment->hide = $request->delete == 1;
            $comment->save();
            return back();
        }

        return back()
            ->withErrors('access denied');
    }

    public function voteComment(Comment $comment, Request $request) {
        if($comment->hide) {
            return response()->json([
                'success' => false,
            ]);
        }
        $comment_owner = $comment->user;
        $user = $request->user();
        if($comment_owner->id == $user->id) {
            return response()->json([
                'success' => false,
            ]);
        }

        $update = false;
        $is_upVote = $request['upVote'] === 'true';

        $vote = $comment->votes()->where('user_id', $user->id)->first();
        if ($vote) {
            $update = true;
            $already_like = $vote->up_vote;
            if ($already_like == $is_upVote) {
                return response()->json(['success' => false]);
            }
        } else {
            $vote = new Vote();
        }

        $vote->up_vote = $is_upVote;
        $vote->user_id = $user->id;
        $vote->comment_id = $comment->id;

        //change user karma

        if ($update) {
            $vote->update();
            if($is_upVote) {
                $comment_owner->karma += 2;
            } else {
                $comment_owner->karma -= 2;
            }
        } else {
            $vote->save();
            if($is_upVote) {
                $comment_owner->karma++;
            } else {
                $comment_owner->karma--;
            }
        }
        $comment_owner->update();


        $votes = $comment->votes;
        $upVoteCount = $votes->where('up_vote', true)->count();
        return response()->json([
            'success'=> true,
            'UpVoteCount' => $upVoteCount,
            'DownVoteCount' => $votes->count() - $upVoteCount,
        ]);
    }
}
