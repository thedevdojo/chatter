@extends(config('forum.master_file_extend'))

@section(config('forum.yields.head'))
    @if(config('forum.sidebar_in_discussion_view'))
        <link href="{{ url('/forum/assets/vendor/spectrum/spectrum.css') }}" rel="stylesheet">
    @endif
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

<div id="forum" class="discussion">

	<div id="forum_header" style="background-color:{{ $discussion->color }}">
		<div class="container">
			<a class="back_btn" href="/{{ config('forum.routes.home') }}"><i class="forum-back"></i></a>
			<h1>{{ $discussion->title }}</h1><span class="forum_head_details"> @lang('forum::messages.discussion.head_details')<a class="forum_cat" href="/{{ config('forum.routes.home') }}/{{ config('forum.routes.category') }}/{{ $discussion->category->slug }}" style="background-color:{{ $discussion->category->color }}">{{ $discussion->category->name }}</a></span>
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

	<div class="container margin-top">

	    <div class="row">

			@if(! config('forum.sidebar_in_discussion_view'))
	        	<div class="col-md-12">
            @else
                <div class="col-md-3 left-column">
                    <!-- SIDEBAR -->
                    <div class="forum_sidebar">
                        <button class="btn btn-primary" id="new_discussion_btn"><i class="forum-new"></i> @lang('forum::messages.discussion.new')</button>
                        <a href="/{{ config('forum.routes.home') }}"><i class="forum-bubble"></i> @lang('forum::messages.discussion.all')</a>
                        <ul class="nav nav-pills nav-stacked">
                            <?php $categories = MeinderA\Forum\Models\Models::category()->all(); ?>
                            @foreach($categories as $category)
                                <li><a href="/{{ config('forum.routes.home') }}/{{ config('forum.routes.category') }}/{{ $category->slug }}"><div class="forum-box" style="background-color:{{ $category->color }}"></div> {{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- END SIDEBAR -->
                </div>
                <div class="col-md-9 right-column">
            @endif

				<div class="conversation">
	                <ul class="discussions no-bg" style="display:block;">
	                	@foreach($posts as $post)
	                		<li data-id="{{ $post->id }}" data-markdown="{{ $post->markdown }}">
		                		<span class="forum_posts">
		                			@if(!Auth::guest() && (Auth::user()->id == $post->user->id))
		                				<div id="delete_warning_{{ $post->id }}" class="forum_warning_delete">
		                					<i class="forum-warning"></i> @lang('forum::messages.response.confirm')
		                					<button class="btn btn-sm btn-danger pull-right delete_response">@lang('forum::messages.response.yes_confirm')</button>
		                					<button class="btn btn-sm btn-default pull-right">@lang('forum::messages.response.no_confirm')</button>
		                				</div>
			                			<div class="forum_post_actions">
			                				<p class="forum_delete_btn">
			                					<i class="forum-delete"></i> @lang('forum::messages.words.delete')
			                				</p>
			                				<p class="forum_edit_btn">
			                					<i class="forum-edit"></i> @lang('forum::messages.words.edit')
			                				</p>
			                			</div>
			                		@endif
			                		<div class="forum_avatar">
					        			@if(config('forum.user.avatar_image_database_field'))

					        				<?php $db_field = config('forum.user.avatar_image_database_field'); ?>

					        				<!-- If the user db field contains http:// or https:// we don't need to use the relative path to the image assets -->
					        				@if( (substr($post->user->{$db_field}, 0, 7) == 'http://') || (substr($post->user->{$db_field}, 0, 8) == 'https://') )
					        					<img src="{{ $post->user->{$db_field}  }}">
					        				@else
					        					<img src="{{ config('forum.user.relative_url_to_image_assets') . $post->user->{$db_field}  }}">
					        				@endif

					        			@else
					        				<span class="forum_avatar_circle" style="background-color:#<?= \MeinderA\Forum\Helpers\ForumHelper::stringToColorCode($post->user->{config('forum.user.database_field_with_user_name')}) ?>">
					        					{{ ucfirst(substr($post->user->{config('forum.user.database_field_with_user_name')}, 0, 1)) }}
					        				</span>
					        			@endif
					        		</div>

					        		<div class="forum_middle">
					        			<span class="forum_middle_details"><a href="{{ \MeinderA\Forum\Helpers\ForumHelper::userLink($post->user) }}">{{ ucfirst($post->user->{config('forum.user.database_field_with_user_name')}) }}</a> <span class="ago forum_middle_details">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }}</span></span>
					        			<div class="forum_body">

					        				@if($post->markdown)
					        					<pre class="forum_body_md">{{ $post->body }}</pre>
					        					<?= \MeinderA\Forum\Helpers\ForumHelp::demoteHtmlHeaderTags( GrahamCampbell\Markdown\Facades\Markdown::convertToHtml( $post->body ) ); ?>
					        					<!--?= GrahamCampbell\Markdown\Facades\Markdown::convertToHtml( $post->body ); ?-->
					        				@else
					        					<?= $post->body; ?>
					        				@endif

					        			</div>
					        		</div>

					        		<div class="forum_clear"></div>
				        		</span>
		                	</li>
	                	@endforeach


	                </ul>
	            </div>

	            <div id="pagination">{{ $posts->links() }}</div>

	            @if(!Auth::guest())

	            	<div id="new_response">

	            		<div class="forum_avatar">
		        			@if(config('forum.user.avatar_image_database_field'))

		        				<?php $db_field = config('forum.user.avatar_image_database_field'); ?>

		        				<!-- If the user db field contains http:// or https:// we don't need to use the relative path to the image assets -->
		        				@if( (substr(Auth::user()->{$db_field}, 0, 7) == 'http://') || (substr(Auth::user()->{$db_field}, 0, 8) == 'https://') )
		        					<img src="{{ Auth::user()->{$db_field}  }}">
		        				@else
		        					<img src="{{ config('forum.user.relative_url_to_image_assets') . Auth::user()->{$db_field}  }}">
		        				@endif

		        			@else
		        				<span class="forum_avatar_circle" style="background-color:#<?= \MeinderA\Forum\Helpers\ForumHelper::stringToColorCode(Auth::user()->{config('forum.user.database_field_with_user_name')}) ?>">
		        					{{ strtoupper(substr(Auth::user()->{config('forum.user.database_field_with_user_name')}, 0, 1)) }}
		        				</span>
		        			@endif
		        		</div>

			            <div id="new_discussion">


					    	<div class="forum_loader dark" id="new_discussion_loader">
							    <div></div>
							</div>

				            <form id="forum_form_editor" action="/{{ config('forum.routes.home') }}/posts" method="POST">

						        <!-- BODY -->
						    	<div id="editor">
									@if( $forum_editor == 'tinymce' || empty($forum_editor) )
										<label id="tinymce_placeholder">@lang('forum::messages.editor.tinymce_placeholder')</label>
					    				<textarea id="body" class="richText" name="body" placeholder="">{{ old('body') }}</textarea>
					    			@elseif($forum_editor == 'simplemde')
					    				<textarea id="simplemde" name="body" placeholder="">{{ old('body') }}</textarea>
									@elseif($forum_editor == 'trumbowyg')
										<textarea class="trumbowyg" name="body" placeholder="Type Your Discussion Here...">{{ old('body') }}</textarea>
									@endif
								</div>

						        <input type="hidden" name="_token" id="csrf_token_field" value="{{ csrf_token() }}">
						        <input type="hidden" name="forum_discussion_id" value="{{ $discussion->id }}">
						    </form>

						</div><!-- #new_discussion -->
						<div id="discussion_response_email">
							<button id="submit_response" class="btn btn-success pull-right"><i class="forum-new"></i> @lang('forum::messages.response.submit')</button>
							@if(config('forum.email.enabled'))
								<div id="notify_email">
									<img src="{{ url('/forum/assets/images/email.gif') }}" class="forum_email_loader">
									<!-- Rounded toggle switch -->
									<span>@lang('forum::messages.email.notify')</span>
									<label class="switch">
									  	<input type="checkbox" id="email_notification" name="email_notification" @if(!Auth::guest() && $discussion->users->contains(Auth::user()->id)){{ 'checked' }}@endif>
									  	<span class="on">@lang('forum::messages.words.yes')</span>
										<span class="off">@lang('forum::messages.words.no')</span>
									  	<div class="slider round"></div>
									</label>
								</div>
							@endif
						</div>
					</div>

				@else

					<div id="login_or_register">
						<p>
                            @lang('forum::messages.auth', ['home' => config('forum.routes.home')])
                        </p>
					</div>

				@endif

	        </div>


	    </div>
	</div>

    @if(config('forum.sidebar_in_discussion_view'))
        <div id="new_discussion_in_discussion_view">

            <div class="forum_loader dark" id="new_discussion_loader_in_discussion_view">
                <div></div>
            </div>

            <form id="forum_form_editor_in_discussion_view" action="/{{ config('forum.routes.home') }}/{{ config('forum.routes.discussion') }}" method="POST">
                <div class="row">
                    <div class="col-md-7">
                        <!-- TITLE -->
                        <input type="text" class="form-control" id="title" name="title" placeholder="@lang('forum::messages.editor.title')" v-model="title" value="{{ old('title') }}" >
                    </div>

                    <div class="col-md-4">
                        <!-- CATEGORY -->
                        <select id="forum_category_id" class="form-control" name="forum_category_id">
                            <option value="">@lang('forum::messages.editor.select')</option>
                            @foreach($categories as $category)
                                @if(old('forum_category_id') == $category->id)
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
                        <label id="tinymce_placeholder">Add the content for your Discussion here</label>
                        <textarea id="body_in_discussion_view" class="richText" name="body" placeholder="">{{ old('body') }}</textarea>
                    @elseif($forum_editor == 'simplemde')
                        <textarea id="simplemde_in_discussion_view" name="body" placeholder="">{{ old('body') }}</textarea>
                    @elseif($forum_editor == 'trumbowyg')
                        <textarea class="trumbowyg" name="body" placeholder="">{{ old('body') }}</textarea>
                    @endif
                </div>

                <input type="hidden" name="_token" id="csrf_token_field" value="{{ csrf_token() }}">

                <div id="new_discussion_footer">
                    <input type='text' id="color" name="color" /><span class="select_color_text">@lang('forum::messages.editor.tinymce_placeholder')</span>
                    <button id="submit_discussion" class="btn btn-success pull-right"><i class="forum-new"></i> Create {{ config('forum.titles.discussion') }}</button>
                    <a href="/{{ config('forum.routes.home') }}" class="btn btn-default pull-right" id="cancel_discussion">Cancel</a>
                    <div style="clear:both"></div>
                </div>
            </form>

        </div><!-- #new_discussion -->
    @endif

