@extends ('layouts.user_layout')

@section('head')
    <title>Edit Profile &#8211; Dian</title>
@endsection

@section('custom_style')
<style>
    .labeling{
        font-size: 16px;
    color: #AEAEAE;
    }
</style>
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <form method="POST" action="{{ route('update-user-profile') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header border-0 pb-0 flex-wrap">
                        <div class="products mb-3 anek-telugu">
                            <div class="uploadPicContainer">
                                @if ($user->profilePic != '-' && $user->profilePic != null)
                                    <img class="profileImage" id="uploadPic"
                                        src="https://www.dentistryinanutshell.com/dian/storage/app/profile_pics/{{ $user->profilePic }}"
                                        alt="Image">
                                @elseif ($user->profilePic == '-' || $user->profilePic == null)
                                    <img class="profileImage" id="uploadPic"
                                        src="{{ asset('images/general/profile.png') }}">
                                @endif
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
                            <button type="button" class="btn9 anek-telugu mr-13" id="deleteButton"
                                data-image="{{ $user->profilePic }}">Delete</button>
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
                        <div class="col-md-6">
                            <div class="mb-3">
                                <Label class="labeling anek-telegu">UserName</Label>
                                <input type="text" value="{{ $user->name ?? '' }}" class="form-control1 input-default "
                                    id="dentistName" name="dentistName" placeholder="UserName" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <Label class="labeling anek-telegu">GDC Number</Label>
                                <input type="text" value="{{ $user->gdc_number ?? '' }}"
                                    class="form-control1 input-default " name="gdc_number" placeholder="GDC NO">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <Label class="labeling anek-telegu">Designation</Label>
                                <input type="text" value="{{ $user->designation ?? '' }}"
                                    class="form-control1 input-default " name="designation" placeholder="Designation">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <Label class="labeling anek-telegu">Location</Label>
                                <input type="text" value="{{ $user->location ?? '' }}"
                                    class="form-control1 input-default " name="location" placeholder="Location">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <Label class="labeling anek-telegu">Instagram URL</Label>
                                <input type="text" value="{{ $user->instagram_url ?? '' }}"
                                    class="form-control1 input-default " name="instagram_url" placeholder="Instagram URL">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <Label class="labeling anek-telegu">Facebook URL</Label>
                                <input type="text" value="{{ $user->facebook_url ?? '' }}"
                                    class="form-control1 input-default " name="facebook_url" placeholder="Facebook URL">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <Label class="labeling anek-telegu">Twitter URL</Label>
                                <input type="text" value="{{ $user->twitter_url ?? '' }}"
                                    class="form-control1 input-default " name="twitter_url" placeholder="Twitter URL">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <Label class="labeling anek-telegu">LinkedIn URL</Label>
                                <input type="text" value="{{ $user->linkedin_url ?? '' }}"
                                    class="form-control1 input-default " name="linkedin_url" placeholder="LinkedIn URL">
                            </div>
                        </div>

                            <div class="mb-3">
                            <Label class="labeling anek-telegu">Bio</Label>

                                <textarea class="textarea1 form-control" name="bio" rows="8" placeholder="Bio">{{ $user->bio }}</textarea>
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
    <script>
        $(function() {
            $('#deleteButton').click(function() {
                var imagePath = $(this).data('image');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('delete.image') }}",
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                image_path: imagePath
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your image has been deleted.',
                                        'success'
                                    ).then((result) => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Failed!',
                                        'Failed to delete image.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting the image.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
