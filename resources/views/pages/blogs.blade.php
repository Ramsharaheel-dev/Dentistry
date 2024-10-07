@extends ('layouts.layout_2')

@section('head')
    <title>Home &#8211; Dian</title>
@endsection

<style>
    .modal-content {
        border-radius: 30px !important;
        border: 1px solid #B79150 !important;
    }

    .textarea3#comment {
        height: auto !important;
    }
</style>

@section('content')
    <div class="content-body">

        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="bootstrap-badge">
                        <button type="button" class="btn btn-outline-light" data-bs-toggle="modal"
                            data-bs-target=".bd-example-modal-lg">General</button>

                    </div>

                </div>

            </div>

            <div class="container-fluid ">

                <div class="row py-3">

                    <div class="col-md-4">

                        <a href ="{{ route('blogs-details') }}"> <img class="" src="{{ asset('images/blogs/1.png') }}"
                                alt="Video Thumbnail">
                        </a>

                        <p class="speech_to_ py-3 ">How do we match missing incisors?</p>
                    </div>
                    <div class="col-md-4">

                        <img class="" src="{{ asset('images/blogs/2.png') }}" alt="Video Thumbnail">

                        <p class="speech_to_ py-3 ">How do we reduce dry sockets?
                        </p>
                    </div>
                    <div class="col-md-4">

                        <img class="" src="{{ asset('images/blogs/3.png') }}" alt="Video Thumbnail">

                        <p class="speech_to_ py-3 ">How to remove a fracture root apex?
                        </p>
                    </div>
                </div>
                <div class="row py-3">

                    <div class="col-md-4">

                        <img class="" src="{{ asset('images/blogs/4.png') }}" alt="Video Thumbnail">

                        <p class="speech_to_ py-3 ">How to section anterior teeth and retain bone?</p>
                    </div>
                    <div class="col-md-4">

                        <img class="" src="{{ asset('images/blogs/5.png') }}" alt="Video Thumbnail">

                        <p class="speech_to_ py-3 ">How to make molar extractio
                            -ns much easier - Part 1
                        </p>
                    </div>
                    <div class="col-md-4">

                        <img class="" src="{{ asset('images/blogs/6.png') }}" alt="Video Thumbnail">

                        <p class="speech_to_ py-3 ">How to make molar extractio
                            -ns much easier - Part 2
                        </p>
                    </div>
                </div>

                <div class="row py-4 ">
                    <div class="col-md-12">
                        <nav>
                            <ul class="pagination justify-content-center">
                                <li class="page-item page-indicator">
                                    <a class="page-link" href="javascript:void(0)">
                                        <i class="fa fa-angle-left"></i></a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="javascript:void(0)">1</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0)">4</a></li>
                                <li class="page-item page-indicator">
                                    <a class="page-link" href="javascript:void(0)">
                                        <i class="fa fa-angle-right"></i></a>
                                </li>
                            </ul>
                        </nav>

                    </div>
                </div>

            </div>


        </div>

    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title">Modal title</h5> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body anek-telugu lorem-ipsum-dolor">Questions


                    <div class="m-4">
                        <div class="accordion" id="myAccordion">
                            <div class="accordion-item">
                                <h2 class="anek-telugu">
                                    How will this video help your clinical and non clinical skills ?
                                </h2>

                                <textarea class="textarea3 form-control" rows="4" id="comment"></textarea>
                            </div>
                            <div class="accordion-item">
                                <h2 class="anek-telugu">
                                    What is the main point you have learnt ?

                                </h2>
                                <textarea class="textarea3 form-control" rows="4" id="comment"></textarea>
                            </div>
                            <div class="accordion-item">
                                <h2 class="anek-telugu">
                                    In what way will you change or improve your work flow ?


                                </h2>
                                <div id="collapse3" class="accordion-collapse collapse anek-telugu"
                                    data-bs-parent="#myAccordion">
                                    <div class="card-body">
                                        <p>We accept credit/debit cards and PayPal for subscription payments.
                                            </a></p>
                                    </div>
                                </div>
                                <textarea class="textarea3 form-control" rows="4" id="comment"></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-primary">Assign Now</button>

                    </div>

                </div>


            </div>
        </div>
    </div>
@endsection
