@extends ('layouts.layout_2')

@section('head')
    <title>Home &#8211; Dian</title>
@endsection


<style>
    li {
        display: inline-block;

    }

    li.noti {
    display: block;
    }

    .card-body1 {
        padding-left: 21.25px;
    }
</style>


@section('content')
    <div class="content-body">

        <div class="container-fluid">
            <div class="card1" id="card-title-1">
                <div class="card-header border-0 pb-0 ">
                    <p class="speech_to_1">Background</p>
                </div>
                <div class="card-body1">


                    <ul class="py-1">
                        <LI>
                            <p class="please_acc anek-telugu pr-10">Reason for attendance:</p>
                        </LI>
                        <li><button type="button" class="btn5  anek-telugu mr-13">Save</button></li>
                        <li><button type="button" class="btn5  anek-telugu mr-13">Routine Exam</button></li>
                        <li><button type="button" class="btn5  anek-telugu mr-13">Specific Concern</button></li>
                    </ul>
                    <ul class="py-1">
                        <LI>
                            <p class="please_acc anek-telugu pr-10">CO:</p>
                        </LI>
                        <li><button type="button" class="btn5 anek-telugu mr-13">Nil</button></li>
                        <li><button type="button" class="btn5 anek-telugu mr-13">Pain</button></li>
                        <li><button type="button" class="btn5 anek-telugu mr-13">Bleeding Gum</button></li>
                        <li><button type="button" class="btn5 anek-telugu mr-13">Broken Tooth</button></li>
                        <li><button type="button" class="btn5 anek-telugu mr-13">Cavity</button></li>
                        <li><button type="button" class="btn5 anek-telugu mr-13">Sensitivity</button></li>
                        <li><button type="button" class="btn5 anek-telugu mr-13">Gaps</button></li>
                        <li><button type="button" class="btn5 anek-telugu mr-13">Appearance</button></li>

                    </ul>
                    <ul class="py-1">
                        <li>
                            <p class="please_acc anek-telugu pr-10">Patient Goals:</p>
                        </li>
                        <li><button type="button" class="btn5  anek-telugu mr-13">Improve Oral</button></li>
                        <li><button type="button" class="btn5  anek-telugu mr-13">Health</button></li>
                        <li><button type="button" class="btn5  anek-telugu mr-13">Function</button></li>
                        <li><button type="button" class="btn5  anek-telugu mr-13">Appearance</button></li>

                    </ul>
                    <ul class="py-1">
                        <LI>
                            <p class="please_acc anek-telugu pr-10">Maintain oral:</p>
                        </LI>
                        <li><button type="button" class="btn5  anek-telugu mr-13">Health</button></li>
                        <li><button type="button" class="btn5  anek-telugu mr-13">Function</button></li>
                        <li><button type="button" class="btn5  anek-telugu mr-13">Appearance</button></li>

                    </ul>

                    <div class="row py-1">
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Comments :</p>
                            </li>
                            <li class="w-80"> <input type="text" class="form-control input-default "
                                    placeholder=""> </li><img class="left-2" src="{{ asset('images/shop/mic.png') }}">

                        </ul>

                    </div>
                </div>
            </div>
            <div class="py-2">
                <div class="card1 " id="card-title-1">
                    <div class="card-header border-0 pb-0 ">
                        <p class="speech_to_1">Medical History</p>
                    </div>
                    <div class="card-body1">


                        <ul class="py-1">
                            <LI>
                                <p class="please_acc anek-telugu pr-10">Fit and well conditions:</p>
                            </LI>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Save</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Routine Exam</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Specific Concern</button></li>
                        </ul>
                        <ul class="py-1">
                            <LI>
                                <p class="please_acc anek-telugu pr-10">Medication :</p>
                            </LI>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Non</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Please see Chart</button></li>

                        </ul>
                        <ul class="py-1">
                            <LI>
                                <p class="please_acc anek-telugu pr-10">Allergies:</p>
                            </LI>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Non</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Please see Chart</button></li>


                        </ul>

                        <div class="row py-1">
                            <ul class="py-1">
                                <LI>
                                    <p class="please_acc anek-telugu pr-10">Comments :</p>
                                </LI>
                                <li class="w-80"> <input type="text" class="form-control input-default "
                                        placeholder=""> </li><img class="left-2" src="{{ asset('images/shop/mic.png') }}">

                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <div class="py-2">
                <div class="card1 " id="card-title-1">
                    <div class="card-header border-0 pb-0 ">
                        <p class="speech_to_1">Social History</p>
                    </div>
                    <div class="card-body1">


                        <ul class="py-1">
                            <LI>
                                <p class="please_acc anek-telugu pr-10">Occupation:</p>
                            </LI>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Regular Attender</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Irregular Attender</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">First Visit To Practice</button></li>
                        </ul>
                        <ul class="py-1">
                            <LI>
                                <p class="please_acc anek-telugu pr-10">Smoker :</p>
                            </LI>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Non</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Ex Smoker</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Quit</button></li>

                            <li><button type="button" class="btn5  anek-telugu mr-13">Daily Smoker</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Occasional Smoker</button></li>

                            <li><button type="button" class="btn5  anek-telugu mr-13">Vape</button></li>

                        </ul>
                        <ul class="py-1">
                            <LI>
                                <p class="please_acc anek-telugu pr-10">Allergies:</p>
                            </LI>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Non</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Please see Chart</button></li>
                        </ul>

                        <div class="row py-1">
                            <ul class="py-1">
                                <LI>
                                    <p class="please_acc anek-telugu pr-10">Comments :</p>
                                </LI>
                                <li class="w-80"> <input type="text" class="form-control input-default "
                                        placeholder=""> </li><img class="left-2" src="{{ asset('images/shop/mic.png') }}">

                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <div class="py-2">
                <div class="card1 " id="card-title-1">
                    <div class="card-header border-0 pb-0 ">
                        <p class="speech_to_1">Dental History</p>
                    </div>
                    <div class="card-body1">


                        <ul class="py-1">
                            <LI>
                                <p class="please_acc anek-telugu pr-10">Previous attendance:</p>
                            </LI>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Regular Attender</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Irregular Attender</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">First Visit To Practice</button></li>
                        </ul>
                        <ul class="py-1">
                            <LI>
                                <p class="please_acc anek-telugu pr-10">Medication :</p>
                            </LI>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Non</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Please see Chart</button></li>

                        </ul>
                        <ul class="py-1">
                            <LI>
                                <p class="please_acc anek-telugu pr-10">Allergies:</p>
                            </LI>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Non</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Please see Chart</button></li>


                        </ul>

                        <div class="row py-1">
                            <ul class="py-1">
                                <LI>
                                    <p class="please_acc anek-telugu pr-10">Comments :</p>
                                </LI>
                                <li class="w-80"> <input type="text" class="form-control input-default "
                                        placeholder=""> </li><img class="left-2" src="{{ asset('images/shop/mic.png') }}">

                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <div class="py-2">
                <div class="card1 " id="card-title-1">
                    <div class="card-header border-0 pb-0 ">
                        <p class="speech_to_1">Oral Hygiene</p>
                    </div>
                    <div class="card-body1">


                        <ul class="py-1">
                            <LI>
                                <p class="please_acc anek-telugu pr-10">Toothbrush:</p>
                            </LI>
                            <li><button type="button" class="btn5  anek-telugu mr-13">electric</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Manual</button></li>

                        </ul>
                        <ul class="py-1">
                            <LI>
                                <p class="please_acc anek-telugu pr-10">Daily frequency:</p>
                            </LI>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Once</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Twice</button></li>

                        </ul>
                        <ul class="py-1">
                            <LI>
                                <p class="please_acc anek-telugu pr-10">Toothpaste:</p>
                            </LI>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Fluoride Toothpaste</button></li>

                        </ul>

                        <div class="row py-1">
                            <ul class="py-1">
                                <LI>
                                    <p class="please_acc anek-telugu pr-10">Comments :</p>
                                </LI>
                                <li class="w-80"> <input type="text" class="form-control input-default "
                                        placeholder=""> </li><img class="left-2" src="{{ asset('images/shop/mic.png') }}">

                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <div class="py-2">
                <div class="card1 " id="card-title-1">
                    <div class="card-header border-0 pb-0 ">
                        <p class="speech_to_1">Denture</p>
                    </div>
                    <div class="card-body1">


                        <ul class="py-1">
                            <LI>
                                <p class="please_acc anek-telugu pr-10">Steradent / dental tablet for cleaning used:</p>
                            </LI>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Never</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Occasionally</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Daily</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Sometimes Wears Denture to Bed At Night</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Denture Sometimes Lifts When Eating. Pt Uses Fixodent To Help</button></li>

                        </ul>
                        <ul class="py-1">
                            <LI>
                                <p class="please_acc anek-telugu pr-10">Sometimes wears dentures to bed at night time:</p>
                            </LI>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Yes</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">No</button></li>

                        </ul>

                        <div class="row py-1">
                            <ul class="py-1">
                                <LI>
                                    <p class="please_acc anek-telugu pr-10">Comments :</p>
                                </LI>
                                <li class="w-80"> <input type="text" class="form-control input-default "
                                        placeholder=""> </li><img class="left-2" src="{{ asset('images/shop/mic.png') }}">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-2">
                <div class="card1 " id="card-title-1">
                    <div class="card-header border-0 pb-0 ">
                        <p class="speech_to_1">Diet</p>
                    </div>
                    <div class="card-body1">


                        <ul class="py-1">
                            <LI>
                                <p class="please_acc anek-telugu pr-10">Sugar diet/intake:</p>
                            </LI>
                            <li><button type="button" class="btn5  anek-telugu mr-13">High</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Medium</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Low</button></li>


                        </ul>
                        <ul class="py-1">
                            <LI>
                                <p class="please_acc anek-telugu pr-10">Fizzy drink diet/intake:</p>
                            </LI>
                            <li><button type="button" class="btn5  anek-telugu mr-13">High</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Medium</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Low</button></li>

                        </ul>

                        <div class="row py-1">
                            <ul class="py-1">
                                <LI>
                                    <p class="please_acc anek-telugu pr-10">Comments :</p>
                                </LI>
                                <li class="w-80"> <input type="text" class="form-control input-default "
                                        placeholder=""> </li><img class="left-2" src="{{ asset('images/shop/mic.png') }}">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="  py-4">

                <button type="button" class="btn2  anek-telugu mr-13">Save</button>

                <button type="button" class="btn3  anek-telugu">Copy Text</button>

            </div>
        </div>

    </div>
@endsection
