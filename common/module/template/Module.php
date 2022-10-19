<?php
/**
 * @author: liuchg
 *
 */

namespace common\module\template;


class Module extends \yii\base\Module
{
    // public $controllerNamespace = "common\module\lemplate\controllers";
    public function init()
    {
        parent::init();

        $this->params['foo'] = 'bar';
        // ...  其他初始化代码 ...
    }
}
