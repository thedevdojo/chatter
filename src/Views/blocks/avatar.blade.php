<div class="chatter_avatar">
    @if(Config::get('chatter.user.avatar_image_database_field') && $user->{Config::get('chatter.user.avatar_image_database_field')})

        <?php $db_field = Config::get('chatter.user.avatar_image_database_field'); ?>

        <!-- If the user db field contains http:// or https:// we don't need to use the relative path to the image assets -->
        @if(Str::startsWith('http://', $user->{Config::get('chatter.user.avatar_image_database_field')}) || Str::startsWith('https://', $user->{Config::get('chatter.user.avatar_image_database_field')}))
            <img src="{{ $user->{Config::get('chatter.user.avatar_image_database_field')}  }}">
        @else
            <img src="{{ config('chatter.user.relative_url_to_image_assets') . $user->{Config::get('chatter.user.avatar_image_database_field')}  }}">
        @endif

    @else
        <span class="chatter_avatar_circle" style="background-color:#<?php echo \DevDojo\Chatter\Helpers\ChatterHelper::stringToColorCode($user->{Config::get('chatter.user.database_field_with_user_name')}) ?>">
            {{ ucfirst(substr($user->{Config::get('chatter.user.database_field_with_user_name')}, 0, 1)) }}
        </span>
    @endif
</div>
