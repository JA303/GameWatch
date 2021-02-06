@extends('layouts.app')

@section('content')

<!-- External CSS -->
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<link rel="stylesheet" href="{{ asset('css/games.css') }}">

<script>
    function setAndSent(value, inputID) {
        document.getElementById(inputID).value = value;
        document.getElementById('filter-form').submit();
    }
</script>

<div class="title-holder container">
    <div class=" row">
        <!-- Title -->
        <span class=" py-1">Games</span>
    </div>
    <div class="title-text-holder row"></div>
</div>

<!-- Filter Container -->
<div class=" container filter-container">
    <div class="row">

        <div class="col-lg-3 col-6">
            <div class="wrap">
                <!-- Search Box -->
                <form id="filter-form" method="GET" action="{{ route('games.index') }}">
                    <div class="search form-group mt-3">
                        <input name="title"  type="text" class=" searchTerm search-box-text" placeholder="Game Title..." @if(request()->has('title')) value="{{ request()->title }} @endif">
                        <input name="state" id="state" type="text" @if(request()->has('state')) value="{{ request()->state }}" @endif hidden>
                        <input name="filter" id="filter" type="text" @if(request()->has('filter')) value="{{ request()->filter }}" @endif hidden>
                        <button type="submit" class="searchButton form-inline">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-2 p-2 col-6">
            <div class="dropdown status-dropDown">
                <!-- Game State drop down -->
                <button  class="btn  dropdown-toggle status-dropDown-button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(request()->has('state') && request()->state != '')
                        {{ ucfirst(request()->state) }}
                    @else
                        Game Status
                    @endif
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" onclick="setAndSent('all', 'state')">All</a>
                    <a class="dropdown-item" onclick="setAndSent('cracked', 'state')">Cracked</a>
                    <a class="dropdown-item" onclick="setAndSent('uncracked', 'state')">Uncracked</a>
                    <a class="dropdown-item" onclick="setAndSent('unreleased', 'state')">Unreleased</a>
                </div>
            </div>
        </div>
        <!-- Filter Buttons -->
        <div class="col-lg-2 "></div>
        <div class="col-lg-5 d-flex justify-content-center pt-2 pb-2 " >
            <span class="sort-text">Filter:</span>
            <button class="btn-filter" onclick="setAndSent('date', 'filter')" @if(request()->has('filter') && request()->filter == 'date') autofocus @endif>Date</button>
            <button class="btn-filter" onclick="setAndSent('followers', 'filter')" @if(request()->has('filter') && request()->filter == 'followers') autofocus @endif>Followers</button>
            <button class="btn-filter" onclick="setAndSent('comments', 'filter')" @if(request()->has('filter') && request()->filter == 'comments') autofocus @endif>Comments</button>
        </div>

    </div>
</div>
<div class="container mt-4">

    <!-- You can add more col to this row -->
    <div class="row">
        @foreach($games as $game)
            @include('post.partials.game_col', ['game' => $game])
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        <div class="mt-3">
{{--            {{ $games->links('pagination::bootstrap-4') }}--}}
            {{ $games->appends(request()->all())->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
