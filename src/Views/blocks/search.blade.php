<form class="form-inline w-100" action="{{ route('chatter.search') }}">
    <div class="form-group flex-fill mb-2">
        <input type="text" class="form-control" name="q" placeholder="Search...">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Search</button>
</form>