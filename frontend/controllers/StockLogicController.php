<?php 
namespace app\controllers;
use app\models\stock\StockLogicService;

class StockLogicController extends Controller {
    public function actionIndex(){
        $service = new StockLogicService();
        $res = $service->search();
        return $this->jsonSuccess('成功', $res);
    }
}
