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
        <h5 class="py-2">You can get karma by get up votes</h5>
    </div>
    <!-- Users -->
    <div class="container">
        <div class="row bg-dark align-middle round-corner-1 shadow-box-1" >
            <div class="col" style="flex: 0 0 75px;">

            </div>
            <div class="col-6">
                <h5 class="green-text p-2">USER NAME</h5>
            </div>
            <div class="col d-flex justify-content-center">
                <h5 class="text-warning p-2">KARMA</h5>
            </div>
        </div>
        <?php $rank = 1 ?>
        @foreach($users as $user)
            <div class="row bg-dark round-corner-2 rank-holder shadow-box-1" >
                <div class="col" style="flex: 0 0 75px;">
                    <img  class="no-padding-col rounded-circle commet-row-avatar" style="position: relative; top: -25%; display: inline" src="{{ asset('uploads/avatars/'.$user->avatar) }}">
                    <div style="width: 25px; height: 25px; position: absolute; top: 30px; text-align: center" class="rounded-circle bg-light font-weight-bold" >
{{--                        <h4 class="text-danger" style="display: inline">{{ $rank++ }}</h4>--}}
                        {{ $rank++ }}
                    </div>
                </div>
                <div class="col-6 pt-2">
                    <a href="{{ route('user.profile', $user) }}" class="text-decoration-none ">
                        <h5 class="green-text align-middle ">{{{ $user->name }}}</h5>
                    </a>
                </div class="">
                <div class="col d-flex justify-content-center pt-2">
                    <h4 class="text-warning">{{{ $user->karma }}}</h4>
                </div>
            </div>
        @endforeach
    </div>
@endsection
