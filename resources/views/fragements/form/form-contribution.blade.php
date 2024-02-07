<form class='contrib-form' action="{{ url('create-contribution') }}" method='POST'>
    @if($errors->any())
    @foreach($errors->all() as $err)
        <p class="alert alert-danger">{{ $err }}</p>
    @endforeach
    @endif

    @csrf
    
    <section class='section-block '>
        <div class='section-content'>
            <div class='form-group'>
                <label for="inputName" class="form-label">Proprietors</label>
                
                <select class="form-select" aria-label="Default select example" name='proprietor'>
                    <option selected>Choose a Proprietor</option>
                    @foreach ($proprietors as $proprietor)
                        <option value="{{ $proprietor->id }}">
                            lot:# {{ $proprietor->lot_number }} - {{ $proprietor->first_name }} {{ $proprietor->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        
            <div class='form-group amount-gp'>
                <label for="inputName" class="form-label">Amount</label>
                <input type="number" name="amount" id="inputAmount" 
                        class="form-control" placeholder="0.0" value='{{ old('amount') }}' required autofocus>
            </div>
        </div>
    </section>

    <button class="btn btn-lg btn-primary btn-block flexible" type="submit">Add Payment</button>
</form>