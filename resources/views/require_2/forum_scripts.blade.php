<script>
    $(function() {
        function loadComments(postId) {
            $.ajax({
                url: '{{ route('comments.get', ':id') }}'.replace(':id', postId),
                type: 'GET',
                success: function(comments) {
                    var commentsHtml = '';
                    comments.forEach(function(comment) {
                        commentsHtml += `
                        <hr>
                        <div class="row comment" style="align-items: baseline; display: none;" data-comment-id="${comment.id}">
                            <div class="col-lg-1 col-md-1 col-sm-6 col-6">
                                <img class="w-h-80"
                                    src="https://www.dentistryinanutshell.com/dian/storage/app/profile_pics/${comment.user.profilePic}"
                                    onerror="this.onerror=null; this.src='{{ asset('images/general/profile.png') }}';">
                            </div>
                            <div class="col-md-10">
                                <div class="panel panel-default admin">
                                    <h4 class="panel-title">
                                        <div class="ab">
                                            <div class="row">
                                                <div class="col-md-11">
                                                    <div class="title_wrapper anek-telugu"><a href="https://www.dentistryinanutshell.com/dian/public/forum-profile/${comment.user.id}" target="_blank">${comment.user.name}</a> @<span
                                                            class="dentist anek-telugu">${comment.user.designation}</span><span class="time-elapsed"> ${comment.time_elapsed}</span>
                                                            ${comment.user.id === activeUserId ? '<i class="fa fa-trash btn-delete-comment pointer" data-comment-id="'+comment.id+'" data-post-id="'+comment.post_id+'"></i>' : ''}
                                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="dentist anek-telugu">${comment.text}</p>
                                    </h4>
                                </div>
                                <div class="py-sm-3">
                                    <div class="py-sm-3">
                                        <img class="mw-2 reply-icon pointer" src="{{ asset('images/forum/comment.png') }}" data-comment-id="${comment.id}">&nbsp; <span class="reply-icon pointer comment-font-size anek-telugu" data-comment-id="${comment.id}">${comment.replies_count} Replies</span>
                                    </div>
                                    <div class="replies-container" id="replies-container-${comment.id}"></div>
                                    <div class="reply-input-container" id="reply-input-container-${comment.id}" style="display: none;">
                                        <div class=" d-flex"  >
                                            <input type="text" class="reply-input form-control" id="reply-input-${comment.id}" placeholder="Write a reply...">
                                            <button class="btn-submit-reply btn btn-primary" data-post-id="${comment.post_id}" data-comment-id="${comment.id}">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    });

                    $('#comments-' + postId).html(commentsHtml);
                    $('#comments-' + postId + ' .comment').each(function() {
                        $(this).fadeIn(500); // Fade in each comment with a 500ms duration
                    });
                }
            });
        }

        function loadReplies(commentId, parentContainerId = null) {
            $.ajax({
                url: '{{ route('replies.get', ':id') }}'.replace(':id', commentId),
                type: 'GET',
                success: function(replies) {
                    var repliesHtml = '';
                    replies.forEach(function(reply) {
                        repliesHtml += `
                        <div class="row reply" style="align-items: baseline; display: none;" data-reply-id="${reply.id}">
                            <div class="col-lg-1 col-md-1 col-sm-6 col-6">
                                    <img class="w-h-60"
                                    src="https://www.dentistryinanutshell.com/dian/storage/app/profile_pics/${reply.user.profilePic}"
                                    onerror="this.onerror=null; this.src='{{ asset('images/general/profile.png') }}';">
                            </div>
                            <div class="col-md-10">
                                <div class="panel panel-default admin">
                                    <h4 class="panel-title">
                                        <div class="ab">
                                            <div class="row">
                                                <div class="col-md-11">
                                                    <div class="title_wrapper anek-telugu"><a href="https://www.dentistryinanutshell.com/dian/public/forum-profile/${reply.user.id}" target="_blank">${reply.user.name}</a> @<span class="dentist anek-telugu">${reply.user.designation}</span><span class="time-elapsed"> ${reply.time_elapsed}</span>
                                                        ${reply.user.id === activeUserId ? '<i class="fa fa-trash  btn-delete-reply pointer" data-comment-id="'+commentId+'" data-post-id="'+reply.post_id+'" data-reply-id="'+reply.id+'"></i>' : ''}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="dentist anek-telugu">${reply.text}</p>
                                    </h4>
                                </div>
                            </div>
                        </div>`;


                    });

                    if (parentContainerId) {
                        $('#replies-container-' + parentContainerId).html(repliesHtml);
                        $('#replies-container-' + parentContainerId + ' .reply').each(function() {
                            $(this).fadeIn(500); // Fade in each reply with a 500ms duration
                        });
                    } else {
                        $('#replies-container-' + commentId).html(repliesHtml);
                        $('#replies-container-' + commentId + ' .reply').each(function() {
                            $(this).fadeIn(500); // Fade in each reply with a 500ms duration
                        });
                    }
                }
            });
        }

        // function loadParentReplies(replyId) {
        //     <div class="py-sm-3">
        //     <div class="py-sm-3">
        //         <img class="mw-2 comment-reply-icon pointer" src="{{ asset('images/forum/comment.png') }}" data-reply-id="${reply.id}">&nbsp; <span class="comment-reply-icon comment-reply-text pointer comment-font-size anek-telugu" data-reply-id="${reply.id}">${reply.replies.length} Replies</span>
        //     </div>
        //     <div class="comment-replies-container" id="comment-replies-container-${reply.id}"></div>
        //     <div class="comment-reply-input-container" id="comment-reply-input-container-${reply.id}" style="display: none;">
        //         <div class="d-flex">
        //             <input type="text" class="reply-input form-control" id="comment-reply-input-${reply.id}" placeholder="Write a reply...">
        //             <button class="btn-submit-comment-reply btn btn-primary" data-post-id="${reply.post_id}" data-comment-id="${reply.comment_id}" data-reply-id="${reply.id}">Submit</button>
        //         </div>
        //     </div>
        // </div>
        //     $.ajax({
        //         url: '{{ route('replies.parent.get', ':id') }}'.replace(':id', replyId),
        //         type: 'GET',
        //         success: function(replies) {
        //             var repliesHtml = '';
        //             replies.forEach(function(reply) {
        //                 repliesHtml += `
        //             <div class="row reply" style="align-items: baseline; display: none;" data-reply-id="${reply.id}">
        //                 <div class="col-lg-1 col-md-1 col-sm-6 col-6">
        //                     <img class="w-h-50"
        //                         src="https://www.dentistryinanutshell.com/dian/storage/app/profile_pics/${reply.user.profilePic}"
        //                         onerror="this.onerror=null; this.src='{{ asset('images/general/profile.png') }}';">
        //                 </div>
        //                 <div class="col-md-10">
        //                     <div class="panel panel-default admin">
        //                         <h4 class="panel-title">
        //                             <div class="ab">
        //                                 <div class="row">
        //                                     <div class="col-md-11">
        //                                         <div class="title_wrapper anek-telugu"><a href="https://www.dentistryinanutshell.com/dian/public/forum-profile/${reply.user.id}" target="_blank">${reply.user.name}</a> @<span
        //                                                 class="dentist anek-telugu">${reply.user.designation} ${reply.time_elapsed}</span>
        //                                                 ${reply.user.id === activeUserId ? '<i class="fa fa-trash  btn-delete-reply pointer" data-comment-id="'+reply.comment_id+'" data-post-id="'+reply.post_id+'"data-parent-id="'+reply.parent_id+'" ></i>' : ''}
        //                                                 </div>
        //                                     </div>
        //                                 </div>
        //                             </div>
        //                             <p class="dentist anek-telugu">${reply.text}</p>
        //                         </h4>
        //                     </div>
        //                 </div>
        //             </div>`;
        //                 // Call loadReplies only if there are nested replies
        //                 if (reply.replies_count > 0) {
        //                     loadParentReplies(reply.id);
        //                 }
        //             });

        //             $('#comment-replies-container-' + replyId).html(repliesHtml);
        //             $('#comment-replies-container-' + replyId + ' .reply').each(function() {
        //                 $(this).fadeIn(500); // Fade in each reply with a 500ms duration
        //             });
        //         }
        //     });
        // }

        $(document).on('click', '.comment-reply-icon', function() {
            var replyId = $(this).data('reply-id');
            var replyInputContainer = $('#comment-reply-input-container-' + replyId);

            replyInputContainer.fadeIn('slow');

            loadParentReplies(replyId);
        });

        $(document).on('click', '.reply-icon', function() {
            var commentId = $(this).data('comment-id');
            var commentInputContainer = $('#reply-input-container-' + commentId);

            commentInputContainer.fadeIn('slow');

            loadReplies(commentId);
        });


        $(document).on('click', '.comment-icon', function() {
            var postId = $(this).data('post-id');
            var container = $('#comments-' + postId);
            // Check if the container is currently visible
            var isVisible = container.hasClass('visible');

            if (isVisible) {
                container.slideUp();
                container.removeClass('visible');
            } else {
                container.slideDown();
                container.addClass('visible');
                loadComments(postId);
            }
        });


        $(document).on('click', '.btn-add-comment', function() {
            var postId = $(this).data('post-id');
            var $commentInput = $('.comment-input[data-post-id="' + postId + '"]');
            var text = $commentInput.val();

            $.ajax({
                url: "{{ route('comments.store') }}",
                type: 'POST',
                data: {
                    text: text,
                    post_id: postId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status) {
                        loadComments(postId);

                        // Update the comment count in the UI
                        var displayText = response.displayComments + ' Comments';

                        var commentText = $('[data-post-id="' + postId + '"]').filter(
                            '.comment-icon-text');
                        commentText.text(displayText);

                        $commentInput.val('');
                    }
                }
            });
        });


        $(document).on('click', '.btn-submit-reply', function() {
            var commentId = $(this).data('comment-id');
            var replyId = $(this).data('reply-id') || null;
            var text = $('#reply-input-' + commentId).val();
            var postId = $(this).data('post-id');

            $.ajax({
                url: "{{ route('replies.store') }}",
                type: 'POST',
                data: {
                    text: text,
                    post_id: postId,
                    comment_id: commentId,
                    parent_id: replyId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status) {
                        $('#reply-input-' + commentId).val('');
                        loadReplies(commentId);

                        // Update the replies count in the UI
                        var replyIcon = $('[data-comment-id="' + commentId + '"]').find(
                            '.reply-icon');
                        replyIcon.text(response.replies_count + ' ' + 'Replies');

                        // Update the individual comment replies count in the UI
                        var commentReplyIcon = $('[data-reply-id="' + replyId + '"]').find(
                            '.comment-reply-text');
                        commentReplyIcon.text(response.comment_replies_count + ' ' +
                            'Replies');

                        // Update the comment count in the UI
                        var displayText = response.displayComments + ' Comments';

                        var commentText = $('[data-post-id="' + postId + '"]').filter(
                            '.comment-icon-text');
                        commentText.text(displayText);
                    }
                }
            });
        });

        $(document).on('click', '.btn-submit-comment-reply', function() {
            var commentId = $(this).data('comment-id');
            var replyId = $(this).data('reply-id') || null;
            var text = $('#comment-reply-input-' + replyId).val();
            var postId = $(this).data('post-id');

            $.ajax({
                url: "{{ route('replies.store') }}",
                type: 'POST',
                data: {
                    text: text,
                    post_id: postId,
                    comment_id: commentId,
                    parent_id: replyId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status) {
                        $('#comment-reply-input-' + replyId).val('');
                        loadParentReplies(replyId);

                        // Update the replies count in the UI
                        var replyIcon = $('[data-comment-id="' + commentId + '"]').find(
                            '.reply-icon');
                        replyIcon.text(response.replies_count + ' ' + 'Replies');

                        // Update the individual comment replies count in the UI
                        var commentReplyIcon = $('[data-reply-id="' + replyId + '"]').find(
                            '.comment-reply-text');
                        commentReplyIcon.text(response.comment_replies_count + ' ' +
                            'Replies');

                        // Update the comment count in the UI
                        var displayText = response.displayComments + ' Comments';

                        var commentText = $('[data-post-id="' + postId + '"]').filter(
                            '.comment-icon-text');
                        commentText.text(displayText);
                    }
                }
            });
        });

        // Function to handle delete comment button click
        $(document).on('click', '.btn-delete-comment', function() {
            var commentId = $(this).data('comment-id');
            var postId = $(this).data('post-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('comments.destroy', ':id') }}".replace(':id',
                            commentId),
                        type: 'DELETE',
                        data: {
                            post_id: postId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status) {
                                loadComments(response.post_id);

                                var displayText = response.displayComments +
                                    ' Comments';

                                var commentText = $('[data-post-id="' + postId +
                                    '"]').filter(
                                    '.comment-icon-text');
                                commentText.text(displayText);
                                Swal.fire(
                                    'Deleted!',
                                    'Your comment has been deleted.',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    'Failed to delete the comment.',
                                    'error'
                                );
                            }
                        }
                    });
                }
            });
        });

        // Function to handle delete reply button click
        $(document).on('click', '.btn-delete-reply', function() {
            var replyId = $(this).data('reply-id');
            var postId = $(this).data('post-id');
            var commentId = $(this).data('comment-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('replies.destroy', ':id') }}".replace(':id',
                            replyId),
                        type: 'DELETE',
                        data: {
                            post_id: postId,
                            comment_id: commentId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status) {
                                loadReplies(response.comment_id);
                                // Update the replies count in the UI
                                var replyIcon = $('[data-comment-id="' + commentId +
                                    '"]').find(
                                    '.reply-icon');
                                replyIcon.text(response.replies_count + ' ' +
                                    'Replies');

                                // Update the individual comment replies count in the UI
                                var commentReplyIcon = $('[data-reply-id="' +
                                    replyId + '"]').find(
                                    '.comment-reply-text');
                                commentReplyIcon.text(response
                                    .comment_replies_count + ' ' +
                                    'Replies');

                                // Update the comment count in the UI
                                var displayText = response.displayComments +
                                    ' Comments';

                                var commentText = $('[data-post-id="' + postId +
                                    '"]').filter(
                                    '.comment-icon-text');
                                commentText.text(displayText);
                                Swal.fire(
                                    'Deleted!',
                                    'Your Reply has been deleted.',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    'Failed to delete the Reply.',
                                    'error'
                                );
                            }
                        }
                    });
                }
            });
        });

        // Function to handle delete parent reply button click
        // $(document).on('click', '.btn-delete-parent-reply', function() {
        //     var replyId = $(this).data('reply-id');
        //     var postId = $(this).data('post-id');
        //     var commentId = $(this).data('comment-id');
        //     var parentId = $(this).data('parent-id');

        //     Swal.fire({
        //         title: 'Are you sure?',
        //         text: "You won't be able to revert this!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, delete it!'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             $.ajax({
        //                 url: '{{ route('replies.parent.destroy', ':id') }}'.replace(
        //                     ':id', replyId),
        //                 type: 'DELETE',
        //                 data: {
        //                     post_id: postId,
        //                     comment_id: commentId,
        //                     parent_id: parentId,
        //                     reply_id: replyId,
        //                     _token: '{{ csrf_token() }}'
        //                 },
        //                 success: function(response) {
        //                     if (response.status) {
        //                         loadParentReplies(response.reply_id);
        //                         console.log(response.comment_replies_count +
        //                             "comments replies");
        //                         // Update the replies count in the UI
        //                         var replyIcon = $('[data-comment-id="' + commentId +
        //                             '"]').find('.reply-icon');
        //                         replyIcon.text(response.replies_count + ' ' +
        //                             'Replies');

        //                         // Update the individual comment replies count in the UI
        //                         var commentReplyIcon = $('[data-reply-id="' +
        //                             parentId + '"]').find('.comment-reply-text');
        //                         console.log(commentReplyIcon);
        //                         commentReplyIcon.text(response
        //                             .comment_replies_count + ' ' + 'Replies');

        //                         // Update the comment count in the UI
        //                         var displayText = response.displayComments +
        //                             ' Comments';

        //                         var commentText = $('[data-post-id="' + postId +
        //                             '"]').filter('.comment-icon-text');
        //                         commentText.text(displayText);
        //                         Swal.fire(
        //                             'Deleted!',
        //                             'Your Reply has been deleted.',
        //                             'success'
        //                         );
        //                     } else {
        //                         Swal.fire(
        //                             'Failed!',
        //                             'Failed to delete the Reply.',
        //                             'error'
        //                         );
        //                     }
        //                 }
        //             });
        //         }
        //     });
        // });

        // Function to handle delete parent reply button click
        $(document).on('click', '.btn-delete-post', function() {
            var postId = $(this).data('post-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('posts.destroy', ':id') }}'.replace(':id',
                            postId),
                        type: 'DELETE',
                        data: {
                            post_id: postId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status) {
                                Swal.fire(
                                    'Deleted!',
                                    'Post deleted successfully',
                                    'success'
                                ).then(() => {
                                    // Reload the page
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    'Failed to delete the Post.',
                                    'error'
                                );
                            }
                        }
                    });
                }
            });
        });
    });
</script>
