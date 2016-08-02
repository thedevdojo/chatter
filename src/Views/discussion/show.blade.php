@extends('layouts.app')

@section(Config::get('chatter.yields.head'))
	@include('chatter::partials.css')
@stop

@section('content')

<div id="chatter">

	<div id="chatter_header">
		<div class="container">
			<a href="/{{ Config::get('chatter.routes.home') }}"><i class="chatter-back"></i></a>
			<h1>{{ $discussion->title }}</h1>
		</div>
	</div>

	<div class="container">
		
	    <div class="row">

	    	<div class="col-md-3 left-column">
	    		@include('chatter::partials.sidebar')
	    	</div>
	        <div class="col-md-9 right-column">
	            <div class="panel panel-default">
	                <div class="panel-heading">Welcome to Chatter!</div>

	                <div class="panel-body">
	                    {{{ $discussion->body }}}
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

</div>


@stop

@section(Config::get('chatter.yields.footer'))

<script src="/vendor/devdojo/chatter/assets/vendor/tinymce/tinymce.min.js"></script>
<script src="/vendor/devdojo/chatter/assets/js/tinymce.js"></script>
<script src="/vendor/devdojo/chatter/assets/js/chatter.js"></script>

@stop