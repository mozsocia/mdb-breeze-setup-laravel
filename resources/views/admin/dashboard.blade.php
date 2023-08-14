@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
  
@endphp

@extends($admin_auth_view.'layouts.app')

@section('content')
  @include($admin_auth_view.'partials.navbar')

  <div class="container">


    <h2>Hello {{ Auth::user()->name }}</h2>

    {{ $prefix }}
    {{ $route }}

  </div>
@endsection
