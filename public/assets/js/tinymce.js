
// Initiate the tinymce editor on any textarea with a class of richText
tinymce.init({ 
	selector:'textarea.richText',
	skin: 'chatter',
	plugins: 'link, image, codesample',
	toolbar: 'styleselect bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image | codesample ',
	menubar: false,
	height : "260",
	template_popup_height: 380,
	setup: function (editor) {
        editor.on('init', function(args) {
        	// The tinymce editor is ready
            document.getElementById('editor').className = "loaded";
        });
    }
});