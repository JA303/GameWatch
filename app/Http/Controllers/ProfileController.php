<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use phpDocumentor\Reflection\Types\Boolean;
use Validator;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:user,admin')->except(['index', 'index_games', 'index_comments']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user) {
        $show = '';
        return view('home', compact(['user', 'show']));
    }
    public function index_games(User $user) {
        $show = 'games';
        return view('home', compact(['user', 'show']));
    }
    public function index_comments(User $user) {
        $show = 'comments';
        $comments = $user->comments()->paginate(20);
        return view('home', compact(['user', 'show', 'comments']));
    }

    public function index_edit(User $user) {
        if(!($user == Auth::user() || Auth::user()->hasRole('admin')))
            return back()->withErrors(['access denied']);

        return view('profile.edit', compact('user'));
    }

    public function update_info(User $user, Request $request) {
        if(!($user == Auth::user() || Auth::user()->hasRole('admin')))
            return back()->withErrors(['access denied']);

        $user->description = $request->description;
        $user->save();

        return back()
            ->with('success','You have successfully Update info.');
    }

    public function change_password(User $user, Request $request) {
        if(Auth::user() != $user) {
            return back()->withErrors(['access denied']);
        }

        if(!Hash::check($request->old_password, auth()->user()->password))
            return back()->withErrors(['Incorrect old password']);

        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'g-recaptcha-response' => 'required|captcha',
        ]);

        $user->update(['password' => Hash::make($request->password)]);

        return back()
            ->with('success','You have successfully Change Password.');
    }

    //avatar
    private function delete_avatar_file(User $user)
    {
        if(File::exists(public_path('uploads/avatars/').$user->avatar )){
            File::delete(public_path('uploads/avatars/') . $user->avatar );
        } else {
            return back()
                ->withErrors(['msg', 'avatar does not exists']);
        }
    }

    public  function delete_avatar(User $user, Request $request){
        if(!($user == Auth::user() || Auth::user()->hasRole('admin')))
            return  back()->withErrors(['err' => 'access denied']);

        if(!$user->has_avatar()){
            return back()
                ->withErrors(['User does not have an avatar']);
        }

        $this->delete_avatar_file($user);

        $user->avatar = 'user.jpg';
        $user->save();

        return back()
            ->with('success','You have successfully Delete image.');
    }

    public function update_avatar(User $user, Request $request){
        if(!($user == Auth::user() || Auth::user()->hasRole('admin')))
            return  back()->withErrors(['err' => 'access denied']);

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:512'
        ]);

        if($user->has_avatar()){
            $this->delete_avatar_file($user);
        }

        $fileName = $user->id.'_avatar_'.time().'.'.$request->avatar->extension();
        $request->avatar->move(public_path('uploads/avatars/'), $fileName);

        $user->avatar = $fileName;
        $user->save();

        return back()
            ->with('success','You have successfully upload image.');
    }

    //header
    private function delete_header_file(User $user)
    {
        if(File::exists(public_path('uploads/gamer_headers/').$user->header )){
            File::delete(public_path('uploads/gamer_headers/') . $user->header );
        } else {
            return back()
                ->withErrors(['header does not exists']);
        }
    }

    public  function delete_header(User $user, Request $request){
        if(!($user == Auth::user() || Auth::user()->hasRole('admin')))
            return  back()->withErrors(['err' => 'access denied']);

        if(!$user->has_header()){
            return back()
                ->withErrors(['User does not have an header']);
        }

        $this->delete_header_file($user);

        $user->header = 'gamer_header.jpg';
        $user->save();

        return back()
            ->with('success','You have successfully Delete image.');
    }

    public function update_header(User $user, Request $request){
        if(!($user == Auth::user() || Auth::user()->hasRole('admin')))
            return  back()->withErrors(['err' => 'access denied']);

        $request->validate([
            'header' => 'required|image|mimes:jpeg,png,jpg|max:1024'
        ]);


        if($user->has_header()){
            $this->delete_header_file($user);
        }

        $fileName = $user->id.'_header_'.time().'.'.$request->header->extension();
        $request->header->move(public_path('uploads/gamer_headers/'), $fileName);

        $user->header = $fileName;
        $user->save();

        return back()
            ->with('success','You have successfully upload image.');
    }
}
