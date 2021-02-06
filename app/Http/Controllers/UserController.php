<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index_ranking() {
        $users = User::query()->orderByDesc('karma')->take(50)->get();
        return view('ranking', compact(['users']));
    }
}
