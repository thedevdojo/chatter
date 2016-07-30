@extends('layouts.app')

@section('chatter_head')
	@include('chatter::partials.chatter_head')
@stop

@section('content')

<div id="chatter">

	<div id="chatter_hero">

		<div id="chatter_hero_dimmer"></div>
		<h1>{{ Config::get('chatter.headline') }}</h1>
		<p>{{ Config::get('chatter.description') }}</p>
	</div>


	<div class="container">
		
	    <div class="row">

	    	<div class="col-md-3 left-column">
	    		<a href="/{{ Config::get('chatter.routes.home') }}/create" class="btn btn-primary"><i class="chatter-new"></i> New {{ Config::get('chatter.titles.discussion') }}</a> 
	    		<ul class="nav nav-pills nav-stacked">
	    			@foreach($categories as $category)
	    				<li><a href="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.category') }}/{{ $category->slug }}"><div class="chatter-box" style="background-color:{{ $category->color }}"></div> {{ $category->name }}</a></li>
	    			@endforeach
				</ul>
	    	</div>
	        <div class="col-md-9 right-column">
	            <div class="panel panel-default">
	                <div class="panel-heading">Welcome to Chatter!</div>

	                <div class="panel-body">
	                    body contents
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

</div>

@endsection
