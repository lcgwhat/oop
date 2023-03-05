<?php
namespace app\models\stock;

use app\models\Service;
use common\models\stock\StockLogic;

class StockLogicService extends Service {
    public function search(){
       return StockLogic::find()
           ->with(['items'])
           ->orderBy(['sort' => SORT_DESC,'id'=> SORT_DESC])
           ->asArray()->all();
    }
}
