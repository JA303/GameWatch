@extends('layouts.app')

@section('content')
    <!-- External CSS -->
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/game.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">

    <style>
            body{
            background-image: url({{ asset('img/contact.png') }});
            background-color: rgba(17, 17, 17, 0.671);
            background-blend-mode:saturation;
            background-size: cover; 
            background-attachment: fixed;
            background-position: center;
        }
    </style>


    <div class=" container text-white">
        <div class="row padding-contact">
            <div class=" col-lg-6 pb-5 ">
                <h2 class="yellow-front">Contact Us</h2>
                <p>Feel free to get in touch whith us. Share any problems, criticisms, or suggestions with us.</p>
                <br><br>
                <p class=""><a class="email-link" href="mailto:contact@GamesWatch.ir">Contact@GamesWatch.ir</a></p>
                <br>
                <div class="row ">
                <ul>
                    <li class="li-social"><a class="li-social-link" href=""><img src="{{ asset('img/instagram.png') }}" alt=""></a></li>
                    <li class="li-social"><a class="li-social-link" href=""><img src="{{ asset('img/twitter.png') }}" alt=""></a></li>
                    <li class="li-social"><a class="li-social-link" href=""><img src="{{ asset('img/youtube.png') }}" alt=""></a></li>
                </ul>
                </div>  
            </div>
            <div class=" col-lg-6 ">
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
                
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form id="contact-form" method="GET" action="{{ route('contact.send') }}" role="form">

                    <div class="messages"></div>
                
                    <div class="controls">
                
                        <div class="row ">
                            <div class="col-md-6 ">
                                <div class="form-group ">
                                    <label for="form_name ">Firstname *</label>
                                    <input id="form_name" type="text" name="name" class="form-control" placeholder="firstname *" required="required" data-error="Firstname is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_lastname">Lastname *</label>
                                    <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="lastname *" required="required" data-error="Lastname is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_email">Email *</label>
                                    <input id="form_email" type="email" name="email" class="form-control" placeholder="your email *" required="required" data-error="Valid email is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_need">Please specify your need *</label>
                                    <select id="form_need" name="need" class="form-control" required="required" data-error="Please specify your need.">
                                        <option value="None"></option>
                                        <option value="Report Bug">Report Bug</option>
                                        <option value="Suggestion">Suggestion</option>
                                        <option value="Cooperation Requeste">Cooperation Requeste</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_message">Message *</label>
                                    <textarea id="form_message" name="message" class="form-control" placeholder="Message for GamesWatch *" rows="4" required="required" data-error="Please, leave us a message."></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="btn yellow-back btn-send" value="Send message">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-muted">
                                    <strong>*</strong> These fields are required.
                            </div>
                        </div>
                    </div>
                
                </form>
            </div>
        </div>
        
    </div>


@endsection