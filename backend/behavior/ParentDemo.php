<?php
/**
 * @author: liuchg
 *
 */

namespace app\behavior;


class ParentDemo
{
    public function get(int $id){
        return $id+10;
    }
}
