@extends ('layouts.layout_2')

@section('head')
    <title>Home &#8211; Dian</title>
@endsection

@section('content')
    <div class="content-body">

        <div class="container-fluid">

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <input type="text" class="form-control1 input-default " placeholder="Dentist Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <input type="text" class="form-control1 input-default " placeholder="Practice Email">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <input type="text" class="form-control1 input-default " placeholder="Patient Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <input type="text" class="form-control1 input-default " placeholder="Patient Email">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <input type="text" class="form-control1 input-default " placeholder="Subject">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <input type="text" class="form-control1 input-default " placeholder="Dentist Email">
                    </div>
                </div>
            </div>

            <p class="">
                <img class="w-4" src="{{ asset('images/assist/mic.png') }}">
            </p>
            <div class="row">

                <div class="col-md-12">

                    <div class="mb-3">
                        <textarea class="form-txtarea form-control" rows="8" id="comment"></textarea>
                    </div>

                </div>

                <div class="col-md-12">

                        <form>
                            <div class="mb-3">

                                <div class="basic-form">
                                    <form>
										<select class="default-select  wide mb-3 form-control-lg">
											<option>Select Procedure</option>
											<option>Option 2</option>
											<option>Option 3</option>
										</select>

                                    </form>
                                </div>
                            </div>
                        </form>
                </div>

                <div class="col-md-12">

                    <div class="mb-3">
                        <textarea class="textarea1 form-control" rows="8" id="comment"></textarea>
                    </div>
                </div>

            </div>

            <div class=" pt-0 mb-4">

                <button type="button" class="btn4  anek-telugu">Send email</button>

            </div>

        </div>
    </div>
@endsection
