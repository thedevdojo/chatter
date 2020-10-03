<?php

return [
    'words' => [
        'cancel'  => 'Anulează',
        'delete'  => 'Șterge',
        'edit'    => 'Modifică',
        'yes'     => 'Da',
        'no'      => 'Nu',
        'minutes' => 'un minut| :count minute',
    ],

    'discussion' => [
        'new'          => 'Nou '.trans('forum::intro.titles.discussion'),
        'all'          => 'Toate '.trans('forum::intro.titles.discussion'),
        'create'       => 'Creează '.trans('forum::intro.titles.discussion'),
        'posted_by'    => 'Publicat de',
        'head_details' => 'Publicat în categorie',

    ],
    'response' => [
        'confirm'     => 'Ești sigur că vrei să ștergi acest răspuns?',
        'yes_confirm' => 'Da, șterge-l',
        'no_confirm'  => 'Nu mulțumesc',
        'submit'      => 'Trimite răspuns',
        'update'      => 'Actualizează răspuns',
    ],

    'editor' => [
        'title'               => 'Titlul lui '.trans('forum::intro.titles.discussion'),
        'select'              => 'Selectează o categorie',
        'tinymce_placeholder' => 'Scrie '.trans('forum::intro.titles.discussion').' aici...',
        'select_color_text'   => 'Alege o culoare pentru '.trans('forum::intro.titles.discussion').' (opțional)',
    ],

    'email' => [
        'notify' => 'Anunță-mă când cineva răspunde',
    ],

    'auth' => 'Te rog <a href="/:home/login">autentifică-te</a>
                sau <a href="/:home/register">înregistrează-te</a>
                pentru a lăsa un răspuns.',

];
