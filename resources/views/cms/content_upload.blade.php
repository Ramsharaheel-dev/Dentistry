@extends ('layouts.cms_layout')

@section('head')
    <title>CMS CONTENT UPLOAD &#8211; DIAN</title>
@endsection

<style>
    .dropzone {
        border: 2px dashed #D6A858;
        padding: 20px;
        cursor: pointer;
        min-height: 250px;
        border-style: dashed;
        /* margin: 2rem 0; */
        border-radius: 20px;
    }

    button:hover {
        cursor: pointer;
    }

    .d-files {
        color: #FFF;
        /* font-family: "Anek Telugu"; */
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

    .name-div {
        display: none;
    }
</style>

@section('content')
    <div class="content-body">

        <div class="container-fluid">

            <div class="card-header border-0 pb-0 flex-wrap">
                <div class="products mb-3 anek-telugu">
                    <div>
                        <p class="your_perso1">Content Upload</h6>
                    </div>
                </div>
            </div>
            <form action="{{ route('cms.content.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="bootstrap-badge">
                            <span class="badge drop-files white">Select Page</span>
                            <span class="badge badge-primary custom-badge" data-category="students">Students</span>
                            <span class="badge badge-primary custom-badge" data-category="guidelines">Guidelines</span>
                            <span class="badge badge-primary custom-badge" data-category="courses">Courses</span>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <div class="bootstrap-badge" id="category-content">
                            {{-- cATEGORIES COME DYNAMICALLY HERE FROM JAVASCRIPT --}}
                        </div>
                        <input type="hidden" id="selected-page" name="selected_page">
                        <input type="hidden" id="selected-category-id" name="selected_category_id">

                    </div>

                </div>
                <div class="m-4 name-div">
                    <div class="row">
                        <div class="col-md-6">
                            <Label class="labeling white2 anek-telegu">Content Name</Label>
                            <div class="mb-3">
                                <input type="text" class="form-control1 input-default" name="name" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <Label class="labeling white2 anek-telegu">Url</Label>
                            <div class="mb-3">
                                <input type="text" class="form-control1 input-default" name="url" placeholder="URL">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <h1 class="heading-color">Upload Image</h1>
                    <div class="button_outer image-upload">
                        <div class="btn_upload">
                            <input type="file" id="upload_image" name="thumbnail" accept="image/*">
                            Upload Image
                        </div>
                        <div class="processing_bar"></div>
                        <div class="success_box"></div>
                    </div>
                    <div class="error_msg image-error"></div>
                    <div class="uploaded_file_view image-view" id="image_view">
                        <span class="file_remove image-remove">X</span>
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

                // Show or hide the name-div based on the selected category
                if (category === 'guidelines' || category === 'students') {
                    fetchCategories(category);
                } else {
                    fetchCategories(category);
                    $('.name-div').fadeOut(); // Hide the title section smoothly
                }
            });

            function fetchCategories(category) {
                var contentDiv = $('#category-content');

                // Fade out the content before making an AJAX request
                contentDiv.fadeOut(500, function() {
                    $.ajax({
                        url: '{{ route('get.hashtags', ':category') }}'.replace(':category',
                            category),
                        method: 'GET',
                        success: function(data) {
                            // Filter out "Videos" and "Wellbeing" categories
                            if (category === 'students') {
                                data = data.filter(function(item) {
                                    return item.nameOfHashtag !== 'Videos' && item
                                        .nameOfHashtag !== 'Wellbeing';
                                });
                            }

                            updateCategoryContent(data);

                            // Fade in the content after it has been updated
                            contentDiv.fadeIn(500);
                            $('.name-div').fadeIn(); // Show the title section smoothly
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching categories:', error);
                            contentDiv.html('<p>Error fetching categories.</p>').fadeIn(300);
                        }
                    });
                });
            }

            function updateCategoryContent(data) {
                var contentDiv = $('#category-content');
                contentDiv.empty();

                if (data.length === 0) {
                    contentDiv.append('');
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

                        // Show or hide the name-div based on the selected category under "Students"
                        if (item.nameOfHashtag === 'Images') {
                            $('.name-div').fadeOut();
                        } else {
                            $('.name-div').fadeIn();
                        }
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

                // Event listener for "Add Hashtag" button
                $(document).on('click', '#add-hashtags', function() {
                    $('#new-hashtag-input').show().focus(); // Show the input field
                    $('#save-hashtag-btn').show(); // Show the save button
                });

                // Event listener for saving new hashtag
                $(document).on('click', '#save-hashtag-btn', function() {
                    var newHashtag = $('#new-hashtag-input').val().trim();
                    var selectedPage = $('#selected-page').val();

                    // Prevent multiple submissions
                    if ($(this).data('submitted')) {
                        return;
                    }
                    $(this).data('submitted', true);

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
                                            '<span class="badge badge-primary m-10"></span>')
                                        .text(newHashtag);

                                    // Add click event to select the new badge
                                    newBadge.on('click', function() {
                                        $('#category-content').find('.badge')
                                            .removeClass('selected');
                                        $(this).addClass('selected');
                                        $('#selected-category-id').val(response
                                            .category_id
                                            ); // Assume the new category ID is returned in response

                                        // Show or hide the name-div based on the selected category
                                        if (newHashtag === 'Images') {
                                            $('.name-div').fadeOut();
                                        } else {
                                            $('.name-div').fadeIn();
                                        }
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
                            },
                            complete: function() {
                                // Allow further submissions after completion
                                $('#save-hashtag-btn').data('submitted', false);
                            }
                        });
                    } else {
                        $('#new-hashtag-input').fadeOut();
                        $('#save-hashtag-btn').fadeOut();
                        // Allow further submissions
                        $('#save-hashtag-btn').data('submitted', false);
                    }
                });

            }
        });
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
            var selectedPage = $('#selected-page').val();
            var selectedCategory = $('#selected-category-id').val();

            // Check if page is not selected
            if (!selectedPage) {
                Swal.fire({
                    title: 'Error',
                    text: 'Please select a page before submitting.',
                    icon: 'error'
                });
                return; // Prevent form submission
            }

            // Check if category is not selected, except for "Courses" page
            if (selectedPage !== 'courses' && !selectedCategory) {
                Swal.fire({
                    title: 'Error',
                    text: 'Please select a category before submitting.',
                    icon: 'error'
                });
                return; // Prevent form submission
            }

            // Check if image or video is not selected
            if (imageUpload) {
                Swal.fire({
                    title: 'Error',
                    text: 'Please select an image before submitting.',
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
                    // Assuming the response contains a "success" field
                    if (response.status === true) {
                        // Close the SweetAlert loading indicator
                        Swal.close();
                        Swal.fire('Success', response.message, 'success').then(() => {
                            window.location.reload();
                        });
                    } else {
                        // Close the SweetAlert loading indicator
                        Swal.close();

                        // Show error message
                        Swal.fire({
                            title: 'Error',
                            text: response.message ||
                                'There was an error uploading your files. Please try again.',
                            icon: 'error'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Close the SweetAlert loading indicator
                    Swal.close();

                    // Show error message
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
