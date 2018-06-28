<?php

return [
    'words' => [
        'cancel'  => 'Annuler',
        'delete'  => 'Supprimer',
        'edit'    => 'Modifier',
        'yes'     => 'Oui',
        'no'      => 'Non',
        'minutes' => '1 minute| :count minutes',
    ],

    'discussion' => [
        'new'          => 'Nouveau '.trans('chatter::intro.titles.discussion'),
        'all'          => 'Tous les '.trans('chatter::intro.titles.discussions'),
        'create'       => 'Créér '.trans('chatter::intro.titles.discussion'),
        'posted_by'    => 'Par',
        'head_details' => 'Posté dans la Catégorie',

    ],
    'response' => [
        'confirm'     => 'Êtes-vous sûr de vouloir supprimer cette réponse?',
        'yes_confirm' => 'Oui le Supprimer',
        'no_confirm'  => 'Non Merci',
        'submit'      => 'Envoyer une réponse',
        'update'      => 'Mise à jour',
    ],

    'editor' => [
        'title'               => 'Titre de '.trans('chatter::intro.titles.discussion'),
        'select'              => 'Choisir une Catégorie',
        'tinymce_placeholder' => 'Tapez votre '.trans('chatter::intro.titles.discussion').' Ici...',
        'select_color_text'   => 'Choissisez une couleur pour ce '.trans('chatter::intro.titles.discussion').' (optionel)',
    ],

    'email' => [
        'notify' => 'Avertissez-moi quand quelqu\'un répond',
    ],

    'auth' => 'S\'il vous plait <a href="/:home/login">Connectez-vous</a>
                ou <a href="/:home/register">Créér un compte</a>
                pour repondre.',

];
