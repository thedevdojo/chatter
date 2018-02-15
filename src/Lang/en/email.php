<?php

return [
    'preheader'       => 'Just wanted to let you know that someone has responded to a forum post.',
    'greeting'        => 'Hi there,',
    'body'            => 'Just wanted to let you know that someone has responded to a forum post at',
    'view_discussion' => 'View the '.mb_strtolower(trans('chatter::intro.titles.discussion')).'.',
    'farewell'        => 'Have a great day!',
    'unsuscribe'      => [
        'message' => 'If you no longer wish to be notified when someone responds to this form post be sure to uncheck the notification setting at the bottom of the page :)',
        'action'  => 'Don\'t like these emails?',
        'link'    => 'Unsubscribe to this '.mb_strtolower(trans('chatter::intro.titles.discussion')).'.',
    ],
];
