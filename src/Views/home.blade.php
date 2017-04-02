@extends(Config::get('chatter.master_file_extend'))

@section(Config::get('chatter.yields.head'))
    <link href="/vendor/devdojo/chatter/assets/vendor/spectrum/spectrum.css" rel="stylesheet">
    @include('chatter::partials.header.styles')
@stop

@section('content')

<div id="chatter" class="chatter_home">

	<div id="chatter_hero">
		<div id="chatter_hero_dimmer"></div>
		<?php $headline_logo = Config::get('chatter.headline_logo'); ?>
		@if( isset( $headline_logo ) && !empty( $headline_logo ) )
			<img src="{{ Config::get('chatter.headline_logo') }}">
		@else
			<h1>{{ Config::get('chatter.headline') }}</h1>
			<p>{{ Config::get('chatter.description') }}</p>
		@endif
	</div>

    @include('chatter::partials.alert')

	<div class="container chatter_container">

	    <div class="row">

	    	<div class="col-md-3 left-column">
                @include('chatter::partials.sidebar')
	    	</div>
	        <div class="col-md-9 right-column">
	        	<div class="panel">
		        	<ul class="discussions">
		        		@foreach($discussions as $discussion)
                            @include('chatter::partials.components.discussion')
			        	@endforeach
		        	</ul>
	        	</div>

	        	<div id="pagination">
	        		{{ $discussions->links() }}
	        	</div>

	        </div>
	    </div>
	</div>

	<div id="new_discussion">


    	<div class="chatter_loader dark" id="new_discussion_loader">
		    <div></div>
		</div>

    	<form id="chatter_form_editor" action="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.discussion') }}" method="POST">
            @include('chatter::partials.editor.new-discussion')
        </form>

    </div><!-- #new_discussion -->

</div>

@include('chatter::partials.editor.tinymce-config')

@endsection

@section(Config::get('chatter.yields.footer'))
    @include('chatter::partials.footer.scripts-home')
@stop
