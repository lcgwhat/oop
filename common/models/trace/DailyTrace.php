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
            [['account_id', 'trace_date'], 'unique', 'targetAttribute' => ['account_id', 'trace_date']],
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
