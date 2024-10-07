@extends ('layouts.cms_layout')

@section('head')
    <title>CMS UPLOAD IMAGES &#8211; Dian</title>
@endsection

<script src="{{ asset('js/dropzone.min.js') }}"></script>
<script src="{{ asset('js/file-upload.js') }}"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css"
    integrity="sha512-5T9G1m2Q8ZSBbA2tzt5RmxmFmpyxkIq8dQFSVxHvLTrdpI7A5coBY0pZB3H5E75UjSdpw/f/GRlQauDhU0X5Kw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

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

    /* .dropzone:hover {
    background-color: #f0f0f0;
} */

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
</style>



@section('content')
    <div class="content-body">

        <div class="container-fluid">

            <div class="card-header border-0 pb-0 flex-wrap">
                <div class="products mb-3 anek-telugu">
                    <div>
                        <p class="your_perso1">Upload Images</h6>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="bootstrap-badge">
                        {{-- <p></p> --}}
                        <span class="badge drop-files">Select Page</span>
                        <span class="badge  badge-primary1">Student</span>


                    </div>

                </div>
                <br>
                <br>
                </br>

                <div class="col-md-12">
                    <div class="bootstrap-badge">
                        {{-- <p></p> --}}
                        <span class="badge drop-files">Select Category</span>
                        <span class="badge badge-primary">Images</span>
                        <span class="badge badge-primary">Videos</span>
                        <span class="badge badge-primary">Past Papers</span>
                        <span class="badge badge-primary">Lecture Notes</span>
                        <span class="badge badge-primary">Wellbeing</span>

                    </div>

                </div>

            </div>

            <div class="box">
                <div class="upload-box">
                    <p class="videos">Your Videos Upload</p>
                    {{-- <p class="drop-files">Open source library that provides drag-drop Videos uploads & previews.</p>
                <p class="videos">Preview</p>
                <img class="" src="{{ asset('images/cms/line.png') }}"> --}}
                    <div class="container">
                        <div id="dropzone" class="dropzone">
                            <div class="dz-message needsclick">
                                <img class="" src="{{ asset('images/cms/Vector.png') }}">
                                <br>
                                <br>
                                <div class="d-files"> Drag and drop an image here or click to select
                                    <br>
                                    <div class="drop-files">Drop files here or click to upload.</div>
                                    {{-- <span class="text-muted font-13 text-center"></span> --}}
                                </div>
                            </div>

                        </div>
                        <div id="preview-container" class="preview-container"></div>
                    </div>
                </div>
            </div>

            <div class="row py-4 text-left">
                <div class="col-md-12">
                    <button type="submit" class="btn2 anek-telugu mr-13">Cancel</button>
                    <a href="">
                        <button type="button" class="btn17 anek-telugu"> Save</button> </a>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropzone = document.getElementById('dropzone');
            const previewContainer = document.getElementById('preview-container');

            dropzone.addEventListener('dragover', function(e) {
                e.preventDefault();
                dropzone.style.backgroundColor = '#f0f0f0';
            });

            dropzone.addEventListener('dragleave', function(e) {
                e.preventDefault();
                dropzone.style.backgroundColor = '#fff';
            });

            dropzone.addEventListener('drop', function(e) {
                e.preventDefault();
                dropzone.style.backgroundColor = '#fff';
                handleFiles(e.dataTransfer.files);
            });

            dropzone.addEventListener('click', function() {
                const fileInput = document.createElement('input');
                fileInput.type = 'file';
                fileInput.accept = 'image/*';
                fileInput.multiple = true;
                fileInput.addEventListener('change', function(e) {
                    handleFiles(e.target.files);
                });
                fileInput.click();
            });

            function handleFiles(files) {
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        const preview = document.createElement('div');
                        preview.classList.add('preview');
                        const deleteBtn = document.createElement('button');
                        deleteBtn.classList.add('delete-btn');
                        deleteBtn.textContent = 'X';
                        deleteBtn.addEventListener('click', function() {
                            previewContainer.removeChild(preview);
                        });
                        preview.appendChild(img);
                        preview.appendChild(deleteBtn);
                        previewContainer.appendChild(preview);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });
    </script>
    {{--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js" integrity="sha512-2tB+xBqB8HBO5zPdoVE9CPtJ/RB8AKur9ni3bm8A6l5scNEq5NRRC5GuyaAr6eKmQoRQ93gUM3zN1Rk6GHngQw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- File upload component JS -->
    <script src="https://yourdomain.com/assets/js/ui/component.fileupload.js"></script> --}}
@endsection
