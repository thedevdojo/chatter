<?php

return [
    'preheader'       => 'Este texto es como un encabezado. Algunos clientes muestran este texto como una vista previa.',
    'greeting'        => 'Hola,',
    'body'            => 'Te informamos que alguien ha respondido a una '.mb_strtolower(trans('chatter::intro.titles.discussion')).' publicada en',
    'view_discussion' => 'Ver la '.mb_strtolower(trans('chatter::intro.titles.discussion')),
    'farewell'        => 'Que tengas un buen día.',
    'unsuscribe'      => [
        'message' => 'Si ya no deseas ser notificado cuando alguien más responda, asegurate de desmarcar la configuración de notificación al final de la página :)',
        'action'  => '¿No le gustan estos correos electrónicos?',
        'link'    => 'Anular la suscripción a la '.mb_strtolower(trans('chatter::intro.titles.discussion')),
    ],
];
