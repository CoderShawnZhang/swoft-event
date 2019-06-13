<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/5
 * Time: 下午4:47
 */
namespace SwoftRewrite\Event;

use SwoftRewrite\Bean\BeanFactory;
use SwoftRewrite\Event\Manager\EventManager;
use SwoftRewrite\Framework\Swoft;

final class ListenerRegister
{
    private static $listeners = [];

    private static $subscribers = [];


    public static function register(EventManager $em)
    {
        //将扫描到的事件监听器 注册到 事件管理器中，在事件管理器中把 监听 列表使用队列
        foreach(self::$listeners as $className => $eventInfo){
            $bindListenerObj = BeanFactory::getSingleton($className);//绑定了Listener 类对象
            $em->addListener($bindListenerObj,$eventInfo);
        }
        

        $count1 = count(self::$listeners);
        $count2 = count(self::$subscribers);
        self::$listeners = self::$subscribers = [];
        return [$count1,$count2];
    }

    /**
     * 注册监听
     * @param string $className
     * @param array $definition
     */
    public static function addListener(string $className,array $definition = [])
    {
        self::$listeners[$className] = $definition;
    }

    /**
     * 注册订阅
     * @param string $className
     */
    public static function addSubscriber(string $className)
    {
        self::$subscribers[] = $className;
    }
}