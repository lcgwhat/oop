<?php

namespace common\models\trace;

use Yii;

/**
 * This is the model class for table "daily_trace".
 *
 * @property int $id 账号id
 * @property int $account_id 账号ID
 * @property int $type
 * @property string|null $trace_date 日期
 * @property string|null $note 备注
 */
class DailyTrace extends \yii\db\ActiveRecord
{
    const TYPE_FAIL = 10;
    const TYPE_OTHER = 20;
    const TYPE_STOCk = 30;
    public static function getTypeNames(){
        return [
            self::TYPE_FAIL => '失败',
            self::TYPE_OTHER => '其他',
            self::TYPE_STOCk => 'stock'
        ];
    }
    public function getTypeName(){
        $names = self::getTypeNames();
        return $names[$this->type] ?? '未知类型';
    }
    public function isFail(){
        return $this->type == self::TYPE_FAIL;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'daily_trace';
    }

    public static function existFailByAccountAndDate(int $accountId, $date)
    {
        return self::find()
            ->andWhere(['account_id' => $accountId])
            ->andWhere(['trace_date' => $date])
            ->andWhere(['type' => static::TYPE_FAIL])
            ->exists();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_id'], 'required'],
            [['account_id', 'type'], 'integer'],
            [['trace_date'], 'safe'],
            [['note'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '账号id',
            'account_id' => '账号ID',
            'trace_date' => '日期',
            'note' => '备注',
        ];
    }
}
