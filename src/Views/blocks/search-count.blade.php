@if (isset($query) && $discussions->count() > 0)
<div class="chatter-search-count-container">
    <h3 class="font-weight-black mb-3">{{ $discussions->count() }} {{ Str::plural('result', $discussions->count()) }} found</h3>
</div>
@endif
