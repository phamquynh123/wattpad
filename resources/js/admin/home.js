$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.category-content').on('click', function() {
    $b = $(this).attr('data-categoryId');
    // var formData = new FormData();
    // formData.append('category_id', $(this).attr('data-categoryId'));
    $.ajax({
        dataType: 'JSON',
        method: 'post',
        cache: false,
        contentType: false,
        processData: false,
        data: $b,
        url: route('getCategory'),
        success: function(response){
            toastr.info(response.success);
        }
    })
});

$(document).ready(function() {
    $('#bestStory').children().first().addClass('active');
    $('#bestStory').children().first().first().attr('aria-expanded', true);
    $('#bestStory').next().children().first().first().addClass('active');
});

$(document).on('submit', '#comment-story', function(e) {
    e.preventDefault();
    $.ajax({
        dataType: 'JSON',
        method: 'post',
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData(this),
        url: route('addComment'),
        success: function(response){
            toastr.info(response.success);
            console.log(response.result);

            var html =` <div class="image-cmt float-left">
                            <img src="` + response.user.avatar + ` }}" alt="">
                        </div>
                        <div class="float-left">
                            <p><b>{{ $value->user->name }}</b></p>
                            <p>` + response.content + `</p>
                        </div>
                        <div class="clear"></div>`;
            $('.div-comment').prepend(html);
        },
        error:function(jqXHR, textStatus, errorThrown){
            if (jqXHR.responseJSON.errors.content !== undefined){
                toastr.error(jqXHR.responseJSON.errors.content[0]);
            }
        },
    });
})

$(document).on('click', '.vote-Story', function(e) {
    e.preventDefault();
    $story_id = $(this).attr('data-id');
    $.ajax({
        dataType: 'JSON',
        method: 'get',
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData(this),
        url: route('vote', $story_id),
        success: function(response){
            toastr.info(response.success);
            if (response.status == 'voted') {
                var html = `<a href="#" class="vote-Story" data-id=` + response.total_vote.id +`>
                                    <i class="fas fa-thumbs-up"></i>
                                    <span class="total_vote">` + response.total_vote.total_vote +`</span>
                                </a>`;
            } else if(response.status == 'unvote') {
                var html = `<a href="#" class="vote-Story notlike" data-id=` + response.total_vote.id +`>
                                    <i class="fas fa-thumbs-up"></i>
                                    <span class="total_vote">` + response.total_vote.total_vote +`</span>
                                </a>`;
            }
            $('.vote').html(html);

        },
        error:function(jqXHR, textStatus, errorThrown){
        },
    });
})
