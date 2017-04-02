<link href="/vendor/devdojo/chatter/assets/css/chatter.css" rel="stylesheet">
@if($chatter_editor == 'simplemde')
    <link href="/vendor/devdojo/chatter/assets/css/simplemde.min.css" rel="stylesheet">
@elseif($chatter_editor == 'trumbowyg')
    <link href="/vendor/devdojo/chatter/assets/vendor/trumbowyg/ui/trumbowyg.css" rel="stylesheet">
    <style>
        .trumbowyg-box, .trumbowyg-editor {
            margin: 0px auto;
        }
    </style>
@endif
