<?php


namespace common\models\stock;

/**
 * Class StockLogicItem
 * @package common\models\stock
 *  @property int $id
 * @property int $stock_logic_id 代码
 * @property string|null $description
 * @property int $sort 排序
 */
class StockLogicItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock_logic_item';
    }
}