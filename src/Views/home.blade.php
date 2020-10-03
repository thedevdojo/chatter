@extends(config('forum.master_file_extend'))

@section(config('forum.yields.head'))
    <link href="{{ url('/forum/assets/vendor/spectrum/spectrum.css') }}" rel="stylesheet">
	<link href="{{ url('/forum/assets/css/forum.css') }}" rel="stylesheet">
	@if($forum_editor == 'simplemde')
		<link href="{{ url('/forum/assets/css/simplemde.min.css') }}" rel="stylesheet">
	@elseif($forum_editor == 'trumbowyg')
		<link href="{{ url('/forum/assets/vendor/trumbowyg/ui/trumbowyg.css') }}" rel="stylesheet">
		<style>
			.trumbowyg-box, .trumbowyg-editor {
				margin: 0px auto;
			}
		</style>
	@endif
@stop

@section('content')

<div id="forum" class="forum_home">

	<div id="forum_header" style="background-color:green">
		<div class="container">
			<h1>@lang('forum::intro.headline')</h1>
		</div>
	</div>

	@if(config('forum.errors'))
		@if(Session::has('forum_alert'))
			<div class="forum-alert alert alert-{{ Session::get('forum_alert_type') }}">
				<div class="container">
					<strong><i class="forum-alert-{{ Session::get('forum_alert_type') }}"></i> {{ config('forum.alert_messages.' . Session::get('forum_alert_type')) }}</strong>
					{{ Session::get('forum_alert') }}
					<i class="forum-close"></i>
				</div>
			</div>
			<div class="forum-alert-spacer"></div>
		@endif

		@if (count($errors) > 0)
			<div class="forum-alert alert alert-danger">
				<div class="container">
					<p><strong><i class="forum-alert-danger"></i> @lang('forum::alert.danger.title')</strong> @lang('forum::alert.danger.reason.errors')</p>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			</div>
		@endif
	@endif

	<div class="container forum_container">

	    <div class="row">

	    	<div class="col-md-3 left-column">
	    		<!-- SIDEBAR -->
	    		<div class="forum_sidebar">
					<button class="btn btn-primary" id="new_discussion_btn"><i class="forum-new"></i> @lang('forum::messages.discussion.new')</button>
					<a href="/{{ config('forum.routes.home') }}"><i class="forum-bubble"></i> @lang('forum::messages.discussion.all')</a>
          {!! $categoriesMenu !!}
				</div>
				<!-- END SIDEBAR -->
	    	</div>
	        <div class="col-md-9 right-column">
	        	<div class="panel">
		        	<ul class="discussions">
		        		@foreach($discussions as $discussion)
				        	<li>
				        		<a class="discussion_list" href="/{{ config('forum.routes.home') }}/{{ config('forum.routes.discussion') }}/{{ $discussion->category->slug }}/{{ $discussion->slug }}">
					        		<div class="forum_avatar">
					        			@if(config('forum.user.avatar_image_database_field'))

					        				<?php $db_field = config('forum.user.avatar_image_database_field'); ?>

					        				<!-- If the user db field contains http:// or https:// we don't need to use the relative path to the image assets -->
					        				@if( (substr($discussion->user->{$db_field}, 0, 7) == 'http://') || (substr($discussion->user->{$db_field}, 0, 8) == 'https://') )
					        					<img src="{{ $discussion->user->{$db_field}  }}">
					        				@else
					        					<img src="{{ config('forum.user.relative_url_to_image_assets') . $discussion->user->{$db_field}  }}">
					        				@endif

					        			@else

					        				<span class="forum_avatar_circle" style="background-color:#<?= \MeinderA\Forum\Helpers\ForumHelper::stringToColorCode($discussion->user->{config('forum.user.database_field_with_user_name')}) ?>">
					        					{{ strtoupper(substr($discussion->user->{config('forum.user.database_field_with_user_name')}, 0, 1)) }}
					        				</span>

					        			@endif
					        		</div>

					        		<div class="forum_middle">
					        			<h3 class="forum_middle_title">{{ $discussion->title }} <div class="forum_cat" style="background-color:{{ $discussion->category->color }}">{{ $discussion->category->name }}</div></h3>
					        			<span class="forum_middle_details">@lang('forum::messages.discussion.posted_by') <span data-href="/user">{{ ucfirst($discussion->user->{config('forum.user.database_field_with_user_name')}) }}</span> {{ \Carbon\Carbon::createFromTimeStamp(strtotime($discussion->created_at))->diffForHumans() }}</span>
					        			@if($discussion->post[0]->markdown)
					        				<?php $discussion_body = GrahamCampbell\Markdown\Facades\Markdown::convertToHtml( $discussion->post[0]->body ); ?>
					        			@else
					        				<?php $discussion_body = $discussion->post[0]->body; ?>
					        			@endif
					        			<p>{{ substr(strip_tags($discussion_body), 0, 200) }}@if(strlen(strip_tags($discussion_body)) > 200){{ '...' }}@endif</p>
					        		</div>

					        		<div class="forum_right">

					        			<div class="forum_count"><i class="forum-bubble"></i> {{ $discussion->postsCount[0]->total }}</div>
					        		</div>

					        		<div class="forum_clear"></div>
					        	</a>
				        	</li>
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


    	<div class="forum_loader dark" id="new_discussion_loader">
		    <div></div>
		</div>

    	<form id="forum_form_editor" action="/{{ config('forum.routes.home') }}/{{ config('forum.routes.discussion') }}" method="POST">
        	<div class="row">
	        	<div class="col-md-7">
		        	<!-- TITLE -->
	                <input type="text" class="form-control" id="title" name="title" placeholder="@lang('forum::messages.editor.title')" value="{{ old('title') }}" >
	            </div>

	            <div class="col-md-4">
		            <!-- CATEGORY -->
					<select id="forum_category_id" class="form-control" name="forum_category_id">
						<option value="">@lang('forum::messages.editor.select')</option>
						@foreach($categories as $category)
							@if(old('forum_category_id') == $category->id)
								<option value="{{ $category->id }}" selected>{{ $category->name }}</option>
							@elseif(!empty($current_category_id) && $current_category_id == $category->id)
								<option value="{{ $category->id }}" selected>{{ $category->name }}</option>
							@else
								<option value="{{ $category->id }}">{{ $category->name }}</option>
							@endif
						@endforeach
					</select>
		        </div>

		        <div class="col-md-1">
		        	<i class="forum-close"></i>
		        </div>
	        </div><!-- .row -->

            <!-- BODY -->
        	<div id="editor">
        		@if( $forum_editor == 'tinymce' || empty($forum_editor) )
					<label id="tinymce_placeholder">@lang('forum::messages.editor.tinymce_placeholder')</label>
    				<textarea id="body" class="richText" name="body" placeholder="">{{ old('body') }}</textarea>
    			@elseif($forum_editor == 'simplemde')
    				<textarea id="simplemde" name="body" placeholder="">{{ old('body') }}</textarea>
				@elseif($forum_editor == 'trumbowyg')
					<textarea class="trumbowyg" name="body" placeholder="@lang('forum::messages.editor.tinymce_placeholder')">{{ old('body') }}</textarea>
				@endif
    		</div>

            <input type="hidden" name="_token" id="csrf_token_field" value="{{ csrf_token() }}">

            <div id="new_discussion_footer">
            	<input type='text' id="color" name="color" /><span class="select_color_text">@lang('forum::messages.editor.select_color_text')</span>
            	<button id="submit_discussion" class="btn btn-success pull-right"><i class="forum-new"></i> @lang('forum::messages.discussion.create')</button>
            	<a href="/{{ config('forum.routes.home') }}" class="btn btn-default pull-right" id="cancel_discussion">@lang('forum::messages.words.cancel')</a>
            	<div style="clear:both"></div>
            </div>
        </form>

    </div><!-- #new_discussion -->

