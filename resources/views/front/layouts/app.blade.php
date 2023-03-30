<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Material Design for Bootstrap</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
</head>
<style>
  .divider:after,
  .divider:before {
    content: "";
    flex: 1;
    height: 1px;
    background: #eee;
  }

  .h-custom {
    height: calc(100% - 73px);
  }

  @media (max-width: 450px) {
    .h-custom {
      height: 100%;
    }
  }

  /* .alert-message {
    margin-top: 10px;
    width: 40%;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 9999;
    margin: 0 auto;
    opacity: .8;
  } */
  .alert-floating {
    position: fixed;
    top: 10px;
    right: 20px;
    z-index: 9999;
    opacity: .9;
  }
</style>

<body style="background-color: #F3F4F6">
  <div class="container">



    @if (session('status'))
      <div class="alert alert-primary alert-message session-alert">
        {{ session('status') }}
      </div>
    @endif


    @if ($errors->any())

      <div class="alert alert-danger session-alert">
        {{ __('Whoops! Something went wrong.') }}
      </div>

      <div class="row d-fex justify-content-center mt-3">
        <div class="col-md-6 dip">
          <ul class="mt-3 list-group list-group-light text-danger">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>

    @endif


  </div>




  <!-- Start your project here-->
  @yield('content')
  <!-- End your project here-->

  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
  <!-- Custom scripts -->


  <script>
    // setTimeout(function() {
    //   var errorAlert = document.getElementById('error-alert');
    //   if (errorAlert) {
    //     errorAlert.style.display = 'none';
    //   }
    // }, 5000);


    // document.addEventListener("DOMContentLoaded", function(event) {
    //   var alertMessages = document.getElementsByClassName("alert-message");

    //   setTimeout(function() {
    //     for (var i = 0; i < alertMessages.length; i++) {
    //       var alertMessage = alertMessages[i];
    //       alertMessage.style.transition = "opacity 1s";
    //       alertMessage.style.opacity = 0;
    //       setTimeout(function() {
    //         alertMessage.style.display = "none";
    //       }, 2000);
    //     }
    //   }, 5000);
    // });

    // Get the session alert element
    const sessionAlert = document.querySelector(".session-alert");

    // Add the alert-floating class to make it float
    sessionAlert.classList.add('alert-floating');

    // Add a transition effect to the alert
    sessionAlert.style.transition = 'transform 0.8s ease';

    // Slide the alert in from the right
    sessionAlert.style.transform = 'translateX(100%)';

    // Wait for 100ms to allow the slide-in effect to take place
    setTimeout(() => {
      // Slide the alert back to its original position
      sessionAlert.style.transform = 'translateX(0)';
    }, 100);

    // Wait for 5 seconds before sliding the alert out
    setTimeout(() => {
      // Slide the alert out to the right
      sessionAlert.style.transform = 'translateX(100%)';

      // Wait for 500ms to allow the slide-out effect to take place
      setTimeout(() => {
        // Remove the alert from the DOM
        sessionAlert.remove();
      }, 500);
    }, 7000);
  </script>
</body>

</html>
