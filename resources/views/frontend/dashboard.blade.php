@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
  
@endphp

@extends('front.layouts.app')

@section('content')
  @include('front.partials.navbar')

  <div class="container">


    <h2>Hello {{ Auth::user()->name }}</h2>

    {{ $prefix }}
    {{ $route }}

  </div>
@endsection
