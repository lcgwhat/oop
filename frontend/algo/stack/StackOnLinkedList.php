<?php
/**
 * StackOnLinkedList.php
 * @author liuchg
 */

namespace app\algo\stack;

use app\algo\linkedist\ListNode;

class StackOnLinkedList
{
    /**
     * 头指针
     * @var ListNode
     */
    public $head;

    /**
     * 长度
     * @var integer
     */
    public $length;

    /**
     * StackOnLinkedList constructor.
     */
    public function __construct()
    {
        $this->head = new ListNode();
        $this->length = 0;
    }

    /**
     * 出栈
     * @return bool
     */
    public function pop() {
        if ($this->length == 0 ) {
            return false;
        }
        $this->head->next = $this->head->next->next;
        $this->length--;

        return true;
    }

    /**
     * 入栈
     * @param $data
     * @return bool
     */
    public function push($data) {
        if ($this->pushData($data)) {
            return true;
        }

        return false;
    }

    /**
     * data 入栈
     * @param $data
     * @return bool
     */
    public function pushData($data) {
        $newNode = new ListNode($data);
        if ($this->pushNode($newNode)) {
            return true;
        }
        return false;
    }

    /**
     * 入栈 node
     * @param ListNode $node
     * @return bool
     */
    public function pushNode(ListNode $node) {
        if (is_null($node)) {
            return false;
        }
        $node->next = $this->head->next;
        $this->head->next = $node;

        $this->length++;

        return true;
    }

    /**
     * @return ListNode|bool|null
     */
    public function top() {
        if ($this->length == 0) {
            return false;
        }
        return $this->head->next;
    }

    /**
     * 打印栈
     */
    public function printSelf() {
        if ($this->length == 0) {
            echo 'empty stack' . PHP_EOL;
            return;
        }
        echo 'head next-> ';
        $curNode = $this->head;
        while ($curNode->next) {
            echo $curNode->next->data . '->';
            $curNode = $curNode->next;
        }
        echo 'NULL'.PHP_EOL;
    }

    /**
     * 返回栈的长度
     * @return int
     */
    public function getLength() {
        return $this->length;
    }

    /**
     * 判断是否为空
     * @return bool
     */
    public function isEmpty() {
        return $this->length > 0?false:true;
    }
}
