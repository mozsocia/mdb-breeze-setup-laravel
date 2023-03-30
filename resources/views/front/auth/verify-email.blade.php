@extends('front.layouts.app')


@section('content')
  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">

        <div class="col-md-8 col-lg-6 col-xl-6 ">
          <div class="card my-4 border" style="border-radius: 15px;">
            <div class="card-body p-5">

              @if (session('status') == 'verification-link-sent')
                <div class="mb-4 text-sm text-success">
                  {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
              @endif

              <!-- START main content   -->
              <h2 class=" text-center mb-4">Thanks for signing up! </h2>
              <p> Before getting started, could you verify your email address by clicking on the link we just emailed to
                you? If you didn\'t receive the email, we will gladly send you another.
              </p>


              <form method="POST" action="{{ route('verification.send') }}">
                @csrf


                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Resend Verification Email</button>


              </form>

              <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="btn btn-primary btn mb-4">
                  {{ __('Log Out') }}
                </button>
              </form>


              <!-- END main content   -->
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
@endsection
