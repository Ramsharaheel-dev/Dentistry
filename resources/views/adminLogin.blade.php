@extends ('layouts.layout')

@section('head')
<title>Admin &#8211; Dian</title>
@endsection

@section('content')

<style>
    .form-outline input{
        color:white !important;
    }

    .form-control{
      color: white !important;
    }

    input:focus {
      background-color: #232323 !important;
      color: white !important;
    }

    .adminLoginBtn{
      background-color: #d9aa5a;
    }
</style>
<section class="vh-100 ">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

            <form method="post" action="{{ route('checkAdminLogin') }}">
                @csrf
              <h2 class="fw-bold mb-2 text-uppercase">Admin Login</h2>
              <p class="text-white-50 mb-5">Please enter your login and password!</p>

              <div class="form-outline form-white mb-4">
                <input type="email" required id="typeEmailX" name="adminEmail" class="form-control form-control-lg" placeholder="Entry your email" />
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" required id="typePasswordX" name="adminPassword" class="form-control form-control-lg" placeholder = "Enter your password"/>
              </div>
              <button class="btn btn-outline-light btn-lg px-5 adminLoginBtn" type="submit">Login</button>

            </form>

            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection