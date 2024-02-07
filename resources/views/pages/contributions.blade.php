@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/table.list.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class='container'>
    <div class='title-action-bar'>
        <div class='title'>
          <h5>Contributions</h5>
        </div>
        <div class='action-box'>
          <button type="button" class="btn btn-secondary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Add New</button>
        </div>
    </div>
</div>

<div class="container collection-list">
  <div class="table-wrapper">
    <h5>List of Contributions</h5>

    <table class="table table-hover caption-top">
      <caption></caption>
      <thead class="table-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Donner</th>
          <th scope="col">Amount</th>
          <th scope="col">Date</th>
        </tr>
      </thead>
      <tbody>
      @if ($contributions->isNotEmpty())
        @foreach($contributions as $contribution)
          <tr>
            <td scope="row">{{ $contribution->id }}</td>
            <td>{{ $contribution->proprietor->first_name }} {{ $contribution->proprietor->last_name }}</td>
            <td>{{ $contribution->amount }}</td>
            <td>{{ $contribution->created_at }}</td>
          </tr>
        @endforeach
      @endif
      </tbody>
    </table>
    @if ($contributions->isEmpty())
      <div class='empty-row'>
        No data found
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
@include('modals.modal-create-contribution')
@stop
