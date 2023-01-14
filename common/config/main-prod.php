<?php
/**
 * main-prod.php
 * @author liuchg
 */
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=golang_demo',
            'username' => 'golang_demo',
            'password' => '9527golang_demo@com',
            'charset' => 'utf8mb4',
            'enableSchemaCache' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ]
];
