@extends ('layouts.layout_profile')

@section('head')
    <title>Edit Profile &#8211; Dian</title>
@endsection

@section('custom_style')
    <style>
        .content-body {
            margin: 0rem 18rem;
        }

        .assist-btn {
            color: #F8B940 !important;
            font-weight: bold;
            display: none;
        }

        .header-right .search-area {
            width: 15.625rem;
            display: none;
        }

        [data-theme-version="dark"][data-layout="vertical"][data-sidebar-position="fixed"] .deznav {
            border-color: rgba(255, 255, 255, 0.1);
            display: none;
        }

        .btn1 {
            padding: 12px 14px;
            border-radius: 0.375rem;
            font-weight: 500;
            font-size: 18px;
        }
    </style>
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <form method="POST" action="{{ route('upload-initial-profile-data') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header border-0 pb-0 flex-wrap">
                        <div class="products mb-3 anek-telugu">
                            <div class="uploadPicContainer">
                                <img class="profileImage" id="uploadPic" src="{{ asset('images/general/profile.png') }}">
                                <input
                                    onchange="document.getElementById('uploadPic').src = window.URL.createObjectURL(this.files[0])"
                                    type="file" name="editProfilePic" id="editProfilePic"
                                    style="display: none !important;" />
                            </div>
                            <div class="uploadBtnContainer">
                                <button id="uploadLatestPic" type="button"
                                    class="btn9 anek-telugu mr-13 uploadNewProfilePhoto">Upload New
                                    Picture</button>
                            </div>
                        </div>

                        <ul class="nav nav-pills mix-chart-tab" id="pills-tab" role="tablist">
                            {{--
                            <li class="nav-item" role="presentation">
                                <a href="{{ route('subscriptionPlans') }}">
                                    <button class="nav-link"> <span style="color: #b79150">Upgrade</span> your
                                        account</button></a>
                            </li> --}}
                        </ul>
                    </div>
                    <div class="row py-3">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <input type="text" class="form-control1 input-default " name="firstName"
                                    placeholder="First Name" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control1 input-default " name="lastName"
                                    placeholder="Last Name" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control1 input-default " name="gdc_number"
                                    placeholder="GDC/REGISTRATION NO." required>
                            </div>
                        </div>
                    </div>
                    <div class="row py-4">
                        <div class="col-md-2">
                            <button type="submit" class="btn1 btn-secondary anek-telugu">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    </div>
@endsection
@section('customjs')
    <script src="{{ asset('js/profile.js') }}"></script>
@endsection
