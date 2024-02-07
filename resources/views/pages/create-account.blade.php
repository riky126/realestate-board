@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/create-account.page.css') }}" rel="stylesheet">
@endpush

@push('data_scripts')
    <script type="text/javascript">
      var plans = '<?php echo json_encode($plans); ?>';
      var $PLANS = @json($plans->toArray())
    </script>
@endpush


@push('scripts')
    <script type="text/javascript" src="{{ asset('js/create-account.js') }}"></script>
@endpush


@section('content')

<div class="container c-account-wrapper">
  <div class="row">
    <div class='inner-content'>
      
      <div class='page-heading'>
        <h2>Create new Account</h2>
        <h4>Already Registered? <a href="{{ url('login') }}">Login</a></h4>
      </div>
    
      <form action="{{ url('create-account') }}" method='POST'>
        @if($errors->any())
          @foreach($errors->all() as $err)
              <p class="alert alert-danger">{{ $err }}</p>
          @endforeach
        @endif

        @csrf
        <section class='section-block'>
          <h5>Choose Plan</h5>

            @foreach($plans as $plan)
              <div class='section-content plans'>
                <div class='plan-group' data-id="{{ $plan->id }}">
                    <div class='plan-name'>
                      <p>{{ $plan->name }}</p>
                    </div>
                    <div class='bill-cylc'>
                        <span>{{ $plan->billing_cycle }}</span>
                    </div>
                    <div class='plan-price'>
                      <div class='amt'>${{ $plan->price }}</div>
                      @if ($plan->discount > 0)
                        <span>Save {{ $plan->discount }}%</span>
                      @endif
                    </div>
                </div>
              </div>
            @endforeach
          <span class="help-block">Choose a subscription plan.</span>
          <input type='hidden' id="inputPlan" name='plan' value='' />
        </section>

        <section class='section-block corp-info'>
          <h5>Corporation Info</h5>
          <div class='section-content'>
            <div class='form-group'>
              <label for="inputCorpName" class="form-label">Name</label>
              <input type="text" name="name" id="inputCorpName"
                    value="{{ old('name') }}"
                    class="form-control" placeholder="Corp. Name" required autofocus>
            </div>

            <div class='form-group'>
              <label for="inputName" class="form-label">Strata Plan No.</label>
              <input type="text" name="strata_number" id="inputName"
                    value="{{ old('strata_number') }}"
                    class="form-control" placeholder="#1234" required autofocus>
            </div>

          </div>
        </section>

        <section class='section-block acct-details'>
          <h5>Account Detail</h5>
          <div class='section-content'>
            <div class='form-group'>
              <label for="inputName" class="form-label">Name</label>
              <div class="field-pair">
                <input type="text" name="first_name" id="inputFirstName"
                      value="{{ old('first_name') }}"
                      class="form-control" placeholder="John" required autofocus>

                <input type="text" name="last_name" id="inputLastName"
                      value="{{ old('last_name') }}"
                      class="form-control" placeholder="Joe" required autofocus>
              </div>

              <div class='form-group'>
                <label for="inputEmail" class="form-label">Email address</label>
                <input type="email" name="email" id="inputEmail"
                      value="{{ old('email') }}"
                      class="form-control" placeholder="Email address" required autofocus>
              </div>
    
              <div class='form-group'>
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" name="password" id="inputPassword"
                      class="form-control" placeholder="* * * * * *" required>
              </div>
            </div>
          </div>
        </section>

        <button class="btn btn-lg btn-primary btn-block flexible" type="submit">Subscribe</button>
      </form>
    </div>
  </div>
</div>

@stop
