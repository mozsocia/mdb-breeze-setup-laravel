@extends('front.layouts.app')

@section('content')
  @include('front.partials.navbar')

  <div class="container">


    <h2>Hello {{ Auth::user()->name }}</h2>

  </div>
@endsection
