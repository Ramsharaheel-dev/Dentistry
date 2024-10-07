@extends ('layouts.layout_2')

@section('head')
    <title>Forum &#8211; Dian</title>
@endsection

<style>

.tab-content>.active {
    display: block;
    width: 98%;
}
    .badge-primary {
        background-color: #102335;
        /* padding: 10px; */
    }

    .badge {
        font-size: 18px !important;
        padding-left: 17px;
        padding: 6px 35px !important;
        display: inline-flex;
        margin-right: 18px;
    }

    @media (min-width: 300px) and (max-width: 480px){
img, svg {
    vertical-align: middle;
    width: auto !important;
}
}
</style>

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="bootstrap-badge">
                        <ul class="nav nav-tabs" role="tablist">
                            <span class="badge badge-primary nav-link active" data-bs-toggle="tab" href="#home">Index</span>
                            <span class="badge badge-primary nav-link" data-bs-toggle="tab" href="#profile">Ask
                                Question</span>
                        </ul>
                    </div>
                </div>
                <div class="py-4">
                    <p class="step_into_">Disclaimer: In this section we have created simulation videos of common procedures
                        and issues you may want to use as visual aid to show your patients to help improve the patient
                        experience and allow them to have a better understanding.
                    </p>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="home" role="tabpanel">
                <div class="pt-4">
                    <div class="row">
                        <div class="col-md-12">
                            @foreach ($questions as $question)
                                <div class="box view-more">
                                    <div class="">
                                        <img class="image" src="{{ asset('images/shop/user.png') }}">
                                        <a href="{{ route('single-category', ['questionId' => $question->id]) }}"
                                            target="_blank">
                                            <div class=" py-3">
                                                <span class="jhon-doe  py-3">{{ $question->question }}</span>
                                            </div>

                                            <p class="step_into_" maxlength="50">{{ $question->content }}
                                            </p>
                                        </a>

                                    </div>
                                </div>
                                {{-- <div class="description" style="display: none">
                                    <div class="box ">
                                        <div class="">
                                            <img class="image" src="{{ asset('images/shop/user.png') }}">

                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form id="pubmedSearchForm">
                                                    <div class="input-group search-area">
                                                        <input type="text" class="form-control input-default "
                                                            id="dentistName" name="dentistName"
                                                            placeholder="Enter Text Here">

                                                        <button type="submit" class="btn btn-primary ">Submit</button>


                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>

                                </div> --}}
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile">
                <div class="card1" id="card-title-1">
                    <div class="card-header border-0 pb-0 ">

                    </div>
                    <div class="card-body1">

                        <div class="row py-1">
                            <form action="{{ route('submit-question') }}" method="POST">
                                @csrf
                                <div class="col-md-10 offset-md-1">
                                    <p class="intro1">Ask Question</p>
                                    <div class="mb-3">
                                        <input type="text" class="form-control1 input-default " id="question"
                                            name="question" placeholder="Enter Question">
                                    </div>
                                </div>
                                <div class="col-md-10 offset-md-1">
                                    <div class="mb-3">
                                        <input type="text" class="form-control1 input-default " id="content"
                                            name="content" placeholder="Enter Description">
                                    </div>
                                    <button type="submit" class="btn btn-primary ">Submit</button>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    </div>

    <script>
        $(".view-more").on("click", function() {
            $(this).next().toggle();
        });
    </script>
@endsection
