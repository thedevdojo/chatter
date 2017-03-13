function initializeNewTrumbowyg(id){
    $('#'+id).trumbowyg({
        btns: [
            ['viewHTML'],
            ['formatting'],
            'btnGrp-semantic',
            ['link'],
            ['insertImage'],
            'btnGrp-justify',
            'btnGrp-lists',
            ['horizontalRule'],
            ['removeformat'],
            ['preformatted'],
            ['fullscreen']
        ]
    });
}

$('document').ready(function() {
    $('#trumbowyg').trumbowyg({
        btns: [
            ['viewHTML'],
            ['formatting'],
            'btnGrp-semantic',
            ['link'],
            ['insertImage'],
            'btnGrp-justify',
            'btnGrp-lists',
            ['horizontalRule'],
            ['removeformat'],
            ['preformatted'],
            ['fullscreen']
        ]
    });

    document.getElementById('new_discussion_loader').style.display = "none";
    document.getElementById('chatter_form_editor').style.display = "block";
});

