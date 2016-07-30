tinymce.init({ 
	selector:'textarea',
	skin: 'chatter',
	plugins: 'link, image, codesample',
	toolbar: 'styleselect bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image | codesample ',
	menubar: false,
	height : "260",
	template_popup_height: 380,
	setup: function (editor) {
        editor.on('init', function(args) {
        	console.log('completed');
            document.getElementById('editor').className = "loaded";
        });
    }
});