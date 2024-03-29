@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/profile.page.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="container profile-page">
    <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
            <div class="card-body  profile-card">
                <div class="account-settings">
                    <div class="user-profile">
                        <div class="user-avatar">
                            <img src="{{ URL::asset('images/profile-icon.svg') }}" alt="Maxwell Admin">
                        </div>
                        <h5 class="user-name">{{ $user->first_name }} {{ $user->last_name }}</h5>
                        <h6 class="user-email">{{ $user->email }}</h6>
                        <h6 class="user-email">{{ $user->type }}</h6>
                    </div>
                    <div class="about">
                        <h5>About</h5>
                        <p>Some information goes here</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
            <form action="" method="POST">
            @csrf()
            <div class="card-body">
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h6 class="mb-2 text-primary">Personal Details</h6>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input value=" {{ $user->first_name }}" type="text" 
                                    class="form-control" id="firstName" placeholder="Enter first name">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input  value={{ $user->last_name }} type="url" 
                                class="form-control" id="lastName" placeholder="Enter last name">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="eMail">Email</label>
                            <input type="email" 
                                    value="{{ $user->email }}"
                                    class="form-control" id="eMail" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" placeholder="Enter phone number">
                        </div>
                    </div>
                </div>
                @if ($corporation != null)
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h6 class="mt-3 mb-2 text-primary">Corporation Details</h6>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="Street">Strata Plan No.</label>
                            <input value={{ $corporation->number }} disabled type="number" 
                                class="form-control" id="Street" placeholder="Enter Street">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="ciTy">City</label>
                            <input type="name" class="form-control" id="ciTy" placeholder="Enter City">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="sTate">Name</label>
                            <input  value={{ $corporation->name }} 
                                type="text" class="form-control" id="sTate" placeholder="Enter State">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="zIp">Zip Code</label>
                            <input type="text" class="form-control" id="zIp" placeholder="Zip Code">
                        </div>
                    </div>
                </div>
                @endif
                <div class="row gutters action-bar">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="text-right">
                            <button type="button" id="submit" name="submit" class="btn btn-secondary">Cancel</button>
                            <button type="button" id="submit" name="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>

@stop
