@extends ('layouts.layout_2')

@section('head')
    <title>Shop; Dian</title>
@endsection

<style>
    .input1 {
        padding: 11px 14px;
        font-size: 20px;
        height: 45px;
        width: 100%;
        text-align: center;
        border-radius: 5px;
        border: none;
        color: white;
        background: #191920;
    }
</style>



@section('content')
    <div class="content-body">

        {{-- @include('pages.subheader') --}}
        <div class="container-fluid">

            <div class="row">

                <div class="col-md-5 ">

                    <img class="w-100" src="{{ asset('images/shop/shop-big.png') }}">

                    <p class="your_perso pt-5">You May Also Like</p>

                    <div class="col-md-12">



                        <div class="row ">
                           <a href=""> <img class="" src="http://127.0.0.1:8000/images/shop/shop2.png"></a>
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
                <div class="col-md-6 offset-md-1">

                    <p class="notes1 anek-telugu">Guidebook</p>
                    <p class="your_perso">Dentistry in a Nutshell</p>



                    <p class="please_acc">£64.99 GBP</p>
                    <p class="fs-16">Tax included </p>
                    <div class="mb-3 row align-items-center">
                        <label class="col-lg-2">
                            <div class="fs-16">Quantity:</div>

                        </label>
                        <div class="col-lg-9">
                            <div class="product-quantity">
                                <input class="input1" type="number" value="0" min="0" max="20">
                            </div>

                        </div>
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-md-11">
                                    <button type="button" class="btn1 btn-secondary anek-telugu">Add To Cart</button>
                                </div>

                            </div>

                        </div>
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-md-11">
                                    <button type="button" class="btn1 btn-secondary anek-telugu"
                                        style="background: #3C0DEF">Buy with <img class=""
                                            src="{{ asset('images/shop/shop-pay.png') }}"></button>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-11">

                            <p class="step_into_">We are currently in the process of production for new books therefore
                                orders may
                                take slightly longer to get to you than normal.</p>
                            <p class="step_into_">A step-by-step guide covering the most common procedures within advanced
                                clinical
                                dentistry, ranging from simple to complex. This book breaks these into concise step-by step
                                instructions and ensures your confidence at ever stage.</p>
                            <p class="step_into_">Dentistry in a Nutshell has been created using 36 years of combined
                                clinical
                                dentistry experience, evidence-based techniques and input from specialists in their
                                respective
                                fields. It is a step by step workflow aimed to guide dentists to practice in a effective,
                                predictable and safe manner. Complex treatment procedures have been broken down into easy to
                                follow
                                flowcharts, supplemented by tables and images.</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row py-4">
                <div class="col-md-12 text-center">
                    <p class="your_perso">Subscribe to our emails</p>
                    <p class="notes1 anek-telugu">Subscribe to our mailing list for insider news, product launches, and more.
                    </p>
                    <div class="col-md-6 offset-md-3">
                    <div class="mb-3">
                        <input type="text" class="form-control1 input-default " placeholder="Enter Email Address">
                    </div>
                </div>
                </div>
            </div>

        </div>
    </div>
@endsection


{{-- <script>
    $(function(){

  $('<span class="add" uk-icon="plus">+</span>').insertAfter('.product-container .product-quantity input');
  $('<span class="sub" uk-icon="minus">-</span>').insertBefore('.product-container .product-quantity input');


  $('.add').click(function () {
		var selectedInput = $(this).prev('input');
			if (selectedInput.val() < 10) { --}}
{{-- selectedInput[0].stepUp(1);
			 }
	});

  $('.sub').click(function () {
		var selectedInput = $(this).next('input');
			if (selectedInput.val() > 0) {
        selectedInput[0].stepDown(1);
			 }
	});


});
</script> --}}
