<?php
/**
 * @author: liuchg
 *
 */

namespace app\models\trace;


use common\models\FormModel;

class FailLogForm extends FormModel
{
    public $date;
    public $note;

    public function rules()
    {
        return [
            [['date', 'note'], 'required'],
            [['date'], 'filter', 'filter'=>function($value){
                $day = strtotime($value);
                if(!$day) {
                    return $this->addError('date', '格式错误');
                }
                return date('Y-m-d', $day);
            }]
        ];
    }

    public function attributeLabels()
    {
        return [
            'date' => '日期',
            'note' => '备注'
        ];
    }
}
