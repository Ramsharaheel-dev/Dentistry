@extends ('layouts.cms_layout')

@section('head')
    <title>CMS UPLOAD VIDEOS &#8211; Dian</title>
@endsection

<style>
    .dropzone {
        border: 2px dashed #D6A858;
        padding: 20px;
        cursor: pointer;
        min-height: 250px;
        border-style: dashed;
        border-radius: 20px;
    }

    button:hover {
        cursor: pointer;
    }

    .d-files {
        color: #FFF;
        font-size: 25px;
        text-align: center;
        font-weight: 600;
        line-height: 40px;
        text-transform: capitalize;
    }

    .preview-container {
        margin-top: 20px;
    }

    .preview {
        position: relative;
        display: inline-block;
        margin: 10px;
    }

    .preview img {
        max-width: 100px;
        max-height: 100px;
    }

    .preview .delete-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: transparent;
        color: black;
        border: none;
        border-radius: 50%;
        cursor: pointer;
    }

    .custom-badge {
        font-size: 16px;
        color: wheat;
        margin-right: 10px;
        padding: 6px 32px;
    }

    .m-10 {
        margin: 10px 11px 0px 10px;
    }

    .white {
        color: white !important;
        font-weight: bold !important;
    }

    .white2 {
        color: white !important;
        font-weight: bold !important;
        font-size: 18px;
    }

    .your_perso1 {
        font-size: 32px !important;
    }

    .heading-color {
        font-size: 26px;
        font-weight: 600;
    }

    #new-hashtag-input,
    #save-hashtag-btn {
        display: none;
        margin-top: 10px;
    }

    #save-hashtag-btn {
        margin-left: 10px;
    }
