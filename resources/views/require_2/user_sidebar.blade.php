<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            {{-- <li class="menu-title">YOUR COMPANY</li> --}}
            <li style="background: #191920;">
                <a href="{{ route('dashboard') }}" class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <div class="menu-icon">

                        <img class="w-35" src="{{ asset('images/dashboard/dashboard.png') }}">

                    </div>
                    <span class="nav-text ">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('profile') }}" class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/dashboard/general.png') }}">
                    </div>
                    <span class="nav-text active">General</span>
                </a>
            </li>

            <li><a href="{{ route('edit.profile') }}" class="has-arrow " href="javascript:void(0);"
                    aria-expanded="false">
                    <div class="menu-icon">

                        <img class="w-35" src="{{ asset('images/dashboard/edit-profile.png') }}">
                    </div>
                    <span class="nav-text ">Edit Profile</span>
                </a>

            </li>
            <li>
                <a href="{{ route('Certificate') }}" class="has-arrow " href="javascript:void(0);"
                    aria-expanded="false">
                    <div class="menu-icon">

                        <img class="w-35" src="{{ asset('images/dashboard/certificateicon.png') }}">
                    </div>
                    <span class="nav-text ">CPD Certificate</span>
                </a>
            </li>

            {{-- <li><a href="{{ route('podcasts-and-webinars') }}" class="" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/dashboard/email-notofication.png') }}">
                    </div>
                    <span class="nav-text">Email Notification</span>
                </a>
            </li> --}}

            <li><a href="{{ route('billing') }}" class="" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/dashboard/blogs.png') }}">
                    </div>
                    <span class="nav-text">Billing</span>
                </a>
            </li>

            <li class="hover-black" style="cursor: pointer"> <a class="hover-black cancelSubscription" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/dashboard/delete.png') }}">
                    </div>
                    <span class="nav-text red-color-text">Delete account</span>
                </a>
            </li>

        </ul>
    </div>
</div>

<div class="modal fade cancelModal" id="cancelModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-bg-custom">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <form method="POST" action="{{ route('cancelSubscription') }}">
                @csrf
                <div class="modal-body anek-telugu lorem-ipsum-dolor cancel-form">
                    <h3>Confirm cancel subscription</h3>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">What is the reason for cancelling
                            subscription?</label>
                        <div class="form-check">
                            <input class="form-check-input" value="too expensive" type="radio" name="reason"
                                id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Too Expensive
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="irrelevent content" type="radio" name="reason"
                                id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Irrelevent Content
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="not enough content" type="radio" name="reason"
                                id="flexRadioDefault3">
                            <label class="form-check-label" for="flexRadioDefault3">
                                Not Enough Content
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="poor quality content" type="radio" name="reason"
                                id="flexRadioDefault4">
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
                        <label for="exampleInputEmail1" class="inputHeading">Reason</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="moreInfo">
                    </div>
                    <label class="col-form-label">Please note that by confiming cancellation of your
                        subscription, your access to DIAN Club will be revoked and your account deleted
                        immediately.</label>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-primary custom-btn">cancel</button>
                        <button type="submit" class="btn btn-primary custom-btn">Confirm</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<style>
    .cancel-form label.col-form-label {
        font-size: 18px;
        color: white
    }

    [data-theme-version="dark"] .modal-content.modal-bg-custom {
        background: #182237 !important;
    }

    .cancel-form .form-check {
        font-size: 18px;
        color: white;
    }

    .cancel-form .inputHeading {
        font-size: 15px;
        color: white;
    }

    .cancel-form .modal-footer {
        padding: 0px 0;
    }
</style>
<script>
    $('.cancelSubscription').on('click', function() {
        $('.cancelModal').modal('show');

    });
</script>
