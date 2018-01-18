<?php

return [
    'success' => [
        'title'  => 'Well done!',
        'reason' => [
            'submitted_to_post'       => 'Response successfully submitted to '.strtolower(Config::get('chatter.titles.discussion')).'.',
            'updated_post'            => 'Successfully updated the '.strtolower(Config::get('chatter.titles.discussion')).'.',
            'destroy_post'            => 'Successfully deleted the response and '.strtolower(Config::get('chatter.titles.discussion')).'.',
            'destroy_from_discussion' => 'Successfully deleted the response from the '.strtolower(Config::get('chatter.titles.discussion')).'.',
            'created_discussion'      => 'Successfully created a new '.strtolower(Config::get('chatter.titles.discussion')).'.',
        ],
    ],
    'info' => [
        'title' => 'Heads Up!',
    ],
    'warning' => [
        'title' => 'Wuh Oh!',
    ],
    'danger'  => [
        'title'  => 'Oh Snap!',
        'reason' => [
            'errors'            => 'Please fix the following errors:',
            'prevent_spam'      => 'In order to prevent spam, please allow at least :minutes in between submitting content.',
            'trouble'           => 'Sorry, there seems to have been a problem submitting your response.',
            'update_post'       => 'Nah ah ah... Could not update your response. Make sure you\'re not doing anything shady.',
            'destroy_post'      => 'Nah ah ah... Could not delete the response. Make sure you\'re not doing anything shady.',
            'create_discussion' => 'Whoops :( There seems to be a problem creating your '.strtolower(Config::get('chatter.titles.discussion')).'.',
        ],
    ],
];
