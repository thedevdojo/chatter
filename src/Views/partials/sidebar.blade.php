<!-- SIDEBAR -->
<div class="chatter_sidebar">
    <button class="btn btn-primary" id="new_discussion_btn"><i class="chatter-new"></i>
        @lang('chatter::messages.discussion.new')
    </button>
    <a href="/{{ Config::get('chatter.routes.home') }}"><i class="chatter-bubble"></i>
        @lang('chatter::messages.discussion.all')
    </a>
    <ul class="nav nav-pills nav-stacked">
        @foreach($categories as $category)
            <li><a href="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.category') }}/{{ $category->slug }}"><div class="chatter-box" style="background-color:{{ $category->color }}"></div> {{ $category->name }}</a></li>
        @endforeach
    </ul>
</div>
<!-- END SIDEBAR -->
