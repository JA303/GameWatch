@extends('layouts.app')

@section('content')
<!-- Backgrounds Image - these css (image) needs to feed from server -->
<!-- External CSS -->
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<link rel="stylesheet" href="{{ asset('css/game.css') }}">
<link rel="stylesheet" href="{{ asset('css/gamer.css') }}">

<style>
 body{
        background-image: url("{{{ asset('img/gamer_backGround.jpg') }}}");
        background-color: rgba(17, 17, 17, 0.671);
        background-blend-mode:saturation;
        background-size: cover; 
        background-attachment: fixed;
        background-position: center;
    }
    .game-header-row{
        background-image: url("{{{ asset('uploads/gamer_headers/' . $user->header) }}}"), linear-gradient(rgba(5, 5, 5, 0.671),rgba(20, 20, 20, 0.808));
        background-blend-mode:saturation;
        background-repeat:no-repeat;
        background-position: center;
        background-size: cover;
    }
</style>

<div class=" container mt-5">
    <div class=" row no-gutters game-header-row header-border">
        <!-- Avatar -->
        <div class=" col-xl-3 col-md-3 justify-content-center " style="text-align: center">
            
            <img class="header-avatar-imagee my-3" src="{{ asset('uploads/avatars/' . $user->avatar) }}" alt="{{{ $user->name . ' avatar' }}}">
            @if($user->hasRole('admin'))
                <p class="text-danger display-4 pb-3">ADMIN</p>
            @endif
        </div>
        <!-- summery -->
        <div class="col-xl-6 col-md-9 p-3 white-text ">

            <p class="cracked-text pt-0">{{{ $user->name }}}</p>

            <div class="row  no-gutters">
                <div  class=" col-12 pt-3 ">
                    <p class="gray-text">DESCRIPTION</p>
                    <p class="date-text">{{{ $user->description }}}</p>
                    <p class="gray-text">JOINED</p>
                    <p class="date-text">{{ $user->created_at->format('F Y') }}</p>
                </div>

            </div>
        </div>
        <!-- Edit-Enable it for logined user -->
        <div class="col-xl-3 col-md-12 col-12 d-flex flex-column align-items-center align-self-center">
        <p class="white-text" >KARMA</p>
        <p class="white-text display-4" > <img class="pb-2 pr-2" src="{{{ asset('img/karma.svg') }}}" alt="">{{ $user->karma }}</p>
            @auth()
                <div class="row">
                @if($user == Auth::user())
                    <a href="{{ route('user.profile.edit', $user) }}">
                        <button class="btn follower-btn">EDIT</button><br>
                    </a>
                @elseif(Auth::user()->hasRole('admin'))
                    <a href="{{ route('user.profile.edit', $user) }}">
                        <button class="btn follower-btn">EDIT AS ADMIN</button><br>
                    </a>
                @endif
                </div>
                <div class="row">
                    @if($user == Auth::user() && Auth::user()->hasRole('admin'))
                        <a href="{{ route('games.create') }}">
                            <button class="btn follower-btn">ADD NEW GAME</button>
                        </a>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</div>
<!-- (Games | Comments)  Buttons -->
<div class=" container ">
    <div class=" row no-gutters">
        <div class=" col-6">
            <a href="{{ route('user.profile.games', $user) }}"><button class=" btn tab-buttons">Games</button></a>
        </div>
        <div class=" col-6">
            <a href="{{ route('user.profile.comments', $user) }}"><button class=" btn  tab-buttons">Comments</button></a>
        </div>

    </div>
</div>
@if($show == 'comments')
    <!-- Section Title -->
    <div class="title-holder container">
        <div class=" row">
            <!-- Title -->
            <span class=" py-1"> Comments</span>
        </div>
        <div class="title-text-holder row"></div>
    </div>

{{--    <div class="d-flex justify-content-center">--}}
{{--        {{ $comments->links('pagination::bootstrap-4') }}--}}
{{--    </div>--}}

    <!-- Comments -->
    <div class=" container">
        @foreach($comments as $comment)
            @include('post.partials.comment', ['comments' => $comment, 'level' => 0])
        @endforeach

            <div class="d-flex justify-content-center mt-4">
                {{ $comments->links('pagination::bootstrap-4') }}
            </div>
    </div>



@endif

@if($show == 'games')
    <!-- Section Title -->
    <div class="title-holder container">
        <div class=" row">
            <!-- Title -->
            <span class=" py-1"> Games</span>
        </div>
        <div class="title-text-holder row"></div>
    </div>

    <!-- Games Row -->

    <div class="container">

        <!-- You can add more rows -->
        <div class="row">
            @foreach($user->games as $game)
                @include('post.partials.game_col', ['game' => $game])
            @endforeach
        </div>

    </div>
@endif
@endsection
