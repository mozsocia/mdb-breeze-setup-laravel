@extends($admin_auth_view.'layouts.app')


@section('content')
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">

      <div class="col-md-8 col-lg-6 col-xl-6">
        <div class="card my-4 border rounded-15">
          <div class="card-body p-5">

            <!-- START main content -->
            <h2 class="text-center mb-4">Reset Password</h2>

            <form method="POST" action="{{ route($admin_auth_view.'password.store') }}">
              @csrf

              <!-- Password Reset Token -->
              <input type="hidden" name="token" value="{{ $request->route('token') }}">

              <!-- Email input -->
              <div class="mb-4">
                <label for="form2Example1" class="form-label">Email address</label>
                <input type="email" id="form2Example1" name="email" class="form-control"
                  value="{{ old('email', $request->email) }}" />
              </div>

              <!-- Password input -->
              <div class="mb-4">
                <label for="form2Example2" class="form-label">Password</label>
                <input type="password" id="form2Example2" name="password" class="form-control" />
              </div>

              <!-- Confirm Password input -->
              <div class="mb-4">
                <label for="form3Example4" class="form-label">Confirm Password</label>
                <input type="password" id="form3Example4" name="password_confirmation" class="form-control" />
              </div>

              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block mb-4">Reset Password</button>

            </form>
            <!-- END main content -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