</div>

@if( $forum_editor == 'tinymce' || empty($forum_editor) )
	<input type="hidden" id="forum_tinymce_toolbar" value="{{ config('forum.tinymce.toolbar') }}">
	<input type="hidden" id="forum_tinymce_plugins" value="{{ config('forum.tinymce.plugins') }}">
@endif
<input type="hidden" id="current_path" value="{{ Request::path() }}">

@endsection

@section(config('forum.yields.footer'))


@if( $forum_editor == 'tinymce' || empty($forum_editor) )
	<script src="{{ url('/forum/assets/vendor/tinymce/tinymce.min.js') }}"></script>
	<script src="{{ url('/forum/assets/js/tinymce.js') }}"></script>
	<script>
		var my_tinymce = tinyMCE;
		$('document').ready(function(){
			$('#tinymce_placeholder').click(function(){
				my_tinymce.activeEditor.focus();
			});
		});
	</script>
@elseif($forum_editor == 'simplemde')
	<script src="{{ url('/forum/assets/js/simplemde.min.js') }}"></script>
	<script src="{{ url('/forum/assets/js/forum_simplemde.js') }}"></script>
@elseif($forum_editor == 'trumbowyg')
	<script src="{{ url('/forum/assets/vendor/trumbowyg/trumbowyg.min.js') }}"></script>
	<script src="{{ url('/forum/assets/vendor/trumbowyg/plugins/preformatted/trumbowyg.preformatted.min.js') }}"></script>
	<script src="{{ url('/forum/assets/js/trumbowyg.js') }}"></script>
@endif

<script src="{{ url('/forum/assets/vendor/spectrum/spectrum.js') }}"></script>
<script src="{{ url('/forum/assets/js/forum.js') }}"></script>
<script>
	$('document').ready(function(){

		$('.forum-close, #cancel_discussion').click(function(){
			$('#new_discussion').slideUp();
		});
		$('#new_discussion_btn').click(function(){
			@if(Auth::guest())
				window.location.href = "{{ route('login') }}";
			@else
				$('#new_discussion').slideDown();
				$('#title').focus();
			@endif
		});

		$("#color").spectrum({
		    color: "#333639",
		    preferredFormat: "hex",
		    containerClassName: 'forum-color-picker',
		    cancelText: '',
    		chooseText: 'close',
		    move: function(color) {
				$("#color").val(color.toHexString());
			}
		});

		@if (count($errors) > 0)
			$('#new_discussion').slideDown();
			$('#title').focus();
		@endif


	});
</script>
@stop
