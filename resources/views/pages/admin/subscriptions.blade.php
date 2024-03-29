@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/table.list.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class='container'>
    <div class='title-action-bar'>
        <div class='title'>
          <h5>Subscriptions</h5>
        </div>
    </div>
</div>

<div class="container collection-list">
  <div class="table-wrapper">
    <h5>List of Subscriptions</h5>

    <table class="table table-hover caption-top">
      <caption></caption>
      <thead class="table-dark">
        <tr>
          <th scope="col">Ref#</th>
          <th scope="col">Account#</th>
          <th scope="col">Customer#</th>
          <th scope="col">Plan</th>
          <th scope="col">State</th>
          <th scope="col">Start Date</th>
          <th scope="col">Renewal Date</th>
        </tr>
      </thead>
      <tbody>
      @if ($subscriptions->isNotEmpty())
        @foreach($subscriptions as $index => $subscription)
          <tr>
            <td scope="row">{{ $subscription->id }}</td>
            <td>{{ $subscription->account->number }}</td>
            <td>{{ $subscription->customer->number }}</td>
            <td>{{ $subscription->plan->name }}</td>
            <td>{{ $subscription->is_active ? 'Active' : 'InActive' }}</td>
            <td>{{ $subscription->start_date }}</td>
            <td>
              {{ $subscription->renewal_date }}
              <div class='d-flex justify-content-end contextmenu-block' data-row='{{ $index }}'>
                <div class="dropdown menu-options">
                  <button
                    data-mdb-dropdown-init
                    class="dropdown-toggle d-flex align-items-center"
                    href="#"
                    id="navbarDropdownMenuOption"
                    role="button"
                    data-bs-toggle="dropdown" 
                    aria-expanded="false"
                  >
                    <img
                      src="{{ URL::asset('images/more-option-icon.svg') }}"
                      class="rounded-circle avatar-icon"
                      height="25"
                      alt="Black and White Portrait of a Man"
                      loading="lazy"
                    />
                  </button>
                  <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="navbarDropdownMenuOption"
                  >
                    <li>
                      <a class="dropdown-item" href="/#edit">Payments</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="/#delete">Cancel</a>
                    </li>
                    </ul>
                  </div>
                </div>
            </td>
          </tr>
        @endforeach
      @endif
      </tbody>
    </table>
    @if ($subscriptions->isEmpty())
      <div class='empty-row'>
        No subscriptions found
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
