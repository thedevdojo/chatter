@extends('layouts.app')

@section(Config::get('chatter.yields.head'))
	@include('chatter::partials.head')
@stop


@section('content')

<div id="chatter">

	<div id="chatter_header">
		<div class="container">
			<a href="/{{ Config::get('chatter.routes.home') }}"><i class="chatter-back"></i></a>
			<h1>{{ $discussion->title }}</h1>
		</div>
	</div>

	@if(Session::has('chatter_alert'))
		<div class="chatter-alert alert alert-{{ Session::get('chatter_alert_type') }}">
			<div class="container">
	        	<strong><i class="chatter-alert-{{ Session::get('chatter_alert_type') }}"></i> {{ Config::get('chatter.alert_messages.' . Session::get('chatter_alert_type')) }}</strong>
	        	{{ Session::get('chatter_alert') }}
	        	<i class="chatter-close"></i>
	        </div>
	    </div>
	    <div class="chatter-alert-spacer"></div>
	@endif

	<div class="container margin-top">
		
	    <div class="row">

	        <div class="col-md-10">
					
				<div class="panel">
	                <ul class="discussions no-bg" style="display:block;">
	                	@foreach($posts as $post)
	                		<li>
		                		<span class="chatter_posts">
			                		<div class="chatter_avatar">
					        			<img src="https://discuss.flarum.org/assets/avatars/9fra4tlmk50dmbqq.jpg">
					        		</div>

					        		<div class="chatter_middle">
					        			<span><a href="/user">{{ $post->user->name }}</a> <span class="ago">{{ $post->created_at }}</span></span>
					        			<p><?= $post->body ?></p>
					        		</div>

					        		<div class="chatter_clear"></div>
				        		</span>
		                	</li>
	                	@endforeach

	           
	                </ul>
	            </div>
	        </div>

	        <div class="col-md-2">
	        	<button class="btn btn-primary">Leave a Response</button>
	       	</div>

	    </div>
	</div>

</div>


@stop

@section(Config::get('chatter.yields.footer'))
<script src="/vendor/devdojo/chatter/assets/js/chatter.js"></script>

<script>
	// $('document').ready(function(){
	// 	$.getJSON('/' + '<?= Config::get('chatter.routes.home'); ?>' + '/posts', function(posts_data){
	// 		$('.chatter_loader').addClass('loaded');
	// 		$('.chatter_loader_container').hide();
	// 		$('ul.discussions').show();
	// 		$.each(posts_data, function(index, value){
	// 			//forum.posts.push(value);
	// 		});
	// 	});
	// });
	$('document').ready(function(){

	});
</script>
<script src="/vendor/devdojo/chatter/assets/js/chatter.js"></script>

@stop