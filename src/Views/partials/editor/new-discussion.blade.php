<?php $isDisscussionView = Route::currentRouteName() == 'chatter.discussion.showInCategory'  ?>
<div class="row">
    <div class="col-md-7">
        <!-- TITLE -->
        <input type="text" class="form-control" id="title" name="title" placeholder="@lang('chatter::messages.editor.title')" v-model="title" value="{{ old('title') }}" >
    </div>

    <div class="col-md-4">
        <!-- CATEGORY -->
            <select id="chatter_category_id" class="form-control" name="chatter_category_id">
                <option value="">@lang('chatter::messages.editor.select')</option>
                @foreach($categories as $category)
                    @if(old('chatter_category_id') == $category->id)
                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>
    </div>

    <div class="col-md-1">
        <i class="chatter-close"></i>
    </div>
</div><!-- .row -->

<!-- BODY -->
<div id="editor">
    @if( $chatter_editor == 'tinymce' || empty($chatter_editor) )
        <label id="tinymce_placeholder">@lang('chatter::messages.editor.tinymce_placeholder')</label>
        <textarea id="{{ ($isDisscussionView) ? 'body_in_discussion_view' :'body' }}" class="richText" name="body" placeholder="">{{ old('body') }}</textarea>
    @elseif($chatter_editor == 'simplemde')
        <textarea id="{{ ($isDisscussionView) ? 'simplemde_in_discussion_view' :'body' }}" name="body" placeholder="">{{ old('body') }}</textarea>
    @elseif($chatter_editor == 'trumbowyg')
        <textarea class="trumbowyg" name="body" placeholder="Type Your Discussion Here...">{{ old('body') }}</textarea>
    @endif
</div>

<input type="hidden" name="_token" id="csrf_token_field" value="{{ csrf_token() }}">

<div id="new_discussion_footer">
    <input type='text' id="color" name="color" /><span class="select_color_text">@lang('chatter::messages.editor.select_color_text')</span>
    <button id="submit_discussion" class="btn btn-success pull-right"><i class="chatter-new"></i> @lang('chatter::messages.discussion.create') </button>
    <a href="/{{ Config::get('chatter.routes.home') }}" class="btn btn-default pull-right" id="cancel_discussion">@lang('chatter::messages.words.cancel')</a>
    <div style="clear:both"></div>
</div>
