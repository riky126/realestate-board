@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/table.list.css') }}" rel="stylesheet">
@endpush

@push('data_scripts')
  <script type="text/javascript">
    window['PROPRIETORS'] = @json($proprietors->toArray());
  </script>
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/constribution-page.js') }}"></script>
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
          <th scope="col">Contributor</th>
          <th scope="col">Monthly Fee</th>
          <th scope="col">Amount Paid</th>
          <th scope="col">Date</th>
        </tr>
      </thead>
      <tbody>
      @if ($contributions->isNotEmpty())
        @foreach($contributions as $contribution)
          <tr>
            <td scope="row">{{ $contribution->id }}</td>
            <td>{{ $contribution->proprietor->first_name }} {{ $contribution->proprietor->last_name }} 
              <span class='lg-badge'>Lot #: {{ $contribution->proprietor->lot_number }}</span>
            </td>
            <td>
              ${{ number_format($contribution->proprietor->maintenance_fee, 2) }}
              </td>
            <td>
              ${{ number_format($contribution->amount, 2) }}
              <span class='lg-badge'>{{ $contribution->amount - $contribution->proprietor->maintenance_fee }}</span>
            </td>
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
