@extends('layouts.app')

@section('chatter_head')
	@include('chatter::partials.chatter_head')
@stop

@section('content')

<div id="chatter">

	<div id="chatter_header">
		<div class="container">
			<a href="/{{ Config::get('chatter.routes.home') }}"><i class="chatter-back"></i></a>
			<h1>New {{ Config::get('chatter.titles.discussion') }}</h1>
		</div>
	</div>

	<div class="container">
	    <div class="row">
	        <div class="col-md-8 col-md-offset-2">
	        	
	        	<div class="row">
		        	<div class="col-md-9">
			        	<!-- TITLE -->
			        	<label for="title">Title of {{ Config::get('chatter.titles.discussion') }}</label>
			            <div class="panel">
		                	<div id="new_discussion">
		                		<input type="text" class="form-control" id="title" name="title" placeholder="Title of {{ Config::get('chatter.titles.discussion') }}">
		                	</div>
			            </div>
		            </div>

		            <div class="col-md-3">
			            <!-- CATEGORY -->
			            <label for="chatter_category_id">Select a {{ Config::get('chatter.titles.category') }}</label>
			            <div class="panel chatter_cat">
				            <select id="chatter_category_id" class="form-control" name="chatter_category_id">
					            @foreach($categories as $category)
					            	<option value="{{ $category->id }}">{{ $category->name }}</option>
					            @endforeach
				            </select>
				        </div>
			        </div>
		        </div><!-- .row -->

	            <!-- BODY -->
	            <label for="body">What do you want to talk about:</label>
	            <div class="panel">
	            	<div id="editor">
                		<div class="chatter_editor_loader la-ball-clip-rotate la-dark">
						    <div></div>
						</div>
            			<textarea id="body" name="body"></textarea>
            		</div>
	            </div>

	            <div id="submit_discussion" class="btn btn-success pull-right"><i class="chatter-new"></i> Create {{ Config::get('chatter.titles.discussion') }}</div>
	            <a href="/{{ Config::get('chatter.routes.home') }}" class="btn btn-default pull-right" id="cancel_discussion">Cancel</a>

	        </div>
	    </div>
	</div>
</div>

@endsection
