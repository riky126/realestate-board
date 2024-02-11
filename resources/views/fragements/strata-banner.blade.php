@auth

@if (!Auth::user()->is_admin)
    <div class='strata-badge'>
    <div class='id-num lg-badge'>Strata No. {{ Auth::user()->customer->corporation->number }}</div>
</div>
@endif

@endauth