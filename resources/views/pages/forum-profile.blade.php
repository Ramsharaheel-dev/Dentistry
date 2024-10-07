@extends ('layouts.layout_2')

@section('head')
    <title>{{ strtoupper($user->name) }} Profile &#8211; Dian</title>
@endsection

@section('custom_style')
@endsection

@section('content')
    <div class="content-body anek-telugu">
        <div class="container-fluid">
            <div class="row">
                <div class="card-header border-0 pb-0 flex-wrap">
                    <div class="products mb-3 anek-telugu">
                        <div class="uploadPicContainer">
                            {{-- <img class="profileImage2 w-h-100" id="" src="http://localhost/dentistry/storage/app/profile_pics/{{$user->profilePic}}"> --}}
                            <img class="profileImage2 w-h-100" id=""
                                src="https://www.dentistryinanutshell.com/dian/storage/app/profile_pics/{{ $user->profilePic }}">
                        </div>
                        <div class="uploadBtnContainer">
                            <p class="title_wrapper anek-telugu">{{ $user->name ?? '' }}</p>
                            {{-- <p class="dentist">THE Dentist Coach, Board Certified Orthodontist</p> --}}
                            <p class="step_into_ anek-telugu"><span>@</span>{{ $user->designation ?? '' }}</p>
                        </div>
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col-md-12">
                        <p class="step_into_ anek-telugu"> <img class="w-4-mobile"
                                src="{{ asset('images/forum/map.png') }}">
                            {{ $user->location ?? 'No Location' }} <a href="mailto:{{ $user->email }}"><span
                                    class="contact-info anek-telugu">&nbsp;Contact Info</span></a></p>
                        <div class="py-5">
                            <p class="title_wrapper anek-telugu">About Me</p>
                            <p class="introducin4 anek-telugu" style="color: #AEAEAE">{{ $user->bio ?? 'No Bio' }}</p>
                        </div>
                        <p class="title_wrapper anek-telugu">Social Media</p>
                        <a target="_blank" href="{{ $user->instagram_url ?? '' }}"><img class="w-4 mr-4"
                                src="{{ asset('images/forum/instagram.png') }}"></a>
                        <a target="_blank" href="{{ $user->facebook_url ?? '' }}"><img class="w-4 mr-4"
                                src="{{ asset('images/forum/fb.png') }}"></a>
                        <a target="_blank" href="{{ $user->twitter_url ?? '' }}"><img class="w-4 mr-4"
                                src="{{ asset('images/forum/x.png') }}"></a>
                        <a target="_blank" href="{{ $user->linkedin_url ?? '' }}"> <img class="w-4"
                                src="{{ asset('images/forum/linkedin.png') }}"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
