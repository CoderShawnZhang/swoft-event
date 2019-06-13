<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/5
 * Time: 下午4:48
 */
namespace SwoftRewrite\Event\Manager;

use SwoftRewrite\Bean\Annotation\Mapping\Bean;
use SwoftRewrite\Event\Listener\ListenerQueue;

/**
 * @Bean("eventManager")
 */
class EventManager
{
    /**
     * 存放 队列对象
     * @var array
     */
    protected $listeners = [];

    private $listenedEvents = [];

    public function addListener($listener,$definition = null)
    {
        if(!is_object($listener)){
            if(is_string($listener) && class_exists($listener)){

            } else {
                $listener = 123;
            }
        }

        if($definition){
            foreach ($definition as $name => $priority){
                if(is_int($name)){
                    if(!$priority || !is_string($priority)){
                        continue;
                    }

                    $name = $priority;
                    $priority = 0;
                }

                if(!$name = trim($name,'. ')){
                    continue;
                }

                if(!isset($this->listeners[$name])){
                    $this->listeners[$name] = new ListenerQueue();
                }

                $this->listenedEvents[$name] = 1;
                $this->listeners[$name]->add($listener,$priority);
            }
            return true;
        }
        return false;
    }

    public function trigger($event,$target = null,$args = [])
    {
        //$this->listeners 存放数据监听类对象结构
        $listeners = $this->listeners[$event];
        foreach($listeners as $key => $val){
            $val->handle();//触发绑定事件
        }
    }
}