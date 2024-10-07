@extends ('layouts.layout')

@section('head')
    <title>Profile &#8211; Dian</title>
    <link rel='stylesheet' id='font-awesome-css' href="{{ asset('css/profile.css') }}" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
@endsection

@section('content')

    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li style="list-style-type:none;">{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif

    @include('requires.header-assist')
    <div class="container">
        <div class="profileContainer">
            <h1>Your Profile</h1>
            <form method="post" action="{{ route('update-user-profile') }}" enctype="multipart/form-data">
                @csrf
                <!------- Upload Photo ------->
                <div class="row">
                    <div class="col-lg-6 uploadPicContainer">
                        <img class="profileImage" id="uploadPic" src="../storage/app/profile_pics/{{ $user->profilePic }}"
                            alt="user-profile">
                        <input
                            onchange="document.getElementById('uploadPic').src = window.URL.createObjectURL(this.files[0])"
                            type="file" name="editProfilePic" id="editProfilePic" style="display: none !important;" />
                    </div>
                    <div class="col-lg-6 uploadBtnContainer">
                        <div id="uploadLatestPic" class="uploadNewProfilePhoto">Upload New</div>
                        <!-- <button class="deleteProfilePhoto">Delete</button> -->
                    </div>
                </div>
                <!--------------------------->

                <!------- Upload Names ------->
                <div class="row">
                    <div class="col-lg-12">
                        <input class="firstName uploadNamesContainer" value="{{ $user->firstName }}"
                            placeholder="First Name" style="display: inline;" id="" type="text"
                            name="firstName" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <input class="lastName uploadNamesContainer" value="{{ $user->lastName }}" placeholder="Last Name"
                            style="display: inline;" id="" type="text" name="lastName" />
                    </div>
                </div>
                <!--------------------------->

                <!------- Upload Documents ------->
                <h1>Your Documents</h1>
                <div class="row" style="margin-right:0">
                    <div class="col-lg-10 col-10" style="padding-right:0">
                        <input type="file" name="editStatement" class="uploadNamesContainer" id="editStatement"
                            style="display: none !important;" />
                        <input type="text" class="uploadNamesContainer" readonly value="{{ $user->statement }}"
                            id="updateFileName" />
                    </div>

                    <div class="col-lg-1 col-1 uploadDocument">
                        <a id="download_image_1" href="../storage/app/statements/{{ $user->statement }}" download><img
                                class="profileIcons" src="{{ asset('images/download.png') }}" alt="download"></a>
                    </div>

                    <div class="col-lg-1 col-1 replaceDocument">
                        <img class="profileIcons" id="uploadLatestStatement" src="{{ asset('images/replace.png') }}"
                            alt="replace">
                    </div>
                </div>


                <div class="row" style="margin-right:0">
                    <div class="col-lg-10 col-10" style="padding-right:0">
                        <input type="file" name="editStatementOne" class="uploadNamesContainer" id="editStatementOne"
                            style="display: none !important;" />
                        <input type="text" class="uploadNamesContainer" value="{{ $user->statementOne }}" readonly
                            id="updateFileNameOne" />
                    </div>

                    <div class="col-lg-1 col-1 uploadDocument">
                        <a id="download_image_1" href="../storage/app/statements/{{ $user->statementOne }}" download><img
                                class="profileIcons" src="{{ asset('images/download.png') }}" alt="download"></a>
                    </div>

                    <div class="col-lg-1 col-1 replaceDocument">
                        <img class="profileIcons" id="uploadLatestStatementOne" src="{{ asset('images/replace.png') }}"
                            alt="replace">
                    </div>
                </div>


                <div class="row" style="margin-right:0">
                    <div class="col-lg-10 col-10" style="padding-right:0">
                        <input type="file" name="editStatementTwo" class="uploadNamesContainer" id="editStatementTwo"
                            style="display: none !important;" />
                        <input type="text" class="uploadNamesContainer" readonly value="{{ $user->statementTwo }}"
                            id="updateFileNameTwo" />
                    </div>

                    <div class="col-lg-1 col-1 uploadDocument">
                        <a id="download_image_1" href="../storage/app/statements/{{ $user->statementTwo }}" download><img
                                class="profileIcons" src="{{ asset('images/download.png') }}" alt="download"></a>
                    </div>

                    <div class="col-lg-1 col-1 replaceDocument">
                        <img class="profileIcons" id="uploadLatestStatementTwo" src="{{ asset('images/replace.png') }}"
                            alt="replace">
                    </div>
                </div>


                <div class="row" style="margin-right:0">
                    <div class="col-lg-10 col-10" style="padding-right:0">
                        <input type="file" name="editStatementThree" class="uploadNamesContainer"
                            id="editStatementThree" style="display: none !important;" />
                        <input type="text" class="uploadNamesContainer" readonly value="{{ $user->statementThree }}"
                            id="updateFileNameThree" />
                    </div>
                    <div class="col-lg-1 col-1 uploadDocument">
                        <a id="download_image_1" href="../storage/app/statements/{{ $user->statementThree }}"
                            download><img class="profileIcons" src="{{ asset('images/download.png') }}"
                                alt="download"></a>
                    </div>
                    <div class="col-lg-1 col-1 replaceDocument">
                        <img class="profileIcons" id="uploadLatestStatementThree"
                            src="{{ asset('images/replace.png') }}" alt="replace">
                    </div>
                </div>

                <!--------------------------->

                <input class="saveButton" type="submit" value="SAVE" />
            </form>

            <!------- CPD ------->

            <h1>Your CPD</h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="cpdHeading">
                        <h3>Aims and Objectives</h3>
                    </div>
                    <div class="cpdContent">
                        <p>Develop your professional practice and career with DIAN CPD:</p>
                        <ul>
                            <li>Update your skills and knowledge</li>
                            <li>Prepare you for greater responsibilities</li>
                            <li>Boost your confidence</li>
                            <li>Enhance creative problem solving</li>
                            <li>Make better decisions</li>
                            <li>Helps you take your career further</li>
                        </ul>
                        <p>Complete DIAN CPD to receive your certificate by checking through the video course content below.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row courseContent">
                <div class="col-lg-12">
                    <div class="cpdHeading">
                        <h3>Course Content</h3>
                    </div>

                    <div class="cpdContent">
                        <form action="{{ route('submitcopd') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">GDC Number</label>
                                <input style="color:white" type="text" name="gdcNumber" class="form-control"
                                    id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter GDC number">
                            </div>
                            @foreach ($cpdLists as $cpdList)
                                <div class="form-check">
                                    <input class="form-check-input required" name="checkboxes[]" type="checkbox"
                                        value="{{ $cpdList->name }}" name="one" id="flexCheckDefault1">
                                    <label class="form-check-label" for="flexCheckDefault1">
                                        {{ $cpdList->name }}
                                    </label>
                                </div>
                            @endforeach
                            <button type="submit" id="submitButton" class="toggle-disabled"
                                style="display:none">Submit</button>

                            <div id="verifyButton" class="uploadChecklist">Submit</div>
                        </form>
                        <!-- @if ($checkListStatus == 1)
    <div id="overlay" class="overlayContent overlay">
                                    <img src="{{ asset('images/2023-02-DIAN-Club.png') }}" />
                                    <p>CPD CERTIFICATE</p>
                                    <h1>Submitted for review</h1>
                                    <p>You will receive your certificate by email.</p>
                                </div>
    @endif -->
                    </div>

                </div>
            </div>

            <!------- Subscription ------->
            <h1>Your Subscription</h1>
            <div class="subscriptionContainer">
                <div class="row">
                    <div class="col-lg-12">
                        @if ($status == 'cancelled')
                            <p class="subscriptionContent">Your subscription is cancelled</p>
                        @else
                            @if ($subscriptionPlan == 'ADMIN')
                                <p class="subscriptionContent">ADMIN</p>
                            @else
                                <p class="subscriptionContent">You started your {{ $subscriptionPlan }} subscription on
                                    {{ $startDate }} and your subscription will auto-renew on {{ $autoRenewelDate }}
                                </p>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 updateSub">
                        <a href="{{ route('subscriptionPlans') }}">
                            <p class="updateSubscription">Upgrade</p>
                        </a>
                    </div>
                    @if ($status != 'cancelled')
                        <div class="col-lg-6 cancelSub">
                            <p style="cursor:pointer" type="button" data-toggle="modal"
                                data-target="#exampleModalCenter" class="cancelSubscription">Cancel Subscription</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Confirm cancel subscription</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('cancelSubscription') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">What is the reason for cancelling
                                        subscription?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" value="too expensive" type="radio"
                                            name="reason" id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Too Expensive
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" value="irrelevent content" type="radio"
                                            name="reason" id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Irrelevent Content
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" value="not enough content" type="radio"
                                            name="reason" id="flexRadioDefault3">
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            Not Enough Content
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" value="poor quality content" type="radio"
                                            name="reason" id="flexRadioDefault4">
                                        <label class="form-check-label" for="flexRadioDefault4">
                                            Poor Quality Content
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" value="other" type="radio" name="reason"
                                            id="flexRadioDefault5">
                                        <label class="form-check-label" for="flexRadioDefault5">
                                            Other
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Reason</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="moreInfo">
                                </div>
                                <label class="col-form-label">Please note that by confiming cancellation of your
                                    subscription, your access to DIAN Club will be revoked and your account deleted
                                    immediately.</label>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary confirmBtn">Confirm</button>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
            <!--------------------------->

        </div>
    </div>
    <script src="{{ asset('js/profile.js') }}"></script>
@endsection
