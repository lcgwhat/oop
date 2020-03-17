<?php
/**
 * LinkeList.php
 * @author liuchg
 */

namespace app\algo\linkedist;


class LinkList
{
    private $length;

    public $head;

    /**
     * 初始化链表
     * LinkList constructor.
     * @param null $head
     */
    public function __construct($head = null)
    {
        if (null == $head) {
            $this->head = new ListNode();
        } else {
            $this->head = $head;
        }

        $this->length = 0;
    }

    /**
     * 返回链表长度
     * @return int
     */
    public function getLength() {
        return $this->length;
    }

    /**
     * 插入数据 采用头插法 插入新数据
     * @param $data
     * @return ListNode|bool
     */
    public function insert($data) {
        return $this->insertDataAfter($this->head, $data);
    }

    /**
     * 删除节点
     * @param ListNode $node
     * @return bool
     */
    public function delete(ListNode $node) {
        if (is_null($node)) {
            return false;
        }

        // 获取待删除节点的前置节点
        $preNode = $this->getPreNode($node);
        if (empty($preNode)) {
            return false;
        }

        // 修改指针引向
        $preNode->next = $node->next;
        unset($node);

        $this->length--;
        return true;
    }

    /**
     * 通过索引获取节点
     * @param $index
     * @return null
     */
    public function getNodeByIndex($index) {
        if ($index >= $this->length) {
            return null;
        }
        $cur = $this->head->next;
        for ($i=0; $i<$index; $i++) {
            $cur = $cur->next;
        }

        return $cur;
    }

    /**
     * 输出单链表 当data的数据为可输出类型
     *
     * @return bool
     */
    public function printList(){
        if (is_null($this->head->next)) {
            return false;
        }

        $curNode = $this->head;
        // 防止链表带环，控制遍历次数
        $listLength = $this->getLength();
        while (!is_null($curNode->next) && $listLength--) {
            echo $curNode->next->data . '->';
            $curNode = $curNode->next;
        }
        echo 'NULL' . PHP_EOL;

        return true;
    }
    /**
     * 在某个节点后插入新数据
     * @param ListNode $originNode
     * @param $data
     * @return ListNode|bool
     */
    public function insertDataAfter(ListNode $originNode, $data) {
        //
        if (is_null($originNode)) {
            return false;
        }
        // 新建单链表节点
        $newNode = new ListNode();
        // 新节点的数据
        $newNode->data = $data;

        // 新节点的下节点为源节点的下节点
        $newNode->next = $originNode->next;
        // 在originNode后插入newNode
        $originNode->next = $newNode;

        // 链表长度++
        $this->length++;

        return $newNode;
    }

    /**
     * 在某个节点后插入新的节点
     * @param ListNode $originNode
     * @param ListNode $node
     * @return ListNode|bool
     */
    public function insertNodeAfter(ListNode $originNode, ListNode $node) {
        // 如果originNode为空，插入失败
        if (is_null($originNode)) {
            return false;
        }
        $node->next = $originNode->next;
        $originNode->next = $node;

        $this->length++;

        return $node;
    }
    /**
     * 获取某个节点的前置节点
     * @param ListNode $node
     * @return bool|null
     */
    private function getPreNode(ListNode $node)
    {
        if(is_null($node)) {
            return false;
        }
        $curNode = $this->head;
        $preNode = $this->head;
        // 遍历找到前置节点 要用全等判断是否是同一个对象
        while ($curNode !== $node) {
            if (is_null($curNode)) {
                return false;
            }
            $preNode = $curNode;
            $curNode = $curNode->next;
        }

        return $preNode;
    }

    public function buildCircleList() {
        $data = range(1,8);
        foreach ($data as $k=>$v) {
            $node{$k} = new ListNode($v);
        }
        for ($v=0; $v<count($data); $v++) {
            if ($v==0) {
                $this->insertNodeAfter($this->head, $node{$v});
            } else {
                $this->insertNodeAfter($node{$v-1}, $node{$v});
            }
        }
        $node{$v-1}->next = null;
    }
}
