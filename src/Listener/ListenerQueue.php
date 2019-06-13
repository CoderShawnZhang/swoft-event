<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/13
 * Time: 上午9:36
 */
namespace SwoftRewrite\Event\Listener;

class ListenerQueue implements \IteratorAggregate,\Countable
{
    private $store;
    private $counter = PHP_INT_MAX;
    private $queue;

    public function __construct()
    {
        //可实现统计、迭代、序列化、数组式访问等功能。
        //类实现了Countable,Iterator,Serializable,ArrayAccess四个接口
        $this->store = new \SplObjectStorage(); //数据结构对象容器

        //优先队列也是非常实用的一种数据结构，可以通过加权对值进行排序，
        //由于排序在php内部实现，业务代码中将精简不少而且更高效。
        //通过SplPriorityQueue::setExtractFlags(int  $flag)设置提取方式可以提取数据（等同最大堆）、
        //优先级、和两者都提取的方式。
        $this->queue = new \SplPriorityQueue();
    }

    public function add($listener,$priority)
    {
        if(!is_object($listener)){

        }
        if(!$this->has($listener)){
            $priorityData = [(int)$priority,$this->counter--];
            $this->store->attach($listener,$priorityData);
            $this->queue->insert($listener,$priorityData);
        }
        return $this;
    }

    public function has($listener)
    {
        return $this->store->contains($listener);
    }

    /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        return count($this->queue);
    }

    public function getIterator()
    {
        // SplPriorityQueue queue is a heap.
        $queue = clone $this->queue;

        // rewind pointer.
        if (!$queue->isEmpty()) {
            $queue->top();
        }

        return $queue;
    }
}