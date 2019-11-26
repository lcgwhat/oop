#!/usr/bin/env php
<?php
/**
 * index.php
 * @author liuchg
 */
defined('YII_DEBUG') or define('YII_DEBUG', true);
if (file_exists('dev.txt')) {
    define('YII_ENV', 'dev');
} else {
    define('YII_ENV', 'prod');
}
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../common/config/bootstrap.php');
require(__DIR__ . '/config/bootstrap.php');
$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../common/config/main.php',
    require __DIR__ . '/../common/config/main-'.YII_ENV.'.php',
    require __DIR__ . 'config/main.php',
    require __DIR__ . '/../config/main-'.YII_ENV.'.php'
);

$application = new yii\console\Application($config);
$exitCode = $application->run();
exit($exitCode);
