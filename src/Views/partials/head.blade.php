@if(Request::is(Config::get('chatter.routes.home').'/*') || Request::is(Config::get('chatter.routes.home')))
    <meta name="chatter-csrf-token" content="{{ csrf_token() }}">
    <link href="/vendor/devdojo/chatter/assets/vendor/spectrum/spectrum.css" rel="stylesheet">
	<link href="https://file.myfontastic.com/zhx5qC8YRHTb9FXSDdwL6B/icons.css" rel="stylesheet">
	<link href="/vendor/devdojo/chatter/assets/css/chatter.css" rel="stylesheet">
	<script src="/vendor/devdojo/chatter/assets/js/vue.min.js"></script>
	<script src="/vendor/devdojo/chatter/assets/js/moment.min.js"></script>
@endif