<?php

return [
    'success' => [
        'title'  => '¡Bien hecho!',
        'reason' => [
            'submitted_to_post'       => 'Respuesta enviada correctamente a la discusión.',
            'updated_post'            => 'Discusión actualizada correctamente.',
            'destroy_post'            => 'Se ha borrado correctamente la respuesta y la discusión.',
            'destroy_from_discussion' => 'Se ha borrado correctamente la respuesta de la discusión.',
            'created_discussion'      => 'Se ha creado correctamente una nueva discusión.',
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
            'create_discussion' => '¡Ups! Parece que hay un problema al crear la discusión. :(',
        ],
    ],
];
