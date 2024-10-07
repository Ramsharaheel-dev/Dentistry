@extends ('layouts.cms_layout')

@section('head')
    <title>CMS BLOG UPLOAD &#8211; DIAN</title>
@endsection

<style>
    .dropzone {
        border: 2px dashed #D6A858;
        padding: 20px;
        cursor: pointer;
        min-height: 250px;
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

    .white {
        color: white !important;
        font-weight: bold !important;
    }

    .your_perso1 {
        font-size: 32px !important;
    }

    .heading-color {
        font-size: 26px;
        font-weight: 600;
    }

    .labeling {
        color: #B6B0B0;
        font-size: 18px;
        font-weight: 500 !important;
        padding-top: 0px;
        font-family: Arial, Helvetica, sans-serif;
    }

    button {
        background-color: #D9AA59;
        border: none;
        padding: 11px 44px;
        cursor: pointer;
        color: white;
        font-size: 20px !important;
    }

    button.new {
        background-color: #D9AA59;
        border: none;
        padding: 11px 21px;
        cursor: pointer;
        color: white;
        font-size: 18px !important;
    }

    .custom-button {
        display: flex !important;
        flex-direction: row-reverse;
    }

    .form-control {
        background: #102335 !important;
        padding: 14px 1rem !important;
    }

    .thumbnail-style {
        text-align: center;
    }

    .thumbnail-style h1 {
        color: #B6B0B0 !important;
        font-size: 26px;
    }

    .button_outer.change {
        top: 17px;
        left: 24px;
    }
</style>

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="card-header border-0 pb-0 flex-wrap">
                <div class="products mb-3 anek-telugu">
                    <div>
                        <p class="your_perso1">Blog Upload</p>
                    </div>
                </div>
            </div>
            <form id="blog-form" action="{{ route('cms.blog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Step 1 -->
                <div class="step" id="step-1">
                    <div class="row mt-3">
                        <div class="col-md-12 thumbnail-style">
                            <h1 for="image" class="labeling" style="color: #B6B0B0 !important">Upload Blog Thumbnail</h1>
                            <div class="button_outer image-upload upload_image">
                                <div class="btn_upload">
                                    <input type="file" class="upload_image" name="thumbnail" accept="image/*">
                                    Upload
                                </div>
                                <div class="processing_bar"></div>
                                <div class="success_box"></div>
                            </div>
                            <div class="error_msg image-error"></div>
                            <div class="uploaded_file_view image-view" id="image_view_${contentIndex}">
                                <span class="file_remove image-remove">X</span>
                            </div>
                        </div>
                    </div>
                    <div class="row py-4 text-left">
                        <div class="col-md-12">
                            <button type="button" id="nextBtn1" class="next-btn">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="step" id="step-2" style="display:none;">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="title" class="labeling">Title</label>
                            <input type="text" class="form-control" placeholder="Title" name="title" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="shortTitle" class="labeling">Short Title</label>
                            <input type="text" class="form-control" placeholder="ShortTitle" name="shortTitle" required>
                        </div>
                    </div>
                    <div class="row mt-3 ">
                        <div class="col-md-12">
                            <label for="publisher" class="labeling">Publisher</label>
                            <input type="text" class="form-control" placeholder="Publisher" name="publisher" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="shortDescription" class="labeling">Short Description</label>
                            <textarea class="form-control" placeholder="Short Description" name="shortDescription" required></textarea>
                        </div>
                    </div>
                    <div class="row py-4 custom-button">
                        <div class="col-md-2">
                            <button type="button" id="prevBtn1" class="new">Previous</button>
                            <button type="button" id="nextBtn2" class="new">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="step" id="step-3" style="display: none">
                    <div id="content-container">
                        <div class="content-block">
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label for="heading" class="labeling">Heading</label>
                                    <input type="text" placeholder="Heading" class="form-control"
                                        name="content[0][heading]">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label for="description" class="labeling">Description</label>
                                    <textarea class="form-control" placeholder="Description" name="content[0][description]" required></textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label for="image" class="labeling">Upload Image</label>
                                    <div class="button_outer change image-upload">
                                        <div class="btn_upload">
                                            <input type="file" class="upload_image" name="content[0][image]"
                                                accept="image/*">
                                            Upload
                                        </div>
                                        <div class="processing_bar"></div>
                                        <div class="success_box"></div>
                                    </div>
                                    <div class="error_msg image-error"></div>
                                    <div class="uploaded_file_view image-view" id="image_view_${contentIndex}">
                                        <span class="file_remove image-remove">X</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add-content" class=" mt-3">Add More Content</button>
                    <div class="row py-4 text-left">
                        <div class="col-md-12">
                            <button type="button" id="prevBtn2">Previous</button>
                            <button type="button" id="submit-blog">Submit Blog</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('customjs')
    <script>
        $(document).ready(function() {
            // Step Transitions
            $('#nextBtn1').on('click', function() {
                $('#step-1').hide();
                $('#step-2').show();
            });

            $('#nextBtn2').on('click', function() {
                $('#step-2').hide();
                $('#step-3').show();
            });

            $('#prevBtn1').on('click', function() {
                $('#step-2').hide();
                $('#step-1').show();
            });

            $('#prevBtn2').on('click', function() {
                $('#step-3').hide();
                $('#step-2').show();
            });

            // Adding Dynamic Content Blocks
            let contentIndex = 1;

            $(document).on('click', '#add-content', function() {
                let newContentBlock = `
            <div class="content-block" data-content-index="${contentIndex}">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="heading" class="labeling">Heading</label>
                        <input type="text" placeholder="Heading" class="form-control" name="content[${contentIndex}][heading]">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="description" class="labeling">Description</label>
                        <textarea class="form-control" placeholder="Description" name="content[${contentIndex}][description]" required></textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="image" class="labeling">Upload Image</label>
                        <div class="button_outer change image-upload">
                            <div class="btn_upload">
                                <input type="file" class="upload_image" name="content[${contentIndex}][image]" accept="image/*">
                                Upload
                            </div>
                            <div class="processing_bar"></div>
                            <div class="success_box"></div>
                        </div>
                        <div class="error_msg image-error"></div>
                        <div class="uploaded_file_view image-view" id="image_view_${contentIndex}">
                            <span class="file_remove image-remove">X</span>
                        </div>
                    </div>
                </div>
                <button type="button" class="remove-content mt-3">Remove</button>
            </div>`;

                $('#content-container').append(newContentBlock);
                contentIndex++;
            });

            // Removing Content Blocks
            $(document).on('click', '.remove-content', function() {
                $(this).closest('.content-block').remove();
            });

            // *** Handle Static Image Uploads (Thumbnail and Step 3) ***
            // This is for static image uploads outside the dynamically added content blocks.
            function handleImageUpload(fileInput) {
                let imageView = fileInput.closest('.image-upload').siblings('.image-view');
                let file = fileInput[0].files[0];
                let ext = fileInput.val().split('.').pop().toLowerCase();

                if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    imageView.siblings('.image-error').text("Not a valid image format...");
                    return;
                }

                imageView.siblings('.image-error').text("");
                let uploadedFile = URL.createObjectURL(file);

                imageView.empty().append('<img src="' + uploadedFile +
                    '" style="max-width: 100%;" /><span class="file_remove image-remove">X</span>').addClass(
                    "show");
            }

            // Bind the static image upload handlers
            $('.upload_image').on('change', function(e) {
                handleImageUpload($(this));
            });

            // *** Handle Dynamic Image Uploads ***
            // This is for dynamically added content blocks.
            $(document).on('change', '.upload_image', function(e) {
                handleImageUpload($(this));
            });

            // Remove Uploaded Image Preview
            $(document).on('click', '.image-remove', function() {
                let contentBlock = $(this).closest('.content-block');
                let imageView = $(this).closest('.image-view');
                imageView.removeClass("show").empty();
                contentBlock.find('.upload_image').val(''); // Clear file input
            });

            // Blog Submission
            $('#submit-blog').on('click', function() {
                let formData = new FormData($('#blog-form')[0]);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to submit the blog?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, submit it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Uploading...',
                            text: 'Please wait while your blog is being uploaded.',
                            icon: 'info',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            didOpen: () => Swal.showLoading()
                        });

                        // Submit Form via AJAX
                        $.ajax({
                            url: $('#blog-form').attr('action'),
                            method: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Your blog has been submitted successfully!',
                                    icon: 'success'
                                }).then(() => window.location.reload());
                            },
                            error: function(xhr) {
                                let errorMsg =
                                    'There was an error submitting your blog. Please try again.';
                                if (xhr.responseJSON && xhr.responseJSON.errors) {
                                    errorMsg = Object.values(xhr.responseJSON.errors)
                                        .map(err => err.join(' ')).join('<br>');
                                }
                                Swal.fire({
                                    title: 'Error',
                                    html: errorMsg,
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
