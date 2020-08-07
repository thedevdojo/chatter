<div class="no-results px-3 py-3 px-sm-5 py-sm-5 d-flex flex-column align-items-center justify-content-center">
    <h4 class="font-weight-black mb-2">No discussion found...</h4>
    <p class="lead mb-4">
        We couldn't find results for the search <b><i>"{{ $query }}"</i></b>.
    </p>
    @if (auth()->check())
    <button class="btn btn-primary new_discussion_btn">
        <i class="fal fa-comment-alt"></i> Start A New Discussion</button>
    @else
    <a class="btn btn-primary" href="{{ route('login', ['redirect_to' => url()->current()]) }}">
        <i class="fal fa-comment-alt"></i> Login To Start A New Discussion
    </a>
    @endif
</div>
