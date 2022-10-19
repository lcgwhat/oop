<?php
/**
 * main-dev.php
 * @author liuchg
 */

$config = [
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'cookieValidationKey' => '在此处输入你的密钥',
        ],
        'user' => [

        ]
    ],
    'params' => [
    ]
];

if (!YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class'=>'yii\debug\Module',
        'allowedIPs'=>['127.0.0.1', '::1', '10.0.2.*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class'=>'yii\gii\Module',
        'allowedIPs'=>['127.0.0.1', '::1', '10.0.2.*'],
    ];

}

return $config;
