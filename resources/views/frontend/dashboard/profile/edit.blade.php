@extends('frontend.dashboard.layout')

@section('content')
  @include('frontend.dashboard.partials.navbar')

  <div class="container">


    <h2>Hello {{ Auth::user()->name }}</h2>


    <!-- Button trigger modal -->
    <a type="button" class="" data-mdb-toggle="modal" data-mdb-target="#exampleModal">
      Launch demo modal
    </a>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">...</div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Profile Information   -->


    <div class="card my-4 border" style="border-radius: 10px;">
      <div class="card-body p-5 w-50">
        <h5 class="card-title">Profile Information</h5>
        <h6 class="card-subtitle mb-5 text-muted">Update your account's profile information and email address.</h6>


        <!-- START main content   -->

        <div class="my-4">
          @if (!$user->hasVerifiedEmail())
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
              @csrf



            </form>


            <div>
              <p class="text-warning mt-2 text-gray-800">
                {{ __('Your email address is unverified.') }}

                <button form="send-verification" class="btn btn-outline-primary">
                  {{ __('Click here to re-send the verification email.') }}
                </button>
              </p>
            </div>
          @else
          @endif

          @if ($user->hasVerifiedEmail())
            <button class="btn btn-outline-success" disabled>Email address is verified</button>
          @endif

        </div>

        <form method="POST" action="{{ route('profile.update') }}">
          @csrf
          @method('patch')
          <!-- Name input -->
          <div class="form-outline mb-4">
            <input type="text" id="form2Example2" name="name" class="form-control"
              value="{{ old('name', $user->name) }}" />
            <label class="form-label" for="form2Example2">Name</label>
          </div>

          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" id="form2Example1" name="email" class="form-control"
              value="{{ old('email', $user->email) }}" />
            <label class="form-label" for="form2Example1">Email address</label>
          </div>





          <!-- Submit button -->
          <button type="submit" class="btn btn-primary mb-4 card-link">Update</button>

        </form>


        <!-- END main content   -->
      </div>
    </div>



    <!-- Password Update Form    -->

    <div class="card my-4 border" style="border-radius: 10px;">
      <div class="card-body p-5 w-50">
        <h5 class="card-title">Update Password</h5>
        <h6 class="card-subtitle mb-5 text-muted">Ensure your account is using a long, random password to stay secure.
        </h6>

        <!-- START main content   -->

        <form method="POST" action="{{ route('password.update') }}">
          @csrf
          @method('PUT')
          <!-- Current Password Input -->
          <div class="form-outline mb-4">
            <input type="password" id="current_password" name="current_password" class="form-control"
              autocomplete="current-password" />
            <label class="form-label" for="current_password">Current Password</label>
          </div>

          <!-- New Password Input -->
          <div class="form-outline mb-4">
            <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" />
            <label class="form-label" for="password">New Password</label>
          </div>

          <!-- Password Confirmation Input -->
          <div class="form-outline mb-4">
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
              autocomplete="new-password" />
            <label class="form-label" for="password_confirmation">Confirm New Password</label>
          </div>




          <!-- Submit button -->
          <button type="submit" class="btn btn-primary mb-4 card-link">Save</button>

        </form>


        <!-- END main content   -->
      </div>
    </div>


  </div>
@endsection
