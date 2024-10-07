@extends ('layouts.layout')

@section('head')
    <title>CMS &#8211; Dian</title>
@endsection

@section('content')
    <style>
        .form-outline input {
            color: white !important;
        }

        .form-control {
            color: white !important;
        }

        input:focus {
            background-color: #232323 !important;
            color: white !important;
        }

        .adminLoginBtn {
            background-color: #d9aa5a;
        }

        button {
            background-color: #D9AA59 !important;
        }

        form input:focus:invalid,
        form textarea:focus:invalid,
        form select:focus:invalid {
            color: #D9AA59;
            border-color: #D9AA59;
        }
    </style>
    <section class="vh-100 ">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <form method="post" action="{{ route('cms.check.login') }}">
                                    @csrf
                                    <h2 class="fw-bold mb-2 text-uppercase">CMS Login</h2>
                                    <p class="text-white-50 mb-5">Please enter your login and password!</p>
                                    <div class="form-outline form-white mb-4">
                                        <input type="email" required autocomplete="off" id="" name="cmsEmail"
                                            class="form-control form-control-lg" placeholder="Enter your email" />
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <input type="password" required autocomplete="off" name="cmsPassword"
                                            class="form-control form-control-lg" placeholder = "Enter your password" />
                                    </div>
                                    <button class="btn btn-outline-light btn-lg px-5 adminLoginBtn"
                                        type="submit">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
