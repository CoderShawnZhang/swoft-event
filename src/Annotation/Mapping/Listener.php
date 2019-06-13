<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/11
 * Time: 下午8:23
 */
namespace SwoftRewrite\Event\Annotation\Mapping;

/**
 * @Annotation
 * @Target("CLASS")
 * @Attributes({
 *      @Attribute("event", type="string"),
 * })
 */
final class Listener
{
    private $event = '';

    /**
     * Listener priority value
     *
     * @var int
     */
    private $priority = 0;
    public function __construct(array $values)
    {
        if (isset($values['value'])) {
            $this->event = (string)$values['value'];
        } elseif (isset($values['event'])) {
            $this->event = (string)$values['event'];
        }

        if (isset($values['priority'])) {
            $this->priority = (int)$values['priority'];
        }
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function getPriority()
    {
        return $this->priority;
    }
}