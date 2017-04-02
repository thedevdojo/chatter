@extends(Config::get('chatter.master_file_extend'))

@section(Config::get('chatter.yields.head'))

    @if(Config::get('chatter.sidebar_in_discussion_view'))
        <link href="/vendor/devdojo/chatter/assets/vendor/spectrum/spectrum.css" rel="stylesheet">
    @endif

    @include('chatter::partials.header.styles')
@stop


@section('content')

<div id="chatter" class="discussion">

	<div id="chatter_header" style="background-color:{{ $discussion->color }}">
		<div class="container">
			<a class="back_btn" href="/{{ Config::get('chatter.routes.home') }}"><i class="chatter-back"></i></a>
			<h1>{{ $discussion->title }}</h1><span class="chatter_head_details"> @lang('chatter::messages.discussion.head_details')<a class="chatter_cat" href="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.category') }}/{{ $discussion->category->slug }}" style="background-color:{{ $discussion->category->color }}">{{ $discussion->category->name }}</a></span>
		</div>
	</div>

    @include('chatter::partials.alert')

	<div class="container margin-top">

	    <div class="row">

			@if(! Config::get('chatter.sidebar_in_discussion_view'))
	        	<div class="col-md-12">
            @else
                <div class="col-md-3 left-column">
                    @include('chatter::partials.sidebar')
                </div>
                <div class="col-md-9 right-column">
            @endif

				<div class="conversation">
	                <ul class="discussions no-bg" style="display:block;">
	                	@foreach($posts as $post)
                            @include('chatter::partials.components.post')
	                	@endforeach
	                </ul>
	            </div>

	            <div id="pagination">{{ $posts->links() }}</div>

	            @if(!Auth::guest())
                    @include('chatter::partials.editor.new-response')
				@else

					<div id="login_or_register">
						<p>
                            @lang('chatter::messages.auth', ['home' => Config::get('chatter.routes.home')])
                        </p>
					</div>

				@endif

	        </div>


	    </div>
	</div>

    @if(Config::get('chatter.sidebar_in_discussion_view'))
        <div id="new_discussion_in_discussion_view">

            <div class="chatter_loader dark" id="new_discussion_loader_in_discussion_view">
                <div></div>
            </div>

            <form id="chatter_form_editor_in_discussion_view" action="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.discussion') }}" method="POST">
                @include('chatter::partials.editor.new-discussion')
            </form>

        </div><!-- #new_discussion -->
    @endif

</div>

@include('chatter::partials.editor.tinymce-config')

@stop

@section(Config::get('chatter.yields.footer'))
    @include('chatter::partials.footer.scripts-discussion')
@stop
