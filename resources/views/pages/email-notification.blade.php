@extends ('layouts.user_layout')

@section('head')
    <title>Home &#8211; Dian</title>
@endsection

<style>
    /* img,
    svg {
        vertical-align: middle;
        width: 100% !important;
    } */
</style>

@section('content')
    <div class="content-body">



        <div class="container-fluid">
            <div class="row" >


                    <div class="col-md-12 col-sm-12 col-xs-12" >
                        <div class="card-header border-0 pb-0 flex-wrap">
                            <div class="products mb-3 anek-telugu">
                                <img class="" src="{{ asset('images/general/profile.png') }}">
                                <div>
                                    <h6><a href="javascript:void(0)">Jhon Doe / General</a></h6>
                                    <span>Set up your Dian Club presence and hiring needs</span>
                                </div>
                            </div>
                            <ul class="nav nav-pills mix-chart-tab" id="pills-tab" role="tablist">

                               <li class="nav-item" role="presentation">
                                <button class="nav-link"> <span style="color: #b79150">Upgrade</span>  your account</button>
                              </li>
                            </ul>
                        </div>

                        <p class="selected-videos">Alerts & Notifications</p>
                        <div class="bottom"></div>

                        <div class="py-3">

                        <p class="please_acc ">send me</p>
                        <div class="col-xl-6">
                            <div class="form-check custom-checkbox mb-3">
                                <input type="checkbox" class="form-check-input" id="customCheckBox1" required="">
                                <label class=" please_acc" for="customCheckBox1">Video Announcements</label>


                            </div>
                            <span>Videos/Podcasts/Webinars/Blogs/Courses/Guideline/etc.</span>


                        </div>
                        <div class="bottom"></div>
                    </div>
                    <div class="py-3">


                        <div class="col-xl-6">
                            <div class="form-check custom-checkbox mb-3">
                                <input type="checkbox" class="form-check-input" id="customCheckBox1" required="">
                                <label class=" please_acc" for="customCheckBox1">Video Assignment</label>

                            </div>


                        </div>
                        <div class="bottom"></div>
                    </div>
                    <div class="py-3">


                        <div class="col-xl-6">
                            <div class="form-check custom-checkbox mb-3">
                                <input type="checkbox" class="form-check-input" id="customCheckBox1" required="">
                                <label class=" please_acc" for="customCheckBox1">Notify me when the task assigned is complete</label>

                            </div>


                        </div>
                        <div class="bottom"></div>
                    </div>

                    </div>
            </div>
            <div class="row py-4">
                <div class="col-md-12 float-end">
                    <button type="button" class="btn3 btn-secondary anek-telugu">Update Email Notifications</button>
                </div>
            </div>
        </div>

    </div>
@endsection
