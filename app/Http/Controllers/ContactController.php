<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;

class ContactController extends Controller
{
    //

    public function index() {
        return view('contact');
    }

    public function send_message(Request $request) {

        $request->validate([
            'name' => 'required|string|max:64',
            'surname' => 'required|string|max:64',
            'email' => 'required|email|max:128',
            'need' => 'required|string|max:128',
            'message' => 'required|string|max:1024',
        ]);

        $data = 'name: '.$request->name.'\n'
        .'last name: '.$request->surname.'\n'
        .'email: '.$request->email.'\n'
        .'need: '.$request->need.'\n'
        .'message: \n '.$request->message;

        try {
            Mail::raw($data, function($message) use($request) {
                $message->to('Contact@GamesWatch.ir')
                ->subject('Game Watch Contact Us Message')
                ->from($request->email);
            });
        } catch (\Exception $e) {
            return back()
        ->withErrors('Message Could Not Be Sent, Sorry :(');
        }
        

        return back()
        ->withSuccess('Your Message Has Been Sent, Thanks!');
    }
}
