
@if( $chatter_editor == 'tinymce' || empty($chatter_editor) )
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
	<script src="/vendor/devdojo/chatter/assets/js/simplemde.min.js"></script>
	<script src="/vendor/devdojo/chatter/assets/js/chatter_simplemde.js"></script>
@elseif($chatter_editor == 'trumbowyg')
	<script src="/vendor/devdojo/chatter/assets/vendor/trumbowyg/trumbowyg.min.js"></script>
	<script src="/vendor/devdojo/chatter/assets/vendor/trumbowyg/plugins/preformatted/trumbowyg.preformatted.min.js"></script>
	<script src="/vendor/devdojo/chatter/assets/js/trumbowyg.js"></script>
@endif

<script src="/vendor/devdojo/chatter/assets/vendor/spectrum/spectrum.js"></script>
<script src="/vendor/devdojo/chatter/assets/js/chatter.js"></script>
<script>
	$('document').ready(function(){

		$('.chatter-close').click(function(){
			$('#new_discussion').slideUp();
		});
		$('#new_discussion_btn, #cancel_discussion').click(function(){
			@if(Auth::guest())
				window.location.href = "/{{ Config::get('chatter.routes.home') }}/login";
			@else
				$('#new_discussion').slideDown();
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
			$('#new_discussion').slideDown();
			$('#title').focus();
		@endif


	});
</script>
