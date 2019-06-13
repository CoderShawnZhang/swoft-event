<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/11
 * Time: 下午3:19
 */

namespace SwoftRewrite\Event;


use SwoftRewrite\Framework\SwoftComponent;

class AutoLoader extends SwoftComponent
{
    public function getPrefixDirs()
    {
        return [
            __NAMESPACE__ => __DIR__,
        ];
    }
}