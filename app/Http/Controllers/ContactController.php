<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;
use App\Mail\ContactEmail;

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

        // $data = '<h3>name: '.$request->name.'</h3><br>'
        // .'<h3>last name: '.$request->surname.'</h3><br>'
        // .'<h3>email: '.$request->email.'</h3><br>'
        // .'<h3>need: '.$request->need.'</h3><br>'
        // .'<h4>message:</h4><br><p> '.$request->message.'</p>';

        $data = ['message' => $request->message, 'surname' => $request->surname, 'email' => $request->email, 'need' => $request->need, 'name' => $request->name];

        Mail::to('Contact@GamesWatch.ir')->send(new ContactEmail($data));
        
            // Mail::raw($data, function($message) use($request) {
            //     $message->to('Contact@GamesWatch.ir')
            //     ->subject('Game Watch Contact Us Message')
            //     ->from($request->email);
            // });
        
        return back()
            ->withSuccess('Your Message Has Been Sent, Thanks!');
    }
}
