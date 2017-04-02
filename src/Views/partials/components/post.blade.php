<li data-id="{{ $post->id }}" data-markdown="{{ $post->markdown }}">
    <span class="chatter_posts">
        @if(!Auth::guest() && (Auth::user()->id == $post->user->id))
            <div id="delete_warning_{{ $post->id }}" class="chatter_warning_delete">
                <i class="chatter-warning"></i> @lang('chatter::messages.response.confirm')
                <button class="btn btn-sm btn-danger pull-right delete_response">@lang('chatter::messages.response.yes_confirm')</button>
                <button class="btn btn-sm btn-default pull-right">@lang('chatter::messages.response.no_confirm')</button>
            </div>
            <div class="chatter_post_actions">
                <p class="chatter_delete_btn">
                    <i class="chatter-delete"></i> @lang('chatter::messages.words.delete')
                </p>
                <p class="chatter_edit_btn">
                    <i class="chatter-edit"></i> @lang('chatter::messages.words.edit')
                </p>
            </div>
        @endif
        <div class="chatter_avatar">
            @if(Config::get('chatter.user.avatar_image_database_field'))

                <?php $db_field = Config::get('chatter.user.avatar_image_database_field'); ?>

                <!-- If the user db field contains http:// or https:// we don't need to use the relative path to the image assets -->
                @if( (substr($post->user->{$db_field}, 0, 7) == 'http://') || (substr($post->user->{$db_field}, 0, 8) == 'https://') )
                    <img src="{{ $post->user->{$db_field}  }}">
                @else
                    <img src="{{ Config::get('chatter.user.relative_url_to_image_assets') . $post->user->{$db_field}  }}">
                @endif

            @else
                <span class="chatter_avatar_circle" style="background-color:#<?= \DevDojo\Chatter\Helpers\ChatterHelper::stringToColorCode($post->user->email) ?>">
                    {{ ucfirst(substr($post->user->email, 0, 1)) }}
                </span>
            @endif
        </div>

        <div class="chatter_middle">
            <span class="chatter_middle_details"><a href="{{ \DevDojo\Chatter\Helpers\ChatterHelper::userLink($post->user) }}">{{ ucfirst($post->user->{Config::get('chatter.user.database_field_with_user_name')}) }}</a> <span class="ago chatter_middle_details">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }}</span></span>
            <div class="chatter_body">

                @if($post->markdown)
                    <pre class="chatter_body_md">{{ $post->body }}</pre>
                    <?= \DevDojo\Chatter\Helpers\ChatterHelper::demoteHtmlHeaderTags( GrahamCampbell\Markdown\Facades\Markdown::convertToHtml( $post->body ) ); ?>
                    <!--?= GrahamCampbell\Markdown\Facades\Markdown::convertToHtml( $post->body ); ?-->
                @else
                    <?= $post->body; ?>
                @endif

            </div>
        </div>

        <div class="chatter_clear"></div>
    </span>
</li>
