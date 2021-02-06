@foreach($comments as $comment)

<div class="row comment-row comment-row-reply shadow ">
    <!-- Reply Gap -->
    <div class=" col-{{ $level }}"></div>             <!-- Gap col = x -->
    <!-- Rank -->
    <div class=" col-lg-1 col-2 pt-1 ">
        @auth()
            <?php
            $up_vote = $comment->vote(auth()->user());
            ?>
        @endauth
        @if(!$comment->hide)
            <div class=" d-flex justify-content-center pt-2 arr">
                @auth()
                    @if($comment->user->id != auth()->user()->id)
                        <i class="arr-up" @if($up_vote === 1) style="background-color: green"  @endif id="comment{{ $comment->id }}-upvote" onclick="voteAJAX({{$comment->id}}, '{{ route('comment.vote' , $comment) }}', true)"></i>
                    @else
                        <i class="arr-up" onclick="alert('You cant vote your comment')"></i>
                    @endif
                @else
                    <a href="{{ route('login') }}"><i class="arr-up"></i></a>
                @endauth
            </div>
            <div class="d-flex justify-content-center rate-num" id="comment{{ $comment->id }}-vote">
                {{ $comment->sumOfVotes() }}
            </div>
            <div class="d-flex justify-content-center pb-2 arr">
                @auth()
                    @if($comment->user->id != auth()->user()->id)
                        <i class="arr-down" @if($up_vote === 0) style="background-color: red"  @endif id="comment{{ $comment->id }}-downvote" onclick="voteAJAX({{$comment->id}}, '{{ route('comment.vote', $comment) }}', false)"></i>
                    @else
                        <i class="arr-down" onclick="alert('You cant vote your comment')"></i>
                    @endif
                @else
                    <a href="{{ route('login') }}"><i class="arr-down"></i></a>
                @endauth
            </div>
        @endif
    </div>
    <!-- Main -->
    <div class=" col-lg-{{ 8 - $level }} col-{{ 10 - $level }} ">             <!-- Main col = 8-x  , 8-x+2 -->
        <div class="row  ">
            <div class=" col-12 ">
                <div class="row  ">
                    <div class="col comment-row-text no-padding-col">
                        <p>
                            @if($comment->hide)
                                COMMENT DELETED BY ADMIN
                            @else
                                {{{ $comment->comment }}}
                            @endif
                        </p>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-12 no-padding-col">
                        <img style="max-height: 200px;" @if(!$comment->hide) src="{{ asset('uploads/comment_imgs').'/'.$comment->image }}" @endif alt="">
                    </div>
                </div>


                <div class="row  pb-1">

                    <div class="col-12 commet-row-nav no-padding-col">
                        @auth()
                            <span class="commet-row-nav-item " data-toggle="collapse" data-target="{{'#collaps'.$comment->id }}">
                                Reply
                            </span>

                            @if(auth()->user()->hasRole('admin'))
                                <form id="delete-comment{{ $comment->id }}" method="POST" action="{{ route('comment.delete', $comment) }}" hidden>
                                    @csrf
                                    <input name="delete" value="{{ !$comment->hide }}" hidden>
                                </form>
                                <span class="commet-row-nav-item" onclick="document.getElementById('delete-comment{{ $comment->id }}').submit()">
                                    @if($comment->hide) RESTORE @else DELETE @endif
                                </span>

                            @endif
                        @endauth
                        <span>
                            {{ $comment->created_at->diffforhumans() }}
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- User Avatar -->
    <div class=" col-lg-3  col-4">
        <div class="row ">
            <div class=" col-9  align-self-center  ">
                <a href="{{ route('user.profile', $comment->user) }}">
                    <p class="rtl commet-row-username "> {{{ $comment->user->name }}} </p>
                </a>
            </div>
            <div class=" col-3 d-flex justify-content-center ">
                <img class="commet-row-avatar" src="{{ asset('uploads/avatars/'.$comment->user->avatar) }}" alt="">
            </div>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('comment.reply', $comment) }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <div id="{{'collaps'.$comment->id }}" class="row pt-1 collapse">
        <!-- Reply Gap -->
        <div class="col-1 "></div>
        <!-- Main Reply Text -->
        <div class="col-lg-10 col-9 ">
            <div class="reply-text-area-holder">
                <textarea name="comment" class="reply-text-area shadow" rows="3" placeholder="Your comment..."></textarea>
            </div>
        </div>

        <div style="background-color:#161618;" class="col-lg-1 col-2 ">
            <div class="row reply-button-row  ">
                <label id="comment-image-label{{ $comment->id }}" for="comment-image{{ $comment->id }}" class="btn btn-reply">Image</label>
                <input type="file" name="comment_image" id="comment-image{{ $comment->id }}" onchange="$('#comment-image-label{{ $comment->id }}').css('background-color', 'green')" hidden>
            </div>
            <div class="row reply-button-row   ">
                <button type="submit" class="btn btn-reply ">Send</button>
            </div>

        </div>
    </div>
</form>

@include('post.partials.replies', ['comments' => $comment->replies, 'post' => $post, 'level' => $level + 1])
@endforeach
