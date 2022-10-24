<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
if (!file_exists('prod.txt')) {
    define('YII_ENV', 'dev');
} else {
    define('YII_ENV', 'prod');
}
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../../common/config/bootstrap.php';
require __DIR__ . '/../config/bootstrap.php';
//
//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
//header("Access-Control-Allow-Headers:x-requested-with,content-type");

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../common/config/main.php',
    require __DIR__ . '/../../common/config/main-'.YII_ENV.'.php',
    require __DIR__ . '/../config/main.php',
    require __DIR__ . '/../config/main-'.YII_ENV.'.php'
);

(new yii\web\Application($config))->run();
