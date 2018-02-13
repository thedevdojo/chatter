<?php

return [
    'success' => [
        'title'  => '¡Bien hecho!',
        'reason' => [
            'submitted_to_post'       => 'Respuesta enviada correctamente a la '.mb_strtolower(trans('chatter::intro.titles.discussion')),
            'updated_post'            =>  trans('chatter::intro.titles.discussion').' actualizada correctamente.',
            'destroy_post'            => 'Se ha borrado correctamente la respuesta y la '.mb_strtolower(trans('chatter::intro.titles.discussion')),
            'destroy_from_discussion' => 'Se ha borrado correctamente la respuesta de la '.mb_strtolower(trans('chatter::intro.titles.discussion')),
            'created_discussion'      => 'Se ha creado correctamente una nueva '.mb_strtolower(trans('chatter::intro.titles.discussion')),
        ],
    ],
    'info' => [
        'title' => '¡Aviso!',
    ],
    'warning' => [
        'title' => '¡Precaución!',
    ],
    'danger'  => [
        'title'  => '¡Ha ocurrido un error!',
        'reason' => [
            'errors'            => 'Por favor corrige los siguientes errores:',
            'prevent_spam'      => 'Con el fin de prevenir el SPAM, podrás volver a enviar el contenido nuevamente en :minutes',
            'trouble'           => 'Parece que ha ocurrido un problema al intentar enviar la respuesta, vuelve a intentarlo más tarde.',
            'update_post'       => '¡Oh! No se ha podido actualizar la respuesta.',
            'destroy_post'      => '¡Oh! No se ha podido borrar la respuesta.',
            'create_discussion' => '¡Ups! Parece que hay un problema al crear la '.mb_strtolower(trans('chatter::intro.titles.discussion')).'. :(',
        	'title_required'    => 'Por favor escribe un título',
        	'title_min'		    => 'El título debe tener al menos :min caracteres.',
        	'title_max'		    => 'El título no debe superar los :max caracteres.',
        	'content_required'  => 'Es necesario escribir algo en el contenido',
        	'content_min'  		=> 'El contenido debe tener al menos :min caracteres',
        	'category_required' => 'Por favor selecciona una categoría',
        	
        ],
    ],
];
