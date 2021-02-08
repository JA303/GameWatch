@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<!-- External CSS -->
<link rel="stylesheet" href="{{ asset('css/game.css') }}">

<script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
</script>

<!-- Backgrounds Image - these css (image) needs to feed from server -->
<style>
    body{
        background-image: url("{{ asset('uploads/games/'.$post->back_image) }}");
        background-color: rgba(17, 17, 17, 0.671);
        background-blend-mode:saturation;
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
    }
    .game-header-row{
        background-image: url("{{ asset('uploads/games/'.$post->header) }}"), linear-gradient(rgba(5, 5, 5, 0.671),rgba(20, 20, 20, 0.808));
        background-blend-mode:saturation;
        background-repeat:no-repeat;
        background-position: center;
        background-size: cover;

    }
</style>

<!-- Game main header -->
<div class=" container mt-5">
    <div class=" row no-gutters game-header-row ">
        <!-- vertical banner -->
        <div class=" col-xl-2 col-md-3">
            <img class="header-main-image" src="{{ asset('uploads/games/'.$post->image) }}" alt="">
        </div>
        <!-- summery -->
        <div class="col-xl-4 col-md-9 p-3 white-text ">
            <h3>{{{ $post->title }}}</h3>
            @if($post->state() == 'unreleased')
                <p class=" unreleased-text pt-0">UNRELEASED</p>
            @elseif($post->state() == 'uncracked')
                <p class=" uncracked-text pt-0">UNCRACKED</p>
            @else
                <p class=" cracked-text pt-0">CRACKED</p>
            @endif
            <div class="row  no-gutters">
                <div  class=" col-6 pt-3 ">
                    <p class="gray-text">RELEASE DATE</p>
                    <p class="date-text">{{ $post->release_date->format('M d, Y') }}</p>
                </div>
                <div class=" col-6 pt-3">
                    <p class="gray-text">CRACK DATE</p>
                    <p class="date-text">
                        @if($post->crack_date != null)
                            {{ $post->crack_date->format('M d, Y') }}
                        @endif
                    </p>
                </div>

            </div>
            <div class="row">
                <div class="col studio-text-holder">
                    <span class="Studio-text studio-name-text"> {{{ $post->game_studio_name }}} </span>
                </div>

            </div>
        </div>
        <!-- stores -->
        <div class=" col-xl-3 col-md-6 col-12">
            <div class="row d-flex justify-content-center ">
                <span class="store-text pt-2 pb-2 store-main-text">Get it from</span>
            </div>
            <div class="row ">
                <div class="col">
                    <div class="row d-flex justify-content-center">
                        <img class="store-image" src="{{ asset('img/Steam.png') }}" alt="Steam icon">
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col">
                    <div class="row d-flex justify-content-center">
                        <!-- Steam buy -->
                        <a href="{{ $post->prices['steam']['url'] }}" target="_blank"><button class="btn  store-btn">{{ $post->prices['steam']['price'] }}</button></a>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col">
                    <div class="row d-flex justify-content-center">
                        <img class="store-image" src="{{ asset('img/EpicGames.png') }}" alt="Epic Games icon">
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col">
                    <!-- Epic Store buy -->
                    <div class="row d-flex justify-content-center">
                        <a href="{{ $post->prices['epic']['url'] }}" target="_blank"><button class="btn store-btn">{{ $post->prices['epic']['price'] }}</button></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Followers -->
        <div class="col-xl-3 col-md-6 col-12">
            <div class="row pt-5">
                <div class="col  d-flex flex-column align-items-center">
                    <div class="row ">
                        <span class="follower-text">FOLLOWERS</span>
                    </div>
                    <div class="row ">
                        <span id="game-followers-count" class="follower-num-text">{{ $post->followers()->count() }}</span>
                    </div>
                    <div class="row ">
                        @auth()
                            <button id="game-followers-button" class="btn follower-btn" onclick="followAJAX('{{ route('games.follow', $post) }}')">
                                @if($post->followBy(auth()->user()))
                                    UNFOLLOW
                                @else
                                    FOLLOW
                                @endif
                            </button>
                        @else
                            <a class="btn follower-btn" href="{{ route('login') }}">FOLLOW</a>
                        @endauth
                    </div>
                    <div class="row">
                        @auth()
                            @if(Auth::user()->hasRole('admin'))
                                <a href="{{ route('games.edit', $post) }}">
                                    <button class="btn follower-btn">EDIT</button>
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Trailer and screenShots -->
<div class=" container mt-5">
    <div  class="row no-gutters">
        <div class="col-xl-6 col-12 ">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{{ $post->video_link }}}"></iframe>
            </div>
        </div>
        <div class="col-xl-6 col-12 bg-white">
            <div class="row no-gutters">
                <div class="col-6 ">
                    <a href="{{ asset('uploads/games/'.$post->screen_shots[0]) }}" data-toggle="lightbox" data-gallery="example-gallery" >
                        <img src="{{ asset('uploads/games/'.$post->screen_shots[0]) }}" class="screen-shots">
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ asset('uploads/games/'.$post->screen_shots[1]) }}" data-toggle="lightbox" data-gallery="example-gallery" >
                        <img src="{{ asset('uploads/games/'.$post->screen_shots[1]) }}" class="screen-shots">
                    </a>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-6 ">
                    <a href="{{ asset('uploads/games/'.$post->screen_shots[2]) }}" data-toggle="lightbox" data-gallery="example-gallery" >
                        <img src="{{ asset('uploads/games/'.$post->screen_shots[2]) }}" class="screen-shots">
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ asset('uploads/games/'.$post->screen_shots[3]) }}" data-toggle="lightbox" data-gallery="example-gallery" >
                        <img src="{{ asset('uploads/games/'.$post->screen_shots[3]) }}" class="screen-shots">
                    </a>
                </div>
            </div>


        </div>
    </div>
