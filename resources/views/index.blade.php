@extends('layouts.app')
{{--<link rel="stylesheet" href="{{ asset('css/icon.css') }}">--}}
@section('content')
    <!-- External CSS -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <!-- Section Title -->
    <div class="title-holder container">
        <div class=" row">
            <!-- Title -->
            <span class=" py-1">Hot Games</span>
        </div>
        <div class="title-text-holder row"></div>
    </div>

    <!-- Hot Games Container-->
    <div class="container">
        <div class="row ">
            <!-- Game 1-->
            <div class="col-lg-7 col-12     " >
                <div class="row">
                    <div class="game-container p-1">
                        <?php $have_post = count($hot_games) >= 1?>
                        <a href="@if($have_post){{ route('games.show', $hot_games[0]) }}@endif">
                            <div class="game-container-image">
                                    <img class="game-container-image" src="{{ asset('uploads/games/'.($have_post? $hot_games[0]->header : 'def.png')) }}" alt="">
                            </div>
                        </a>
                        <div class="game-container-Title "><h3>{{{ $have_post? $hot_games[0]->title : 'NONE' }}}</h3></div>
                        <div class="game-container-Description"><span>{{{ $have_post? $hot_games[0]->game_studio_name : 'NONE' }}}</span></div>
                        <div class="game-container-state game-container-state-xl <?php
                            if($have_post) {
                                $game = $hot_games[0];
                                if($game->state() == 'unreleased')
                                    echo "unreleased";
                                elseif($game->state() == 'uncracked')
                                    echo "uncracked";
                                else
                                    echo "released";
                            }?>">
                        </div>
                    </div>
                </div>
                <!-- Hot Games Live div - dont change it-->
                <div style="padding-left: 0.3em; padding-right: 0.25em; " class="row ">
                    <div style="background-color: rgba(0, 0, 0, 0.616); padding-bottom: 0.1em; color: cornsilk;" class="col-12   ">

                        <span class="dot"></span>
                        Hot Games Live Now

                    </div>

                </div>

            </div>
            <!-- Game 2-->
            <div class="col-lg-5 col-12  " >
                <div class="row">
                    <div class="col-lg-12 col-12 p-1" >
                        <div class="game-container">
                            <?php $have_post = count($hot_games) >= 2?>
                                <a href="@if($have_post){{ route('games.show', $hot_games[1]) }}@endif">
                                <div class="game-container-image">
                                    <img class="game-container-image" src="{{ asset('uploads/games/'.($have_post? $hot_games[1]->header : 'def.png')) }}" alt="">
                                </div>
                                </a>
                            <div class="game-container-Title"><h5>{{{ $have_post? $hot_games[1]->title : 'NONE' }}}</h5></div>
                            <div class="game-container-Description"><span>{{{ $have_post? $hot_games[1]->game_studio_name : 'NONE' }}}</span></div>
                            <div class="game-container-state <?php
                            if($have_post) {
                                $game = $hot_games[1];
                                if($game->state() == 'unreleased')
                                    echo "unreleased";
                                elseif($game->state() == 'uncracked')
                                    echo "uncracked";
                                else
                                    echo "released";
                            }?>">
                            </div>
                        </div>
                    </div>

                    <!-- Game 3-->
                </div>
                <div class="row">
                    <div class="col-lg-6 col-6   p-1" >
                        <div class="game-container">
                            <?php $have_post = count($hot_games) >= 3?>
                                <a href="@if($have_post){{ route('games.show', $hot_games[2]) }}@endif">
                                <div class="game-container-image">
                                    <img class="game-container-image" src="{{ asset('uploads/games/'.($have_post? $hot_games[2]->header : 'def.png')) }}" alt="">
                                </div>
                                </a>
                            <div class="game-container-Title"><h6>{{{ $have_post? $hot_games[2]->title : 'NONE' }}}</h6></div>
                            <div class="game-container-Description"><span>{{{ $have_post? $hot_games[2]->game_studio_name : 'NONE' }}}</span></div>
                            <div class="game-container-state <?php
                            if($have_post) {
                                $game = $hot_games[2];
                                if($game->state() == 'unreleased')
                                    echo "unreleased";
                                elseif($game->state() == 'uncracked')
                                    echo "uncracked";
                                else
                                    echo "released";
                            }?>">
                            </div>
                        </div>
                    </div>
                    <!-- Game 4-->
                    <div class="col-lg-6 col-6  p-1" >
                        <div class="game-container">
                            <?php $have_post = count($hot_games) >= 4?>
                                <a href="@if($have_post){{ route('games.show', $hot_games[3]) }}@endif">
                                <div class="game-container-image">
                                    <img class="game-container-image" src="{{ asset('uploads/games/'.($have_post? $hot_games[3]->header : 'def.png')) }}" alt="">
                                </div>
                                </a>
                            <div class="game-container-Title"><h6>{{{ $have_post? $hot_games[3]->title : 'NONE' }}}</h6></div>
                            <div class="game-container-Description"><span>{{{ $have_post? $hot_games[3]->game_studio_name : 'NONE' }}}</span></div>
                            <div class="game-container-state <?php
                            if($have_post) {
                                $game = $hot_games[3];
                                if($game->state() == 'unreleased')
                                    echo "unreleased";
                                elseif($game->state() == 'uncracked')
                                    echo "uncracked";
                                else
                                    echo "released";
                            }?>"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                            
    <!-- Ad-->       
    <a href="https://www.kinguin.net/category/64435/cyberpunk-2077-gog-cd-key"><div class=" container ad-container " 
    style="background-image: url(http://127.0.0.1:8000/img/ad.png );"></div>  </a>

    <!-- Section Title -->
    <div class="title-holder container">
        <div class=" row">
            <!-- Title -->
            <span class=" py-1">Best Games</span>
        </div>
        <div class="title-text-holder row"></div>
    </div>

    <!-- Games Row -->
    <div class="container">
        <!-- You can add more col in this row -->
        <div class="row">
            @foreach($most_followed_games as $game)
                @include('post.partials.game_col', ['game']);
            @endforeach
        </div>
    </div>

    @if(count($coming_soon_games) > 0)
        <!-- Section Title -->
        <div class="title-holder container">
            <div class=" row">
                <!-- Title -->
                <span class=" py-1">Coming Soon</span>
            </div>
            <div class="title-text-holder row"></div>
        </div>

        <!-- Games Row -->
        <div class="container">
            <!-- You can add more col in this row -->
            <div class="row">
                @foreach($coming_soon_games as $game)
                    @include('post.partials.game_col', ['game']);
                @endforeach
            </div>
        </div>
    @endif

    <!-- Section Title -->
    <div class="title-holder container">
        <div class=" row">
            <!-- Title -->
            <span class=" py-1">Best Comments Of Week</span>
        </div>
        <div class="title-text-holder row"></div>
    </div>
    <!-- Comments -->
    <div class=" container">
        <!-- Comment -->
        @foreach($best_weekly_comments as $comment)
            @include('post.partials.comment', [$comment , 'level' => 0])
        @endforeach

        <div class="d-flex justify-content-center mt-2 md-4">
            <a class="btn btn-dark" href="{{ route('comment.bestOfWeek') }}">Show more</a>
        </div>
    </div>

    <!-- Section Title -->
    <div class="title-holder container">
        <div class=" row">
            <!-- Title -->
            <span class=" py-1">Best Comments</span>
        </div>
        <div class="title-text-holder row"></div>
    </div>
    <!-- Comments of week -->
    <div class=" container">
        <!-- Comment -->
        @foreach($best_comments as $comment)
            @include('post.partials.comment', [$comment , 'level' => 0])
        @endforeach
        <div class="d-flex justify-content-center mt-2 md-4">
            <a class="btn btn-dark" href="{{ route('comment.bests') }}">Show more</a>
        </div>
    </div>
@endsection
