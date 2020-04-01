<?php
/**
 * QueueOnLinkedList.php
 * @author liuchg
 */

namespace app\algo\queue;

use app\algo\linkedist\ListNode;

/**
 * 队列链表
 * Class QueueOnLinkedList
 * @package app\algo\queue
 */
class QueueOnLinkedList
{
    /**
     * 队列头节点
     * @var ListNode
     */
    public $head;

    /**
     * 队列尾节点
     * @var null
     */
    public $tail;

    /**
     * 队列长度
     * @var integer
     */
    public $length;

    /**
     * QueueOnLinkedList constructor.
     */
    public function __construct()
    {
        $this->head = new ListNode();
        $this->tail = $this->head;
        $this->length = 0;
    }

    /**
     * 入队
     * @param $data
     */
    public function enQueue($data){
        $newNode = new ListNode();
        $newNode->data = $data;
        $this->tail->next = $newNode;
        $this->tail = $newNode;
        $this->length++;
    }

    /**
     * 出队
     * @return ListNode|bool|null
     */
    public function deQueue() {
        if ($this->length < 0) {
            return false;
        }
        $node = $this->head->next;
        $this->head->next = $this->head->next->next;
        $this->length--;

        return $node;
    }

    /**
     * 获取长度
     * @return int
     */
    public function getLength(){
        return $this->length;
    }

    public function printSelf() {
        if ($this->length < 0 ) {
            echo 'empty queue'. PHP_EOL;
        }
        $curNode = $this->head;
        while (!is_null($curNode)) {
            echo $curNode->next->data . '->';
            $curNode = $curNode->next;
        }
        echo 'NULL' . PHP_EOL;
    }
}
