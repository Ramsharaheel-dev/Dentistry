@extends ('layouts.layout_2')

@section('head')
    <title>Shop; Dian</title>
@endsection

<style>


</style>



@section('content')
    <div class="content-body">

        {{-- @include('pages.subheader') --}}
        <div class="container-fluid">
            <p class="introducin">Shop</p>

            <div class="row">

                <div class="col-md-3">



                        <div class="row ">
                           <a href="{{ route('shopdetails') }}"> <img class="" src="{{ asset('images/shop/shop.png') }}"></a>
                        </div>

                        <br>
                        <div class="row ">
                            <div class="col-md-12">
                                <a href=""><p class="speech_to_1">Dentistry in a Nutshell</p></a>
                            </div>

                        </div>
                        <div class="row ">
                            <p class="notes1 anek-telugu">£64.99 GBP</p>

                        </div>

                </div>
                <div class="col-md-3">



                    <div class="row ">
                       <a href=""> <img class="" src="{{ asset('images/shop/shop2.png') }}"></a>
                    </div>

                    <br>
                    <div class="row ">
                        <div class="col-md-12">
                            <a href=""><p class="speech_to_1">DIAN Bur Kit</p></a>
                        </div>

                    </div>
                    <div class="row ">
                        <p class="notes1 anek-telugu">£295.00 GBP</p>

                    </div>

            </div>


            </div>

        </div>
    </div>
@endsection
