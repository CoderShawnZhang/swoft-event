<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/5
 * Time: 下午4:47
 */
namespace SwoftRewrite;

use SwoftRewrite\Manager\EventManager;

final class ListenerRegister
{
    private static $listeners = [];

    private static $subscribers = [];


    public static function register(EventManager $em)
    {

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