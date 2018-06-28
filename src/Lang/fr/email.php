<?php

return [
    'preheader'       => 'Je voulais juste vous faire savoir que quelqu\'un a répondu à un message sur le forum.',
    'greeting'        => 'Salut,',
    'body'            => 'Je voulais juste vous faire savoir que quelqu\'un a répondu à un message sur le forum à',
    'view_discussion' => 'Voir le '.mb_strtolower(trans('chatter::intro.titles.discussion')).'.',
    'farewell'        => 'Passez une bonne journée!',
    'unsuscribe'      => [
        'message' => 'Si vous ne souhaitez plus être averti lorsque quelqu\'un répond à ce formulaire, assurez-vous de décocher le paramètre de notification au bas de la page :)',
        'action'  => 'Vous n\'aimez pas ces emails?',
        'link'    => 'Se désabonner à cette '.mb_strtolower(trans('chatter::intro.titles.discussion')).'.',
    ],
];
