@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/home.page.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class='jumbotron text-center home-content'>
  <div class="container">
    <h1 class="jumbotron-heading">Stratafair App</h1>
    <p class="lead text-muted">Welcome to the Stratafair Platform. You can Subscribe for a easy and convenient way to manage your Proprietor and Contributions.</p>
    <p class="lead text-muted">Login if you already have an account.</p>
    <p>
      <a href="{{ URL::to('create-account')}}" class="btn btn-primary my-2">Subscribe Now</a>
      <a href="{{ URL::to('login')}}" class="btn btn-secondary my-2">Login</a>
    </p>
  </div>
</div>
@stop
