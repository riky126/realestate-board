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
            <h1 class="card-title pricing-card-title">$29<small class="text-muted fw-light">/mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>30 users included</li>
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
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
         </tr>
         <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
         </tr>
         <tr>
            <th scope="row">3</th>
            <td>Larry</td>
            <td>the Bird</td>
            <td>@twitter</td>
         </tr>
      </tbody>
      </table>
      </div>
</div>
@stop
