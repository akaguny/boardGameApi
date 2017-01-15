<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings TODO: удалить
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::API,
        ],
        // Database connection settings
        "db" => [
            "host" => "localhost",
            "dbname" => "angular-crud",
            "user" => "root",
            "pass" => "",
            "key" => file_get_contents(__DIR__ . '/key', NULL, NULL, 20, 14)
        ],
    ],
];
