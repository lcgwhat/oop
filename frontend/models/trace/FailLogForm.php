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
            [['date', 'note'], 'required']
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
