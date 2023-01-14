<?php
/**
 * @author: liuchg
 *
 */

namespace common\validates;


use yii\base\NotSupportedException;
use yii\validators\Validator;

class MonthValidate extends Validator
{
    public $format = ['Y-m', 'Y/m'];
    public function validateAttribute($model, $attribute)
    {
        $month = $model->$attribute;
        $this->validateValue($month);
    }
    public function validateValue($month)
    {
        $unixTime = strtotime($month);
        if(!$unixTime) { //无法用strtotime转换，说明日期格式非法
            return ['时间格式非法',[]];
        }

        //支持多种格式的时间判断  @var format array   例如：['Y-m-d','Y/m/d']
        if(!is_array($this->format)){
            if (date($this->format, $unixTime) != $month) {
                return ['时间格式错误',[]];
            }
        }else{
            $ret = false;
            foreach ($this->format as $format){
                if (date($format, $unixTime) == $month) {
                    $ret = true;
                }
            }

            if(!$ret){
                return ['时间格式错误',[]];
            }
        }
    }
}
