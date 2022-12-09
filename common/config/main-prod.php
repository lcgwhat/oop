<?php
/**
 * main-prod.php
 * @author liuchg
 */
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=test',
            'username' => 'vps',
            'password' => 'lfv2a21k6a309&2399',
            'charset' => 'utf8mb4',
            'enableSchemaCache' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ]
];
