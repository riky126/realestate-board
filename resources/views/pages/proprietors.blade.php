@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/table.list.css') }}" rel="stylesheet">
@endpush

@push('data_scripts')
    <script type="text/javascript">
      var $PROPRIETORS = @json($proprietors->toArray());
      var $MODAL_ERROR = @json($errors->toArray());
    </script>
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/proprietor-page.js') }}"></script>
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
      <h5>List of Proprietors </h5> 
      <span class='lg-badge'>Month Maintenance: ${{ number_format($monthly_mentenace_budget, 2) }}</span>
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
        @foreach($proprietors as $index => $proprietor)
          <tr data-row-id='{{ $index }}'>
            <td scope="row">{{ $proprietor->lot_number }}</td>
            <td>{{ $proprietor->first_name }} {{ $proprietor->last_name }}</td>
            <td>{{ $proprietor->unit_entitlement }}</td>
            <td>{{ $proprietor->email }}</td>
            <td>${{ number_format($proprietor->maintenance_fee, 2)}}
              
              <div class='d-flex justify-content-end contextmenu-block'>
                <div class="dropdown menu-options">
                  <button
                    data-mdb-dropdown-init
                    class="dropdown-toggle d-flex align-items-center"
                    href="#"
                    id="navbarDropdownMenuOption"
                    role="button"
                    data-bs-toggle="dropdown"
                    data-row-id={{ $index }}
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
                      <a class="dropdown-item" 
                        data-action-command='edit'
                        data-row-id={{ $index }}
                        href="/#edit" data-bs-target="#exampleModalToggle"
                        data-bs-toggle="modal" >
                        Edit
                      </a>
                    </li>
                    <li>
                      <a 
                        class="dropdown-item"
                        data-row-id={{ $index }}
                        data-action-command='delete'
                        href="/#delete">Delete</a>
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
