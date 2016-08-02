<a href="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.discussion') }}/create" class="btn btn-primary"><i class="chatter-new"></i> New {{ Config::get('chatter.titles.discussion') }}</a> 
<ul class="nav nav-pills nav-stacked">
	<?php $categories = DevDojo\Chatter\Models\Category::all(); ?>
	@foreach($categories as $category)
		<li><a href="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.category') }}/{{ $category->slug }}"><div class="chatter-box" style="background-color:{{ $category->color }}"></div> {{ $category->name }}</a></li>
	@endforeach
</ul>