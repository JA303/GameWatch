@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <!-- Section Title -->
    <div class="title-holder container">
        <div class="row">
            <!-- Title -->
            <span class=" py-1">BEST USERS</span>
        </div>
        <div class="row">

        </div>
        <div class="title-text-holder row"></div>
        <p class="py-1">You can get karma by get up votes</p>
    </div>
    <!-- Users -->
    <div class="container">
        <div class="row bg-dark align-middle" style="height: 50px;">
            <div class="col" style="flex: 0 0 75px;">

            </div>
            <div class="col-6">
                <h5 class="text-success">USER NAME</h5>
            </div>
            <div class="col">
                <h5 class="text-warning">KARMA</h5>
            </div>
        </div>
        <?php $rank = 1 ?>
        @foreach($users as $user)
            <div class="row bg-dark" style="height: 40px; margin: 50px 0;">
                <div class="col" style="flex: 0 0 75px;">
                    <img  class="no-padding-col rounded-circle commet-row-avatar" style="position: relative; top: -25%; display: inline" src="{{ asset('uploads/avatars/'.$user->avatar) }}">
                    <div style="width: 25px; height: 25px; position: absolute; top: 30px; text-align: center" class="rounded-circle bg-light font-weight-bold" >
{{--                        <h4 class="text-danger" style="display: inline">{{ $rank++ }}</h4>--}}
                        {{ $rank++ }}
                    </div>
                </div>
                <div class="col-6">
                    <a href="{{ route('user.profile', $user) }}" class="text-decoration-none">
                        <h5 class="text-success align-middle">{{{ $user->name }}}</h5>
                    </a>
                </div>
                <div class="col">
                    <h4 class="text-warning">{{{ $user->karma }}}</h4>
                </div>
            </div>
        @endforeach
    </div>
@endsection
