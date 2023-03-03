<?php

namespace common\models\stock;

use Yii;

/**
 * This is the model class for table "stock_logic".
 *
 * @property int $id
 * @property string|null $code 代码
 * @property string|null $name
 * @property string|null $logic 操作逻辑
 * @property int $sort 排序
 */
class StockLogic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock_logic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['code'], 'string'],
            [['sort'], 'integer'],
            [['code'], 'string', 'max' => 6],
            [['name'], 'string', 'max' => 16],
            [['logic'], 'string', 'max' => 1024],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => '代码',
            'name' => 'Name',
            'logic' => '操作逻辑',
            'sort' => '排序',
        ];
    }
}
