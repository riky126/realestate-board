@auth

@if (!Auth::user()->is_admin)
    <div class='strata-badge'>
    <div class='id-num lg-badge'>Strata No. 234</div>
</div>
@endif

@endauth