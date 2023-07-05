<?php

namespace common\models\plan;

use Yii;

/**
 * This is the model class for table "plan".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string|null $start_date
 * @property int $keep_day 坚持？天
 * @property string|null $create_time 创建时间
 */
class Plan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'keep_day'], 'required'],
            [['user_id', 'keep_day'], 'integer'],
            [['start_date', 'create_time'], 'safe'],
            [['title'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'start_date' => 'Start Date',
            'keep_day' => '坚持？天',
            'create_time' => '创建时间',
        ];
    }
}
