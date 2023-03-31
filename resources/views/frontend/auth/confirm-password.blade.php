@extends('frontend.layouts.app')


@section('content')
  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">

        <div class="col-md-8 col-lg-6 col-xl-6 ">
          <div class="card my-4 border" style="border-radius: 15px;">
            <div class="card-body p-5">

              <!-- START main content   -->

              <h4 class=" text-center mb-4">Please confirm password</h4>
              <p> This is a secure area of the application. Please confirm your password before continuing. </p>

              <form method="POST" action="{{ route('password.confirm') }}">
                @csrf
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="password" id="form2Example1" name="password" required autocomplete="current-password"
                    class="form-control" />
                  <label class="form-label" for="form2Example1">Password</label>
                </div>



                <!-- Submit button -->
                <button type="button" class="btn btn-primary btn-block mb-4">Confirm</button>


              </form>


              <!-- END main content   -->
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
@endsection
