@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/table.list.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class='container'>
    <div class='title-action-bar'>
        <div class='title'>
          <h5>Proprietors</h5>
        </div>
        <div class='action-box'>
          <button type="button" class="btn btn-secondary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Add New</button>
        </div>
    </div>
</div>

<div class='date-field-group'>
  <label class='form-label'>Accounting period</label>
  <input class='form-control' id="bday-month" type="month" name="bday-month" value="2024-02" />
</div>

<div class="container collection-list">
  <div class="table-wrapper">
    <div class='table-lead'>
      <h5>List of Proprietors </h5> <span class='lg-badge'>Month Maintenance: ${{ number_format($monthly_mentenace_budget, 2) }}</span>
    </div>
    
    <table class="table table-hover caption-top">
      <caption></caption>
      <thead class="table-dark">
        <tr>
          <th scope="col">Lot#</th>
          <th scope="col">Name</th>
          <th scope="col">Unit Ent.</th>
          <th scope="col">Email</th>
          <th scope="col">Monthly Fee</th>
        </tr>
      </thead>
      <tbody>
      @if ($proprietors->isNotEmpty())
        @foreach($proprietors as $proprietor)
          <tr>
            <td scope="row">{{ $proprietor->lot_number }}</td>
            <td>{{ $proprietor->first_name }} {{ $proprietor->last_name }}</td>
            <td>{{ $proprietor->unit_entitlement }}</td>
            <td>{{ $proprietor->email }}</td>
            <td>${{ number_format($proprietor->maintenance_fee, 2)}}</td>
          </tr>
        @endforeach
      @endif
      </tbody>
    </table>

    @if ($proprietors->isEmpty())
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
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>

  </div>
</div>

@include('modals.modal-create-proprietor')
@stop
