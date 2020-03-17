<?php
/**
 * ListNode.php
 * @author liuchg
 */

namespace app\algo\linkedist;


class ListNode
{
    /**
     * 节点中的数据域
     *
     * @var null
     */
    public $data;

    /**
     * 节点中的指针域，指向下一个节点
     *
     * @var ListNode
     */
    public $next;


    public function __construct($data=null)
    {
        $this->data = $data;
        $this->next = null;
    }


}
