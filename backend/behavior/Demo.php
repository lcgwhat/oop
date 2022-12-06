<?php
/**
 * @author: liuchg
 *
 */

namespace app\behavior;


use yii\base\Behavior;

class Demo
{
    function todo(){
        $this->add(new UserBehavior());
    }
    public function add(Behavior $be){

    }
}
