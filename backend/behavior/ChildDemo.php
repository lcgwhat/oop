<?php
/**
 * @author: liuchg
 *
 */

namespace app\behavior;


class ChildDemo extends ParentDemo
{
    public function get(string $id)
    {
        return $id;
    }
}
