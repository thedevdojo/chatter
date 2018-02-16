<?php

return [
    'success' => [
        'title'  => 'Well done!',
        'reason' => [
            'submitted_to_post'       => 'Răspunsul a fost trimis cu succes la '.mb_strtolower(trans('chatter::intro.titles.discussion')).'.',
            'updated_post'            => 'Actualizarea lui '.mb_strtolower(trans('chatter::intro.titles.discussion')).' a fost făcută cu success.',
            'destroy_post'            => 'S-a șters cu succes răspunsul și '.mb_strtolower(trans('chatter::intro.titles.discussion')).'.',
            'destroy_from_discussion' => 'A fost șters cu succes răspunsul de la '.mb_strtolower(trans('chatter::intro.titles.discussion')).'.',
            'created_discussion'      => 'A fost creat cu succes un nou '.mb_strtolower(trans('chatter::intro.titles.discussion')).'.',
        ],
    ],
    'info' => [
        'title' => 'Atenție!',
    ],
    'warning' => [
        'title' => 'Wuh Oh!',
    ],
    'danger'  => [
        'title'  => 'Firar!',
        'reason' => [
            'errors'            => 'Te rog corectează următoarele erori:',
            'prevent_spam'      => 'Pentru a prevenii spam-ul, te rog permite :minutes între trimiterea de răspunsuri.',
            'trouble'           => 'Scuze, se pare că a apărut o problemă în trimiterea răspunsului tău.',
            'update_post'       => 'Nah ah ah... Nu am putut actualia răspunsul. Asigurați-vă că nu faceți nimic dubios.',
            'destroy_post'      => 'Nah ah ah... Nu am putut șterge răspunsul. Asigurați-vă că nu faceți nimic dubios.',
            'create_discussion' => 'Hopa :( Se pare că este o problema în crearea '.mb_strtolower(trans('chatter::intro.titles.discussion')).'.',
            'title_required'    => 'Vă rugăm să scrieți un titlu',
            'title_min'         => 'Titlul trebuie să aibă cel puțin :min caractere.',
            'title_max'         => 'Titlul trebuie să aibă cel mult :max caractere.',
            'content_required'  => 'Vă rugăm să scrieți ceva conținut',
            'content_min'       => 'Conținutul trebuie să aibă cel puțin :min caractere',
            'category_required' => 'Vă rugăm alegeți o categorie',



        ],
    ],
];
