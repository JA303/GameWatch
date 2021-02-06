@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <!-- Section Title -->
    <div class="title-holder container">
        <div class="row">
            <!-- Title -->
            <span class=" py-1">{{{ $title }}}</span>
        </div>
        <div class="title-text-holder row"></div>
    </div>
    <!-- Comments -->
    <div class=" container">
        <div class="d-flex justify-content-center mx-4">
            {{ $comments->links('pagination::bootstrap-4') }}
        </div>
        <!-- Comment -->
        @foreach($comments as $comment)
            @include('post.partials.comment', [$comment , 'level' => 0])
        @endforeach
        <div class="d-flex justify-content-center mt-4">
            {{ $comments->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
