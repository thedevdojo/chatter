<?php

return [
    'words' => [
        'cancel'  => 'Cancelar',
        'delete'  => 'Borrar',
        'edit'    => 'Editar',
        'yes'     => 'Si',
        'no'      => 'No',
        'minutes' => '1 minuto| :count minutos',
    ],

    'discussion' => [
        'new'          => 'Nueva '.mb_strtolower(trans('chatter::intro.titles.discussion')),
        'all'          => 'Todas las '.mb_strtolower(trans('chatter::intro.titles.discussions')),
        'create'       => 'Crear una '.mb_strtolower(trans('chatter::intro.titles.discussion')),
        'posted_by'    => 'Publicado por',
        'head_details' => 'Publicado en categoria',

    ],
    'response' => [
        'confirm'     => '¿Estás seguro de que quieres borrar la respuesta?',
        'yes_confirm' => 'Si, borrar',
        'no_confirm'  => 'No gracias',
        'submit'      => 'Enviar respuesta',
        'update'      => 'Actualizar respuesta',
    ],

    'editor' => [
        'title'               => 'Titulo de la '.mb_strtolower(trans('chatter::intro.titles.discussion')),
        'select'              => 'Selecciona una categoria',
        'tinymce_placeholder' => 'Agrega el contenido para la '.mb_strtolower(trans('chatter::intro.titles.discussion')).' aquí...',
        'select_color_text'   => 'Selecciona un color para la '.mb_strtolower(trans('chatter::intro.titles.discussion')).' (opcional)',
    ],

    'email' => [
        'notify' => 'Notificarme cuando alguien conteste en la '.mb_strtolower(trans('chatter::intro.titles.discussion')),
    ],

    'auth' => 'Por favor <a href="/:home/login">Inicia sesión</a>
                o <a href="/:home/register">Regístrate</a>
                para dejar una respuesta.',

];
