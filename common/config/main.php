<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'jwt' => [
            'class' => 'common\components\JWT',
            'jwt_secret' => '1asdfashk@dfjals*d'
        ],
        'elasticsearch' => [
            'class' => 'yii\elasticsearch\Connection',
            'dslVersion' => '7.2',
            'nodes' => [
                ['http_address' => '127.0.0.1:9200'],
            ],
        ],
        'dbTest' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1:3307;dbname=test',
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8mb4',
            //'enableSchemaCache' => true,
        ],
    ],
];
