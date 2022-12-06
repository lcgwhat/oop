<?php
/**
 * @author: liuchg
 *
 */

namespace console\models;


use yii\base\Behavior;
use yii\base\Event;

class JobBehaviors extends Behavior
{
    const SAY = 'say';
    public function events()
    {
        return [
            static::SAY => 'onSay'
        ];
    }

    /**
     * @param $event Event
     */
    public function onSay($event){
        var_dump($event->name);
        /**
         * @var $sender JobModel
         */
        $sender = $event->sender;
        printf("打工仔：%s\n", $sender->name());
        echo '我是好人';
    }
}
