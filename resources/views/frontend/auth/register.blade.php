@extends('frontend.layouts.app')


@section('content')
<section class="vh-100">
  <div class="d-flex align-items-center h-100">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card my-4 border rounded-15">
            <div class="card-body p-5">

              <!-- START main content -->
              <h2 class="text-center mb-4">Create an account</h2>

              <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- 2 column grid layout with text inputs for the first and last names -->
                                 
                <div class="mb-4">
                  <label for="form3Example1" class="form-label">Name</label>
                  <input type="text" id="form3Example1" name="name" class="form-control" />
                </div>                            

                <!-- Email input -->
                <div class="mb-4">
                  <label for="form3Example3" class="form-label">Email address</label>
                  <input type="email" id="form3Example3" name="email" class="form-control" />
                </div>

                <!-- Password input -->
                <div class="mb-4">
                  <label for="form3Example4" class="form-label">Password</label>
                  <input type="password" id="form3Example4" name="password" class="form-control" />
                </div>

                <!-- Confirm Password input -->
                <div class="mb-4">
                  <label for="form3Example5" class="form-label">Confirm Password</label>
                  <input type="password" id="form3Example5" name="password_confirmation" class="form-control" />
                </div>

                <!-- Checkbox -->
                <div class="form-check d-flex justify-content-center mb-4">
                  <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" />
                  <label class="form-check-label" for="form2Example33">
                    Accept terms and condition
                  </label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Sign up</button>

                <!-- Register buttons -->
                <div class="text-center">
                  <p>or sign up with:</p>
                  <button type="button" class="btn btn-secondary btn-floating mx-1">
                    <i class="fab fa-facebook-f"></i>
                  </button>

                  <button type="button" class="btn btn-secondary btn-floating mx-1">
                    <i class="fab fa-google"></i>
                  </button>

                  <button type="button" class="btn btn-secondary btn-floating mx-1">
                    <i class="fab fa-twitter"></i>
                  </button>

                  <button type="button" class="btn btn-secondary btn-floating mx-1">
                    <i class="fab fa-github"></i>
                  </button>
                </div>
              </form>
              <!-- END main content -->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
