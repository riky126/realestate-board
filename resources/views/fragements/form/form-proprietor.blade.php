<form action="{{ url('create-proprietor') }}" method='POST'>
    @if($errors->any())
    @foreach($errors->all() as $err)
        <p class="alert alert-danger">{{ $err }}</p>
    @endforeach
    @endif

    @csrf
    
    <section class='section-block acct-details'>
        <h5>Account Detail</h5>
        <div class='section-content'>
            <div class='form-group'>
            <label for="inputName" class="form-label">Name</label>
            <div class="field-pair">
                <input type="text" name="first_name" id="inputFirstName"  
                        class="form-control" placeholder="John" required autofocus>
                <input type="text" name="last_name" id="inputLastName" 
                        class="form-control" placeholder="Joe" required autofocus>
            </div>

            <div class='form-group'>
                <label for="inputEmail" class="form-label">Email address</label>
                <input type="email" name="email" id="inputEmail" 
                        class="form-control" placeholder="Email address" required autofocus>
            </div>
            <div class='form-group'>
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" name="address" id="inputAddress" 
                        class="form-control" placeholder="Your Postal Address" required>
            </div>
        </div>
        </div>
    </section>

    <section class='section-block corp-info'>
        <h5>Fund Info</h5>
        <div class='section-content'>
        <div class='form-group'>
            <label for="inputUnitEnt" class="form-label">Unit Entitlement</label>
            <input type="text" name="ent_unit" id="inputUnitEnt" class="form-control" placeholder="#1" required autofocus>
        </div>

        <div class='form-group'>
            <label for="inputLotNumber" class="form-label">Lot No.</label>
            <input type="text" name="lot_number" id="inputLotNumber" class="form-control" placeholder="#123" required autofocus>
        </div>

        </div>
    </section>

    <button class="btn btn-lg btn-primary btn-block flexible" type="submit">Create</button>
</form>