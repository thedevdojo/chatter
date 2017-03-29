<li>
    <a class="discussion_list" href="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.discussion') }}/{{ $discussion->category->slug }}/{{ $discussion->slug }}">
        <div class="chatter_avatar">
            @if(Config::get('chatter.user.avatar_image_database_field'))

                <?php $db_field = Config::get('chatter.user.avatar_image_database_field'); ?>

                <!-- If the user db field contains http:// or https:// we don't need to use the relative path to the image assets -->
                @if( (substr($discussion->user->{$db_field}, 0, 7) == 'http://') || (substr($discussion->user->{$db_field}, 0, 8) == 'https://') )
                    <img src="{{ $discussion->user->{$db_field}  }}">
                @else
                    <img src="{{ Config::get('chatter.user.relative_url_to_image_assets') . $discussion->user->{$db_field}  }}">
                @endif

            @else

                <span class="chatter_avatar_circle" style="background-color:#<?= \DevDojo\Chatter\Helpers\ChatterHelper::stringToColorCode($discussion->user->email) ?>">
                    {{ strtoupper(substr($discussion->user->email, 0, 1)) }}
                </span>

            @endif
        </div>

        <div class="chatter_middle">
            <h3 class="chatter_middle_title">{{ $discussion->title }} <div class="chatter_cat" style="background-color:{{ $discussion->category->color }}">{{ $discussion->category->name }}</div></h3>
            <span class="chatter_middle_details"> @lang('chatter::messages.discussion.posted_by') <span data-href="/user">{{ ucfirst($discussion->user->{Config::get('chatter.user.database_field_with_user_name')}) }}</span> {{ \Carbon\Carbon::createFromTimeStamp(strtotime($discussion->created_at))->diffForHumans() }}</span>
            @if($discussion->post[0]->markdown)
                <?php $discussion_body = GrahamCampbell\Markdown\Facades\Markdown::convertToHtml( $discussion->post[0]->body ); ?>
            @else
                <?php $discussion_body = $discussion->post[0]->body; ?>
            @endif
            <p>{{ substr(strip_tags($discussion_body), 0, 200) }}@if(strlen(strip_tags($discussion_body)) > 200){{ '...' }}@endif</p>
        </div>

        <div class="chatter_right">

            <div class="chatter_count"><i class="chatter-bubble"></i> {{ $discussion->postsCount[0]->total }}</div>
        </div>

        <div class="chatter_clear"></div>
    </a>
</li>
