@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
  
@endphp

@extends('frontend.dashboard.layout')


@section('content')
  @include('frontend.dashboard.partials.navbar')

  <div class="container">


    <h2>Hello {{ Auth::user()->name }}</h2>

    {{ $prefix }}
    {{ $route }}

  </div>
@endsection
