
// Initiate the tinymce editor on any textarea with a class of richText
tinymce.init({ 
	selector:'textarea.richText',
	skin: 'chatter',
	plugins: 'link, image, codesample',
	toolbar: 'styleselect bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image | codesample ',
	menubar: false,
	statusbar: false,
	height : "220",
	content_css : "/css/app.css, /vendor/devdojo/chatter/assets/css/chatter.css",
	template_popup_height: 380,
	setup: function (editor) {
        editor.on('init', function(args) {
        	// The tinymce editor is ready
            document.getElementById('new_discussion_loader').style.display = "none";
            document.getElementById('tinymce_placeholder').style.display = "block";
			document.getElementById('chatter_form_editor').style.display = "block";
        });
        editor.on('keyup', function(e) {
        	content = editor.getContent();
        	if(content){
        		//$('#tinymce_placeholder').fadeOut();
        		document.getElementById('tinymce_placeholder').style.display = "none";
        	} else {
        		//$('#tinymce_placeholder').fadeIn();
        		document.getElementById('tinymce_placeholder').style.display = "block";
        	}
        });
    }
});
