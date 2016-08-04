var CHATTER_CSRF_TOKEN = $('meta[name="chatter-csrf-token"]').attr('content');

$('document').ready(function(){
	$('.chatter-alert .chatter-close').click(function(){
		$(this).parents('.chatter-alert').slideUp();
	});
});