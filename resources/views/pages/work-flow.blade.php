@extends ('layouts.layout_2')

@section('head')
    <title>Courses; Dian</title>
@endsection

<style>
    img,
    svg {
        vertical-align: middle;
        width: auto !important;
    }
</style>

@section('content')
    <div class="content-body">

        {{-- @include('pages.subheader') --}}
        <div class="container-fluid">
            <p class="introducin text-center">Please View In App</p>

            <div class="row">

                <div class="col-md-12 text-center">

                    <button type="button" class="btn6 btn-dark"> <img class="" src="{{ asset('images/shop/g.png') }}"
                            alt=""> Sign in with Google</button>
                    <button type="button" class="btn6 btn-dark"> <img class="" src="{{ asset('images/shop/a.png') }}"
                            alt=""> Sign in with Apple</button>

                </div>

            </div>
            {{-- <div class="row py-4">

                <div class="col-md-12">
                    <button type="button" class="btn1 btn-secondary anek-telugu">New Content Released Every Month</button>
                </div>
            </div> --}}

        </div>
    </div>
@endsection