</style>

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="card-header border-0 pb-0 flex-wrap">
                <div class="products mb-3 anek-telugu">
                    <div>
                        <p class="your_perso1">Upload Videos</p>
                    </div>
                </div>
            </div>
            <form action="{{ route('upload-vimeo') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="bootstrap-badge">
                            <span class="badge drop-files white">Select Page</span>
                            <span class="badge badge-primary custom-badge" data-category="reels">Videos</span>
                            <span class="badge badge-primary custom-badge" data-category="podcasts">Podcast &
                                Webinars</span>
                            <span class="badge badge-primary custom-badge" data-category="businessAndFinances">Business &
                                Finance</span>
                            <span class="badge badge-primary custom-badge"
                                data-category="healthAndWellbeing">Wellbeing</span>
                            <span class="badge badge-primary custom-badge" data-category="assist-app">Explainer
                                Videos</span>
                            <span class="badge badge-primary custom-badge" data-category="students">Students</span>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <div class="bootstrap-badge" id="category-content">
                            {{-- Categories will be dynamically loaded here --}}
                        </div>
                        <input type="hidden" id="selected-page" name="selected_page">
                        <input type="hidden" id="selected-category-id" name="selected_category_id">
                    </div>
                </div>

                <div class="m-4">
                    <div class="row">
                        <div class="col-md-6">
                            <Label class="labeling white2 anek-telegu">Title</Label>
                            <div class="mb-3">
                                <input type="text" class="form-control1 input-default" name="title"
                                    placeholder="Title">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <Label class="labeling white2 anek-telegu">Description</Label>
                                <input type="text" class="form-control1 input-default" name="description"
                                    placeholder="Description">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <h1 class="heading-color">Upload Video Thumbnail</h1>
                    <div class="button_outer image-upload">
                        <div class="btn_upload">
                            <input type="file" id="upload_image" name="thumbnail" accept="image/*">
                            Upload Thumbnail
                        </div>
                        <div class="processing_bar"></div>
                        <div class="success_box"></div>
                    </div>
                    <div class="error_msg image-error"></div>
                    <div class="uploaded_file_view image-view" id="image_view">
                        <span class="file_remove image-remove">X</span>
                    </div>
                </div>

                <div class="panel">
                    <h1 class="heading-color">Upload Video</h1>
                    <div class="button_outer video-upload">
                        <div class="btn_upload">
                            <input type="file" id="upload_video" name="video" accept="video/*">
                            Upload Video
                        </div>
                        <div class="processing_bar"></div>
                        <div class="success_box"></div>
                    </div>
                    <div class="error_msg video-error"></div>
                    <div class="uploaded_file_view video-view" id="video_view">
                        <span class="file_remove video-remove">X</span>
                    </div>
                </div>

                <div class="row py-4 text-left">
                    <div class="col-md-12">
                        <button type="submit" class="btn17 anek-telugu"> Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.custom-badge').on('click', function() {
                var category = $(this).data('category');

                // Unselect previously selected badge
                $('.custom-badge').removeClass('selected');
                $(this).addClass('selected');

                $('#selected-page').val(category);

                if (category === 'students') {
                    // Handle the "Students" category with predefined hashtags
                    updateCategoryContent([{
                            id: 32,
                            nameOfHashtag: 'Videos'
                        },
                        {
                            id: 61,
                            nameOfHashtag: 'Wellbeing'
                        }
                    ]);
                } else if (category == 'assist-app') {
                    $('#category-content').hide();
                    return null;
                } else {
                    // Fetch categories dynamically for other categories
                    fetchCategories(category);
                }
            });

            // Event listener for "Add Hashtag" button
            $(document).on('click', '#add-hashtags', function() {
                $('#new-hashtag-input').show().focus(); // Show the input field
                $('#save-hashtag-btn').show(); // Show the save button
            });

            // Event listener for saving new hashtag
            $(document).on('click', '#save-hashtag-btn', function() {
                var newHashtag = $('#new-hashtag-input').val().trim();
                var selectedPage = $('#selected-page').val();

                if (newHashtag) {
                    // Make AJAX request to save the new hashtag
                    $.ajax({
                        url: "{{ route('save.hashtags') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            hashtag: newHashtag,
                            page: selectedPage
                        },
                        success: function(response) {
                            if (response.status === true) {
                                // Add the new hashtag as a badge right before the "Add Hashtag" button
                                var newBadge = $(
                                    '<span class="badge badge-primary m-10"></span>').text(
                                    newHashtag);

                                // Add click event to select the new badge
                                newBadge.on('click', function() {
                                    $('#category-content').find('.badge').removeClass(
                                        'selected');
                                    $(this).addClass('selected');
                                    $('#selected-category-id').val(response
                                        .id
                                    ); // Assume the new category ID is returned in response
                                });

                                $('#add-hashtags').before(newBadge);

                                // Clear and hide the input field and save button
                                $('#new-hashtag-input').val('').hide();
                                $('#save-hashtag-btn').hide();
                            } else {
                                alert('Error saving hashtag: ' + response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Error saving hashtag: ' + error);
                        }
                    });
                } else {
                    $('#new-hashtag-input').fadeOut();
                    $('#save-hashtag-btn').fadeOut();
                }
            });
        });

        function fetchCategories(category) {
            var contentDiv = $('#category-content');

            // Fade out the content before making an AJAX request
            contentDiv.fadeOut(300, function() {
                $.ajax({
                    url: "{{ route('get.hashtags', ':category') }}".replace(':category', category),
                    method: 'GET',
                    success: function(data) {
                        updateCategoryContent(data);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching categories:', error);
                        $('#category-content').html('<p>Error fetching categories.</p>').fadeIn(300);
                    }
                });
            });
        }

        function updateCategoryContent(data) {
            var contentDiv = $('#category-content');

            // Fade out the current content
            contentDiv.fadeOut(300, function() {
                contentDiv.empty(); // Clear previous content

                if (data.length === 0) {
                    contentDiv.append('');
                    contentDiv.fadeIn(300); // Fade in after clearing content
                    return;
                }

                // Add the static "Select Category" badge
                var selectCategoryBadge = $('<span class="badge drop-files white">Select Category</span>');
                contentDiv.append(selectCategoryBadge);

                // Iterate over each item and create a badge
                $.each(data, function(index, item) {
                    var badge = $('<span class="badge badge-primary m-10"></span>').text(item
                        .nameOfHashtag);

                    badge.on('click', function() {
                        contentDiv.find('.badge').removeClass('selected');
                        $(this).addClass('selected');

                        $('#selected-category-id').val(item.id);
                    });

                    contentDiv.append(badge);
                });

                // Add the "Add Hashtag" button
                var addHashtagBtn = $(
                    '<span id="add-hashtags" class="badge badge-secondary m-10 white">+ Add Hashtag</span>');
                contentDiv.append(addHashtagBtn);

                // Create a row for the input and button
                var rowDiv = $('<div class="row"></div>');

                // Add the input field (6 columns)
                var hashtagInputCol = $('<div class="col-md-4"></div>').append(
                    $(
                        '<input type="text" id="new-hashtag-input" class="form-control1 input-default m-10" placeholder="Enter new hashtag">'
                    )
                );

                // Add the save button (2 columns)
                var saveHashtagBtnCol = $('<div class="col-md-2"></div>').append(
                    $('<button type="button" id="save-hashtag-btn" class="btn btn-primary m-10">Save</button>')
                );

                // Append the columns to the row
                rowDiv.append(hashtagInputCol);
                rowDiv.append(saveHashtagBtnCol);

                // Append the row to the content div
                contentDiv.append(rowDiv);

                // Hide input field and save button initially
                $('#new-hashtag-input').hide();
                $('#save-hashtag-btn').hide();

                // Fade in after updating content
                contentDiv.fadeIn(300);
            });
        }
    </script>



    <script>
        $(document).ready(function() {
            var imageUpload = $("#upload_image"),
                imageOuter = $(".image-upload");

            imageUpload.on("change", function(e) {
                var ext = imageUpload.val().split('.').pop().toLowerCase();
                var file = e.target.files[0];

                if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    $(".image-error").text("Not a valid image format...");
                    return;
                }

                $(".image-error").text("");
                imageOuter.addClass("file_uploading");

                var uploadedFile = URL.createObjectURL(file);

                setTimeout(function() {
                    $("#image_view").empty().append('<img src="' + uploadedFile +
                        '" style="max-width: 100%;" /><span class="file_remove image-remove">X</span>'
                    ).addClass("show");
                    imageOuter.addClass("file_uploaded");
                }, 3000);
            });

            $(document).on("click", ".image-remove", function() {
                $("#image_view").removeClass("show").empty();
                imageOuter.removeClass("file_uploading").removeClass("file_uploaded");
                $("#upload_image").val(''); // Clear file input
            });

            var videoUpload = $("#upload_video"),
                videoOuter = $(".video-upload");

            videoUpload.on("change", function(e) {
                var ext = videoUpload.val().split('.').pop().toLowerCase();
                var file = e.target.files[0];

                if ($.inArray(ext, ['mp4', 'avi', 'mov']) == -1) {
                    $(".video-error").text("Not a valid video format...");
                    return;
                }

                $(".video-error").text("");
                videoOuter.addClass("file_uploading");

                var uploadedFile = URL.createObjectURL(file);

                setTimeout(function() {
                    $("#video_view").empty().append('<video controls src="' + uploadedFile +
                        '" style="max-width: 100%;"></video><span class="file_remove video-remove">X</span>'
                    ).addClass("show");
                    videoOuter.addClass("file_uploaded");
                }, 3000);
            });

            $(document).on("click", ".video-remove", function() {
                $("#video_view").removeClass("show").empty();
                videoOuter.removeClass("file_uploading").removeClass("file_uploaded");
                $("#upload_video").val(''); // Clear file input
            });
        });
    </script>
@endsection

@section('customjs')
    <script>
        $("form").on("submit", function(e) {
            e.preventDefault();

            var imageUpload = $("#upload_image")[0].files.length === 0;
            var videoUpload = $("#upload_video")[0].files.length === 0;

            // Check if image or video is not selected
            if (imageUpload || videoUpload) {
                Swal.fire({
                    title: 'Error',
                    text: 'Please select both an image and a video before submitting.',
                    icon: 'error'
                });
                return; // Prevent form submission
            }

            // Show SweetAlert loading indicator
            Swal.fire({
                title: 'Uploading...',
                text: 'Please wait while your files are being uploaded.',
                icon: 'info',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            var formData = new FormData(this);

            // Submit the form using AJAX
            $.ajax({
                url: $(this).attr('action'), // Form action URL
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === true) {
                        Swal.close();
                        Swal.fire('Success', response.message, 'success').then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.close();
                        Swal.fire({
                            title: 'Error',
                            text: response.message ||
                                'There was an error uploading your files. Please try again.',
                            icon: 'error'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.close();
                    Swal.fire({
                        title: 'Error',
                        text: 'There was an error uploading your files. Please try again.',
                        icon: 'error'
                    });
                }
            });
        });
    </script>
@endsection
