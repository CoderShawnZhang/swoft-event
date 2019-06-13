<?php
/**
 * 注解处理器
 * 
 * 扫描器 扫描到了 使用了我对应mapping里的Listener注解器的类，调用$this->parser 返回这个类的 名称和需要生成对象的存放类型
 *
 * 都是，自己处理，然后你要我给的逻辑，
 */
namespace SwoftRewrite\Event\Annotation\Parser;

use SwoftRewrite\Annotation\Annotation\Mapping\AnnotationParser;
use SwoftRewrite\Annotation\Annotation\Parser\Parser;
use SwoftRewrite\Bean\Annotation\Mapping\Bean;
use SwoftRewrite\Event\Annotation\Mapping\Listener;
use SwoftRewrite\Event\ListenerRegister;

/**
 * @AnnotationParser(Listener::class)
 */
class ListenerParser extends Parser
{
    /**
     * @param int $type
     * @param Listener $annotationObject
     */
    public function parse(int $type, $annotationObject)
    {
        //扫描到有类绑定了事件，将事件加入管理器
        ListenerRegister::addListener($this->className,[$annotationObject->getEvent() => $annotationObject->getPriority()]);

        /**
         *  主要以，第三个参数这只，该解析器解析的类 $this->className 是单例，会在容器创建对象时放到$this->singletonPool保管
         */
        return [$this->className,$this->className,Bean::SINGLETON,4];
    }
}