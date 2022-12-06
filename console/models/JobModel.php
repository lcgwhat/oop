<?php
/**
 * @author: liuchg
 *
 */

namespace console\models;


use yii\base\Component;
use yii\base\Event;

class JobModel extends Component
{

    public function behaviors()
    {
        return [
            'class' => JobBehaviors::class
        ];
    }
    public function name(){
        return "好好工作：";
    }
    /**
     * @param $event
     */
    public function doSay(){
        echo '平庸的人';
        $event = new Event();
        $event->sender = $this;
        $event->name = '对对对';
        $event->data = ['福能大涨'];
        $this->trigger('say', $event);
        $this->attachBehavior('domain', PlayBasketballs::class);
        var_dump($this->whoPlayBasketBall());die;
        var_dump($this->behaviors());die;
    }
}
