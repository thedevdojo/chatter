<?php

return [
    'words' => [
        'cancel'  => 'Cancel',
        'delete'  => 'Delete',
        'edit'    => 'Edit',
        'yes'     => 'Yes',
        'no'      => 'No',
        'minutes' => '1 minute| :count minutes',
    ],

    'discussion' => [
        'new'          => 'New '.trans('chatter::intro.titles.discussion'),
        'all'          => 'All '.trans('chatter::intro.titles.discussion'),
        'create'       => 'Create '.trans('chatter::intro.titles.discussion'),
        'posted_by'    => 'Posted by',
        'head_details' => 'Posted in Category',

    ],
    'response' => [
        'confirm'     => 'Are you sure you want to delete this response?',
        'yes_confirm' => 'Yes Delete It',
        'no_confirm'  => 'No Thanks',
        'submit'      => 'Submit response',
        'update'      => 'Update Response',
    ],

    'editor' => [
        'title'               => 'Title of '.trans('chatter::intro.titles.discussion'),
        'select'              => 'Select a Category',
        'tinymce_placeholder' => 'Type Your '.trans('chatter::intro.titles.discussion').' Here...',
        'select_color_text'   => 'Select a Color for this '.trans('chatter::intro.titles.discussion').' (optional)',
    ],

    'email' => [
        'notify' => 'Notify me when someone replies',
    ],

    'auth' => 'Please <a href="/:home/login">login</a>
                or <a href="/:home/register">register</a>
                to leave a response.',

];
