@extends('layouts.app')

@section('content')
    <!-- External CSS -->
    <link rel="stylesheet" href="{{ asset('css/game.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <script>
        function readURL(input, formId, imgId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#' + imgId).attr('src', e.target.result);
                    $('#' + formId).show(500);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

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
            <span class=" py-1">Edit Profile</span>
        </div>
        <div class="title-text-holder row"></div>


    </div>


    <!-- Profile Pic -->
    <div class="container profile-container">
            <div class="row">
                    <div class="col-md-6">
                        <div class="row ">
                            <div class="col  d-flex flex-column align-items-center">
                                    <div class="row pt-4">
                                        <span class="follower-text">Edit Avatar Picture</span>
                                    </div>
                                    <div class="row pt-3">
                                        <img  class="profile-imager" style="width: 150px" src="{{{ asset('uploads/avatars/' . $user->avatar) }}}" alt="">
                                    </div>
                                @if($user->has_avatar())
                                    <br>
                                    <form action="{{ route('user.profile.edit.deleteAvatar', $user) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">Delete Avatar</button>
                                    </form>
                                @endif
                                <form action="{{ route('user.profile.edit.uploadAvatar', $user) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row pt-3">
                                        <label for="avater-file" class="btn btn-dark">Choose File</label>
                                        <input type="file" name="avatar" id="avater-file" onchange="readURL(this, 'avatar-prev', 'avatar-prev-img')" hidden>
                                    </div>
                                    <div class="row pt-3" id="avatar-prev" style="display: none">
                                        <img class="profile-imager" id="avatar-prev-img" style="width: 150px;" alt="">
                                        <input type="submit" class="btn btn-dark" value="Upload">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Cover Pic -->
                    <div class="col-md-6">
                        <div class="row ">

                            <div class="col  d-flex flex-column align-items-center">
                                <div class="row pt-4">
                                    <span class="follower-text">Edit Header Picture</span>
                                </div>
                                <div class="row pt-3">
                                    <img class="profile-imager" style="width: 290px" src="{{{ asset('uploads/gamer_headers/' . $user->header) }}}" alt="">
                                </div>
                                @if($user->has_header())
                                    <br>
                                    <form action="{{ route('user.profile.edit.deleteHeader', $user) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">Delete Header</button>
                                    </form>
                                @endif
                                <form action="{{ route('user.profile.edit.uploadHeader', $user) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row pt-3">
                                        <label for="header-file" class="btn btn-dark">Choose File</label>
                                        <input type="file" name="header" id="header-file" onchange="readURL(this, 'header-prev', 'header-prev-img')" hidden>

                                    </div>
                                    <div class="row pt-3" id="header-prev" style="display: none">
                                        <img class="profile-imager"  style="width: 290px;" id="header-prev-img" alt="">
                                        <input type="submit" class="btn btn-dark" value="Upload">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
        </div>

        <div class=" line p-3"></div>

        <!-- Specifications -->
{{--        <div class="form-group pt-2">--}}
{{--            <label class="white-text" for="usr ">Email Address</label>--}}
{{--            <input type="text" class="form-control input" id="usr" value="ahmaderfani12@gmail.com">--}}
{{--          </div>--}}
        <form action="{{ route('user.profile.edit.updateInfo', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
              <div class="form-group pt-2">
                <label class="white-text" for="usr ">Bio</label>
                  <textarea class="form-control input" name="description" id="usr" style="height: 150px;" maxlength="500">{{{ $user->description }}}</textarea>
              </div>
            <input type="submit" class="btn btn-dark" value="Save">
        </form>

        <br>
        @if($user == Auth::user())
            <br><br>
            <!-- Title -->
            <div class="title-holder container">
                <div class=" row">
                    <span class=" py-1">Change Password</span>
                </div>
                <div class="title-text-holder row"></div>
            </div>
        <form method="POST" action="{{ route('user.profile.edit.changePassword', $user) }}">
            @csrf
              <div class="form-group pt-2">
                <label class="white-text" for="old_password ">Current Password</label>
                <input name="old_password" type="password" class="form-control input" id="old_password">
              </div>
              <div class="form-group pt-2">
                <label  class="white-text" for="password ">New Password</label>
                <input name="password" type="password" class="form-control input" id="password">
              </div>
              <div class="form-group pt-2">
                <label class="white-text" for="password_confirmation ">Confirm New Password</label>
                <input name="password_confirmation" id="password-confirm" type="password" class="form-control input" id="usr">
              </div>
            <div class="form-group mt-4">
                <label for="captcha">beep BEEP! beep Beep?</label>
                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!}
                @error('g-recaptcha-response')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
              <!-- Buttons -->
              <div class="row pb-3">
             <div class="col d-flex flex-column align-items-center">
                <input type="submit" class="btn btn-dark" value="Change Password">
             </div>
    {{--         <div class="col-6 d-flex flex-column align-items-center">--}}
    {{--            <button class="btn btn-danger">Delete Account</button>--}}
    {{--         </div>--}}
            </div>
        </form>
        @endif
    </div>

@endsection
