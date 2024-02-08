@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/table.list.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class='container'>
    <div class='title-action-bar'>
        <div class='title'>
          <h5>Customers</h5>
        </div>
    </div>
</div>

<div class="container collection-list">
  <div class="table-wrapper">
    <h5>List of Customer</h5>

    <table class="table table-hover caption-top">
      <caption></caption>
      <thead class="table-dark">
        <tr>
          <th scope="col">Customer#</th>
          <th scope="col">Strata Corp.</th>
          <th scope="col">Name</th>
          <th scope="col">Username</th>
          <th scope="col">Date Joined</th>
        </tr>
      </thead>
      <tbody>
      @if ($customers->isNotEmpty())
        @foreach($customers as $customer)
          <tr>
            <td scope="row">{{ $customer->number }}</td>
            <td>
              <span class='lg-badge'>#{{ $customer->corporation->number }}</span>
              {{ $customer->corporation->name }}
            </td>
            <td>{{ $customer->user->name }}</td>
            <td>{{ $customer->user->email }}</td>
            <td>{{ $customer->created_at }}</td>
          </tr>
        @endforeach
      @endif
      </tbody>
    </table>
    @if ($customers->isEmpty())
      <div class='empty-row'>
        No customers found
      </div>
    @endif

    <nav aria-label="page navigation">
      <ul class="pagination justify-content-end">
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>

  </div>
</div>
@stop
