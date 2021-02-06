@extends('layouts.app')

@section('content')
<!-- External CSS -->
<link rel="stylesheet" href="{{ asset('css/game.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/gameEditor.css') }}">

<!-- External JS -->
<script>
    function readURL(input, imgId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#' + imgId).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?php
    $edit = $post != null;
?>

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

<!-- Title -->
<div class="title-holder container">
    <div class=" row">
        <span class=" py-1">@if(!$edit) Add @else Edit Game @endif</span>
    </div>
    <div class="title-text-holder row"></div>
</div>

@if(!$edit)
    <form action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data">
@else
    <form action="{{ route('games.edit.store', $post) }}" method="POST" enctype="multipart/form-data">
@endif
        @csrf
<div class=" container profile-container">
    <div class="row">
        <!-- Vertical Banner -->
        <div class="col-md-4">
            <div class="row ">
                <div class="col  d-flex flex-column align-items-center">
                    <div class="row pt-4">
                        <span class="follower-text">Vertical Banner</span>
                    </div>
                    <div class="row pt-3">
                        <img id="image-prev" class="profile-imager" @if($edit) src="{{asset('uploads/games/'.$post->image)}}" @endif alt="">
                    </div>
                    <div class="row pt-3">
                        <label for="image" class="btn btn-dark">Upload</label>
                        <input type="file" name="image" id="image" onchange="readURL(this, 'image-prev')" hidden>
                    </div>
                </div>
            </div>
        </div>
        <!-- Horizontal Banner -->
        <div class="col-md-4">
            <div class="row ">
                <div class="col  d-flex flex-column align-items-center">
                    <div class="row pt-4">
                        <span class="follower-text">Horizontal Banner</span>
                    </div>
                    <div class="row pt-3">
                        <img id="header-prev" class="profile-imager" @if($edit) src="{{asset('uploads/games/'.$post->header)}}" @endif alt="">
                    </div>
                    <div class="row pt-3">
                        <label for="header" class="btn btn-dark">Upload</label>
                        <input type="file" name="header" id="header" onchange="readURL(this, 'header-prev')" hidden>
                    </div>
                </div>
            </div>
        </div>
        <!-- Blur Background -->
        <div class="col-md-4">
            <div class="row ">
                <div class="col  d-flex flex-column align-items-center">
                    <div class="row pt-4">
                        <span class="follower-text">Blur Background</span>
                    </div>
                    <div class="row pt-3">
                        <img id="backimage-prev" class="profile-imager" @if($edit) src="{{asset('uploads/games/'.$post->back_image)}}" @endif alt="">
                    </div>
                    <div class="row pt-3">
                        <label for="backimage" class="btn btn-dark">Upload</label>
                        <input type="file" name="backimg" id="backimage" onchange="readURL(this, 'backimage-prev')" hidden>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Screen Shots -->
    <div class="row">
        <div class=" col-6">
            <div class="row ">
                <div class="col  d-flex flex-column align-items-center">
                    <div class="row pt-4">
                        <span class="follower-text">ScreenShot 1</span>
                    </div>
                    <div class="row pt-3">
                        <img id="scr1-prev" class="profile-imager" @if($edit) src="{{asset('uploads/games/'.$post->screen_shots[0])}}" @endif alt="">
                    </div>
                    <div class="row pt-3">
                        <label for="scr1" class="btn btn-dark">Upload</label>
                        <input type="file" name="scr1" id="scr1" onchange="readURL(this, 'scr1-prev')" hidden>
                    </div>
                </div>
            </div>
        </div>
        <div class=" col-6">
            <div class="row ">
                <div class="col  d-flex flex-column align-items-center">
                    <div class="row pt-4">
                        <span class="follower-text">ScreenShot 2</span>
                    </div>
                    <div class="row pt-3">
                        <img id="scr2-prev" class="profile-imager" @if($edit) src="{{asset('uploads/games/'.$post->screen_shots[1])}}" @endif alt="">
                    </div>
                    <div class="row pt-3">
                        <label for="scr2" class="btn btn-dark">Upload</label>
                        <input type="file" name="scr2" id="scr2" onchange="readURL(this, 'scr2-prev')" hidden>
                    </div>
                </div>
            </div>
        </div>
        <div class=" col-6">
            <div class="row ">
                <div class="col  d-flex flex-column align-items-center">
                    <div class="row pt-4">
                        <span class="follower-text">ScreenShot 3</span>
                    </div>
                    <div class="row pt-3">
                        <img id="scr3-prev" class="profile-imager" @if($edit) src="{{asset('uploads/games/'.$post->screen_shots[2])}}" @endif alt="">
                    </div>
                    <div class="row pt-3">
                        <label for="scr3" class="btn btn-dark">Upload</label>
                        <input type="file" name="scr3" id="scr3" onchange="readURL(this, 'scr3-prev')" hidden>
                    </div>
                </div>
            </div>
        </div>
        <div class=" col-6">
            <div class="row ">
                <div class="col  d-flex flex-column align-items-center">
                    <div class="row pt-4">
                        <span class="follower-text">ScreenShot 4</span>
                    </div>
                    <div class="row pt-3">
                        <img id="scr4-prev" class="profile-imager" @if($edit) src="{{asset('uploads/games/'.$post->screen_shots[3])}}" @endif alt="">
                    </div>
                    <div class="row pt-3">
                        <label for="scr4" class="btn btn-dark">Upload</label>
                        <input type="file" name="scr4" id="scr4" onchange="readURL(this, 'scr4-prev')" hidden>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class=" line p-3"></div>

    <!-- Specifications -->
    <div class=" row">
        <div class="col-12">
            <div class="form-group pt-2">
                <label class="white-text" for="usr ">Slug</label>
                <input name="slug" type="text" class="form-control input" id="usr" @if($edit) value="{{$post->slug}}" @endif>
            </div>
        </div>
    </div>
    <div class=" row">
        <div class="col-6">
            <div class="form-group pt-2">
                <label class="white-text" for="usr ">Game Name</label>
                <input name="title" type="text" class="form-control input" id="usr" @if($edit) value="{{$post->title}}" @endif>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group pt-2">
                <label class="white-text" for="usr ">Creator</label>
                <input name="creator" type="text" class="form-control input" id="usr" @if($edit) value="{{$post->game_studio_name}}" @endif>
            </div>
        </div>
    </div>

    <div class=" row">
        <div class="col-6">
            <div class="form-group pt-2">
                <label class="white-text" for="usr ">RELEASE DATE</label>
                <input name="r_date" id="date-release" type="text" class="form-control input" @if($edit) value="{{$post->release_date->format('F d, Y')}}" @endif >
            </div>
            <div class="row pl-3">
                <div class="col4 pr-1">
                    <div class="dropdown status-dropDown">
                        <button  class="btn  dropdown-toggle status-dropDown-button bg-dark white-text" type="button" id="dropdown-month-release" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Jan
                        </button>
                        <div class="dropdown-menu scrollable-menu" >
                            <a class="dropdown-item " onclick="SetReleaseMonth(this)">Jan</a>
                            <a class="dropdown-item " onclick="SetReleaseMonth(this)" >Mar</a>
                            <a class="dropdown-item " onclick="SetReleaseMonth(this)">May</a>
                            <a class="dropdown-item " onclick="SetReleaseMonth(this)">Jul</a>
                            <a class="dropdown-item " onclick="SetReleaseMonth(this)">Sep</a>
                            <a class="dropdown-item " onclick="SetReleaseMonth(this)">Nov</a>
                            <a class="dropdown-item " onclick="SetReleaseMonth(this)">Feb</a>
                            <a class="dropdown-item " onclick="SetReleaseMonth(this)">Apr</a>
                            <a class="dropdown-item " onclick="SetReleaseMonth(this)">Jun</a>
                            <a class="dropdown-item " onclick="SetReleaseMonth(this)">Aug</a>
                            <a class="dropdown-item " onclick="SetReleaseMonth(this)">Oct</a>
                            <a class="dropdown-item " onclick="SetReleaseMonth(this)">Dec</a>
                        </div>
                    </div>
                </div>
                <div class="col4 pr-1">
                    <div class="dropdown status-dropDown">
                        <button  class="btn  dropdown-toggle status-dropDown-button bg-dark white-text" type="button" id="dropdown-day-release" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            01
                        </button>
                        <div class="dropdown-menu scrollable-menu"  id="day-drops-r">
                        </div>
                    </div>
                </div>
                <div class="col4 pr-1">
                    <div class="dropdown status-dropDown">
                        <button  class="btn  dropdown-toggle status-dropDown-button bg-dark white-text" type="button" id="dropdown-year-release" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            2020
                        </button>
                        <div class="dropdown-menu scrollable-menu"  id="year-drops-r">
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-6">
            <div class="form-group pt-2">
                <label class="white-text" for="usr ">CRACK DATE</label>
                <input name="c_date" id="date-crack" type="text" class="form-control input" @if($edit && $post->crack_date) value="{{$post->crack_date->format('F d, Y')}}" @endif >
            </div>
            <div class="row pl-3">
                <div class="col4 pr-1">
                    <div class="dropdown status-dropDown">
                        <button  class="btn  dropdown-toggle status-dropDown-button bg-dark white-text" type="button" id="dropdown-month-crack" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Jan
                        </button>
                        <div class="dropdown-menu scrollable-menu" >
                            <a class="dropdown-item " onclick="SetCrackMonth(this)">Jan</a>
                            <a class="dropdown-item " onclick="SetCrackMonth(this)">Mar</a>
                            <a class="dropdown-item " onclick="SetCrackMonth(this)">May</a>
                            <a class="dropdown-item " onclick="SetCrackMonth(this)">Jul</a>
                            <a class="dropdown-item " onclick="SetCrackMonth(this)">Sep</a>
                            <a class="dropdown-item " onclick="SetCrackMonth(this)">Nov</a>
                            <a class="dropdown-item " onclick="SetCrackMonth(this)">Feb</a>
                            <a class="dropdown-item " onclick="SetCrackMonth(this)">Apr</a>
                            <a class="dropdown-item " onclick="SetCrackMonth(this)">Jun</a>
                            <a class="dropdown-item " onclick="SetCrackMonth(this)">Aug</a>
                            <a class="dropdown-item " onclick="SetCrackMonth(this)">Oct</a>
                            <a class="dropdown-item " onclick="SetCrackMonth(this)">Dec</a>
                        </div>
                    </div>
                </div>
                <div class="col4 pr-1">
                    <div class="dropdown status-dropDown">
                        <button  class="btn  dropdown-toggle status-dropDown-button bg-dark white-text" type="button" id="dropdown-day-crack" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            01
                        </button>
                        <div class="dropdown-menu scrollable-menu"  id="day-drops-c">
                        </div>
                    </div>
                </div>
                <div class="col4 pr-1">
                    <div class="dropdown status-dropDown">
                        <button  class="btn  dropdown-toggle status-dropDown-button bg-dark white-text" type="button" id="dropdown-year-crack" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            2020
                        </button>
                        <div class="dropdown-menu scrollable-menu"  id="year-drops-c">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=" row">
        <div class="col-6">
            <div class="form-group pt-2">
                <label class="white-text" for="usr ">Steam Link</label>
                <input name="steam_link" type="text" class="form-control input" id="usr" @if($edit) value="{{$post->prices['epic']['url']}}" @else value="https://epicgames.com/" @endif >
            </div>
        </div>
        <div class="col-6">
            <div class="form-group pt-2">
                <label class="white-text" for="usr ">Steam Price</label>
                <input name="steam_p" type="text" class="form-control input" id="usr" @if($edit) value="{{$post->prices['epic']['price']}}" @else value="59.99$" @endif >
            </div>
        </div>
    </div>
    <div class=" row">
        <div class="col-6">
            <div class="form-group pt-2">
                <label class="white-text" for="usr ">Epic Link</label>
                <input name="epic_link" type="text" class="form-control input" id="usr" @if($edit) value="{{$post->prices['steam']['url']}}" @else value="https://store.steampowered.com/" @endif >
            </div>
        </div>
        <div class="col-6">
            <div class="form-group pt-2">
                <label class="white-text" for="usr ">Epic Price</label>
                <input name="epic_p" type="text" class="form-control input" id="usr" @if($edit) value="{{$post->prices['steam']['price']}}" @else value="59.99$" @endif >
            </div>
        </div>
    </div>
    <div class="form-group pt-2">
        <label class="white-text" for="usr ">Youtube link</label>
        <input name="v_link" type="text" class="form-control input" id="usr" @if($edit) value="{{$post->video_link}}" @else value="https://www.youtube.com/" @endif>
    </div>

    <!-- Requirements -->
    <div class="row pt-4">
        <div class="col-6 white-text">
            <h5>Minimum Requirements</h5>
            <div class="form-group pt-2">
                <label class="white-text" for="usr ">OS</label>
                <input name="m_os" type="text" class="form-control input" id="usr" @if($edit) value="{{$post->system['min']['os']}}" @else value="Windows 7" @endif >
            </div>
            <div class="form-group pt-2">
                <label class="white-text" for="usr ">CPU</label>
                <input name="m_cpu" type="text" class="form-control input" id="usr" @if($edit) value="{{$post->system['min']['cpu']}}" @else value="Intel Core i5-2500K / AMD FX-6300" @endif >
            </div>
            <div class="form-group pt-2">
                <label class="white-text" for="usr ">Ram</label>
                <input name="m_ram" type="text" class="form-control input" id="usr" @if($edit) value="{{$post->system['min']['ram']}}" @else value="8 GB" @endif >
            </div>
            <div class="form-group pt-2">
                <label class="white-text" for="usr ">GPU</label>
                <input name="m_gpu" type="text" class="form-control input" id="usr" @if($edit) value="{{$post->system['min']['gpu']}}" @else value="Nvidia GeForce GTX 770 2 Go / AMD Radeon R9 280 3 Go" @endif >
            </div>
            <div class="form-group pt-2">
                <label class="white-text" for="usr ">HDD</label>
                <input name="m_hdd" type="text" class="form-control input" id="usr" @if($edit) value="{{$post->system['min']['hdd']}}" @else value="150 GB" @endif >
            </div>
        </div>
        <div class="col-6 white-text">
            <h5>Recommended Requirements</h5>
            <div class="form-group pt-2">
                <label class="white-text" for="usr ">OS</label>
                <input name="r_os" type="text" class="form-control input" id="usr" @if($edit) value="{{$post->system['rec']['os']}}" @else value="Windows 10 (v1803)" @endif >
            </div>
            <div class="form-group pt-2">
                <label class="white-text" for="usr ">CPU</label>
                <input name="r_cpu" type="text" class="form-control input" id="usr" @if($edit) value="{{$post->system['rec']['cpu']}}" @else value="Intel Core i7-4770K / AMD Ryzen 5 1500X" @endif >
            </div>
            <div class="form-group pt-2">
                <label class="white-text" for="usr ">Ram</label>
                <input name="r_ram" type="text" class="form-control input" id="usr" @if($edit) value="{{$post->system['rec']['ram']}}" @else value="12 GB" @endif >
            </div>
            <div class="form-group pt-2">
                <label class="white-text" for="usr ">GPU</label>
                <input name="r_gpu" type="text" class="form-control input" id="usr" @if($edit) value="{{$post->system['rec']['gpu']}}" @else value="Nvidia GeForce GTX 1060 6 Go / AMD Radeon RX 480 4Go" @endif >
            </div>
            <div class="form-group pt-2">
                <label class="white-text" for="usr ">HDD</label>
                <input name="r_hdd" type="text" class="form-control input" id="usr" @if($edit) value="{{$post->system['rec']['hdd']}}" @else value="150 GB" @endif >
            </div>
        </div>
    </div>

    <div  class="row pt-2 pb-3">

        <!-- About Game -->
        <div  class="col-12 ">
            <div class="reply-text-area-holder">
                <textarea name="dec" class="reply-text-area shadow" rows="10" placeholder="About The Game...">@if($edit){{$post->description}}@else{{'NO DESCRIPTION'}}@endif</textarea>
            </div>
        </div>


    </div>
    <!-- Buttons -->
    <div class="row pb-5">
        @if($edit)
            <div class="col-6 d-flex flex-column align-items-center">
                <button type="submit" class="btn btn-dark">Save</button>
            </div>
            <div class="col-6 d-flex flex-column align-items-center">
                <script type="text/javascript">
                    function confirmDeleteGame() {
                        if (confirm('Do you want to Delete Game? (Warning!)')) {
                            document.getElementById('delete-game').submit();
                        } else {
                            return false;
                        }
                    }
                </script>
                <a class="btn btn-danger text-white" onclick="confirmDeleteGame()">Delete Game</a>
            </div>
        @else
            <div class="col d-flex flex-column align-items-center">
                <button type="submit" class="btn btn-dark">Save</button>
            </div>
        @endif
    </div>
</div>
    </form>
        @if($edit)
            <form id="delete-game" method="POST" action="{{ route('games.edit.delete', $post) }}">
                @csrf
            </form>
        @endif
            <script src="{{ asset('js/gameEditor.js') }} "></script>

@endsection
