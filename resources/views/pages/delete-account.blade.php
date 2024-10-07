@extends ('layouts.layout_2')

@section('head')
    <title>Home &#8211; Dian</title>
@endsection
@section('custom_style')
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid ">

            <div class="row">
                <div class="col-md-4">
                    <div class="py-4">
                        <button type="button" class="btn btn-outline-light " data-bs-toggle="modal"
                            data-bs-target=".bd-example-modal-lg">Filter Assign
                            Videos</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                    <div class="text-center">
                        <img class="" src="{{ asset('images/blogs/delete.png') }}" />
                    </div>

                    <div class="anek-telugu lorem-ipsum-dolor text-center py-4">
                        We’re sorry to see <br>
                        you go
                    </div>
                    <div class="please_acc anek-telugu py-4 text-center ">Be advised, account deletion is final. There will
                        be no way to restore your account.</div>

                    <div class="row">
                        <div class="col-md-2 offset-md-3">
                            <button type="button" class=" btn3  anek-telugu mr-13"> Nevermind</button>
                        </div>
                        <div class="col-md-4 offset-md-1">
                            <button type="button" class=" btn15 anek-telugu mr-13"> Delete my account</button>
                        </div>
                    </div>

                    <div class="modal-footer">
                        {{-- <button type="submit" class="btn btn-primary assign-btn">Assign Now</button> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade surveryFormModal" id="surveryFormModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button> --}}
                </div>
                <form action="#" method="POST" id="survey_form">
                    @csrf
                    <input type="hidden" name="videoId" id="modalVideoId" value="">
                    <input type="hidden" name="userId" id="modalUserId" value="">

                    <div class="modal-body anek-telugu lorem-ipsum-dolor">Questions
                        <div class="m-4">
                            <div class="accordion" id="myAccordion">
                                <div class="accordion-item">
                                    <h2 class="anek-telugu fs-22">
                                        How will this video help your clinical and non clinical skills ?
                                    </h2>
                                    <textarea name="question1" class="textarea3 form-control" rows="4" id="comment"></textarea>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="anek-telugu fs-22">
                                        What is the main point you have learnt ?
                                    </h2>
                                    <textarea name="question2" class="textarea3 form-control" rows="4" id="comment"></textarea>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="anek-telugu fs-22">
                                        In what way will you change or improve your work flow ?
                                    </h2>
                                    <div id="collapse3" class="accordion-collapse collapse anek-telugu"
                                        data-bs-parent="#myAccordion">
                                    </div>
                                    <textarea name="question3" class="textarea3 form-control" rows="4" id="comment"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
