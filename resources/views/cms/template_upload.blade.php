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
        border-radius: 20px;
    }

    button:hover {
        cursor: pointer;
    }

    button {
        background-color: #D9AA59;
        border: none;
        padding: 12px 20px;
        cursor: pointer;
        border-radius: 10px !important;
        color: white;
        font-size: 18px !important;
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

    button.new {
        background-color: #D9AA59;
        border: none;
        padding: 11px 21px;
        cursor: pointer;
        color: white;
        font-size: 16px !important;
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
<style>
    .hidden-section {
        display: none;
    }

    .w-6 {
        width: 3%;
    }

    .tr-3 {
        cursor: pointer;
    }

    .oppoortunity1 {
        color: #958080;
        font-size: 16px;
        font-weight: 400;
        width: 25%;
        background: #CED4DA;
    }

    .selected {
        background-color: #cce5ff;
        /* Change this to your desired background color */
    }

    .ml-20 {
        margin-left: 20px;
    }

    .display-none {
        display: none;
    }

    .pl-20 {
        padding-left: 20px;
    }

    .dynamicFieldPadding {
        padding: 0.25rem 1rem;
    }

    /* .card-body1.question {
        background-color: #E9E9E9;
        margin: 0px 18px 3px;
        border: 1px solid #CFCFCF;

    } */

    /* .bg-custom {
        background-color: #F3F3F3;
    } */

    .form-custom-padding {
        padding: 20px 18px 4px;
    }

    .q-padding {
        margin: 10px;

    }

    .card.bg-custom {
        box-shadow: none;
    }

    .br-50 {
        border-radius: 50%;
    }

    .active {
        background-color: #133386 !important;
        color: #fff !important;
        transition: .2s linear;
    }

    .mr-16 {
        margin-right: 16px;
    }

    .deleteDynamicSection {
        display: flex;
        justify-content: end;
    }

    .deleteDynamicSection i {
        color: red;
    }

    .qualify h4 {
        font-size: 26px;
        font-weight: bold;
        padding: 12px 0px;
    }

    .qualify input {
        margin-bottom: 10px;
    }

    .card-body1 {
        background-color: #2F4A64;
        padding: 30px;
        border-radius: 20px;
    }

    .addDynamicSection {
        cursor: pointer;
        background-color: #091A29;
        width: 100%;
        border-radius: 20px;
        padding: 8rem 26px;
        display: flex;
        font-size: 22px;
        justify-content: center;
        color: #6F6F6F;
        border: 2px dashed #D6A858;
    }

    button.btn-5 {
        background-color: #091A29;

    }
</style>

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="card-header border-0 pb-0 flex-wrap">
                <div class="products mb-3 anek-telugu">
                    <div>
                        <p class="your_perso1">Template Upload</p>
                    </div>
                </div>
            </div>
            <form method="POST" id="template-form" action="{{ route('cms.template.store') }}">
                @csrf
                <section class="step" id="step-1">
                    <div class="row mt-3">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label for="title" class="labeling">Template Name</label>
                                <input type="text" class="form-control" placeholder="Template Name"
                                    name="template_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row py-4 text-left">
                        <div class="col-md-12">
                            <button type="button" id="nextBtn1" class="next-btn">Next</button>
                        </div>
                    </div>
                </section>
                <section class="content" id="step-2" style="display: none;">
                    <div class="col-md-12">

                        <div id="dynamicFieldSection" class="dynamicFieldSection">
                            <!-- Dynamic Section Added Here -->
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div style="cursor: pointer;" class="div2 addDynamicSection">
                                    + Add New Section
                                </div>
                            </div>
                        </div>
                        <div class="row py-4 custom-button">
                            <div class="col-md-2">
                                <button type="button" id="prevBtn1" class="new">Previous</button>
                                <button type="button" id="submit-template">Submit</button>
                            </div>
                        </div>

                    </div>
                </section>
            </form>
        </div>
    </div>
@endsection
@section('customjs')
    <script>
        $(document).ready(function() {
            // Handle next and previous buttons
            $('#nextBtn1').on('click', function() {
                var templateName = $('input[name="template_name"]')
            .val(); // Get the value of the template_name input

                if (!templateName) { // Check if the template_name input is empty
                    Swal.fire({
                        title: 'Error',
                        text: 'Template name is required before proceeding to the next step.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                } else {
                    $('#step-1').hide();
                    $('#step-2').show();
                }
            });

            $('#prevBtn1').on('click', function() {
                $('#step-2').hide();
                $('#step-1').show();
            });

            var dynamicFieldCounter = 1;
            var sectionCounters = {};

            // Initialize section counters for dynamic fields
            $('.question').each(function(index) {
                sectionCounters[index] = 1;
            });

            // Handle file input changes
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            // Handle removing a dynamic field
            $(document).on('click', '.removeDynamicField', function() {
                $(this).closest('.row').remove();
            });

            // Handle adding a new dynamic section
            $(document).on('click', '.addDynamicSection', function() {
                addDynamicSection();
            });

            // Handle deleting a dynamic section
            $(document).on('click', '.deleteDynamicSection', function() {
                var sectionID = $(this).data('section');
                $('#section_' + sectionID).remove();
            });

            // Handle adding a dynamic field (heading)
            $(document).on('click', '.addDynamicField', function() {
                var sectionID = $(this).attr('data-section');
                var container = $(this).closest('.question').find('.dynamicFieldContainer');
                addDynamicField(container, sectionID);
            });

            // Handle deleting a dynamic field (heading)
            $(document).on('click', '.deleteDynamicField', function() {
                var sectionID = $(this).data('section');
                var questionCounter = $(this).data('field');
                $('#section_' + sectionID + '[data-field="' + questionCounter + '"]').remove();
            });

            // Function to add a dynamic field (heading)
            function addDynamicField(container, sectionID) {
                var questionCounter = sectionCounters[parseInt(sectionID)]++;

                var fieldHTML = `
        <div class="dynamicField row my-3 heading" id="section_${sectionID}" data-field="${questionCounter}">
            <label for="jms_question" class="mb-2 white">Heading - ${questionCounter}</label>
            <div class="col-md-12">
                <input type="text" class="form-control1 questionField heading-title" name="headings[${sectionID}][]" placeholder="Heading" required>
                <div class="my-3">
                    <p class="mb-2">Select Response Type</p>
                    <button type="button" class="btn btn-5 input_type heading_input_type content-type" value="multiple_options">Multiple Options</button>
                    <button type="button" class="btn btn-5 input_type heading_input_type content-type" value="InputText">Text Input</button>
                    <button type="button" class="btn btn-5 input_type heading_input_type content-type" value="longText">Long Text</button>
                    <button type="button" class="btn btn-5 input_type heading_input_type content-type" value="no_content">No Content</button>
                </div>
                <div class="heading_responseContainer"></div>
                <div class="subheadingContainer"></div>
                <button type="button" class="addSubheading" data-section="${sectionID}" data-field="${questionCounter}">Add Subheading</button>
                <button type="button" class="deleteDynamicField" data-section="${sectionID}" data-field="${questionCounter}">Remove Heading</button>
            </div>
        </div>`;
                container.append(fieldHTML);
            }

            // Function to add a dynamic section
            function addDynamicSection() {
                var sectionID = dynamicFieldCounter++;
                sectionCounters[sectionID] = 1;
                var fieldHTML = `
        <div class="card-body1 question mt-3 section mt-4" id="section_${sectionID}">
            <div class="row">
                <div class="col-md-4 pb-2">
                    <input type="text" class="form-control1 field dynamicFieldInput section-title" name="dynamicField[]" placeholder="Add Title" required>
                </div>
                <div class="col-md-8">
                    <div class="deleteDynamicSection" data-section="${sectionID}">
                        <p style="cursor: pointer"> <i class="fa fa-trash"></i></p>
                    </div>
                </div>
            </div>
            <div class="row dynamicFieldPadding">
                <div class="dynamicFieldContainer">
                    <!-- Dynamic Question Display here -->
                </div>
                <div class="col-md-12">
                    <div class="addDynamicField" data-section="${sectionID}">
                        <p style="cursor: pointer" class="white"> <i class="fa fa-plus"></i> Add Heading</p>
                    </div>
                </div>
            </div>
        </div>`;
                $('.dynamicFieldSection').append(fieldHTML);
            }

            // Separate logic for heading response type selection
            $(document).on('click', '.heading_input_type', function() {
                let container = $(this).closest('.dynamicField');
                container.find('.heading_input_type').removeClass('active');
                $(this).addClass('active');
                container.find('.heading_responseContainer').empty();
                let value = $(this).val();
                let result = "";

                switch (value) {
                    case 'multiple_options':
                        result =
                            `<div class="row my-3 align-items-center">
                    <div class="col-md-8">
                        <input class="form-control field_value responseTypeFields option" type="text" placeholder="Text" required>
                    </div>
                    <div class="col-md-2">
                        <i style="cursor: pointer" class="fa fa-plus addDynamicOptions_heading"></i>
                        <i style="cursor: pointer" class="fa fa-minus pl-20 removeDynamicField"></i>
                    </div>
                </div>
                <div class="dynamicMcqs_heading"></div>`;
                        break;
                    case 'InputText':
                    case 'longText':
                    case 'no_content':
                        break;
                }

                container.find('.heading_responseContainer').append(result);
            });

            // Separate logic for subheading response type selection
            $(document).on('click', '.subheading_input_type', function() {
                let container = $(this).closest('.subheading');
                container.find('.subheading_input_type').removeClass('active');
                $(this).addClass('active');
                container.find('.subHeading_responseContainer').empty();
                let value = $(this).val();
                let result = "";

                switch (value) {
                    case 'multiple_options':
                        result = `<div class="row my-3 align-items-center">
                <div class="col-md-8">
                    <input class="form-control field_value responseTypeFields option" type="text" placeholder="Text" required>
                </div>
                <div class="col-md-2">
                    <i style="cursor: pointer" class="fa fa-plus addDynamicOptions_subHeading"></i>
                    <i style="cursor: pointer" class="fa fa-minus pl-20 removeDynamicField"></i>
                </div>
            </div>
            <div class="dynamicMcqs_subHeading"></div>`;
                        break;
                    case 'InputText':
                    case 'longText':
                    case 'no_content':
                        break;
                }

                container.find('.subHeading_responseContainer').append(result);
            });

            // Handle dynamic addition of options for 'multiple_options' for headings
            $(document).on('click', '.addDynamicOptions_heading', function() {
                let container = $(this).closest('.dynamicField').find('.dynamicMcqs_heading');
                if (container.length > 0) {
                    let field = `
        <div class="row my-3 align-items-center">
            <div class="col-md-8">
                <input class="form-control field_value responseTypeFields option" type="text" placeholder="Text" required>
            </div>
            <div class="col-md-2">
                <i style="cursor: pointer" class="fa fa-plus addDynamicOptions_heading"></i>
                <i style="cursor: pointer" class="fa fa-minus pl-20 removeDynamicField"></i>
            </div>
        </div>`;
                    container.append(field);
                }
            });

            // Handle dynamic addition of options for 'multiple_options' for subheadings
            $(document).on('click', '.addDynamicOptions_subHeading', function() {
                let container = $(this).closest('.subheading').find('.dynamicMcqs_subHeading');
                if (container.length > 0) {
                    let field = `
        <div class="row my-3 align-items-center">
            <div class="col-md-8">
                <input class="form-control field_value responseTypeFields option" type="text" placeholder="Text" required>
            </div>
            <div class="col-md-2">
                <i style="cursor: pointer" class="fa fa-plus addDynamicOptions_subHeading"></i>
                <i style="cursor: pointer" class="fa fa-minus pl-20 removeDynamicField"></i>
            </div>
        </div>`;
                    container.append(field);
                }
            });

            // Remove dynamic field
            $(document).on('click', '.removeDynamicField', function() {
                $(this).closest('.row').remove();
            });

            // Handle adding subheading
            $(document).on('click', '.addSubheading', function() {
                var sectionID = $(this).data('section');
                var questionCounter = $(this).data('field');
                var container = $(this).closest('.dynamicField').find('.subheadingContainer');

                var subheadingHTML = `
        <div class="subheading row my-3" id="subheading_${sectionID}_${questionCounter}">
            <div class="col-md-12">
                <input type="text" class="form-control1 subheadingField subheading-title" name="subheadings[${sectionID}][${questionCounter}][]" placeholder="Subheading" required>
                <div class="my-3">
                    <p class="mb-2">Select Response Type</p>
                    <button type="button" class="btn btn-5 input_type subheading_input_type content-type" value="multiple_options">Multiple Options</button>
                    <button type="button" class="btn btn-5 input_type subheading_input_type content-type" value="InputText">Text Input</button>
                    <button type="button" class="btn btn-5 input_type subheading_input_type content-type" value="longText">Long Text</button>
                </div>
                <div class="subHeading_responseContainer"></div>
                <button type="button" class="deleteSubheading" data-section="${sectionID}" data-field="${questionCounter}">Remove Subheading</button>
            </div>
        </div>`;
                container.append(subheadingHTML);
            });

            // Handle deleting subheading
            $(document).on('click', '.deleteSubheading', function() {
                var sectionID = $(this).data('section');
                var questionCounter = $(this).data('field');
                $('#subheading_' + sectionID + '_' + questionCounter).remove();
            });

            // Function to validate required fields and response types
            function validateForm() {
                let isValid = true;

                // Check if each section has a title
                $('.section-title').each(function() {
                    if ($(this).val().trim() === "") {
                        isValid = false;
                        Swal.fire({
                            title: 'Error',
                            text: 'All sections must have a title.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                        return false; // Exit loop on the first invalid field
                    }
                });

                // Check if each heading and subheading has a selected response type and non-empty fields
                $('.dynamicField').each(function() {
                    let responseTypeSelected = $(this).find('.content-type.active').length > 0;
                    let headingField = $(this).find('.questionField').val().trim() !== "";
                    if (!responseTypeSelected || !headingField) {
                        isValid = false;
                        Swal.fire({
                            title: 'Error',
                            text: 'All headings and subheadings must have a selected response type and filled fields.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                        return false; // Exit loop on the first invalid field
                    }
                });

                return isValid;
            }

            // Function to gather and structure the data into JSON
            function getDataToStore() {
                const sections = [];

                $('.section').each(function(sectionIndex) {
                    const sectionObj = {
                        title: $(this).find('.section-title').val(),
                        headings: []
                    };

                    $(this).find('.dynamicField').each(function(
                        headingIndex) {
                        const contentType = $(this).find('.content-type.active').val();
                        let content = null;

                        if (contentType === 'multiple_options') {
                            content = $(this).find('.option').map(function() {
                                return $(this).val();
                            }).get();
                        } else if (contentType === 'InputText') {
                            content = "InputText";
                        } else if (contentType === 'longText') {
                            content = "longText";
                        }

                        const headingObj = {
                            heading: $(this).find('.questionField').val(),
                        };

                        if (contentType !== 'no_content') {
                            headingObj.content = content;
                        }

                        const subHeadings = [];

                        $(this).find('.subheading').each(function(subHeadingIndex) {
                            const subContentType = $(this).find('.content-type.active')
                            .val();
                            let subContent = null;

                            if (subContentType === 'multiple_options') {
                                subContent = $(this).find('.option').map(function() {
                                    return $(this).val();
                                }).get();
                            } else if (subContentType === 'InputText') {
                                subContent = "InputText";
                            } else if (subContentType === 'longText') {
                                subContent = "longText";
                            }

                            const subHeadingObj = {
                                subHeading: $(this).find('.subheadingField').val()
                            };

                            if (subContentType !== 'no_content') {
                                subHeadingObj.content = subContent;
                            }

                            if (subContent !== null) {
                                subHeadings.push(subHeadingObj);
                            }
                        });

                        if (subHeadings.length > 0) {
                            headingObj.subHeadings = subHeadings;
                        }

                        if (content !== null || subHeadings.length > 0) {
                            sectionObj.headings.push(headingObj);
                        }
                    });

                    if (sectionObj.headings.length > 0) {
                        sections.push(sectionObj);
                    }
                });

                console.log("Final JSON Structure:", JSON.stringify(sections, null, 2));
                return sections;
            }

            // Handle form data on check data button click
            $('#checkDataButton').click(function() {
                console.log(getDataToStore());
            });

            $('#submit-template').on('click', function() {
                if (!validateForm()) {
                    return; // Stop form submission if validation fails
                }

                var surveyData = getDataToStore();
                var templateName = $('input[name="template_name"]').val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to submit the template?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, submit it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Uploading...',
                            text: 'Please wait while your template is being uploaded.',
                            icon: 'info',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            didOpen: () => Swal.showLoading()
                        });

                        var formData = new FormData();
                        formData.append('template_name', templateName);
                        formData.append('surveyData', JSON.stringify(surveyData));

                        $.ajax({
                            url: $('#template-form').attr('action'),
                            method: 'POST',
                            data: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Your template has been submitted successfully!',
                                    icon: 'success'
                                }).then(() => window.location.reload());
                            },
                            error: function(xhr) {
                                let errorMsg =
                                    'There was an error submitting your template. Please try again.';
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
