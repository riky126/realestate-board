<form id='proprietorForm' action="{{ url('create-proprietor') }}" method='POST'>
    @if($errors->any())
    @foreach($errors->all() as $err)
        <p class="alert alert-danger">{{ $err }}</p>
    @endforeach
    @endif

    @csrf
    
    <section class='section-block acct-details'>
        <h5>Personal Info</h5>
        <div class='section-content'>
            <div class='form-group'>
            <label for="inputName" class="form-label">Name</label>
            <div class="field-pair">
                <input type="text" name="first_name" id="inputFirstName"
                        value="{{ old('first_name') }}"
                        class="form-control" placeholder="John" required autofocus>
                <input type="text" name="last_name" id="inputLastName"
                        value="{{ old('last_name') }}"
                        class="form-control" placeholder="Doe" required autofocus>
            </div>

            <div class='form-group'>
                <label for="inputEmail" class="form-label">Email address</label>
                <input type="email" name="email" id="inputEmail"
                        value="{{ old('email') }}"
                        class="form-control" placeholder="Email address" required autofocus>
            </div>
            <div class='form-group'>
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" name="address" id="inputAddress"
                        value="{{ old('address') }}"
                        class="form-control" placeholder="Your Postal Address" required>
            </div>
        </div>
        </div>
    </section>

    <section class='section-block corp-info'>
        <h5>Strata Title Info</h5>
        <div class='section-content'>
        <div class='form-group'>
            <label for="inputUnitEnt" class="form-label">Unit Entitlement</label>
            <input type="number" min='1' name="unit_ent" id="inputUnitEnt"
                    value="{{ old('unit_ent') }}"
                    class="form-control" placeholder="#1" required autofocus>
        </div>

        <div class='form-group'>
            <label for="inputLotNumber" class="form-label">Lot No.</label>
            <input type="text" name="lot_number" id="inputLotNumber"
                    value="{{ old('lot_number') }}"
                    class="form-control" placeholder="#123" required autofocus>
        </div>

        </div>
    </section>
    @if (old('proprietor'))
        <input type="hidden" name="proprietor" id="inputProprietor"
            value="{{ old('proprietor') }}">
    @endif

    <button class="btn btn-lg btn-primary btn-block flexible" type="submit">Create</button>
</form>