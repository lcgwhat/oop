<?php
namespace app\models\stock;

use app\models\Service;
use common\models\stock\StockLogic;

class StockLogicService extends Service {
    public function search(){
       return StockLogic::find()->orderBy(['id'=> SORT_DESC])->asArray()->all();
    }
}
