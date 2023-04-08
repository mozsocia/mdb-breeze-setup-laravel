@extends('backend.dashboard.layout')

@section('content')
  @include('backend.dashboard.partials.navbar')

  <div class="container">


    <h2>Hello {{ Auth::guard('admin')->user()->name }}</h2>


  </div>
@endsection