</div>

@if($forum_editor == 'tinymce' || empty($forum_editor))
    <input type="hidden" id="forum_tinymce_toolbar" value="{{ config('forum.tinymce.toolbar') }}">
    <input type="hidden" id="forum_tinymce_plugins" value="{{ config('forum.tinymce.plugins') }}">
@endif
<input type="hidden" id="current_path" value="{{ Request::path() }}">

@stop

@section(config('forum.yields.footer'))

@if( $forum_editor == 'tinymce' || empty($forum_editor) )
	<script>var forum_editor = 'tinymce';</script>
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
	<script>var forum_editor = 'simplemde';</script>
    <script src="{{ url('/forum/assets/js/simplemde.min.js') }}"></script>
    <script src="{{ url('/forum/assets/js/forum_simplemde.js') }}"></script>
@elseif($forum_editor == 'trumbowyg')
	<script>var forum_editor = 'trumbowyg';</script>
    <script src="{{ url('/forum/assets/vendor/trumbowyg/trumbowyg.min.js') }}"></script>
    <script src="{{ url('/forum/assets/vendor/trumbowyg/plugins/preformatted/trumbowyg.preformatted.min.js') }}"></script>
    <script src="{{ url('/forum/assets/js/trumbowyg.js') }}"></script>
@endif

