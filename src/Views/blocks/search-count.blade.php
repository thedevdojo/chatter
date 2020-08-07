@if (isset($query) && $discussions->total() > 0)
<div class="chatter-search-count-container">
    <h3 class="font-weight-black mb-3">{{ $discussions->total() }} {{ Str::plural('result', $discussions->total()) }} found</h3>
</div>
@endif
