

@extends('backend.layouts.app')

@section('content')
  @include('backend.partials.navbar')

  <div class="container">


    <h2>Hello {{ Auth::user()->name }}</h2>


  </div>
@endsection
