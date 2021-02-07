
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//user vote ajax
function voteAJAX(commentId, route, upVote) {
    $.ajax({
        url: route,
        type:"POST",
        data: { upVote: upVote },
        success:function(data){
            if(data.success === true) {
                $('#comment' + commentId + '-vote').text(data.UpVoteCount - data.DownVoteCount);
                if(upVote) {
                    $('#comment' + commentId + '-downvote').css('border-color', '');
                    $('#comment' + commentId + '-upvote').css('border-color', 'green');
                } else {
                    $('#comment' + commentId + '-downvote').css('border-color', 'red');
                    $('#comment' + commentId + '-upvote').css('border-color', '');
                }

            } else {
                alert("You Already Vote");
            }
            //console.log(data);
        },error:function(){
            console.log("Error In Vote")
        }
    });
}

function followAJAX(route) {
    $.ajax({
        url: route,
        type:"POST",
        data: { },
        success:function(data){
            if(data.success === true) {
                $('#game-followers-count').text(data.followers);
                if(data.follow === true)
                    $('#game-followers-button').text('UNFOLLOW');
                else if(data.follow === false)
                    $('#game-followers-button').text('FOLLOW');
            } else {
                alert("some problem happened");
            }
        },error:function(){
            console.log("Error in follow game")
        }
    });
}
