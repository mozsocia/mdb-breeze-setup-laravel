@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
  
@endphp

@extends('frontend.layouts.app')

@section('content')
  @include('frontend.partials.navbar')

  <div class="container">


    <h2>Hello {{ Auth::user()->name }}</h2>

    {{ $prefix }}
    {{ $route }}

  </div>
@endsection
