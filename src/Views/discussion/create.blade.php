@extends('layouts.app')

@section(Config::get('chatter.yields.head'))
	@include('chatter::partials.css')
@stop

@section('content')

<div id="chatter">

	<div id="chatter_header">
		<div class="container">
			<a href="/{{ Config::get('chatter.routes.home') }}"><i class="chatter-back"></i></a>
			<h1 data-value="New {{ Config::get('chatter.titles.discussion') }}">@{{ getHeader }}</h1>
		</div>
	</div>

	<div class="container">
	    <div class="row">
	        <div class="col-md-8 col-md-offset-2">
	        	
	        	<form action="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.discussion') }}" method="POST">
		        	<div class="row">
			        	<div class="col-md-9">
				        	<!-- TITLE -->
				        	<label for="title">Title of {{ Config::get('chatter.titles.discussion') }}</label>
				            <div class="panel">
			                	<div id="new_discussion">@{{ sheader }}
			                		<input type="text" class="form-control" id="title" name="title" placeholder="Title of {{ Config::get('chatter.titles.discussion') }}" v-model="title" value="@{{ title }}" >
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
	            			<textarea id="body" class="richText" name="body">@{{ body }}</textarea>
	            		</div>
		            </div>

		            <input type="hidden" name="_token" value="{{ csrf_token() }}">

		            <button id="submit_discussion" class="btn btn-success pull-right"><i class="chatter-new"></i> Create {{ Config::get('chatter.titles.discussion') }}</button>
		            <a href="/{{ Config::get('chatter.routes.home') }}" class="btn btn-default pull-right" id="cancel_discussion">Cancel</a>

	            </form>

	        </div>
	    </div>
	</div>
</div>
<script>
	 var discussion = new Vue({
	 	el: '#chatter',
	 	data: {
	 		title: '',
	 		header: '',
	 	},
	 	computed: {
		    // a computed getter
		    getHeader: function () {
		      if(this.title){
		      	return this.title;
		      } else {
		        	return document.getElementById("chatter_header").getElementsByTagName("h1")[0].getAttribute('data-value');
		      }
		    }
		  }
	});

</script>


@stop

@section(Config::get('chatter.yields.footer'))

<script src="/vendor/devdojo/chatter/assets/vendor/tinymce/tinymce.min.js"></script>
<script src="/vendor/devdojo/chatter/assets/js/tinymce.js"></script>
<script src="/vendor/devdojo/chatter/assets/js/chatter.js"></script>

@stop