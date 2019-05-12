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
    ]
];