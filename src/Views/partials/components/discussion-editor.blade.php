<div class="row">
    <div class="col-md-7">
        <!-- TITLE -->
        <input type="text" class="form-control" id="title" name="title" placeholder="Title of {{ Config::get('chatter.titles.discussion') }}" v-model="title" value="{{ old('title') }}" >
    </div>

    <div class="col-md-4">
        <!-- CATEGORY -->
        <select id="chatter_category_id" class="form-control" name="chatter_category_id">
            <option value="">Select a Category</option>
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
        <label id="tinymce_placeholder">Add the content for your Discussion here</label>
        <textarea id="body_in_discussion_view" class="richText" name="body" placeholder="">{{ old('body') }}</textarea>
    @elseif($chatter_editor == 'simplemde')
        <textarea id="simplemde_in_discussion_view" name="body" placeholder="">{{ old('body') }}</textarea>
    @elseif($chatter_editor == 'trumbowyg')
        <textarea class="trumbowyg" name="body" placeholder="">{{ old('body') }}</textarea>
    @endif
</div>

<input type="hidden" name="_token" id="csrf_token_field" value="{{ csrf_token() }}">

<div id="new_discussion_footer">
    <input type='text' id="color" name="color" /><span class="select_color_text">Select a Color for this Discussion (optional)</span>
    <button id="submit_discussion" class="btn btn-success pull-right"><i class="chatter-new"></i> Create {{ Config::get('chatter.titles.discussion') }}</button>
    <a href="/{{ Config::get('chatter.routes.home') }}" class="btn btn-default pull-right" id="cancel_discussion">Cancel</a>
    <div style="clear:both"></div>
</div>
