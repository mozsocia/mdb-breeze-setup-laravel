@extends($admin_auth_view.'layouts.app')


@section('content')
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">

      <div class="col-md-8 col-lg-6 col-xl-6">
        <div class="card my-4 border rounded-15">
          <div class="card-body p-5">

            <!-- START main content -->
            <h2 class="text-center mb-4">Sign In</h2>

            <form method="POST" action="{{ route($admin_auth_view.'login') }}">
              @csrf
              <!-- Email input -->
              <div class="mb-4">
                <label for="form2Example1" class="form-label">Email address</label>
                <input type="email" id="form2Example1" name="email" class="form-control" />
              </div>

              <!-- Password input -->
              <div class="mb-4">
                <label for="form2Example2" class="form-label">Password</label>
                <input type="password" id="form2Example2" name="password" class="form-control" />
              </div>

              <!-- 2 column grid layout for inline styling -->
              <div class="row mb-4">
                <div class="col d-flex justify-content-center">
                  <!-- Checkbox -->
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" value=""
                      id="form2Example31" />
                    <label class="form-check-label" for="form2Example31"> Remember me </label>
                  </div>
                </div>

                <div class="col">
                  @if (Route::has($admin_auth_view.'password.request'))
                    <!-- Simple link -->
                    <a href="{{ route($admin_auth_view.'password.request') }}" class="text-decoration-none">Forgot password?</a>
                  @endif

                </div>
              </div>

              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>

              <!-- Register buttons -->
              <div class="text-center">
                <p>Not a member? <a href="{{ route($admin_auth_view.'register') }}" class="text-decoration-none">Register</a></p>
                <p>or sign up with:</p>
                <button type="button" class="btn btn-link btn-floating mx-1">
                  <i class="fab fa-facebook-f"></i>
                </button>

                <button type="button" class="btn btn-link btn-floating mx-1">
                  <i class="fab fa-google"></i>
                </button>

                <button type="button" class="btn btn-link btn-floating mx-1">
                  <i class="fab fa-twitter"></i>
                </button>

                <button type="button" class="btn btn-link btn-floating mx-1">
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
</section>

@endsection
