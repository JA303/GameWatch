<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Validator;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:user,admin')->except('index', 'show');
        $this->middleware('role:admin')->only('create', 'edit');
    }

    public function index(Request $request)
    {
        $games = Post::query();

        if($request->has('title') && $request->title != '') {
            $games->where('title', 'LIKE', "%{$request->title}%");
        }

        if($request->has('state') && $request->state != '') {
//            $games->where('state', $request->state);
            if($request->state == 'unreleased')
                $games->whereDate('release_date', '>=', Carbon::now());
            elseif ($request->state == 'uncracked')
                $games->whereNull('crack_date')->whereDate('release_date', '<', Carbon::now());
            elseif($request->state == 'cracked')
                $games->whereNotNull('crack_date')->whereDate('release_date', '<', Carbon::now());
        }

        if($request->has('filter') && $request->filter != '') {
            if($request->filter == 'date')
                $games->orderByDesc('release_date');
            elseif ($request->filter == 'followers')
                $games->withCount('followers')->orderByDesc('followers_count');
            elseif ($request->filter == 'comments')
                $games->withCount('comments')->orderByDesc('comments_count');
            else
                $games->orderByDesc('created_at');
        }

        $games = $games->paginate(40);

        return view('post.games', compact('games'));
    }

    public function create() {
        $post = null;
        return view('post.edit', compact(['post']));
    }

    public function edit(Post $post) {
        return view('post.edit', compact(['post']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'header' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'backimg' => 'required|image|mimes:jpeg,png,jpg|max:3000',
            'scr1' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'scr2' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'scr3' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'scr4' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'slug' => 'required|string|max:128|alpha_dash|unique:posts',
            'title' => 'required|string|max:128',
            'creator' => 'required|string|max:64',
            'r_date' => 'required|date',
            'c_date' => 'nullable|date',
            'steam_link' => 'string|max:64',
            'steam_p' => 'string|max:64',
            'epic_link' => 'string|max:64',
            'epic_p' => 'string|max:64',
            'v_link' => 'required|string|max:64',
            'm_os' => 'required|string|max:64',
            'm_cpu' => 'required|string|max:64',
            'm_ram' => 'required|string|max:64',
            'm_gpu' => 'required|string|max:64',
            'm_hdd' => 'required|string|max:64',
            'r_os' => 'required|string|max:64',
            'r_cpu' => 'required|string|max:64',
            'r_ram' => 'required|string|max:64',
            'r_gpu' => 'required|string|max:64',
            'r_hdd' => 'required|string|max:64',
            'dec' => 'required|string|max:2048',
        ]);

        $post = new Post();
        $post->slug = $request->slug;

        $fileName = $post->slug.'_image_'.time().'.'.$request->image->extension();
        $request->image->move(public_path('uploads/games/'), $fileName);
        $post->image = $fileName;

        $fileName = $post->slug.'_header_'.time().'.'.$request->header->extension();
        $request->header->move(public_path('uploads/games/'), $fileName);
        $post->header = $fileName;

        $fileName = $post->slug.'_backimg_'.time().'.'.$request->backimg->extension();
        $request->backimg->move(public_path('uploads/games/'), $fileName);
        $post->back_image = $fileName;

        $screen_shots = array(4);

        $fileName = $post->slug.'_scr1_'.time().'.'.$request->scr1->extension();
        $request->scr1->move(public_path('uploads/games/'), $fileName);
        $screen_shots[0] = $fileName;

        $fileName = $post->slug.'_scr2_'.time().'.'.$request->scr2->extension();
        $request->scr2->move(public_path('uploads/games/'), $fileName);
        $screen_shots[1] = $fileName;

        $fileName = $post->slug.'_scr3_'.time().'.'.$request->scr3->extension();
        $request->scr3->move(public_path('uploads/games/'), $fileName);
        $screen_shots[2] = $fileName;

        $fileName = $post->slug.'_scr4_'.time().'.'.$request->scr4->extension();
        $request->scr4->move(public_path('uploads/games/'), $fileName);
        $screen_shots[3] = $fileName;

        $post->screen_shots = $screen_shots;
        $post->title = $request->title;
        $post->game_studio_name = $request->creator;
        $post->release_date = $request->r_date;
        $post->crack_date = $request->c_date;
        $post->video_link = $request->v_link;
        $post->prices = ['epic' => ['price' => $request->epic_link ,'url' => $request->epic_p], 'steam' => ['price' => $request->steam_p ,'url' => $request->steam_link]];
        $post->system = [
            'min' => [
                'os' => $request->m_os,
                'cpu' => $request->m_cpu,
                'ram' => $request->m_ram,
                'gpu' => $request->m_gpu,
                'hdd' => $request->m_hdd,
            ],
            'rec' => [
                'os' => $request->r_os,
                'cpu' => $request->r_cpu,
                'ram' => $request->r_ram,
                'gpu' => $request->r_gpu,
                'hdd' => $request->r_hdd,
            ]
        ];
        $post->description = $request->dec;


        $user = Auth::user();

        $post->user_id = $user->id;

        $post->save();
//        $user->posts()->create($post);

        $user->karma += 10;
        $user->save();

        return back()
            ->with('success','You have successfully edit post.');

    }
    private function delete_image(string $filename)
    {
        $path = public_path('uploads/games/').$filename;
        if(File::exists($path))
            File::delete($path);
    }

    public function edit_store(Post $post, Request $request) {
        if($request->image) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);
        }
        if($request->header) {
            $request->validate([
                'header' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);
        }
        if($request->backimg) {
            $request->validate([
                'backimg' => 'required|image|mimes:jpeg,png,jpg|max:3000'
            ]);
        }
        if($request->src1) {
            $request->validate([
                'src1' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);
        }
        if($request->src2) {
            $request->validate([
                'src2' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);
        }
        if($request->src3) {
            $request->validate([
                'src3' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);
        }
        if($request->src4) {
            $request->validate([
                'src4' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);
        }
        if($request->slug != $post->slug) {
            $request->validate([
                'slug' => 'required|string|max:128|alpha_dash|unique:posts'
            ]);
            $post->slug = $request->slug;
        }

        $request->validate([
            'title' => 'required|string|max:128',
            'creator' => 'required|string|max:64',
            'r_date' => 'required|date',
            'c_date' => 'nullable|date',
            'steam_link' => 'required|string|max:512',
            'steam_p' => 'required|string|max:64',
            'epic_link' => 'required|string|max:512',
            'epic_p' => 'required|string|max:64',
            'v_link' => 'required|string|max:512',
            'm_os' => 'required|string|max:64',
            'm_cpu' => 'required|string|max:64',
            'm_ram' => 'required|string|max:64',
            'm_gpu' => 'required|string|max:64',
            'm_hdd' => 'required|string|max:64',
            'r_os' => 'required|string|max:64',
            'r_cpu' => 'required|string|max:64',
            'r_ram' => 'required|string|max:64',
            'r_gpu' => 'required|string|max:64',
            'r_hdd' => 'required|string|max:64',
            'dec' => 'required|string|max:2048',
        ]);

        if($request->image) {
            $fileName = $post->slug.'_image_'.time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/games/'), $fileName);
            $this->delete_image($post->image);
            $post->image = $fileName;
        }
        if($request->header) {
            $fileName = $post->slug.'_header_'.time().'.'.$request->header->extension();
            $request->header->move(public_path('uploads/games/'), $fileName);
            $this->delete_image($post->header);
            $post->header = $fileName;
        }
        if($request->backimg) {
            $fileName = $post->slug.'_backimg_'.time().'.'.$request->backimg->extension();
            $request->backimg->move(public_path('uploads/games/'), $fileName);
            $this->delete_image($post->back_image);
            $post->back_image = $fileName;
        }
        $screen_shots = $post->screen_shots;
        if($request->scr1) {
            $fileName = $post->slug.'_scr1_'.time().'.'.$request->scr1->extension();
            $request->scr1->move(public_path('uploads/games/'), $fileName);
            $this->delete_image($post->screen_shots[0]);
            $screen_shots[0] = $fileName;
        }
        if($request->scr2) {
            $fileName = $post->slug.'_scr2_'.time().'.'.$request->scr2->extension();
            $request->scr2->move(public_path('uploads/games/'), $fileName);
            $this->delete_image($post->screen_shots[1]);
            $screen_shots[1] = $fileName;
        }
        if($request->scr3) {
            $fileName = $post->slug.'_scr3_'.time().'.'.$request->scr3->extension();
            $request->scr3->move(public_path('uploads/games/'), $fileName);
            $this->delete_image($post->screen_shots[2]);
            $screen_shots[2] = $fileName;
        }
        if($request->scr4) {
            $fileName = $post->slug.'_scr4_'.time().'.'.$request->scr4->extension();
            $request->scr4->move(public_path('uploads/games/'), $fileName);
            $this->delete_image($post->screen_shots[3]);
            $screen_shots[3] = $fileName;
        }
        $post->screen_shots = $screen_shots;
        $post->title = $request->title;
        $post->game_studio_name = $request->creator;
        $post->release_date = $request->r_date;
        $post->crack_date = $request->c_date;
        $post->video_link = $request->v_link;
        $post->prices = ['epic' => ['price' => $request->epic_p ,'url' => $request->epic_link], 'steam' => ['price' => $request->steam_p ,'url' => $request->steam_link]];
        $post->system = [
            'min' => [
                'os' => $request->m_os,
                'cpu' => $request->m_cpu,
                'ram' => $request->m_ram,
                'gpu' => $request->m_gpu,
                'hdd' => $request->m_hdd,
                ],
            'rec' => [
                'os' => $request->r_os,
                'cpu' => $request->r_cpu,
                'ram' => $request->r_ram,
                'gpu' => $request->r_gpu,
                'hdd' => $request->r_hdd,
                ]
        ];
        $post->description = $request->dec;

        $post->save();

        return back()
            ->with('success','You have successfully edit post.');
    }

    public function show(Post $post) {
        $comments = $post->comments()->paginate(10);
        return view('post.game',compact('post', 'comments'));
    }

    public function delete(Post $post) {

    }

    public function follow(Post $post, Request $request) {
        $user = Auth::user();

        if($post->followBy($user)) {
            $post->followers()->detach($user);
            return response()->json([
                'success' => true,
                'follow' => false,
                'followers' => $post->followers()->count(),
            ]);
        } else {
            $post->followers()->attach($user);
            return response()->json([
                'success' => true,
                'follow' => true,
                'followers' => $post->followers()->count(),
            ]);
        }
    }
}
