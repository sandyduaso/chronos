
<div id="comments-container"></div>


@push('css')
    <link rel="stylesheet" type="text/css" href="{{ assets('Frontier/jquery-comments/css/jquery-comments.css') }}">

    <style>
        .wrapper {
            background: #fff !important;
        }

        .content {
            min-height: 0 !important;
        }

        .spinner {
            display: none !important;
        }

        .btn-danger {
            background: #D8462A !important;
            color: #fff !important;
        }
    </style>
@endpush

@push('js')

    <!-- Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.textcomplete/1.8.0/jquery.textcomplete.js"></script>
    <script type="text/javascript" src="{{ assets('Frontier/jquery-comments/js/jquery-comments.js') }}"></script>

    <script>
        $(function() {
            var usersArray = [];
            var saveComment = function(data) {
                // Convert pings to human readable format
                $(data.pings).each(function(index, id) {
                    var user = usersArray.filter(function(user){return user.id == id})[0];
                    data.content = data.content.replace('@' + id, '@' + user.fullname);
                });

                return data;
            }

            $('#comments-container').comments({
                profilePictureURL: '{{ auth()->user()->avatar }}',
                currentUserId: '{{ auth()->user()->id }}',
                roundProfilePictures: true,
                textareaRows: 1,
                enableAttachments: false,
                enableHashtags: true,
                enablePinging: true,
                enableReplying: true,
                enableEditing: true,
                enableUpvoting: true,
                enableDeleting: true,
                postCommentOnEnter: true,
                getUsers: function(success, error) {
                    setTimeout(function() {
                        success(usersArray);
                    }, 500);
                },
                getComments: function(success, error) {
                    setTimeout(function() {
                        $.ajax({
                            url: "{{ $all }}",
                            type: 'post',
                            success: function (data) {
                                success(data);
                            }
                         });
                    }, 500);
                },
                postComment: function(data, success, error) {
                    $.ajax({
                        url: "{{ $post }}",
                        type: 'POST',
                        data: {
                            data: data,
                            user_id: '{{auth()->user()->id}}',
                            // course_id: '{{ $resource->id }}',
                        },
                        success: setTimeout(function () {
                            success(coomentJSON);
                        }, 500),
                        error:function(ww) {-
                            console.log(ww);
                        }
                    });
                    success(saveComment(data));
                    console.log(data);
                },
                //edit comment
                putComment: function(data, success, error) {
                    $ajax({
                        url: "{{ route('api.comments.store') }}",
                        type: 'put',
                        data: {
                            data: data,
                            user_id: '{{ auth()->user()->id }}',
                        },
                        success: setTimeout(function() {
                            success(commentJSON);
                        }, 500),
                        error: function(update){
                            console.log(update)
                        }
                    });
                    success(saveComment(data));
                    console.log(data);
                },
                deleteComment: function(data, success, error) {
                    setTimeout(function() {
                        success();
                    }, 500);
                },
                upvoteComment: function(data, success, error) {
                    setTimeout(function() {
                        success(data);
                    }, 500);
                },
                uploadAttachments: function(dataArray, success, error) {
                    setTimeout(function() {
                        success(dataArray);
                    }, 500);
                },
            });
        });
    </script>
@endpush
