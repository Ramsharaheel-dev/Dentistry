@extends ('layouts.layout')

@section('head')
    <title>CPD &#8211; Dian</title>
    <link rel='stylesheet' href="{{ asset('css/copd.css') }}" />
@endsection

@section('content')
    <style>
        #verifyButton {
            background-color: #d9aa5a !important;
            margin-top: 20px;
            cursor: pointer;
            padding: 10px 20px;
            color: white;
            width: fit-content;
        }

        .form-check-label {
            color: #a0a0a0;
        }
    </style>
    @include('requires.header')
    @include('requires.content-section')
    <div id="activeMenu" value="{{ $activeMenu }}"></div>
    <div class="container">
        <div class="copdContainer">
            <h1 style="coloe:#fff;margin-bottom:10px">CPD</h1>
            <p style="color:#a0a0a0">Please check all boxes to submit</p>
            <form action="{{ route('submitcopd') }}" method="POST">
                @csrf
                <div class="form-check">
                    <input class="form-check-input required" type="checkbox" value="" name="one"
                        id="flexCheckDefault1">
                    <label class="form-check-label" for="flexCheckDefault1">
                        Default checkbox
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input required" type="checkbox" value="" name="one"
                        id="flexCheckDefault2">
                    <label class="form-check-label" for="flexCheckDefault2">
                        Default checkbox
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input required" type="checkbox" value="" name="one"
                        id="flexCheckDefault3">
                    <label class="form-check-label" for="flexCheckDefault3">
                        Default checkbox
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input required" type="checkbox" value="" name="one"
                        id="flexCheckDefault4">
                    <label class="form-check-label" for="flexCheckDefault4">
                        Default checkbox
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input required" type="checkbox" value="" name="one"
                        id="flexCheckDefault5">
                    <label class="form-check-label" for="flexCheckDefault5">
                        Default checkbox
                    </label>
                </div>
                <button type="submit" id="submitButton" class="toggle-disabled" style="display:none">Submit</button>
                <div id="verifyButton">Submit</div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/cpd.js') }}"></script>
@endsection
