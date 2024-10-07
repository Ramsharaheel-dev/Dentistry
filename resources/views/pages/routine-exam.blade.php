@extends ('layouts.layout_2')

@section('head')
    <title>Home &#8211; Dian</title>
@endsection

<style>
    li {
        display: inline-block;

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
                    <p class="speech_to_1">Reason For Attendance : Patient examination</p>
                </div>
                <div class="card-body1">

                    <ul class="py-1">
                        <li>
                            <p class="please_acc anek-telugu pr-10">PCO:</p>
                        </li>
                        <li><button type="button" class="btn5  anek-telugu mr-13">NA General check</button></li>
                        <li><button type="button" class="btn5  anek-telugu mr-13">Pain</button></li>
                        <li><button type="button" class="btn5  anek-telugu mr-13">Broken tooth</button></li>
                        <li><button type="button" class="btn5  anek-telugu mr-13">Missing filling</button></li>
                        <li><button type="button" class="btn5  anek-telugu mr-13">Bleeding gums</button></li>
                        <li><button type="button" class="btn5  anek-telugu mr-13">sensitivity</button></li>
                        <li><button type="button" class="btn5  anek-telugu mr-13">appearance of teeth</button></li>
                        <li><button type="button" class="btn5  anek-telugu mr-13">other</button></li>
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
                        <p class="speech_to_1">SH :</p>
                    </div>
                    <div class="card-body1">

                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">smoker - ceasation advice givenSelect Some Options :</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">No</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Yes</button></li>

                        </ul>
                        <ul class="py-1">
                            <LI>
                                <p class="please_acc anek-telugu pr-10">diet :</p>
                            </LI>
                            <li><button type="button" class="btn5  anek-telugu mr-13">High</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Moderate</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Low</button></li>

                        </ul>
                        <ul class="py-1">
                            <LI>
                                <p class="please_acc anek-telugu pr-10">sugar intake : informed pt of risks of acidic damage from sugars</p>
                            </LI>
                            <li><button type="button" class="btn5  anek-telugu mr-13">stress/habits</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">nil / other</button></li>
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
            </div>
            <div class="py-2">
                <div class="card1" id="card-title-1">
                    <div class="card-header border-0 pb-0 ">
                        <p class="speech_to_1">DH:</p>
                    </div>
                    <div class="card-body1">


                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">brushes 1 / 2  x daily with:</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Manual toothbrush</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Electric toothbrush</button></li>

                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">interdental cleaning :</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">None</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Floss</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Tepe brishes</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Water flosser</button></li>

                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Allergies:</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Non</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Please see Chart</button></li>
                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">FH:</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Nil</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Other</button></li>
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
            </div>
            <div class="py-2">
                <div class="card1 " id="card-title-1">
                    <div class="card-header border-0 pb-0 ">
                        <p class="speech_to_1">EOE:</p>
                    </div>
                    <div class="card-body1">

                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">MOM :</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">NAD</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Other</button></li>

                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Lymph nodes
                                     :</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">NAD</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Other</button></li>

                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">TMJ:</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">NAD</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Other</button></li>
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
            </div>
            <div class="py-2">
                <div class="card1 " id="card-title-1">
                    <div class="card-header border-0 pb-0 ">
                        <p class="speech_to_1">IOE:</p>
                    </div>
                    <div class="card-body1">


                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">FOM:</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">NAD</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Other</button></li>

                        </ul>
                        <ul class="py-1">
                            <LI>
                                <p class="please_acc anek-telugu pr-10">Buccal muscoa:</p>
                            </LI>
                            <li><button type="button" class="btn5  anek-telugu mr-13">NAD</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Other</button></li>

                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Tongue:</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">NAD</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Other</button></li>

                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Palate:</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">NAD</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Other</button></li>

                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Lips:</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">NAD</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Other</button></li>

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
            </div>
            <div class="py-2">
                <div class="card1 " id="card-title-1">
                    <div class="card-header border-0 pb-0 ">
                        <p class="speech_to_1">Findings : </p>
                    </div>
                    <div class="card-body1">

                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Oral Hygiene:</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Good</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Moderate</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Poor</button></li>

                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Caries:</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Nil</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Other</button></li>

                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Defective restoration:</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Nil</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Other</button></li>

                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Tooth surface loss:</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Nil</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Localised to anteriors</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Generalised</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Other</button></li>

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
            </div>
            <div class="py-2">
                <div class="card1 " id="card-title-1">
                    <div class="card-header border-0 pb-0 ">
                        <p class="speech_to_1">Special tests: </p>
                    </div>
                    <div class="card-body1">

                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Endofrost</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Positive</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Negative</button></li>

                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">TTP:</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Positive</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Negative</button></li>

                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Perio pocketing::</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Present</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Not present</button></li>

                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Mobility:</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Non - mobile</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Grade 1</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Grade 2</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Grade 3</button></li>

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
                        <p class="speech_to_1">RADIOGRAPHS: </p>
                    </div>
                    <div class="card-body1">

                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Report:LBW</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Grade A / N</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">No radiolucency / radiolucency evident  in</button></li>

                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Perio pocketing:</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Present</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Not present</button></li>

                        </ul>

                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Mobility:</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Non - mobile</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Grade 1</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Grade 2</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Grade 3</button></li>

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
                        <p class="speech_to_1">Diagnosis: </p>
                    </div>
                    <div class="card-body1">

                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Gingivitis</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Localised</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Generalised</button></li>

                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Periodontitis</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Localised</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Generalised</button></li>
                        </ul>

                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Periodontitis stage:</p>
                            </li>

                            <li><button type="button" class="btn5  anek-telugu mr-13">Grade 1</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Grade 2</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Grade 3</button></li>

                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Periodontitis Grade A/B/C</p>
                            </li>

                            <li><button type="button" class="btn5  anek-telugu mr-13">Stable</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Remission</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Unstable</button></li>

                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Risk factors</p>
                            </li>

                            <li><button type="button" class="btn5  anek-telugu mr-13">Smoker</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Ex</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Diabetes</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Other</button></li>

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
                        <p class="speech_to_1">Treatment : </p>
                    </div>
                    <div class="card-body1">

                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Treatment options discussed:</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Nhs</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Hygienist or pvt</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">nhs specialist discussed</button></li>

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
                        <p class="speech_to_1">Treatment plan:</p>
                    </div>
                    <div class="card-body1">

                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Simple non surgical periodontal treatment with</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Myself Band 2</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Hygienist</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Specialist</button></li>

                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Explained to patient cost of treatment on NHS</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Band 1</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Band 2</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Band 3</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">pt is exempt</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Other</button></li>

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
                        <p class="speech_to_1">Oral Health : risk assessment</p>
                    </div>
                    <div class="card-body1">

                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">CARIES risk: </p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Low</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Medium</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">High</button></li>

                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">PERIODONTAL risk:</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Low</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Medium</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">High</button></li>

                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">ORAL CANCER risk:</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Low</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Medium</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">High</button></li>

                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">TOOTHWEAR risk:</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Low</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">Medium</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">High</button></li>

                        </ul>
                        <ul class="py-1">
                            <li>
                                <p class="please_acc anek-telugu pr-10">Recall</p>
                            </li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">3m</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">6m</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">9m</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">12m</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">18m</button></li>
                            <li><button type="button" class="btn5  anek-telugu mr-13">24m</button></li>

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

                <button type="button" class="btn3  anek-telugu">Copy text</button>

            </div>
        </div>

    </div>
@endsection