@if(config('forum.sidebar_in_discussion_view'))
    <script src="/vendor/devdojo/forum/assets/vendor/spectrum/spectrum.js"></script>
@endif

<script>
	$('document').ready(function(){

		var simplemdeEditors = [];

		$('.forum_edit_btn').click(function(){
			parent = $(this).parents('li');
			parent.addClass('editing');
			id = parent.data('id');
			markdown = parent.data('markdown');
			container = parent.find('.forum_middle');

			if(markdown){
				body = container.find('.forum_body_md');
			} else {
				body = container.find('.forum_body');
				markdown = 0;
			}

			details = container.find('.forum_middle_details');

			// dynamically create a new text area
			container.prepend('<textarea id="post-edit-' + id + '"></textarea>');
            // Client side XSS fix
            $("#post-edit-"+id).text(body.html());
			container.append('<div class="forum_update_actions"><button class="btn btn-success pull-right update_forum_edit"  data-id="' + id + '" data-markdown="' + markdown + '"><i class="forum-check"></i> @lang('forum::messages.response.update')</button><button href="/" class="btn btn-default pull-right cancel_forum_edit" data-id="' + id + '"  data-markdown="' + markdown + '">@lang('forum::messages.words.cancel')</button></div>');

			// create new editor from text area
			if(markdown){
				simplemdeEditors['post-edit-' + id] = newSimpleMde(document.getElementById('post-edit-' + id));
			} else {
                @if($forum_editor == 'tinymce' || empty($forum_editor))
                    initializeNewTinyMCE('post-edit-' + id);
                @elseif($forum_editor == 'trumbowyg')
                    initializeNewTrumbowyg('post-edit-' + id);
                @endif
			}

		});

		$('.discussions li').on('click', '.cancel_forum_edit', function(e){
			post_id = $(e.target).data('id');
			markdown = $(e.target).data('markdown');
			parent_li = $(e.target).parents('li');
			parent_actions = $(e.target).parent('.forum_update_actions');
			if(!markdown){
                @if($forum_editor == 'tinymce' || empty($forum_editor))
                    tinymce.remove('#post-edit-' + post_id);
                @elseif($forum_editor == 'trumbowyg')
                    $(e.target).parents('li').find('.trumbowyg').fadeOut();
                @endif
			} else {
				$(e.target).parents('li').find('.editor-toolbar').remove();
				$(e.target).parents('li').find('.editor-preview-side').remove();
				$(e.target).parents('li').find('.CodeMirror').remove();
			}

			$('#post-edit-' + post_id).remove();
			parent_actions.remove();

			parent_li.removeClass('editing');
		});

		$('.discussions li').on('click', '.update_forum_edit', function(e){
			post_id = $(e.target).data('id');
			markdown = $(e.target).data('markdown');

			if(markdown){
				update_body = simplemdeEditors['post-edit-' + post_id].value();
			} else {
                @if($forum_editor == 'tinymce' || empty($forum_editor))
                    update_body = tinyMCE.get('post-edit-' + post_id).getContent();
                @elseif($forum_editor == 'trumbowyg')
                    update_body = $('#post-edit-' + id).trumbowyg('html');
                @endif
			}

			$.form('/{{ config('forum.routes.home') }}/posts/' + post_id, { _token: '{{ csrf_token() }}', _method: 'PATCH', 'body' : update_body }, 'POST').submit();
		});

		$('#submit_response').click(function(){
			$('#forum_form_editor').submit();
		});

		// ******************************
		// DELETE FUNCTIONALITY
		// ******************************

		$('.forum_delete_btn').click(function(){
			parent = $(this).parents('li');
			parent.addClass('delete_warning');
			id = parent.data('id');
			$('#delete_warning_' + id).show();
		});

		$('.forum_warning_delete .btn-default').click(function(){
			$(this).parent('.forum_warning_delete').hide();
			$(this).parents('li').removeClass('delete_warning');
		});

		$('.delete_response').click(function(){
			post_id = $(this).parents('li').data('id');
			$.form('/{{ config('forum.routes.home') }}/posts/' + post_id, { _token: '{{ csrf_token() }}', _method: 'DELETE'}, 'POST').submit();
		});

		// logic for when a new discussion needs to be created from the slideUp
        @if(config('forum.sidebar_in_discussion_view'))
            $('.forum-close, #cancel_discussion').click(function(){
                $('#new_discussion_in_discussion_view').slideUp();
            });
            $('#new_discussion_btn').click(function(){
                @if(Auth::guest())
                    window.location.href = "/{{ config('forum.routes.home') }}/login";
                @else
                    $('#new_discussion_in_discussion_view').slideDown();
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
                $('#new_discussion_in_discussion_view').slideDown();
                $('#title').focus();
            @endif
        @endif

	});
</script>

<script src="{{ url('/forum/assets/js/forum.js') }}"></script>

@stop
