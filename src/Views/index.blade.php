@extends('layouts.app')


@section(Config::get('chatter.yields.head'))
	@include('chatter::partials.head')
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
	    		@include('chatter::partials.sidebar')
	    	</div>
	        <div class="col-md-9 right-column">
	        	<div class="panel">
		        	<ul class="discussions">
		        		@foreach($discussions as $discussion)
				        	<li>
				        		<a href="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.discussion') }}/{{ $discussion->slug }}">
					        		<div class="chatter_avatar">
					        			<img src="https://discuss.flarum.org/assets/avatars/9fra4tlmk50dmbqq.jpg">
					        		</div>

					        		<div class="chatter_middle">
					        			<h3>{{ $discussion->title }} <div class="chatter_cat" style="background-color:{{ $discussion->category->color }}">{{ $discussion->category->name }}</div></h3>
					        			<span>Posted By: <span data-href="/user">{{ $discussion->user->name }}</span> {{ $discussion->created_at }}</span>
					        			<p>{{ strip_tags($discussion->post[0]->body) }}</p>
					        		</div>

					        		<div class="chatter_right">
					        			
					        			<div class="chatter_count"><i class="chatter-bubble"></i> {{ $discussion->postsCount[0]->total }}</div>
					        		</div>

					        		<div class="chatter_clear"></div>
					        	</a>
				        	</li>
			        	@endforeach
		        	</ul>
	        	</div>
	        </div>
	    </div>
	</div>

	<div id="new_discussion">
	        	

    	<div class="chatter_loader dark" id="new_discussion_loader">
		    <div></div>
		</div>

    	<form id="chatter_form_editor" action="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.discussion') }}" method="POST">
        	<div class="row">
	        	<div class="col-md-7">
		        	<!-- TITLE -->
	                <input type="text" class="form-control" id="title" name="title" placeholder="Title of {{ Config::get('chatter.titles.discussion') }}" v-model="title" value="" >
	            </div>

	            <div class="col-md-4">
		            <!-- CATEGORY -->
			            <select id="chatter_category_id" class="form-control" name="chatter_category_id">
			            	<option value="0">Select a Category</option>
				            @foreach($categories as $category)
				            	<option value="{{ $category->id }}">{{ $category->name }}</option>
				            @endforeach
			            </select>
		        </div>

		        <div class="col-md-1">
		        	<i class="chatter-close"></i>
		        </div>	
	        </div><!-- .row -->

            <!-- BODY -->
        	<div id="editor">
				<label id="tinymce_placeholder">Add the content for your Discussion here</label>
    			<textarea id="body" class="richText" name="body" placeholder=""></textarea>
    		</div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div id="new_discussion_footer">
            	<input type='text' id="color" name="color" /><span class="select_color_text">Select a Color for this Discussion (optional)</span>
            	<button id="submit_discussion" class="btn btn-success pull-right"><i class="chatter-new"></i> Create {{ Config::get('chatter.titles.discussion') }}</button>
            	<a href="/{{ Config::get('chatter.routes.home') }}" class="btn btn-default pull-right" id="cancel_discussion">Cancel</a>
            	<div style="clear:both"></div>
            </div>
        </form>

    </div><!-- #new_discussion -->



</div>

@endsection

@section(Config::get('chatter.yields.footer'))



<script src="/vendor/devdojo/chatter/assets/vendor/tinymce/tinymce.min.js"></script>
<script src="/vendor/devdojo/chatter/assets/js/tinymce.js"></script>
<script src="/vendor/devdojo/chatter/assets/vendor/spectrum/spectrum.js"></script>
<script src="/vendor/devdojo/chatter/assets/js/chatter.js"></script>
<script>
	var my_tinymce = tinyMCE;
	$('document').ready(function(){
		$('#tinymce_placeholder').click(function(){
			my_tinymce.activeEditor.focus();
		});
		$('.chatter-close').click(function(){
			$('#new_discussion').slideUp();
		});
		$('#new_discussion_btn, #cancel_discussion').click(function(){
			@if(Auth::guest())
				window.location.href = "/{{ Config::get('chatter.routes.home') }}/login";
			@else
				$('#new_discussion').slideDown();
			@endif
		});

		$("#color").spectrum({
		    color: "#333639",
		    preferredFormat: "hex",
		    containerClassName: 'chatter-color-picker',
		    cancelText: '',
    		chooseText: 'close',
		    move: function(color) {
				$("#color").val(color.toHexString());
			}
		});
	});
</script>
@stop
