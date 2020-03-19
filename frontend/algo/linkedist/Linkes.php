<?php
/**
 * Linkes.php
 * @author liuchg
 */

namespace app\algo\linkedist;

use app\algo\linkedist\LinkList;

/**
 * 单链表相关算法
 *
 * Class SingleLinkedListAlgo
 *
 * reverse 单链表反转
 * checkCircle 链表中环的检测
 * mergerSortedList 两个有序的链表合并
 * deleteLastKth 删除链表倒数第n个结点
 * findMiddleNode 求链表的中间结点
 *
 * @package Algo_07
 */
class Linkes
{
    //单链
    public $list;

    /**
     * 构造函数设置$list
     * Linkes constructor.
     * @param \app\algo\linkedist\LinkList $linkList
     */
    public function __construct(LinkList $linkList)
    {
        $this->list = $linkList;
    }

    /**
     * 单链表反转
     *
     * 三个指针反转
     * preNode 指向前一个结点
     * curNode 指向当前结点
     * remainNode 临时保存，指向当前结点的下一个节点（保存未逆序的链表，为了在断开curNode的next指针后能找到后续节点）
     *
     * @return bool
     */
    public function reverse() {
        if (is_null($this->list) || is_null($this->list->head) || is_null($this->list->head->next)) {
            return false;
        }

        $preNode = null;
        $curNode = $this->list->head->next;
        $remainNode = null;

        // 保存头结点，稍后指向反转后的链表
        $headNode = $this->list->head;
        // 断开头结点的next指针
        $this->list->head->next = null;
        while(!is_null($curNode)) {

            //记录当前节点的下一个节点
            $remainNode = $curNode->next;

            //然后将当前节点指向pre
            $curNode->next = $preNode;

            //pre和cur节点都前进一位
            $preNode = $curNode;
            $curNode = $remainNode;
        }
        // 头结点指向反转后的链表
        $headNode->next = $preNode;

        return $preNode;
    }
}
