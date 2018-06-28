<?php

return [
    'success' => [
        'title'  => 'Bravo !!',
        'reason' => [
            'submitted_to_post'       => 'Réponse envoyée avec succès à '.mb_strtolower(trans('chatter::intro.titles.discussion')).'.',
            'updated_post'            => 'Mis à jour avec succès du '.mb_strtolower(trans('chatter::intro.titles.discussion')).'.',
            'destroy_post'            => 'Suppression réussie de la réponse et '.mb_strtolower(trans('chatter::intro.titles.discussion')).'.',
            'destroy_from_discussion' => 'Suppression réussie de la réponse du '.mb_strtolower(trans('chatter::intro.titles.discussion')).'.',
            'created_discussion'      => 'Création réussie d\'un nouveau '.mb_strtolower(trans('chatter::intro.titles.discussion')).'.',
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
            'errors'            => 'Veuillez corriger les éléments suivant errors:',
            'prevent_spam'      => 'Afin d\'éviter le spam, veuillez prévoir au moins :minutes après la soumission du contenu.',
            'trouble'           => 'Désolé, il semble y avoir eu un problème lors de la soumission de votre réponse.',
            'update_post'       => 'Nah ah ah ... Impossible de mettre à jour votre réponse. Assurez-vous de ne rien faire de louche.',
            'destroy_post'      => 'Nah ah ah ... Impossible de supprimer la réponse. Assurez-vous de ne rien faire de louche.',
            'create_discussion' => 'Whoops :( Il semble y avoir un problème à créer votre '.mb_strtolower(trans('chatter::intro.titles.discussion')).'.',
        	'title_required'    => 'Le titre est requis',
        	'title_min'		    => 'Le titre doit avoir au moins :min caractères.',
        	'title_max'		    => 'Le titre ne doit pas avoir plus de :max caractères.',
        	'content_required'  => 'Le contenu est requis',
        	'content_min'  		=> 'Le contenu ne doit pas avoir moins de :min caractères',
        	'category_required' => 'Choisissez une catégorie',
        ],
    ],
];
