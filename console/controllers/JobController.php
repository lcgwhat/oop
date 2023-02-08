<?php
/**
 * @author: liuchg
 *
 */

/**
 * php index.php job/test
 * php index.php job/sync-vin-car
 */
namespace console\controllers;


use common\models\elasticsearch\VinCar;
use console\models\JobModel;
use yii\db\ColumnSchema;
use yii\helpers\Json;

class JobController extends \yii\console\Controller
{
    public function actionIndex(){
       $modle = new JobModel();
       $modle->doSay();
    }
    public function actionTest(){
        /**
         * @var $dbTest \yii\db\Connection
         */
        $dbTest = \Yii::$app->get('dbTest');

        $tableSchema = $dbTest->getTableSchema('thirdparty_car_template');
        file_put_contents('./dd.json', Json::encode($tableSchema->getColumnNames()));return;
        $properties = [];
        foreach ($tableSchema->getColumnNames() as $columnName) {
            $columnSchema = $tableSchema->getColumn($columnName);
            $properties[$columnName] = [
                'type' => $this->mysqlT2esType($columnSchema->type)
            ];
        }
        file_put_contents('./dd.json', Json::encode($properties));

    }
    public function actionSyncVinCar(){
        $car = new VinCar();
        $car->id = 1;
        $car->vin = "LFV3A28W9N3400460";
        $car->type_name = '奥迪A4L';
        $car->_id = 1;

        if (!$car->save()) {
            var_dump(current($car->getErrors()));die;

        }else{
            echo "成功";
        }
    }
    public function up(){
       $car =  VinCar::findOne(['id'=>1]);
       $car->type_name = "奥迪A4L";
       if (!$car->update()){
           echo "是吧";
       }else{
           echo "公告";
       }
       var_dump($car);die;
    }
    private function mysqlT2esType($mysqlType){
        switch ($mysqlType) {
            case 'integer':
                return 'integer';
            default:
                return 'text';
        }
    }
}