</div>
<!-- About Game -->
<div class="title-holder container">
    <div class=" row">
        <!-- Title -->
        <span class=" py-1">About The Game</span>
    </div>
    <div class="title-text-holder row"></div>
</div>
<div id="module" class="container  ">
    <div class="row no-gutters p-2">

        <p class="collapse white-text" id="collapseExample" aria-expanded="false">
            <?php
                foreach(preg_split("/((\r?\n)|(\r\n?))/", $post->description) as $line) {
                    echo $line."<br>";
                }
            ?>
        </p>

        <a role="button" class="collapsed" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"></a>
    </div>
</div>
<!-- Requirements -->
<div class=" container mt-3 ">
    <div class="row">
        <div class=" col-md-6 table-black pb-2">
            <h6 class="white-text pt-3">Minimum Requirements</h6>
                <table class="table-sm  ">

                    <tbody>
                    <tr>
                        <td class="gray-text">OS</td>
                        <td class="text-white">{{ $post->system['min']['os'] }}</td>
                    </tr>
                    <tr>
                        <td class="gray-text">CPU</td>
                        <td class="text-white">{{ $post->system['min']['cpu'] }}</td>
                    </tr>
                    <tr>
                        <td class="gray-text">RAM</td>
                        <td class="text-white">{{ $post->system['min']['ram'] }}</td>
                    </tr>
                    <tr>
                        <td class="gray-text">GPU</td>
                        <td class="text-white">{{ $post->system['min']['gpu'] }}</td>
                    </tr>
                    <tr>
                        <td class="gray-text">HDD</td>
                        <td class="text-white">{{ $post->system['min']['hdd'] }}</td>
                    </tr>

                    </tbody>
                </table>
        </div>
        <div class=" col-md-6 table-black pb-2">
            <h6 class="white-text pt-3">Recommended Requirements</h6>
                <table class="table-sm">

                    <tbody>
                    <tr>
                        <td class="gray-text">OS</td>
                        <td class="text-white">{{ $post->system['rec']['os'] }}</td>
                    </tr>
                    <tr>
                        <td class="gray-text">CPU</td>
                        <td class="text-white">{{ $post->system['rec']['cpu'] }}</td>
                    </tr>
                    <tr>
                        <td class="gray-text">RAM</td>
                        <td class="text-white">{{ $post->system['rec']['ram'] }}</td>
                    </tr>
                    <tr>
                        <td class="gray-text">GPU</td>
                        <td class="text-white">{{ $post->system['rec']['gpu'] }}</td>
                    </tr>
                    <tr>
                        <td class="gray-text">HDD</td>
                        <td class="text-white">{{ $post->system['rec']['hdd'] }}</td>
                    </tr>

                    </tbody>
                </table>
        </div>
    </div>
</div>

<div class="title-holder container">
    <div class=" row">
        <!-- Title -->
        <span class=" py-1">Comments</span>
    </div>
    <div class="title-text-holder row"></div>
</div>

<!-- Comments -->
<div class=" container">
    <div class="container">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <!-- Reply  -->
    <form method="post" action="{{ route('comment.add', $post) }}" enctype="multipart/form-data">
        @csrf
    <div  class="row pt-1">
        <!-- Main Reply Text -->
            <div  class="col-lg-11 col-10 ">
                <div class="reply-text-area-holder">
                    <textarea name="comment" class="reply-text-area shadow" rows="3" placeholder="Your comment..."></textarea>
                </div>
            </div>

            <div style="background-color:#161618;" class="col-lg-1 col-2 ">
                <div class="row reply-button-row  ">
                    <label id="comment-image-label" for="comment-image" class="btn btn-reply">Image</label>
                    <input type="file" name="comment_image" id="comment-image" onchange="$('#comment-image-label').css('background-color', 'green')" hidden>
                </div>
                <div class="row reply-button-row   ">
                    <button type="submit" class="btn btn-reply">Send</button>

                </div>
            </div>
    </div>
    </form>

    <!-- Comment -->
        @include('post.partials.replies', ['comments' => $comments, 'post' => $post, 'level' => 0])

    <div class="d-flex justify-content-center mt-4">
        <div class="mt-3">
            {{ $comments->links('pagination::bootstrap-4') }}
        </div>
    </div>

</div>
<br><br>
@endsection
