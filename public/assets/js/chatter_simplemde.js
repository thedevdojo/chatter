
if (typeof simplemdeOptions == 'undefined') {
	var simplemdeOptions = {
		autofocus: true,
		placeholder: "Type Your Discussion Here...",
	    hideIcons: ["guide", "preview"],
	    spellChecker: false,
	    status: false,
	};
}

function newSimpleMde(element){
	simplemdeOptions['element'] = element;
	return new SimpleMDE(simplemdeOptions);
}

$('document').ready(function(){

	var simplemde = newSimpleMde(document.getElementById("simplemde"));
	
	$('.editor-toolbar .fa-columns').click(function(){
		if(!$('body').hasClass('simplemde')){
			$('body').addClass('simplemde');
		}
	});

	$('.editor-toolbar .fa-arrows-alt').click(function(){
		if($('body').hasClass('simplemde')){
			$('body').removeClass('simplemde');
		} else {
			$('body').addClass('simplemde');
		}
	});

	document.getElementById('new_discussion_loader').style.display = "none";
	document.getElementById('chatter_form_editor').style.display = "block";
});
