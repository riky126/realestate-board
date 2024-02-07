@extends('layouts.basic')

@push('styles')
    <link href="{{ asset('css/login.page.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/login.js') }}"></script>
@endpush

@section('head')@stop

@section('content')

<div class='login-wrapper'>
  <!-- Show errors !-->
  @if($errors->any())
    @foreach($errors->all() as $err)
      <p class="alert alert-danger">{{ $err }}</p>
    @endforeach
  @endif
  
  <div class='login-form-container'>

    <form class="form-signin" action="{{ url('login') }}" method="POST">
      @csrf
      <img class="mb-4" src="{{ asset('images/logo.svg') }}" alt="" width="150" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
      
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block flexible" type="submit">Sign in</button>
    </form>

  </div>
</div>

@stop
