@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/dashboard.page.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class='container insight-block'>
      
      <div class="row row-cols-1 row-cols-md-2 mb-2 text-center">
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-body">
            <h1 class="card-title pricing-card-title">{{ $stats['subscriptions_count'] }}</h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>active subscriptions</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-body">
            <h1 class="card-title pricing-card-title">{{ $stats['customer_count'] }}</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>registered customers</li>
            </ul>
          </div>
        </div>
      </div>
   </div>
</div>

<div class="container recent-collection">
   <div class="recent-wrapper">
   <h5>Recent Subscriptions</h5>
   <table class="table">
      <thead>
         <tr>
            <th scope="col">Ref#</th>
            <th scope="col">Customer#</th>
            <th scope="col">Plan</th>
            <th scope="col">Start Date</th>
         </tr>
      </thead>
      <tbody>
        @foreach ($subscriptions as $subscription)
          <tr>
              <th scope="row">{{ $subscription->id }}</th>
              <td>{{ $subscription->customer->number }}</td>
              <td>{{ $subscription->plan->name }}</td>
              <td>{{ $subscription->start_date }}</td>
         </tr>
        @endforeach
      
      </tbody>
      </table>
      @if ($subscriptions->isEmpty())
        <div class='empty-row'>
          No recently activity
        </div>
      @endif
      </div>
</div>
@stop
