<?php
/**
 * @author: liuchg
 *
 */

namespace app\models;


use yii\web\ResponseFormatterInterface;

class UpServerService
{
    // n阶台阶，上楼可以一步上1阶，也可以一步上2阶，走完n阶台阶共有多少种不同的走法？
    public function start($n):int{
        return $this->start($n-1) + $this->start($n-2);
    }

    public function method2($n) {
        if ($n<=2) {
            return $n;
        }
        $count_1 = 1; // 3
        $count_2 = 2;
        for($i = 3; $i <= $n; $i++){
            $tem = $count_2;
            $count_2 = $count_1 + $count_2;
            $count_1 = $tem;
        }

        return $count_2;
    }
    // 3  3 F(1) + F(2)
    // 4  3 + F(3) + F(2)
}
