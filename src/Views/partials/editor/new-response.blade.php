<div id="new_response">

    <div class="chatter_avatar">
        @if(Config::get('chatter.user.avatar_image_database_field'))

            <?php $db_field = Config::get('chatter.user.avatar_image_database_field'); ?>

            <!-- If the user db field contains http:// or https:// we don't need to use the relative path to the image assets -->
            @if( (substr(Auth::user()->{$db_field}, 0, 7) == 'http://') || (substr(Auth::user()->{$db_field}, 0, 8) == 'https://') )
                <img src="{{ Auth::user()->{$db_field}  }}">
            @else
                <img src="{{ Config::get('chatter.user.relative_url_to_image_assets') . Auth::user()->{$db_field}  }}">
            @endif

        @else
            <span class="chatter_avatar_circle" style="background-color:#<?= \DevDojo\Chatter\Helpers\ChatterHelper::stringToColorCode(Auth::user()->email) ?>">
                {{ strtoupper(substr(Auth::user()->email, 0, 1)) }}
            </span>
        @endif
    </div>

    <div id="new_discussion">


        <div class="chatter_loader dark" id="new_discussion_loader">
            <div></div>
        </div>

        <form id="chatter_form_editor" action="/{{ Config::get('chatter.routes.home') }}/posts" method="POST">

            <!-- BODY -->
            <div id="editor">
                @if( $chatter_editor == 'tinymce' || empty($chatter_editor) )

                    <label id="tinymce_placeholder">@lang('chatter::messages.editor.tinymce_placeholder')</label>
                    <textarea id="body" class="richText" name="body" placeholder="">{{ old('body') }}</textarea>
                @elseif($chatter_editor == 'simplemde')
                    <textarea id="simplemde" name="body" placeholder="">{{ old('body') }}</textarea>
                @elseif($chatter_editor == 'trumbowyg')
                    <textarea class="trumbowyg" name="body" placeholder="Type Your Discussion Here...">{{ old('body') }}</textarea>
                @endif
            </div>

            <input type="hidden" name="_token" id="csrf_token_field" value="{{ csrf_token() }}">
            <input type="hidden" name="chatter_discussion_id" value="{{ $discussion->id }}">
        </form>

    </div><!-- #new_discussion -->
    <div id="discussion_response_email">
        <button id="submit_response" class="btn btn-success pull-right"><i class="chatter-new"></i> @lang('chatter::messages.response.submit')</button>
        @if(Config::get('chatter.email.enabled'))
            <div id="notify_email">
                <img src="/vendor/devdojo/chatter/assets/images/email.gif" class="chatter_email_loader">
                <!-- Rounded toggle switch -->
                <span>@lang('chatter::messages.email.notify')</span>
                <label class="switch">
                    <input type="checkbox" id="email_notification" name="email_notification" @if(!Auth::guest() && $discussion->users->contains(Auth::user()->id)){{ 'checked' }}@endif>
                    <span class="on"> @lang('chatter::messages.words.yes')</span>
                    <span class="off"> @lang('chatter::messages.words.no')</span>
                    <div class="slider round"></div>
                </label>
            </div>
        @endif
    </div>
</div>
