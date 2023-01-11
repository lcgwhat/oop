<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
$env = getenv('YII_ENV');
if ($env == false) {
    define('YII_ENV', 'dev');
} else {
    define('YII_ENV', 'prod');
}

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../../common/config/bootstrap.php';
require __DIR__ . '/../config/bootstrap.php';


$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../common/config/main.php',
    require __DIR__ . '/../../common/config/main-'.YII_ENV.'.php',
    require __DIR__ . '/../config/main.php',
    require __DIR__ . '/../config/main-'.YII_ENV.'.php'
);

(new yii\web\Application($config))->run();
