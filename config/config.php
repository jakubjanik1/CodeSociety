<?php

return [
    'database' => [
        'name' => getenv('DB_NAME'),
        'username' => getenv('DB_USER'),
        'password' => getenv('DB_PASSWORD'),
        'connection' => getenv('DB_CONNECTION'),
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ],
    'authentication' => [
        'username' => getenv('ADMIN_NAME'), 
        'password' => getenv('ADMIN_PASSWORD')
    ],
    'analytics' => [
        'site_id' => getenv('SITE_ID'),
        'client_id' => getenv('CLIENT_ID'),
        'service_email' => getenv('SERVICE_EMAIL') 
    ],
    'email' => [
        'name' => getenv('EMAIL_NAME'),
        'api_key' => getenv('SENDGRID_API_KEY')
    ]
];