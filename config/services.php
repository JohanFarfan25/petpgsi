<?php

return [

    'agenda_service' => env('AGENDA_SERVICE_URL', 'http://localhost:8001'),
    'mascota_service' => env('MASCOTA_SERVICE_URL', 'http://localhost:8002'),
    'validacion_service' => env('VALIDACION_SERVICE_URL', 'http://localhost:8003'),
    'notificacion_service' => env('NOTIFICACION_SERVICE_URL', 'http://localhost:8004'),

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
