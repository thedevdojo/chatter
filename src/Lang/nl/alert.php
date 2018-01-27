<?php

return [
    'success' => [
        'title'  => 'Goed zo!',
        'reason' => [
            'submitted_to_post'       => 'Reactie succesvol geplaatst in de discussie.',
            'updated_post'            => 'De reactie is succesvol aangepast.',
            'destroy_post'            => 'De discussie en reacties zijn succesvol verwijderd.',
            'destroy_from_discussion' => 'De reactie is succesvol verwijderd van de discussie.',
            'created_discussion'      => 'De discussie is succesvol aangemaakt.',
        ],
    ],
    'info' => [
        'title' => 'Let op!',
    ],
    'warning' => [
        'title' => 'Oeps!',
    ],
    'danger'  => [
        'title'  => 'Oh nee!',
        'reason' => [
            'errors'            => 'Los de volgende problemen alsjeblieft op:',
            'prevent_spam'      => 'Om spam te voorkomen, wacht alsjeblieft :minutes tussen het plaatsen van nieuwe reacties.',
            'trouble'           => 'Helaas, er is een probleem opgetreden tijdens het plaatsen van je reactie.',
            'update_post'       => 'Helaas, je kan deze reactie niet wijzigen.',
            'destroy_post'      => 'Helaas, je kan deze reactie niet verwijderen.',
            'create_discussion' => 'Helaas, er is een probleem opgetreden tijdens het plaatsen van je discussie :(',
        	'title_required'    => 'Please write a tittle',
        	'title_min'		    => 'The title has to have at least :min characters.',
        	'title_max'		    => 'The title has to have no more than :max characters.',
        	'content_required'  => 'Please write some content',
        	'content_min'  		=> 'The content has to have at least :min characters',
        	'category_required' => 'Please choose a category',
        ],
    ],
];
