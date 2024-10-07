@extends ('layouts.layout_2')

@section('head')
    <title>Home &#8211; Dian</title>
@endsection


@section('custom_style')
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button.previous.disabled,
        .dataTables_wrapper .dataTables_paginate .paginate_button.next.disabled {
            color: var(--primary) !important;
            width: 5rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.previous,
        .dataTables_wrapper .dataTables_paginate .paginate_button.next {
            font-size: 13px;
            height: 24px;
            width: 40px;
            background: transparent;
            border-radius: 0.375rem;
            padding: 0 0.45rem;
            line-height: 25px;
            margin: 0 0.625rem;
            display: inline-block;
            color: var(--primary) !important;
            box-shadow: none !important;
        }

        .dataTables_wrapper {
            position: relative;
            clear: both;
            *zoom: 1;
            zoom: 1;
            overflow-x: scroll;
            height: 30rem;
        }

        [data-theme-version="dark"] .paging_simple_numbers.dataTables_paginate {
            background: #182237;
            display: none;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_processing,
        .dataTables_wrapper .dataTables_paginate {
            color: #333;
            display: none;
        }

        [data-theme-version="dark"] .table.table-striped tbody tr:nth-of-type(odd),
        [data-theme-version="dark"] .table.table-hover tr:hover {
            background-color: transparent !important;
        }

        .custom-bg {
            background: #102335;
        }
    </style>
@endsection

@section('content')
    <div class="content-body">

        {{-- @include('pages.subheader') --}}


        <div class="container-fluid">

            <div class="card1">
                <form action="#" method="POST" id="add_users">
                    @csrf
                    <div class="row">

                        <p class="speech_to_ py-3 ">Add Users</p>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <input type="text" name="firstName" class="form-control1 input-default "
                                    placeholder="First Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <input type="text" name="lastName" class="form-control1 input-default "
                                    placeholder="Last Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <input type="email" name="email"
                                    class="form-control1 input-default @error('email') is-invalid @enderror"
                                    placeholder="Email Address" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <input type="text" name="designation" class="form-control1 input-default "
                                    placeholder="Designation" required>
                            </div>
                        </div>
                    </div>
                    <div class=" pt-0 mb-4">
                        <button type="submit" class="btn12  anek-telugu">Add Account</button>
                    </div>
                </form>
            </div>

            <div class=" py-4">
                <div class="card1">
                    <p class="speech_to_ py-3 ">Users</p>
                    <table id="user_table" class=" user_table table table-striped" style="width:100%">
                        <thead class="custom-bg">
                            <tr>
                                <th>Sr #</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Email Address</th>
                                {{-- <th>Status</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($createdUsers) && $createdUsers->isnotempty())
                                @php
                                    $count = 1;
                                @endphp
                                @foreach ($createdUsers as $createdUser)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $createdUser->user->name ?? '' }}</td>
                                        <td>{{ $createdUser->user->designation ?? '' }}</td>
                                        <td>{{ $createdUser->user->email ?? '' }}</td>
                                    </tr>
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach
                            @else
                                <tr class="text-center">
                                    <td colspan="6">No User Available</td>
                                </tr>
                            @endif
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('customjs')
    <script>
        $(function() {
            function SwalLoader() {
                Swal.fire({
                    title: "Please wait...",
                    html: "",
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })

            }
            $('#add_users').on('submit', function(e) {
                SwalLoader();
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('store.user') }}",
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        Swal.close();
                        if (response.status === true) {
                            Swal.fire('Success', response.message, 'success').then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            var response = xhr.responseJSON;
                            if (response && response.status === false) {
                                Swal.fire('Error', response.message, 'error');
                            } else {
                                Swal.fire('Error', "Validation error occurred", 'error');
                            }
                        } else {
                            Swal.fire('Error', "Something went wrong!", 'error');
                        }
                    }
                });

            });
        });
    </script>
@endsection
