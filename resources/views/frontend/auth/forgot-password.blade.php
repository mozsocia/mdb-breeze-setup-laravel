@extends('frontend.layouts.app')


@section('content')
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">

      <div class="col-md-8 col-lg-6 col-xl-6">
        <div class="card my-4 border rounded-15">
          <div class="card-body p-5">

            <!-- START main content -->
            <h4 class="text-center mb-4">Forgot your password? No problem.</h4>
            <p> Just let us know your email address and we
              will email you a password reset link that will allow you to choose a new one. </p>

            <form method="POST" action="{{ route('password.email') }}">
              @csrf
              <!-- Email input -->
              <div class="mb-4">
                <label for="form2Example1" class="form-label">Email address</label>
                <input type="email" id="form2Example1" name="email" class="form-control" />
              </div>

              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block mb-4">Email Password Reset Link</button>
            </form>

            <!-- END main content -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
