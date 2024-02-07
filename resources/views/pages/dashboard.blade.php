@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/dashboard.page.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class='container insight-block'>
      
      <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$0<small class="text-muted fw-light">/mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>10 users included</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$15<small class="text-muted fw-light">/mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>20 users included</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm border-primary">
          <div class="card-body">
            <h1 class="card-title pricing-card-title">${{ number_format($monthly_mentenace_budget, 2) }}<small class="text-muted fw-light">/mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li><b>${{ number_format($total_mentenance_budget, 2) }}</b> for common
area</li>
            </ul>
          </div>
        </div>
      </div>
   </div>
</div>

<div class="container recent-collection">
   <div class="recent-wrapper">
   <h5>Recently Collections</h5>
   <table class="table">
      <thead>
         <tr>
            <th scope="col">#</th>
            <th scope="col">Contributor</th>
            <th scope="col">Amount</th>
            <th scope="col">Date</th>
         </tr>
      </thead>
      <tbody>
        @foreach ($contributions as $contribution)
          <tr>
              <th scope="row">{{ $contribution->id }}</th>
              <td>{{ $contribution->proprietor->first_name }} {{ $contribution->proprietor->last_name }}</td>
              <td>${{ number_format($contribution->amount, 2) }}</td>
              <td>{{ $contribution->created_at }}</td>
         </tr>
        @endforeach
      
      </tbody>
      </table>
      @if ($contributions->isEmpty())
        <div class='empty-row'>
          No recently activity
        </div>
      @endif
      </div>
</div>
@stop
