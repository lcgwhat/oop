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
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8mb4',
            //'enableSchemaCache' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ]
];
