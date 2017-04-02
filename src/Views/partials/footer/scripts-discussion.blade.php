
@if( $chatter_editor == 'tinymce' || empty($chatter_editor) )
	<script>var chatter_editor = 'tinymce';</script>
    <script src="/vendor/devdojo/chatter/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="/vendor/devdojo/chatter/assets/js/tinymce.js"></script>
    <script>
        var my_tinymce = tinyMCE;
        $('document').ready(function(){

            $('#tinymce_placeholder').click(function(){
                my_tinymce.activeEditor.focus();
            });

        });
    </script>
@elseif($chatter_editor == 'simplemde')
	<script>var chatter_editor = 'simplemde';</script>
    <script src="/vendor/devdojo/chatter/assets/js/simplemde.min.js"></script>
    <script src="/vendor/devdojo/chatter/assets/js/chatter_simplemde.js"></script>
@elseif($chatter_editor == 'trumbowyg')
	<script>var chatter_editor = 'trumbowyg';</script>
    <script src="/vendor/devdojo/chatter/assets/vendor/trumbowyg/trumbowyg.min.js"></script>
    <script src="/vendor/devdojo/chatter/assets/vendor/trumbowyg/plugins/preformatted/trumbowyg.preformatted.min.js"></script>
    <script src="/vendor/devdojo/chatter/assets/js/trumbowyg.js"></script>
@endif

@if(Config::get('chatter.sidebar_in_discussion_view'))
    <script src="/vendor/devdojo/chatter/assets/vendor/spectrum/spectrum.js"></script>
    <script src="/vendor/devdojo/chatter/assets/js/chatter.js"></script>
@endif

<script>
	$('document').ready(function(){

		var simplemdeEditors = [];

		$('.chatter_edit_btn').click(function(){
			parent = $(this).parents('li');
			parent.addClass('editing');
			id = parent.data('id');
			markdown = parent.data('markdown');
			container = parent.find('.chatter_middle');

			if(markdown){
				body = container.find('.chatter_body_md');
			} else {
				body = container.find('.chatter_body');
				markdown = 0;
			}

			details = container.find('.chatter_middle_details');

			// dynamically create a new text area
			container.prepend('<textarea id="post-edit-' + id + '"></textarea>');
            // Client side XSS fix
            $("#post-edit-"+id).text(body.html());
			container.append('<div class="chatter_update_actions"><button class="btn btn-success pull-right update_chatter_edit"  data-id="' + id + '" data-markdown="' + markdown + '"><i class="chatter-check"></i>  @lang('chatter::messages.response.update')</button><button href="/" class="btn btn-default pull-right cancel_chatter_edit" data-id="' + id + '"  data-markdown="' + markdown + '"> @lang('chatter::messages.words.cancel')</button></div>');

			// create new editor from text area
			if(markdown){
				simplemdeEditors['post-edit-' + id] = newSimpleMde(document.getElementById('post-edit-' + id));
			} else {
                @if($chatter_editor == 'tinymce' || empty($chatter_editor))
                    initializeNewTinyMCE('post-edit-' + id);
                @elseif($chatter_editor == 'trumbowyg')
                    initializeNewTrumbowyg('post-edit-' + id);
                @endif
			}

		});

		$('.discussions li').on('click', '.cancel_chatter_edit', function(e){
			post_id = $(e.target).data('id');
			markdown = $(e.target).data('markdown');
			parent_li = $(e.target).parents('li');
			parent_actions = $(e.target).parent('.chatter_update_actions');
			if(!markdown){
                @if($chatter_editor == 'tinymce' || empty($chatter_editor))
                    tinymce.remove('#post-edit-' + post_id);
                @elseif($chatter_editor == 'trumbowyg')
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

		$('.discussions li').on('click', '.update_chatter_edit', function(e){
			post_id = $(e.target).data('id');
			markdown = $(e.target).data('markdown');

			if(markdown){
				update_body = simplemdeEditors['post-edit-' + post_id].value();
			} else {
                @if($chatter_editor == 'tinymce' || empty($chatter_editor))
                    update_body = tinyMCE.get('post-edit-' + post_id).getContent();
                @elseif($chatter_editor == 'trumbowyg')
                    update_body = $('#post-edit-' + id).trumbowyg('html');
                @endif
			}

			$.form('/{{ Config::get('chatter.routes.home') }}/posts/' + post_id, { _token: '{{ csrf_token() }}', _method: 'PATCH', 'body' : update_body }, 'POST').submit();
		});

		$('#submit_response').click(function(){
			$('#chatter_form_editor').submit();
		});

		// ******************************
		// DELETE FUNCTIONALITY
		// ******************************

		$('.chatter_delete_btn').click(function(){
			parent = $(this).parents('li');
			parent.addClass('delete_warning');
			id = parent.data('id');
			$('#delete_warning_' + id).show();
		});

		$('.chatter_warning_delete .btn-default').click(function(){
			$(this).parent('.chatter_warning_delete').hide();
			$(this).parents('li').removeClass('delete_warning');
		});

		$('.delete_response').click(function(){
			post_id = $(this).parents('li').data('id');
			$.form('/{{ Config::get('chatter.routes.home') }}/posts/' + post_id, { _token: '{{ csrf_token() }}', _method: 'DELETE'}, 'POST').submit();
		});

		// logic for when a new discussion needs to be created from the slideUp
        @if(Config::get('chatter.sidebar_in_discussion_view'))
            $('.chatter-close').click(function(){
                $('#new_discussion_in_discussion_view').slideUp();
            });
            $('#new_discussion_btn, #cancel_discussion').click(function(){
                @if(Auth::guest())
                    window.location.href = "/{{ Config::get('chatter.routes.home') }}/login";
                @else
                    $('#new_discussion_in_discussion_view').slideDown();
                    $('#title').focus();
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

            @if (count($errors) > 0)
                $('#new_discussion_in_discussion_view').slideDown();
                $('#title').focus();
            @endif
        @endif

	});
</script>

<script src="/vendor/devdojo/chatter/assets/js/chatter.js"></script>
