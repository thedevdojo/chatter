@if(Request::is(Config::get('chatter.routes.home').'/*') || Request::is(Config::get('chatter.routes.home')))
    <link href="/vendor/devdojo/chatter/assets/css/chatter.css" rel="stylesheet">
	<link href="https://file.myfontastic.com/zhx5qC8YRHTb9FXSDdwL6B/icons.css" rel="stylesheet">

	@if(Config::get('chatter.editor') == 'tinymce')
		<script src="/vendor/devdojo/chatter/assets/vendor/tinymce/tinymce.min.js"></script>
	@elseif(Config::get('chatter.editor') == 'medium')

	@elseif(Config::get('chatter.editor') == 'markdown')

	@endif

	<script src="/vendor/devdojo/chatter/assets/js/editor/{{ Config::get('chatter.editor') }}.js"></script>

@endif