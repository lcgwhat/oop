<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/params.php'
);

return [
    'id' => 'app-frontend',
    'language' =>'zh-CN',
    'name' => '-_-!商城',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\controllers',
    'components' => [
        'view' => [
            'title' => '商城',
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'enableCsrfValidation' => false,
        ],
        'user' => [
            'identityClass' => 'common\models\account\UserIdentity',
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'class'=>'yii\web\CacheSession',
            'useCookies'=>true,
            'timeout' => 7200,
            'name' => 'ASESSID',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'class' => 'common\components\JsonErrorHandle',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
            ],
        ],

    ],
    'params' => $params,
];
