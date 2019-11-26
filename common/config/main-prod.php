<?php
/**
 * main-prod.php
 * @author liuchg
 */
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=mancando_dev',
            'username' => 'mancando',
            'password' => '123456',
            'charset' => 'utf8mb4',
            //'enableSchemaCache' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ]
];