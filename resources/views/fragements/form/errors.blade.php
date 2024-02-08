<!-- Show errors !-->
@if($errors->any())
@foreach($errors->all() as $err)
    <p class="alert alert-danger">{{ $err }}</p>
@endforeach
@endif