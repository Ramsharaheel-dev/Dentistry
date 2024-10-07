<style>
    .no-user {
        font-size: 18px;
        background: black;
        display: flex;
        justify-content: center;
    }
</style>
<script>
    $(function() {
        let selectedVideos = [];
        let selectedUsers = [];
        let buttonClicked = false;
        let currentPlayers = [];
        var assignedVideosVisible = false;

        $(document).ready(function() {

            $('.videoIframe').each(function() {
                const iframe = this;
                const iframeVideoId = $(iframe).attr('data-video-id');
                const iframeSrc = $(iframe).attr('src');
                const iframeDuration = $(iframe).attr('data-reel-duration');
                const iframeType = $(iframe).attr('data-video-type');

                $.ajax({
                    url: "{{ route('get.total.length') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        video_type: iframeType,
                        video_id: iframeVideoId,
                    },
                    success: function(response) {
                        var watchedTime = response.watchedTime;
                        var totalLength = response.totalLength;

                        var percentageWatched = (watchedTime / totalLength) * 100;
                        if (!isNaN(percentageWatched) && isFinite(
                                percentageWatched)) {
                            updatePercentageWatched(iframeVideoId,
                                percentageWatched);
                        } else {
                            updatePercentageWatched(iframeVideoId, 0);
                        }

                    },
                    error: function(error) {
                        console.error('Error fetching video data:', error);
                    }
                });
                initializePlayer(iframe, iframeVideoId, iframeSrc, iframeDuration, iframeType);

            });
        });

        function initializePlayer(iframe, videoId, iframeSrc, iframeDuration, iframeType) {
            const player = new Vimeo.Player(iframe);

            player.on('play', function(data) {
                pauseAllPlayers(player);
            });

            function playVideo(videoId, data) {
                var currentTime = data.seconds;
                console.log(currentTime);
                $.ajax({
                    url: "{{ route('store.watch.time') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        video_type: iframeType,
                        video_id: videoId,
                        watched_time: currentTime,
                    },
                    success: function(response) {
                        console.log("Video Duration: " + response);
                    },
                    error: function(error) {
                        console.error('Error fetching video details:', error);
                    }
                });
            }

            player.on('pause', function() {
                $.ajax({
                    url: "{{ route('get.total.length') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        video_type: iframeType,
                        video_id: videoId,
                    },
                    success: function(response) {
                        var watchedTime = response.watchedTime;
                        var totalLength = response.totalLength;
                        var percentageWatched = (watchedTime / totalLength) * 100;
                        if (!isNaN(percentageWatched) && isFinite(percentageWatched)) {
                            updatePercentageWatched(videoId, percentageWatched);
                        } else {
                            updatePercentageWatched(videoId, 0);
                        }
                    },
                    error: function(error) {
                        console.error('Error fetching video details:', error);
                    }
                });
            });

            player.on('ended', function() {
                $.ajax({
                    url: "{{ route('video.completed') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        video_type: iframeType,
                        video_id: videoId,
                    },
                    success: function(response) {
                        console.log('Video completed:', response);
                        var userId = response.userId;
                        var videoId = response.videoId;
                        var videoType = response.videoType;

                        if (response.popup) {
                            var surveyFormModal = $('.surveryFormModal');

                            surveyFormModal.find('#modalVideoId').val(videoId);
                            surveyFormModal.find('#modalUserId').val(userId);
                            surveyFormModal.find('#modalVideoType').val(videoType);

                            surveyFormModal.modal({
                                backdrop: 'static',
                                keyboard: false
                            });

                            surveyFormModal.on('hide.bs.modal', function(e) {
                                e.preventDefault();
                            });

                            function showAlert() {
                                Swal.fire({
                                    title: 'You must fill out the survey before closing.',
                                    icon: 'warning',
                                    confirmButtonText: 'OK',
                                });

                                $(document).off('click', clickOutsideHandler);
                            }

                            function clickOutsideHandler(e) {
                                if (!$(e.target).closest('.modal-dialog').length) {
                                    showAlert();
                                }
                            }

                            $(document).on('click', clickOutsideHandler);
                            surveyFormModal.modal('show');
                        }
                    },
                    error: function(error) {
                        console.error('Error handling video completion:', error);
                    }
                });
            });

            player.on('timeupdate', function(data) {
                var currentTime = data.seconds;

                $.ajax({
                    url: "{{ route('update.watched.time') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        video_type: iframeType,
                        video_id: videoId,
                        watched_time: currentTime
                    },
                    success: function(response) {
                        console.log('Watched time update response:', response);
                    },
                    error: function(error) {
                        console.error('Error updating watched time:', error);
                    }
                });

                $.ajax({
                    url: "{{ route('store.watch.time') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        video_type: iframeType,
                        video_id: videoId,
                        watched_time: currentTime,
                        total_length: iframeDuration
                    },
                    success: function(response) {
                        console.log(
                            "Un Assigned Video Watched time updated successfully:",
                            response);
                    },
                    error: function(error) {
                        console.error('Error updating watched time:',
                            error);
                    }
                });
            });

            currentPlayers.push(player);

        }

        function updatePercentageWatched(videoId, percentage) {
            $("#percentageWatched-" + videoId).text("Watched: " + percentage.toFixed(0) + "%");
        }

        function pauseAllPlayers(currentPlayer) {
            currentPlayers.forEach(function(player) {
                if (player !== currentPlayer) {
                    player.pause();
                }
            });
        }

        $('#filterButton').click(function() {
            var hasAssignedVideos = $('.videoContainer.assign-borders').length > 0;

            if (hasAssignedVideos) {
                if (!assignedVideosVisible) {
                    // Show only the .videoContainer elements with assign-borders class
                    $('.videoContainer').hide().filter('.assign-borders').show();
                    assignedVideosVisible = true;
                } else {
                    // Show all .videoContainer elements
                    $('.videoContainer').show();
                    assignedVideosVisible = false;
                }
            } else {
                alert('No video assigned');
            }
        });

        $('#selectVideosBtn').on('click', function() {
            $('.selectCheckbox').toggle();
            $('.round').toggle();

            $('.assign-p').toggle();

            $(this).toggleClass('background-active');

            buttonClicked = true;

        });

        $('.selectButton').on('click', function() {
            const videoId = $(this).data('video-id');
            const videoUrl = $(this).data('src');
            const videoType = $(this).data('video-type');
            console.log(videoType);

            if (selectedVideos.some(video => video.videoId === videoId)) {
                selectedVideos = selectedVideos.filter(video => video.videoId !== videoId);
            } else {
                selectedVideos.push({
                    videoType,
                    videoId,
                    videoUrl
                });
            }

            $('.openAssignModalBtn').toggle(selectedVideos.length > 0 || selectedVideos.length > 1);
        });

        $('.openAssignModalBtn').on('click', function() {
            $.ajax({
                url: "{{ route('fetch.selected.items') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    videoType: selectedVideos.map(video => video.videoType),
                    videoIds: selectedVideos.map(video => video.videoId)
                },
                success: function(response) {
                    console.log(response);
                    updateAssignModal(response);
                    $('.assignModal').modal('show');
                },
                error: function(error) {
                    console.error('Error fetching video details:', error);
                }
            });
        });

        function updateAssignModal(response) {
            const selectedVideosContainer = $('#selectedVideosContainer');
            const userContainer = $('#userContainer');
            selectedVideosContainer.empty();
            userContainer.empty();

            const videos = response.videos;
            const users = response.users;

            videos.forEach(function(video) {
                const videoItem = `
            <div class="col-md-6 col-sm-12 col-xs-12 videoContainer" data-video-id="${video.id}">
                <div class="round">
                    <input type="checkbox" checked class="selectButton" id="checkbox" disabled/>
                    <label class="selectCheckbox" for="checkbox"></label>
                </div>
                <div class="" style="padding:56.25% 0 0 0;position:relative;">
                    <iframe class="videoIframe" src="${video.url}"
                    frameborder="0"
                    allow="autoplay; fullscreen; picture-in-picture" allowfullscreen
                    style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Test"></iframe>
                </div>
                <h1 class="dashboard-name fs-20">${video.name}</h1>
            </div>`;

                selectedVideosContainer.append(videoItem);
            });

            if (users.length === 0) {
                const noUserMessage = `<div class="no-user">No user available</div>`;
                userContainer.append(noUserMessage);
            } else {
                users.forEach(function(user) {
                    const listItem = `
                <div class="py-1">
                    <li class="jhon-doe rectangle-div userListItem" style="cursor: pointer;" data-user-id="${user.id}">${user.name}</li>
                </div>`;
                    userContainer.append(listItem);
                });

                userContainer.find('li').on('click', function() {
                    $(this).toggleClass('background-active');
                });
            }
        }


        function SwalLoader() {
            Swal.fire({
                title: "Please wait...",
                html: "",
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                }
            })

        }

        $('#userContainer').on('click', '.userListItem', function() {
            const userId = $(this).data('user-id');
            // console.log(userId);
            if (selectedUsers.includes(userId)) {
                selectedUsers = selectedUsers.filter(id => id !== userId);
            } else {
                selectedUsers.push(userId);
            }
        });

        $('.assign-btn').on('click', function(event) {
            SwalLoader();
            event.preventDefault();

            const deadlineDate = $('input[type="date"]').val();
            const deadlineTime = $('input[type="time"]').val();
            const videoType = $('#assignModal').data('video-type');
            console.log(videoType);

            const selectedVideoUrls = selectedVideos.map(video => video.videoUrl);

            function fetchVideoDurations(videoUrls, callback) {
                const fetchPromises = [];

                videoUrls.forEach(videoUrl => {
                    const fetchPromise = new Promise((resolve, reject) => {
                        $.ajax({
                            url: "{{ route('get.video.duration') }}",
                            method: 'GET',
                            data: {
                                videoUrl: videoUrl
                            },
                            success: function(response) {
                                const durationInSeconds = response.duration;
                                resolve({
                                    videoUrl,
                                    durationInSeconds
                                });
                            },
                            error: function(error) {
                                console.error(
                                    'Error fetching video duration:',
                                    error);
                                reject(error);
                            }
                        });
                    });

                    fetchPromises.push(fetchPromise);
                });

                Promise.all(fetchPromises)
                    .then(results => {
                        $response = callback(results);
                        console.log($response);
                    })
                    .catch(error => {
                        console.error('Error fetching video durations:', error);
                    });
            }

            fetchVideoDurations(selectedVideoUrls, function(durations) {
                const payload = {
                    '_token': "{{ csrf_token() }}",
                    'videoIds': selectedVideos.map(video => video.videoId),
                    'userIds': selectedUsers,
                    'deadlineDate': deadlineDate,
                    'deadlineTime': deadlineTime,
                    'videoDurations': durations,
                    'videoType': videoType
                };

                $.ajax({
                    url: "{{ route('assign.videos') }}",
                    method: 'POST',
                    data: payload,
                    success: function(response) {
                        Swal.close();
                        if (response.status === true) {
                            const successMessage = response.message;

                            const storeIds = response.data;
                            const userNames = response.userNames;
                            let warningMessage = '';

                            Object.keys(storeIds).forEach(userId => {
                                const userStoreIds = storeIds[userId];
                                if (userStoreIds.length > 0) {
                                    const userName = userNames[userId];
                                    const videoIds = userStoreIds.join(
                                        ', ');
                                    warningMessage +=
                                        `<strong>${userName} is Already Assigned or Completed</strong><br>`;
                                }
                            });

                            if (warningMessage) {
                                Swal.fire({
                                    title: 'success',
                                    html: warningMessage,
                                    icon: 'success',
                                    confirmButtonText: 'OK',
                                }).then(() => {
                                    window.location.reload();
                                });
                                $('.assignModal').modal('hide');
                            } else {
                                Swal.fire({
                                    title: 'Success',
                                    text: successMessage,
                                    icon: 'success',
                                    confirmButtonText: 'OK',
                                }).then(() => {
                                    window.location.reload();
                                });
                                $('.assignModal').modal('hide');
                            }
                        } else {
                            if (response.status == false) {
                                Swal.fire({
                                    title: 'Error',
                                    text: response.message,
                                    icon: 'error',
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Failed to assign videos. Please try again.',
                                });
                            }
                        }
                    },
                    error: function(error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to assign videos. Please try again.',
                        });
                    }
                });

            });

        });

        $('#survey_form').on('submit', function(e) {
            SwalLoader();
            e.preventDefault();

            let formdata = $(this).serialize();
            console.log(formdata);

            $.ajax({
                type: 'POST',
                url: "{{ route('save.survey.form') }}",
                dataType: 'json',
                data: formdata,
                success: function(response) {
                    Swal.close();
                    if (response.status == true) {
                        Swal.fire('Success', response.message, 'success').then(() => {
                            window.location.reload();
                        });
                        $('.assignModal').modal('hide');
                    } else {
                        if ((response.error).length > 0) {

                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });

        })
    });
</script>
