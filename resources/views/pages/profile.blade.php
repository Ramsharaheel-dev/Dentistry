@extends ('layouts.user_layout')
@section('head')
    <title>Profile &#8211; Dian</title>
@endsection

@section('custom_style')

@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="card-header border-0 pb-0 flex-wrap">
                        <div class="products mb-3 anek-telugu">
                            @if ($user->profilePic != '-' && $user->profilePic != null)
                                <img class="profileImage" id="uploadPic"
                                    src="https://dentistryinanutshell.com/dian/storage/app/profile_pics/{{ $user->profilePic }}"
                                    alt="Image">
                            @elseif ($user->profilePic == '-' || $user->profilePic == null)
                                <img class="profileImage" id="uploadPic" src="{{ asset('images/general/profile.png') }}">
                            @endif
                            <div>
                                <h6><a href="javascript:void(0)">{{ $user->name }} / General</a></h6>
                                <span>Set up your Dian Club presence and hiring needs</span>
                            </div>
                        </div>
                        <ul class="nav nav-pills mix-chart-tab" id="pills-tab" role="tablist">

                            <li class="nav-item" role="presentation">
                                <a href="{{ route('subscriptionPlans') }}">
                                    <button class="nav-link"> <span style="color: #b79150">Upgrade</span> your
                                        account</button></a>
                            </li>
                        </ul>
                    </div>

                    <div class="row py-3">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <input value="{{ $user->name }}" class="form-control1 input-default" disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <input value="{{ $user->email }}" class="form-control1 input-default " disabled>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

